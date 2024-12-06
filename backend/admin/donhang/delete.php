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

// Truy vấn xóa đơn hàng
$query = "DELETE FROM orders WHERE order_id = $orderID";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Có lỗi xảy ra: " . mysqli_error($conn));
}

// Kiểm tra số hàng bị ảnh hưởng (được xóa)
if (mysqli_affected_rows($conn) > 0) {
    $_SESSION['success_message'] = "Đơn hàng đã được xóa thành công.";
} else {
    $_SESSION['error_message'] = "Không tìm thấy đơn hàng.";
}

header("Location: index.php");
exit;
?>
