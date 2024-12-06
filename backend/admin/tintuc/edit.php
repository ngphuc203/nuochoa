<?php
require_once "../../../dbconnect.php";
session_start();

// Kiểm tra xem ID tin tức đã được truyền vào hay chưa
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$news_id = $_GET['id'];

// Lấy thông tin tin tức từ CSDL để hiển thị trong form
$sql = "SELECT * FROM news WHERE news_id = '$news_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Kiểm tra xem tin tức có tồn tại hay không
if (!$row) {
    header('Location: index.php');
    exit();
}

// Xử lý logic khi người dùng submit form
if (isset($_POST['submit'])) {
    // Lấy thông tin từ form
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Kiểm tra và xử lý upload ảnh mới
    if ($_FILES['image']['name'] !== '') {
        $image = $_FILES['image']['name'];
        $targetDir = "../../core/uploads/tintuc/";
        $targetFile = $targetDir . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);

        // Xóa ảnh cũ (nếu có)
        if ($row['image'] !== '') {
            unlink($targetDir . $row['image']);
        }
    } else {
        $image = $row['image'];
    }

    // Cập nhật thông tin tin tức trong CSDL
    $updateSql = "UPDATE news SET title = '$title', content = '$content', image = '$image' WHERE news_id = '$news_id'";
    $updateResult = mysqli_query($conn, $updateSql);

    if ($updateResult) {
        $_SESSION['success_message'] = 'Cập nhật tin tức thành công!';
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['error_message'] = 'Có lỗi xảy ra. Vui lòng thử lại sau.';
        header("Location: edit.php?id=$news_id");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa tin tức</title>
    <!-- Bootstrap 5.2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <!-- Font Awesome 5.15 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- CKEditor 5 -->
    <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-3">
                <?php require_once "../../layouts/sidebar.php"; ?>
            </div>
            <div class="col-9">
                <h2>Chỉnh sửa tin tức</h2>

                <?php if (isset($_SESSION['error_message'])) : ?>
                    <div class="alert alert-danger"><?php echo $_SESSION['error_message']; ?></div>
                    <?php unset($_SESSION['error_message']); ?>
                <?php endif; ?>

                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="title" class="form-label">Tiêu đề</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?php echo $row['title']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Nội dung</label>
                        <textarea id="content" name="content"><?php echo $row['content']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Ảnh</label>
                        <input type="file" class="form-control" id="image" name="image">
                        <?php if ($row['image'] !== '') : ?>
                            <img src="../../core/uploads/tintuc/<?php echo $row['image']; ?>" alt="Image" width="150">
                        <?php endif; ?>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Cập nhật</button>
                    <a href="index.php" class="btn btn-secondary">Hủy</a>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5.2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- CKEditor 5 -->
    <script>
        ClassicEditor
            .create(document.querySelector('#content'))
            .catch(error => {
                console.error(error);
            });
    </script>
</body>

</html>
