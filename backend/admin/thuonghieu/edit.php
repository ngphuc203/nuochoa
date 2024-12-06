<?php
require_once "../../../dbconnect.php";
session_start();

// Kiểm tra xem ID thương hiệu đã được truyền vào hay chưa
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$brand_id = $_GET['id'];

// Lấy thông tin thương hiệu từ CSDL để hiển thị trong form chỉnh sửa
$sql = "SELECT * FROM brands WHERE brand_id = '$brand_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Kiểm tra xem thương hiệu có tồn tại hay không
if (!$row) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Kiểm tra xem dữ liệu đã được gửi từ form hay chưa
    if (isset($_POST['name'])) {
        $name = $_POST['name'];

        // Kiểm tra xem tên thương hiệu đã được nhập hay chưa
        if (empty($name)) {
            $_SESSION['error_message'] = 'Vui lòng nhập tên thương hiệu.';
            header("Location: edit.php?id=$brand_id");
            exit();
        }

        // Thực hiện truy vấn cập nhật thông tin thương hiệu vào CSDL
        $updateSql = "UPDATE brands SET name = '$name' WHERE brand_id = '$brand_id'";
        $updateResult = mysqli_query($conn, $updateSql);

        if ($updateResult) {
            $_SESSION['success_message'] = 'Cập nhật thông tin thương hiệu thành công!';
            header('Location: index.php');
            exit();
        } else {
            $_SESSION['error_message'] = 'Có lỗi xảy ra. Vui lòng thử lại sau.';
            header("Location: edit.php?id=$brand_id");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa thương hiệu</title>
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
                <h2>Chỉnh sửa thương hiệu</h2>

                <?php if (isset($_SESSION['error_message'])) : ?>
                    <div class="alert alert-danger"><?php echo $_SESSION['error_message']; ?></div>
                    <?php unset($_SESSION['error_message']); ?>
                <?php endif; ?>

                <form method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên thương hiệu</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <a href="index.php" class="btn btn-secondary">Hủy</a>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5.2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
