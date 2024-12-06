<?php
require_once "../../../dbconnect.php";
session_start();

// Kiểm tra xem có yêu cầu cập nhật trạng thái đơn hàng không
if (isset($_GET['id']) && isset($_GET['status'])) {
    $order_id = $_GET['id'];
    $status = $_GET['status'];

    // Cập nhật trạng thái đơn hàng trong cơ sở dữ liệu
    $query = "UPDATE orders SET status = '$status' WHERE order_id = '$order_id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $_SESSION['success_message'] = "Cập nhật trạng thái đơn hàng thành công.";
    } else {
        $_SESSION['error_message'] = "Có lỗi xảy ra. Vui lòng thử lại sau.";
    }

    // Chuyển hướng trở lại trang quản lý đơn hàng
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý đơn hàng</title>
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
                <h2>Quản lý đơn hàng</h2>

                <?php if (isset($_SESSION['success_message'])) : ?>
                    <div class="alert alert-success"><?php echo $_SESSION['success_message']; ?></div>
                    <?php unset($_SESSION['success_message']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['error_message'])) : ?>
                    <div class="alert alert-danger"><?php echo $_SESSION['error_message']; ?></div>
                    <?php unset($_SESSION['error_message']); ?>
                <?php endif; ?>

                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Mã đơn hàng</th>
                            <th>Ngày đặt hàng</th>
                            <th>Tổng số tiền</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Truy vấn dữ liệu từ bảng orders
                        $query = "SELECT order_id, order_date, total_amount, `status` FROM orders";
                        $result = mysqli_query($conn, $query);

                        if (!$result) {
                            die("Có lỗi xảy ra: " . mysqli_error($conn));
                        }

                        if (mysqli_num_rows($result) > 0) {
                            $count = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $count . "</td>";
                                echo "<td>" . $row['order_id'] . "</td>";
                                echo "<td>" . $row['order_date'] . "</td>";
                                echo "<td>" . number_format($row['total_amount'], 0, ',', '.') . "</td>";
                                echo "<td>" . $row['status'] . "</td>";
                                echo "<td>
                                        <a href='view.php?id=" . $row['order_id'] . "' class='btn btn-primary btn-sm'>
                                            <i class='fas fa-eye'></i> Xem chi tiết
                                        </a>
                                        <a href='update.php?id=" . $row['order_id'] . "&status=Đang giao hàng' class='btn btn-success btn-sm'>
                                            <i class='fas fa-truck'></i> Đang giao hàng
                                        </a>
                                        <a href='update.php?id=" . $row['order_id'] . "&status=Đã hoàn thành' class='btn btn-info btn-sm'>
                                            <i class='fas fa-check'></i> Đã hoàn thành
                                        </a>
                                        <a href='delete.php?id=" . $row['order_id'] . "' class='btn btn-danger btn-sm'>
                                        <i class='fas fa-trash'></i> Xóa
                                    </a>
                                    </td>";
                                echo "</tr>";
                                $count++;
                            }
                        } else {
                            echo "<tr><td colspan='6'>Không có đơn hàng nào.</td></tr>";
                        }

                        // Giải phóng bộ nhớ và đóng kết nối CSDL
                        mysqli_free_result($result);
                        mysqli_close($conn);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5.2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
