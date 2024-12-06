<?php
require_once "../../../dbconnect.php";
session_start();

// Kiểm tra nếu không có tham số id trong URL
if (!isset($_GET['id'])) {
    $_SESSION['error_message'] = "Không tìm thấy đơn hàng.";
    header("Location: index.php");
    exit;
}

$orderID = $_GET['id'];

// Truy vấn thông tin đơn hàng
$query = "SELECT * FROM orders WHERE order_id = $orderID";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Có lỗi xảy ra: " . mysqli_error($conn));
}

// Kiểm tra nếu không có dữ liệu trả về
if (mysqli_num_rows($result) == 0) {
    $_SESSION['error_message'] = "Không tìm thấy đơn hàng.";
    header("Location: index.php");
    exit;
}

$row = mysqli_fetch_assoc($result);

// Truy vấn thông tin chi tiết đơn hàng
$query = "SELECT order_details.*, products.name AS product_name, products.price AS product_price 
          FROM order_details 
          INNER JOIN products ON order_details.product_id = products.product_id
          WHERE order_id = $orderID";
$detailResult = mysqli_query($conn, $query);

if (!$detailResult) {
    die("Có lỗi xảy ra: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xem chi tiết đơn hàng</title>
    <!-- Bootstrap 5.2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <!-- Font Awesome 5.15 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-3">
                <?php require_once "../../layouts/sidebar.php"; ?>
            </div>
            <div class="col-9">
                <h2>Xem chi tiết đơn hàng #<?php echo $row['order_id']; ?></h2>

                <?php if (isset($_SESSION['error_message'])) : ?>
                    <div class="alert alert-danger"><?php echo $_SESSION['error_message']; ?></div>
                    <?php unset($_SESSION['error_message']); ?>
                <?php endif; ?>

                <div class="mb-3">
                    <h4>Thông tin đơn hàng</h4>
                    <p><strong>Mã đơn hàng:</strong> <?php echo $row['order_id']; ?></p>
                    <p><strong>Tên khách hàng:</strong> <?php echo $row['name']; ?></p>
                    <p><strong>Địa chỉ:</strong> <?php echo $row['address']; ?></p>
                    <p><strong>Số điện thoại:</strong> <?php echo $row['phone']; ?></p>
                    <p><strong>Ngày đặt hàng:</strong> <?php echo $row['order_date']; ?></p>
                    <p><strong>Tổng số tiền:</strong> <?php echo number_format($row['total_amount'], 0, ',', '.'); ?></p>
                    <p><strong>Trạng thái:</strong> <?php echo $row['status']; ?></p>
                </div>

                <div>
                    <h4>Chi tiết đơn hàng</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên sản phẩm</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $totalAmount = 0;
                            $counter = 1;
                            while ($detailRow = mysqli_fetch_assoc($detailResult)) :
                                $productPrice = $detailRow['product_price'];
                                $quantity = $detailRow['quantity'];
                                $subtotal = $productPrice * $quantity;
                                $totalAmount += $subtotal;
                            ?>
                                <tr>
                                    <td><?php echo $counter++; ?></td>
                                    <td><?php echo $detailRow['product_name']; ?></td>
                                    <td><?php echo $productPrice; ?></td>
                                    <td><?php echo $quantity; ?></td>
                                    <td><?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4">Tổng cộng</th>
                                <th><?php echo number_format($totalAmount, 0, ',', '.'); ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
