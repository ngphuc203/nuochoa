<?php
// Kết nối đến CSDL
include_once __DIR__ . "/../dbconnect.php";

// Lấy số lượng sản phẩm
$productCount = 0;
$productQuery = "SELECT COUNT(*) as count FROM products";
$productResult = mysqli_query($conn, $productQuery);
if ($productResult) {
    $productRow = mysqli_fetch_assoc($productResult);
    $productCount = $productRow['count'];
}

// Lấy số lượng đơn hàng
$orderCount = 0;
$orderQuery = "SELECT COUNT(*) as count FROM orders";
$orderResult = mysqli_query($conn, $orderQuery);
if ($orderResult) {
    $orderRow = mysqli_fetch_assoc($orderResult);
    $orderCount = $orderRow['count'];
}

// Lấy số lượng tin tức
$newsCount = 0;
$newsQuery = "SELECT COUNT(*) as count FROM news";
$newsResult = mysqli_query($conn, $newsQuery);
if ($newsResult) {
    $newsRow = mysqli_fetch_assoc($newsResult);
    $newsCount = $newsRow['count'];
}

// Lấy số lượng thương hiệu
$brandCount = 0;
$brandQuery = "SELECT COUNT(*) as count FROM brands";
$brandResult = mysqli_query($conn, $brandQuery);
if ($brandResult) {
    $brandRow = mysqli_fetch_assoc($brandResult);
    $brandCount = $brandRow['count'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Thêm các kiểu tùy chỉnh của bạn */
        .card-product {
            background-color: #f8f9fa;
            border: 1px solid #e2e6ea;
            padding: 20px;
            border-radius: 5px;
        }

        .card-product i {
            font-size: 36px;
            color: #28a745;
        }

        .card-order i {
            font-size: 36px;
            color: #007bff;
        }

        .card-news i {
            font-size: 36px;
            color: #6c757d;
        }

        .card-brand i {
            font-size: 36px;
            color: #dc3545;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-3">
                <!-- Sidebar -->
                <?php include_once __DIR__ . "/layouts/sidebar.php"; ?>
            </div>
            <div class="col-9">
                <!-- Content -->
                <h1>Dashboard</h1>
                <div class="dashboard-stats">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-product">
                                <div class="card-body">
                                    <i class="fas fa-box"></i>
                                    <h3><?php echo $productCount; ?></h3>
                                    <p class="card-text">Sản phẩm</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card card-order">
                                <div class="card-body">
                                    <i class="fas fa-shopping-cart"></i>
                                    <h3><?php echo $orderCount; ?></h3>
                                    <p class="card-text">Đơn hàng</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card card-news">
                                <div class="card-body">
                                    <i class="far fa-newspaper"></i>
                                    <h3><?php echo $newsCount; ?></h3>
                                    <p class="card-text">Tin tức</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card card-brand">
                                <div class="card-body">
                                    <i class="fas fa-tags"></i>
                                    <h3><?php echo $brandCount; ?></h3>
                                    <p class="card-text">Thương hiệu</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once __DIR__ . "/layouts/footer.php"; ?>
    <!-- JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.min.js"></script>
</body>

</html>
