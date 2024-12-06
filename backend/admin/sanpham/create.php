<?php
require_once "../../../dbconnect.php";
session_start();

// Kiểm tra nếu người dùng submit form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $brand_id = $_POST['brand_id'];
    $origin_id = $_POST['origin_id'];

    // Xử lý tải lên hình ảnh
    $image = '';
    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $upload_path = "../../core/uploads/img/";
        $image_extension = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
        $image = date('YmdHis') . '.' . $image_extension;
        move_uploaded_file($image_tmp, $upload_path . $image);
    }

    // Thực hiện truy vấn để tạo sản phẩm mới trong CSDL
    $sql = "INSERT INTO products (name, description, price, image, category_id, brand_id, origin_id)
            VALUES ('$name', '$description', '$price', '$image', '$category_id', '$brand_id', '$origin_id')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $_SESSION['success_message'] = 'Thêm sản phẩm thành công!';
        header('Location: index.php');
        exit();
    } else {
        echo "Có lỗi xảy ra: " . mysqli_error($conn);
    }
}

// Lấy danh sách danh mục, thương hiệu và xuất xứ từ CSDL để hiển thị trong form
$categorySql = "SELECT * FROM categories";
$categoryResult = mysqli_query($conn, $categorySql);

$brandSql = "SELECT * FROM brands";
$brandResult = mysqli_query($conn, $brandSql);

$originSql = "SELECT * FROM origins";
$originResult = mysqli_query($conn, $originSql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm</title>
    <!-- Bootstrap 5.2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/27.0.0/classic/ckeditor.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-3">
                <?php require_once "../../layouts/sidebar.php"; ?>
            </div>
            <div class="col-9">
                <h2>Thêm sản phẩm</h2>

                <?php if (isset($_SESSION['success_message'])) : ?>
                    <div class="alert alert-success"><?php echo $_SESSION['success_message']; ?></div>
                    <?php unset($_SESSION['success_message']); ?>
                <?php endif; ?>

                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Giá</label>
                            <input type="number" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Danh mục</label>
                            <select class="form-select" id="category" name="category_id" required>
                                <option value="">Chọn danh mục</option>
                                <?php
                                if (mysqli_num_rows($categoryResult) > 0) {
                                    while ($row = mysqli_fetch_assoc($categoryResult)) {
                                        echo "<option value='" . $row['category_id'] . "'>" . $row['name'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="brand" class="form-label">Thương hiệu</label>
                            <select class="form-select" id="brand" name="brand_id" required>
                                <option value="">Chọn thương hiệu</option>
                                <?php
                                if (mysqli_num_rows($brandResult) > 0) {
                                    while ($row = mysqli_fetch_assoc($brandResult)) {
                                        echo "<option value='" . $row['brand_id'] . "'>" . $row['name'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="origin" class="form-label">Xuất xứ</label>
                            <select class="form-select" id="origin" name="origin_id" required>
                                <option value="">Chọn xuất xứ</option>
                                <?php
                                if (mysqli_num_rows($originResult) > 0) {
                                    while ($row = mysqli_fetch_assoc($originResult)) {
                                        echo "<option value='" . $row['origin_id'] . "'>" . $row['name'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Hình ảnh</label>
                            <input type="file" class="form-control" id="image" name="image" onchange="previewImage(event)">
                            <div class="mt-2">
                                <img id="image-preview" src="#" alt="Hình ảnh sản phẩm" style="max-width: 200px; max-height: 200px; display: none;">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm</button>
                        <a href="index.php" class="btn btn-secondary">Hủy</a>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5.2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Khởi tạo CKEditor 5 cho phần mô tả
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });

        function previewImage(event) {
            var input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('image-preview').style.display = 'block';
                    document.getElementById('image-preview').src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>

</html>