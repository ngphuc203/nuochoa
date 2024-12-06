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
} else {
    // Nếu không có thông tin đơn hàng, chuyển hướng trở lại trang quản lý đơn hàng
    header("Location: index.php");
    exit();
}
?>
