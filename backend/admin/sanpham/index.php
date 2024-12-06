<?php
require_once "../../../dbconnect.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <!-- Bootstrap 5.2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <!-- Font Awesome 5.15 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-3">
                <?php require_once "../../layouts/sidebar.php"; ?>
            </div>
            <div class="col-9">
                <h2>Quản lý sản phẩm</h2>

                <?php if (isset($_SESSION['success_message'])) : ?>
                    <div class="alert alert-success"><?php echo $_SESSION['success_message']; ?></div>
                    <?php unset($_SESSION['success_message']); ?>
                <?php endif; ?>

                <a href="create.php" class="btn btn-primary mb-3">
                    <i class="fas fa-plus"></i> Thêm sản phẩm
                </a>

                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Hình ảnh</th>
                            <th>Danh mục</th>
                            <th>Thương hiệu</th>
                            <th>Xuất xứ</th>
                            <th>Ngày tạo</th>
                            <th>Ngày cập nhật</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Lấy danh sách sản phẩm từ CSDL
                        $sql = "SELECT p.*, c.name AS category_name, b.name AS brand_name, o.name AS origin_name
                                FROM products p
                                LEFT JOIN categories c ON p.category_id = c.category_id
                                LEFT JOIN brands b ON p.brand_id = b.brand_id
                                LEFT JOIN origins o ON p.origin_id = o.origin_id";
                        $result = mysqli_query($conn, $sql);

                        // Kiểm tra nếu có lỗi trong quá trình truy vấn
                        if (!$result) {
                            die("Có lỗi xảy ra: " . mysqli_error($conn));
                        }

                        if (mysqli_num_rows($result) > 0) {
                            $count = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['product_id'] . "</td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . number_format($row['price']) . "</td>";
                                echo "<td><img src='../../core/uploads/img/" . $row['image'] . "' alt='Product Image' width='50'></td>";                                
                                echo "<td>" . $row['category_name'] . "</td>";
                                echo "<td>" . $row['brand_name'] . "</td>";
                                echo "<td>" . $row['origin_name'] . "</td>";
                                echo "<td>" . $row['created_at'] . "</td>";
                                echo "<td>" . $row['updated_at'] . "</td>";
                                echo "<td>
                                        <a href='edit.php?id=" . $row['product_id'] . "' class='btn btn-sm btn-primary'><i class='fas fa-edit'></i></a>
                                        <a href='delete.php?id=" . $row['product_id'] . "' class='btn btn-sm btn-danger'><i class='fas fa-trash'></i></a>
                                    </td>";
                                echo "</tr>";
                                $count++;
                            }
                        } else {
                            echo "<tr><td colspan='11'>Không có sản phẩm nào</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5.2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome 5.15 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>

</html>
