<?php
require_once "../../../dbconnect.php";
session_start();

// Kiểm tra xem ID tin tức đã được truyền vào hay chưa
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$news_id = $_GET['id'];

// Lấy thông tin tin tức từ CSDL để hiển thị trên thông báo xác nhận xóa
$sql = "SELECT * FROM news WHERE news_id = '$news_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Kiểm tra xem tin tức có tồn tại hay không
if (!$row) {
    header('Location: index.php');
    exit();
}

// Xử lý logic khi người dùng xác nhận xóa
if (isset($_POST['delete'])) {
    // Thực hiện truy vấn xóa tin tức trong CSDL
    $deleteSql = "DELETE FROM news WHERE news_id = '$news_id'";
    $deleteResult = mysqli_query($conn, $deleteSql);

    if ($deleteResult) {
        $_SESSION['success_message'] = 'Xóa tin tức thành công!';
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
    <title>Xóa tin tức</title>
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
                <h2>Xóa tin tức</h2>

                <?php if (isset($_SESSION['success_message'])) : ?>
                    <div class="alert alert-success"><?php echo $_SESSION['success_message']; ?></div>
                    <?php unset($_SESSION['success_message']); ?>
                <?php endif; ?>

                <div class="alert alert-danger">
                    <p>Bạn có chắc chắn muốn xóa tin tức sau? Bạn sẽ không thể khôi phục tin tức đã xóa!!!!</p>
                    <p><strong>Tiêu đề:</strong> <?php echo $row['title']; ?></p>
                    <p><strong>Nội dung:</strong> <?php echo $row['content']; ?></p>
                    <?php if ($row['image'] !== '') : ?>
                        <p><strong>Ảnh:</strong></p>
                        <img src="../../core/uploads/tintuc/<?php echo $row['image']; ?>" alt="Image" width="150">
                    <?php endif; ?>
                </div>

                <form method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa tin tức này?')">
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
