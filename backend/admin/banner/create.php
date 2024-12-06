<?php
require_once "../../../dbconnect.php";
session_start();

// Kiểm tra xem người dùng đã nhấn nút tạo mới hay chưa
if (isset($_POST['create'])) {
    // Kiểm tra xem đã chọn file ảnh hay chưa
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Lấy thông tin file ảnh
        $file = $_FILES['image'];
        $fileName = $file['name'];
        $fileTmpPath = $file['tmp_name'];
        $fileSize = $file['size'];

        // Kiểm tra định dạng file ảnh
        $allowedExtensions = array('jpg', 'jpeg', 'png');
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
            $_SESSION['error_message'] = "Chỉ chấp nhận file ảnh định dạng JPG, JPEG, PNG!";
            header('Location: create.php');
            exit();
        }

        // Kiểm tra kích thước file ảnh (giới hạn là 2MB)
        $maxFileSize = 2 * 1024 * 1024; // 2MB
        if ($fileSize > $maxFileSize) {
            $_SESSION['error_message'] = "Kích thước file ảnh vượt quá giới hạn cho phép (2MB)!";
            header('Location: create.php');
            exit();
        }

        // Tạo tên file mới để lưu trữ trên server (đảm bảo tên file là duy nhất)
        $newFileName = uniqid('banner_', true) . '.' . $fileExtension;

        // Di chuyển file ảnh vào thư mục lưu trữ
        $uploadDir = "../../core/uploads/banner/";
        $destination = $uploadDir . $newFileName;
        if (!move_uploaded_file($fileTmpPath, $destination)) {
            $_SESSION['error_message'] = "Có lỗi xảy ra khi tải lên file ảnh!";
            header('Location: create.php');
            exit();
        }
    } else {
        $_SESSION['error_message'] = "Vui lòng chọn file ảnh!";
        header('Location: create.php');
        exit();
    }

    // Lưu thông tin banner vào CSDL
    $sql = "INSERT INTO banners (image) VALUES ('$newFileName')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $_SESSION['success_message'] = "Tạo mới banner thành công!";
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['error_message'] = "Có lỗi xảy ra khi tạo mới banner: " . mysqli_error($conn);
        header('Location: create.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo mới banner</title>
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
                <h2>Tạo mới banner</h2>

                <?php if (isset($_SESSION['error_message'])) : ?>
                    <div class="alert alert-danger"><?php echo $_SESSION['error_message']; ?></div>
                    <?php unset($_SESSION['error_message']); ?>
                <?php endif; ?>

                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="image" class="form-label">Ảnh banner</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                    </div>
                    <button type="submit" name="create" class="btn btn-primary">Tạo mới</button>
                </form>

                <?php if (isset($newFileName)) : ?>
                    <h4>Hình ảnh banner đã tải lên:</h4>
                    <img src="../../core/uploads/banner/<?php echo $newFileName; ?>" alt="Banner Image" width="200">
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5.2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
