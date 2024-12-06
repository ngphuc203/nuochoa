<?php
require_once "../../../dbconnect.php";
session_start();

// Kiểm tra nếu người dùng submit form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $brand_id = $_POST['brand_id'];
    $origin_id = $_POST['origin_id'];

    // Kiểm tra xem người dùng đã chọn hình ảnh mới hay không
    $update_image = false;
    $image = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $update_image = true;
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $upload_path = "../../core/uploads/img/";
        $image_extension = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
        $image = date('Ymd') . '_' . $image_name;
        move_uploaded_file($image_tmp, $upload_path . $image);
    }

    // Thực hiện truy vấn để cập nhật thông tin sản phẩm trong CSDL
    $update_sql = "UPDATE products SET name='$name', description='$description', price='$price', category_id='$category_id', brand_id='$brand_id', origin_id='$origin_id'";

    if ($update_image) {
        // Nếu người dùng đã chọn hình ảnh mới, cập nhật đường dẫn hình ảnh
        $update_sql .= ", image='$image'";
    }

    $update_sql .= " WHERE product_id='$product_id'";

    $result = mysqli_query($conn, $update_sql);

    if ($result) {
        $_SESSION['success_message'] = 'Cập nhật thông tin sản phẩm thành công!';
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['error_message'] = 'Có lỗi xảy ra: ' . mysqli_error($conn);
        header('Location: index.php');
        exit();
    }
}

// Kiểm tra xem đã nhận được product_id từ URL hay chưa
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Lấy thông tin sản phẩm từ CSDL dựa trên product_id
    $sql = "SELECT * FROM products WHERE product_id='$product_id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $description = $row['description'];
        $price = $row['price'];
        $category_id = $row['category_id'];
        $brand_id = $row['brand_id'];
        $origin_id = $row['origin_id'];
    } else {
        echo "Không tìm thấy sản phẩm!";
        exit();
    }
} else {
    echo "Không có sản phẩm nào được xác định!";
    exit();
}

mysqli_close($conn);
?>
