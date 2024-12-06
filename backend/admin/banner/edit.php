<?php
require_once "../../../dbconnect.php";
session_start();

// Kiểm tra xem ID banner đã được truyền vào hay chưa
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$banner_id = $_GET['id'];

// Lấy thông tin banner từ CSDL để hiển thị trên trang chỉnh sửa
$sql = "SELECT * FROM banners WHERE banner_id = '$banner_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Kiểm tra xem banner có tồn tại hay không
if (!$row) {
    header('Location: index.php');
    exit();
}

// Xử lý logic khi người dùng cập nhật thông tin banner
if (isset($_POST['update'])) {
    // Kiểm tra xem người dùng đã chọn file ảnh mới hay chưa
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Lấy thông tin file ảnh mới
        $file = $_FILES['image'];
        $fileName = $file['name'];
        $fileTmpPath = $file['tmp_name'];
        $fileSize = $file['size'];

        // Kiểm tra định dạng file ảnh
        $allowedExtensions = array('jpg', 'jpeg', 'png');
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
            $_SESSION['error_message'] = "Chỉ chấp nhận file ảnh định dạng JPG, JPEG, PNG!";
            header('Location: edit.php?id=' . $banner_id);
            exit();
        }

        // Kiểm tra kích thước file ảnh (giới hạn là 2MB)
        $maxFileSize = 2 * 1024 * 1024; // 2MB
        if ($fileSize > $maxFileSize) {
            $_SESSION['error_message'] = "Kích thước file ảnh vượt quá giới hạn cho phép (2MB)!";
            header('Location: edit.php?id=' . $banner_id);
            exit();
        }

        // Tạo tên file mới để lưu trữ trên server (đảm bảo tên file là duy nhất)
        $newFileName = uniqid('banner_', true) . '.' . $fileExtension;

        // Di chuyển file ảnh mới vào thư mục lưu trữ
        $uploadDir = "../../core/uploads/banner/";
        $destination = $uploadDir . $newFileName;
        if (!move_uploaded_file($fileTmpPath, $destination)) {
            $_SESSION['error_message'] = "Có lỗi xảy ra khi tải lên file ảnh!";
            header('Location: edit.php?id=' . $banner_id);
            exit();
        }

        // Xóa file ảnh cũ nếu tồn tại
        if (!empty($row['image'])) {
            $oldFilePath = $uploadDir . $row['image'];
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }
    } else {
        // Sử dụng lại tên file ảnh cũ
        $newFileName = $row['image'];
    }

    // Cập nhật thông tin banner trong CSDL
    $updateSql = "UPDATE banners SET image = '$newFileName' WHERE banner_id = '$banner_id'";
    $updateResult = mysqli_query($conn, $updateSql);

    if ($updateResult) {
        $_SESSION['success_message'] = 'Cập nhật thông tin banner thành công!';
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['error_message'] = 'Có lỗi xảy ra khi cập nhật thông tin banner!';
        header('Location: edit.php?id=' . $banner_id);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa banner</title>
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
                <h2>Chỉnh sửa banner</h2>

                <?php if (isset($_SESSION['error_message'])) : ?>
                    <div class="alert alert-danger"><?php echo $_SESSION['error_message']; ?></div>
                    <?php unset($_SESSION['error_message']); ?>
                <?php endif; ?>

                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="image" class="form-label">Ảnh banner</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    </div>
                    <button type="submit" name="update" class="btn btn-primary">Cập nhật</button>
                </form>

                <?php if (!empty($row['image'])) : ?>
                    <h4>Ảnh banner hiện tại:</h4>
                    <img src="../../core/uploads/banner/<?php echo $row['image']; ?>" alt="Banner Image" width="200">
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5.2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
