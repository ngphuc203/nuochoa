<?php
require_once "dbconnect.php";
session_start();

// Kiểm tra xem số điện thoại đã được nhập vào hay chưa
if (isset($_POST['phone_number']) && !empty($_POST['phone_number'])) {
    $phone_number = $_POST['phone_number'];

    // Truy vấn thông tin đơn hàng dựa trên số điện thoại
    $query = "SELECT * FROM orders WHERE phone = '$phone_number'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Có lỗi xảy ra: " . mysqli_error($conn));
    }

    // Kiểm tra xem có đơn hàng tương ứng hay không
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Thông tin đơn hàng</title>
            <!-- Bootstrap 5.2 CSS -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
            <!-- Font Awesome 5.15 CSS -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        </head>

        <body>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Thông tin đơn hàng</h2>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Tên khách hàng:</th>
                                    <td><?php echo $row['name']; ?></td>
                                </tr>
                                <tr>
                                    <th>Số điện thoại:</th>
                                    <td><?php echo $row['phone']; ?></td>
                                </tr>
                                <tr>
                                    <th>Địa chỉ:</th>
                                    <td><?php echo $row['address']; ?></td>
                                </tr>
                                <tr>
                                    <th>Trạng thái:</th>
                                    <td><?php echo $row['status']; ?></td>
                                </tr>
                                <tr>
                                    <th>Tổng số tiền:</th>
                                    <td><?php echo $row['total_amount']; ?></td>
                                </tr>
                            </tbody>
                        </table>

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
                                // Truy vấn chi tiết đơn hàng
                                $orderID = $row['order_id'];
                                $detailQuery = "SELECT order_details.*, products.name AS product_name FROM order_details JOIN products ON order_details.product_id = products.product_id WHERE order_id = '$orderID'";
                                $detailResult = mysqli_query($conn, $detailQuery);

                                if (!$detailResult) {
                                    die("Có lỗi xảy ra: " . mysqli_error($conn));
                                }

                                $subTotal = 0;
                                $count = 1;

                                // Hiển thị chi tiết đơn hàng
                                while ($detailRow = mysqli_fetch_assoc($detailResult)) {
                                    $productName = $detailRow['product_name'];
                                    $price = $detailRow['price'];
                                    $quantity = $detailRow['quantity'];
                                    $subtotal = $price * $quantity;
                                    $subTotal += $subtotal;

                                    echo "<tr>";
                                    echo "<td>$count</td>";
                                    echo "<td>$productName</td>";
                                    echo "<td>$price VNĐ</td>";
                                    echo "<td>$quantity</td>";
                                    echo "<td>$subtotal VNĐ</td>";
                                    echo "</tr>";

                                    $count++;
                                }
                                ?>
                                <tr>
                                    <th colspan="4" class="text-end">Tổng cộng:</th>
                                    <td><?php echo $subTotal; ?> VNĐ</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Bootstrap 5.2 JS -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
        </body>

        </html>
<?php
    } else {
        echo "Không tìm thấy đơn hàng với số điện thoại: $phone_number";
    }
} else {
    echo "Vui lòng nhập số điện thoại để tìm kiếm";
}
?>
