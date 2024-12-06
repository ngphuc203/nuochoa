<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/favicon.png">
    <title>Giỏ hàng</title>
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
                        <h1>Giỏ hàng</h1>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                    <th>Tổng cộng</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Bước 1: Kiểm tra xem có sản phẩm trong giỏ hàng không
                                if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                                    // Bước 2: Kết nối đến cơ sở dữ liệu
                                    include_once __DIR__ . "/dbconnect.php";

                                    // Bước 3: Lặp qua các sản phẩm trong giỏ hàng
                                    foreach ($_SESSION['cart'] as $product_id => $quantity) {
                                        // Bước 4: Lấy thông tin sản phẩm từ cơ sở dữ liệu
                                        $query = "SELECT product_id, name, price FROM products WHERE product_id = '$product_id'";
                                        $result = mysqli_query($conn, $query);

                                        if ($result && mysqli_num_rows($result) > 0) {
                                            $row = mysqli_fetch_assoc($result);
                                            $product_name = $row['name'];
                                            $price = floatval($row['price']); // Chuyển đổi sang kiểu số

                                            // Tăng số lượng sản phẩm nếu đã tồn tại trong giỏ hàng và yêu cầu là POST
                                            if (isset($_SESSION['cart'][$product_id]) && $_SERVER['REQUEST_METHOD'] === 'POST') {
                                                $_SESSION['cart'][$product_id] = intval($_SESSION['cart'][$product_id]) + 1;
                                            }

                                            $quantity = $_SESSION['cart'][$product_id];
                                            $quantity = intval($quantity);
                                            $subtotal = $price * $quantity;

                                            $formatted_price = number_format($price);
                                            $formatted_subtotal = number_format($subtotal);

                                            // Hiển thị thông tin sản phẩm trong giỏ hàng
                                            echo "<tr>";
                                            echo "<td>$product_name</td>";
                                            echo "<td>$quantity</td>";
                                            echo "<td>$formatted_price VNĐ</td>";
                                            echo "<td>$formatted_subtotal VNĐ</td>";
                                            echo "<td><a href='remove_from_cart.php?product_id=$product_id'>Xóa</a></td>";
                                            echo "</tr>";
                                        }
                                    }

                                    // Hiển thị trạng thái của order
                                    $status = isset($_SESSION['cart']['status']) ? $_SESSION['cart']['status'] : '';

                                    echo "<tr>";
                                    echo "<td colspan='4'>Trạng thái đơn hàng: $status</td>";
                                    echo "<td></td>";
                                    echo "</tr>";

                                    // Bước 5: Đóng kết nối
                                    mysqli_close($conn);
                                } else {
                                    // Hiển thị thông báo nếu giỏ hàng trống
                                    echo "<tr><td colspan='5'>Giỏ hàng trống.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php
                        // Kiểm tra xem có sản phẩm trong giỏ hàng hay không
                        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                            // Thêm 3 trường dữ liệu mới vào $_SESSION['cart']
                            $_SESSION['cart']['name'] = '';       // Tên người đặt hàng
                            $_SESSION['cart']['address'] = '';    // Địa chỉ người đặt hàng
                            $_SESSION['cart']['phone'] = '';      // Số điện thoại người đặt hàng
                            $_SESSION['cart']['status'] = 'Đang chờ';     // Trạng thái của order

                            echo '<a class="btn btn-primary" href="checkout.php">Đặt hàng</a>';
                        }
                        ?>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <form action="order.php" method="POST">
                            <div class="form-group">
                                <label for="order_number">Nhập số điện thoại đơn hàng của bạn:</label>
                                <input type="text" class="form-control" id="order_number" name="phone_number">
                            </div>
                            <button type="submit" class="btn btn-primary">Tìm kiếm đơn hàng</button>
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