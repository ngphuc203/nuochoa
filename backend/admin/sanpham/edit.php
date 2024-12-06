<?php
require_once "../../../dbconnect.php";
session_start();

// Kiểm tra xem đã nhận được product_id từ URL hay chưa
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

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
        $image = $row['image'];
    } else {
        echo "Không tìm thấy sản phẩm!";
        exit();
    }
} else {
    echo "Không có sản phẩm nào được chỉ định!";
    exit();
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
    <title>Chỉnh sửa sản phẩm</title>
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
                <h2>Chỉnh sửa sản phẩm</h2>

                <form method="POST" action="update.php" enctype="multipart/form-data">
                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="name" name="name" required value="<?php echo $name; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Mô tả</label>
                        <textarea class="form-control" id="description" name="description" rows="3"><?php echo $description; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Giá</label>
                        <input type="number" class="form-control" id="price" name="price" required value="<?php echo $price; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Hình ảnh</label>
                        <input type="file" class="form-control" id="image" name="image">
                        <img src="<?php echo $image; ?>" alt="Product Image" class="mt-2" style="max-width: 200px;">
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Danh mục</label>
                        <select class="form-select" id="category" name="category_id" required>
                            <?php while ($categoryRow = mysqli_fetch_assoc($categoryResult)) : ?>
                                <option value="<?php echo $categoryRow['category_id']; ?>" <?php echo ($categoryRow['category_id'] == $category_id) ? 'selected' : ''; ?>>
                                    <?php echo $categoryRow['name']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="brand" class="form-label">Thương hiệu</label>
                        <select class="form-select" id="brand" name="brand_id" required>
                            <?php while ($brandRow = mysqli_fetch_assoc($brandResult)) : ?>
                                <option value="<?php echo $brandRow['brand_id']; ?>" <?php echo ($brandRow['brand_id'] == $brand_id) ? 'selected' : ''; ?>>
                                    <?php echo $brandRow['name']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="origin" class="form-label">Xuất xứ</label>
                        <select class="form-select" id="origin" name="origin_id" required>
                            <?php while ($originRow = mysqli_fetch_assoc($originResult)) : ?>
                                <option value="<?php echo $originRow['origin_id']; ?>" <?php echo ($originRow['origin_id'] == $origin_id) ? 'selected' : ''; ?>>
                                    <?php echo $originRow['name']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu</button>
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
</script>

</body>

</html>
