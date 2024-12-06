<?php
session_start();

// Kiểm tra xem người dùng đã bấm nút Đặt hàng chưa
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['cart'])) {
    // Kiểm tra các trường thông tin người đặt hàng
    if (isset($_POST['name']) && isset($_POST['address']) && isset($_POST['phone'])) {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];

        // Thực hiện lưu thông tin đặt hàng vào CSDL
        include_once __DIR__ . "/dbconnect.php";

        // Tạo câu truy vấn để chèn dữ liệu vào bảng orders
        $query = "INSERT INTO orders (order_date, total_amount, status, name, address, phone)
                  VALUES (NOW(), 0, 'Đang xử lý', '$name', '$address', '$phone')";

        // Thực thi câu truy vấn
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Lấy order_id mới được tạo
            $order_id = mysqli_insert_id($conn);

            // Lặp qua các sản phẩm trong giỏ hàng để lưu thông tin chi tiết đơn hàng
            foreach ($_SESSION['cart'] as $product_id => $quantity) {
                // Lấy thông tin sản phẩm từ CSDL
                $query = "SELECT price FROM products WHERE product_id = '$product_id'";
                $result = mysqli_query($conn, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $price = floatval($row['price']); // Chuyển đổi sang kiểu số

                    // Tính toán tổng số tiền cho mỗi sản phẩm
                    $subtotal = $price * $quantity;

                    // Tạo câu truy vấn để chèn dữ liệu vào bảng order_details
                    $query = "INSERT INTO order_details (order_id, product_id, quantity, price)
                              VALUES ('$order_id', '$product_id', '$quantity', '$price')";

                    // Thực thi câu truy vấn
                    mysqli_query($conn, $query);
                }
            }

            // Cập nhật tổng số tiền cho đơn hàng
            $query = "UPDATE orders SET total_amount = (SELECT SUM(price * quantity) FROM order_details WHERE order_id = '$order_id')
                      WHERE order_id = '$order_id'";
            mysqli_query($conn, $query);

            // Xóa thông tin giỏ hàng sau khi đặt hàng thành công
            unset($_SESSION['cart']);

            // Chuyển hướng về trang giỏ hàng với thông báo đặt hàng thành công
            header("Location: cart.php?order_success=true");
            exit();
        } else {
            // Đặt hàng không thành công
            echo "Đặt hàng không thành công. Vui lòng thử lại.";
        }

        // Đóng kết nối CSDL
        mysqli_close($conn);
    } else {
        echo "Vui lòng nhập đầy đủ thông tin người đặt hàng.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/favicon.png">
    <title>Đặt hàng</title>
    <?php
    include_once __DIR__ . "/styles.php";
    ?>
</head>
<body>
    <div class="wrapper">
        <?php
        include_once __DIR__ . "/fontend/layouts/header.php";
        ?>
        <div class="container_fullwidth">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Đặt hàng</h1>
                        <form action="checkout.php" method="post">
                            <div class="form-group">
                                <label for="name">Họ và tên:</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Địa chỉ:</label>
                                <input type="text" name="address" id="address" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Số điện thoại:</label>
                                <input type="text" name="phone" id="phone" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Đặt hàng</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
        include_once __DIR__ . "/fontend/layouts/footer.php";
        ?>
    </div>
    <?php
    include_once __DIR__ . "/scripts.php";
    ?>
</body>
</html>
