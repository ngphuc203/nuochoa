<?php
require_once "../../../dbconnect.php";
session_start();

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

// Kiểm tra sự tồn tại của xuất xứ trong CSDL
$sql = "SELECT * FROM origins WHERE origin_id = $id";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) <= 0) {
    $_SESSION['error_message'] = "Xuất xứ không tồn tại.";
    header("Location: index.php");
    exit();
}

$row = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Kiểm tra dữ liệu và thực hiện cập nhật xuất xứ trong CSDL
    $name = $_POST['name'];

    $sql = "UPDATE origins SET name = '$name' WHERE origin_id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $_SESSION['success_message'] = "Cập nhật xuất xứ thành công.";
        header("Location: index.php");
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
    <title>Chỉnh sửa xuất xứ</title>
    <!-- Bootstrap 5.2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <!-- Font Awesome 5.15 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Chỉnh sửa xuất xứ</h2>

                <?php if (isset($_SESSION['error_message'])) : ?>
                    <div class="alert alert-danger"><?php echo $_SESSION['error_message']; ?></div>
                    <?php unset($_SESSION['error_message']); ?>
                <?php endif; ?>

                <form method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên xuất xứ</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5.2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
