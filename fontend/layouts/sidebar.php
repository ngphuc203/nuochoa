<?php
// Bước 1: Kết nối đến cơ sở dữ liệu
include_once __DIR__ . "/../../dbconnect.php";
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Sidebar</title>
    <style>
        .sidebar {
            width: 200px;
            padding: 20px;
            border: 1px solid #ccc;
        }

        .sidebar-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .sidebar-menu {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .nav-item {
            margin-bottom: 5px;
        }

        .nav-link {
            text-decoration: none;
            color: #333;
        }

        .nav-link i {
            margin-right: 5px;
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>

<body>
    <div class="sidebar">
        <h2 class="sidebar-title">Thương Hiệu</h2>
        <ul class="sidebar-menu">
            <?php
            // Bước 2: Truy vấn danh sách danh hiệu
            $query = "SELECT brand_id, name FROM brands";
            $result = mysqli_query($conn, $query);

            // Bước 3: Kiểm tra xem có dữ liệu trả về hay không
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $brandId = $row['brand_id'];
                    $brandName = $row['name'];
                    echo '<li class="nav-item">';
                    echo '<a class="nav-link" href="timthuonghieu.php?brand_id=' . $brandId . '"><i class="fas fa-chevron-right"></i> ' . $brandName . '</a>';
                    echo '</li>';
                }
            } else {
                echo '<li class="nav-item">Không có danh hiệu.</li>';
            }

            // Bước 4: Đóng kết nối
            mysqli_close($conn);
            ?>
        </ul>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
