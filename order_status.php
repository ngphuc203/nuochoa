<?php
session_start();

// Kiểm tra xem có dữ liệu gửi đi từ form không
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Kiểm tra xem số điện thoại đã được nhập vào hay chưa
    if (isset($_POST['phone_number']) && !empty($_POST['phone_number'])) {
        $phone_number = $_POST['phone_number'];

        // Kiểm tra xem có tồn tại đơn hàng có số điện thoại tương ứng hay không
        if (isset($_SESSION['cart']['phone']) && $_SESSION['cart']['phone'] === $phone_number) {
            $order_number = $_SESSION['cart']['order_number'];
            $status = $_SESSION['cart']['status'];

            echo "Số đơn hàng: $order_number";
            echo "<br>";
            echo "Trạng thái: $status";
        } else {
            echo "Không tìm thấy đơn hàng với số điện thoại: $phone_number";
        }
    } else {
        echo "Vui lòng nhập số điện thoại để tìm kiếm";
    }
} else {
    echo "Phương thức không được hỗ trợ";
}
?>
