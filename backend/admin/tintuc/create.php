<?php
require_once "../../../dbconnect.php";
session_start();

// Kiểm tra xem người dùng đã submit form hay chưa
if (isset($_POST['submit'])) {
    // Lấy thông tin từ form
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Xử lý upload ảnh
    $targetDir = "../../core/uploads/tintuc/";
    $fileName = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Kiểm tra xem file được upload có phải là ảnh không
    $allowTypes = array('jpg', 'jpeg', 'png', 'gif');
    if (in_array($fileType, $allowTypes)) {
        // Upload file lên server
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            // Thêm tin tức vào CSDL
            $sql = "INSERT INTO news (image, title, content) VALUES ('$fileName', '$title', '$content')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $_SESSION['success_message'] = 'Thêm tin tức thành công!';
                header('Location: index.php');
                exit();
            } else {
                $_SESSION['error_message'] = 'Có lỗi xảy ra. Vui lòng thử lại sau.';
                header("Location: create.php");
                exit();
            }
        } else {
            $_SESSION['error_message'] = 'Có lỗi xảy ra. Vui lòng thử lại sau.';
            header("Location: create.php");
            exit();
        }
    } else {
        $_SESSION['error_message'] = 'Chỉ được upload các định dạng JPG, JPEG, PNG và GIF.';
        header("Location: create.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo mới tin tức</title>
    <!-- Bootstrap 5.2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <!-- CKEditor 5 -->
    <script src="https://cdn.ckeditor.com/ckeditor5/27.0.0/classic/ckeditor.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-3">
                <?php require_once "../../layouts/sidebar.php"; ?>
            </div>
            <div class="col-9">
                <h2>Tạo mới tin tức</h2>

                <?php if (isset($_SESSION['error_message'])) : ?>
                    <div class="alert alert-danger"><?php echo $_SESSION['error_message']; ?></div>
                    <?php unset($_SESSION['error_message']); ?>
                <?php endif; ?>

                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="image" class="form-label">Ảnh</label>
                        <input type="file" class="form-control" id="image" name="image" required>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Tiêu đề</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Nội dung</label>
                        <textarea class="form-control" id="content" name="content" rows="5"></textarea>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Thêm tin tức</button>
                </form>
            </div>
        </div>
    </div>

    <!-- CKEditor 5 -->
    <script>
        ClassicEditor
            .create(document.querySelector('#content'))
            .catch(error => {
                console.error(error);
            });
    </script>

    <!-- Bootstrap 5.2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
