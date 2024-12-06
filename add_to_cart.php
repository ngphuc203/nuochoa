<?php
session_start();
?>

<?php
// Bước 1: Kiểm tra xem có sản phẩm ID được gửi từ trang index.php hay không
if (isset($_POST['productId'])) {
   $productId = $_POST['productId'];

   // Bước 2: Kiểm tra xem có giỏ hàng trong phiên hiện tại hay không
   if (!isset($_SESSION['cart'])) {
      $_SESSION['cart'] = array();
   }

   // Bước 3: Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
   if (isset($_SESSION['cart'][$productId])) {
      // Nếu sản phẩm đã tồn tại, tăng số lượng lên 1
      $_SESSION['cart'][$productId]++;
   } else {
      // Nếu sản phẩm chưa tồn tại, thêm vào giỏ hàng với số lượng là 1
      $_SESSION['cart'][$productId] = 1;
   }

   // Bước 4: Trả về phản hồi thành công
   echo "success";
}
?>
