<?php
require_once "../../../dbconnect.php";
session_start();

// Kiểm tra xem ID xuất xứ đã được truyền vào hay chưa
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$origin_id = $_GET['id'];

// Lấy thông tin xuất xứ từ CSDL để hiển thị trên thông báo xác nhận xóa
$sql = "SELECT * FROM origins WHERE origin_id = '$origin_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Kiểm tra xem xuất xứ có tồn tại hay không
if (!$row) {
    header('Location: index.php');
    exit();
}

// Xử lý logic khi người dùng xác nhận xóa
if (isset($_POST['delete'])) {
    // Thực hiện truy vấn xóa xuất xứ trong CSDL
    $deleteSql = "DELETE FROM origins WHERE origin_id = '$origin_id'";
    $deleteResult = mysqli_query($conn, $deleteSql);

    if ($deleteResult) {
        $_SESSION['success_message'] = 'Xóa xuất xứ thành công!';
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
    <title>Xóa xuất xứ</title>
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
                <h2>Xóa xuất xứ</h2>

                <?php if (isset($_SESSION['success_message'])) : ?>
                    <div class="alert alert-success"><?php echo $_SESSION['success_message']; ?></div>
                    <?php unset($_SESSION['success_message']); ?>
                <?php endif; ?>

                <div class="alert alert-danger">
                    <p>Bạn có chắc chắn muốn xóa xuất xứ sau? Bạn sẽ không thể hoàn tác lại hành động này!!!!</p>
                    <p><strong>Tên xuất xứ:</strong> <?php echo $row['name']; ?></p>
                </div>

                <form method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa xuất xứ này?')">
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
