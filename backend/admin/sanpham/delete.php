<?php
require_once "../../../dbconnect.php";
session_start();

// Kiểm tra xem ID sản phẩm đã được truyền vào hay chưa
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$product_id = $_GET['id'];

// Lấy thông tin sản phẩm từ CSDL để hiển thị trên thông báo xác nhận xóa
$sql = "SELECT p.*, c.name AS category_name, b.name AS brand_name
        FROM products p
        LEFT JOIN categories c ON p.category_id = c.category_id
        LEFT JOIN brands b ON p.brand_id = b.brand_id
        WHERE p.product_id = '$product_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Kiểm tra xem sản phẩm có tồn tại hay không
if (!$row) {
    header('Location: index.php');
    exit();
}

// Xử lý logic khi người dùng xác nhận xóa
if (isset($_POST['delete'])) {
    // Xóa hình ảnh liên quan nếu có
    $imagePath = '../../core/uploads/img/' . $row['image'];
    if (file_exists($imagePath)) {
        unlink($imagePath);
    }

    // Thực hiện truy vấn xóa sản phẩm trong CSDL
    $deleteSql = "DELETE FROM products WHERE product_id = '$product_id'";
    $deleteResult = mysqli_query($conn, $deleteSql);

    if ($deleteResult) {
        $_SESSION['success_message'] = 'Xóa sản phẩm thành công!';
        header('Location: index.php');
        exit();
    } else {
        echo "Có lỗi xảy ra: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xóa sản phẩm</title>
    <!-- Bootstrap 5.2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-3">
                <?php require_once "../../layouts/sidebar.php"; ?>
            </div>
            <div class="col-9">
                <h2>Xóa sản phẩm</h2>

                <?php if (isset($_SESSION['success_message'])) : ?>
                    <div class="alert alert-success"><?php echo $_SESSION['success_message']; ?></div>
                    <?php unset($_SESSION['success_message']); ?>
                <?php endif; ?>

                <div class="alert alert-danger">
                    <p>Bạn có chắc chắn muốn xóa sản phẩm sau? Bạn sẽ không thể khôi phục lại sản phẩm đã xóa!!!</p>
                    <p><strong>Tên sản phẩm:</strong> <?php echo $row['name']; ?></p>
                    <p><strong>Mô tả:</strong> <?php echo $row['description']; ?></p>
                    <p><strong>Giá tiền:</strong> <?php echo number_format($row['price']); ?> đ</p>
                    <p><strong>Danh mục:</strong> <?php echo $row['category_name']; ?></p>
                    <p><strong>Thương hiệu:</strong> <?php echo $row['brand_name']; ?></p>
                    <p><strong>Ngày tạo:</strong> <?php echo $row['created_at']; ?></p>
                    <p><strong>Hình ảnh:</strong></p>
                    <img src="../../core/uploads/img/<?php echo $row['image']; ?>" alt="Product Image" width="200">
                </div>

                <form method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                    <button type="submit" name="delete" class="btn btn-danger">Xóa</button>
                    <a href="index.php" class="btn btn-secondary">Hủy</a>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5.2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
