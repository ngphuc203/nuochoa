<?php
session_start();

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng hay không
    if (isset($_SESSION['cart'][$product_id])) {
        // Xóa sản phẩm khỏi giỏ hàng
        unset($_SESSION['cart'][$product_id]);

        // Đặt lại chỉ số mảng của giỏ hàng
        $_SESSION['cart'] = array_values($_SESSION['cart']);

        // Chuyển hướng trở lại trang giỏ hàng
        header("Location: cart.php");
        exit();
    }
}

// Nếu không tìm thấy sản phẩm hoặc không có tham số product_id được truyền vào
// Chuyển hướng trở lại trang giỏ hàng
header("Location: cart.php");
exit();
?>
