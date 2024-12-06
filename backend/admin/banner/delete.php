<?php
require_once "../../../dbconnect.php";
session_start();

// Kiểm tra xem ID banner đã được truyền vào hay chưa
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$banner_id = $_GET['id'];

// Lấy thông tin banner từ CSDL để hiển thị trong thông báo xác nhận xóa
$sql = "SELECT * FROM banners WHERE banner_id = '$banner_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Kiểm tra xem banner có tồn tại hay không
if (!$row) {
    header('Location: index.php');
    exit();
}

// Xử lý logic khi người dùng xác nhận xóa
if (isset($_POST['delete'])) {
    // Xóa banner khỏi CSDL
    $deleteSql = "DELETE FROM banners WHERE banner_id = '$banner_id'";
    $deleteResult = mysqli_query($conn, $deleteSql);

    if ($deleteResult) {
        $_SESSION['success_message'] = 'Xóa banner thành công!';
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['error_message'] = 'Có lỗi xảy ra. Vui lòng thử lại sau.';
        header("Location: delete.php?id=$banner_id");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xóa banner</title>
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
                <h2>Xóa banner</h2>

                <?php if (isset($_SESSION['error_message'])) : ?>
                    <div class="alert alert-danger"><?php echo $_SESSION['error_message']; ?></div>
                    <?php unset($_SESSION['error_message']); ?>
                <?php endif; ?>

                <div class="alert alert-danger">
                    <p>Bạn có chắc chắn muốn xóa banner sau? Bạn sẽ không thể hoàn tác lại hành động này!!!!</p>
                    <p><strong>ID banner:</strong> <?php echo $row['banner_id']; ?></p>
                    <p><strong>Ảnh:</strong></p>
                    <img src="../../core/uploads/banner/<?php echo $row['image']; ?>" alt="Banner Image" width="200">
                </div>

                <form method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa banner này?')">
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
