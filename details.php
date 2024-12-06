<?php
session_start();
?>
<?php
// Bước 1: Kết nối đến cơ sở dữ liệu
include_once __DIR__ . "/dbconnect.php";

// Kiểm tra xem product_id có được truyền qua URL hay không
if (isset($_GET['product_id'])) {
    // Lấy thông tin sản phẩm từ CSDL
    $product_id = mysqli_real_escape_string($conn, $_GET['product_id']);
    $query = "SELECT p.product_id, p.name, p.description, p.price, p.image, p.category_id, p.brand_id, p.origin_id, c.name AS category_name, b.name AS brand_name, o.name AS origin_name, p2.name AS product_name
    FROM products p
    LEFT JOIN categories c ON p.category_id = c.category_id
    LEFT JOIN brands b ON p.brand_id = b.brand_id
    LEFT JOIN origins o ON p.origin_id = o.origin_id
    LEFT JOIN products p2 ON p.product_id = p2.product_id
    WHERE p.product_id = $product_id";

    $result = mysqli_query($conn, $query);

    // Kiểm tra xem có dữ liệu trả về hay không
    if (mysqli_num_rows($result) > 0) {
        // Lấy thông tin sản phẩm từ kết quả truy vấn
        $row = mysqli_fetch_assoc($result);
        $product_name = $row['product_name'];

        $description = $row['description'];
        $price = $row['price'];
        $formatted_price = number_format($price); // Định dạng số giá tiền
        $image = 'backend/core/uploads/img/' . $row['image']; // Thay đổi đường dẫn hình ảnh ở đây
        $category_name = $row['category_name'];
        $brand_name = $row['brand_name'];
        $origin_name = $row['origin_name'];

        // Hiển thị thông tin sản phẩm trong mã HTML
?>
        <!DOCTYPE html>
        <html>

        <head>
            <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
            <meta name="description" content="">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="shortcut icon" href="images/favicon.png">
            <title>Welcome to Fesata Shop</title>
            <?php
            include_once __DIR__ . "/styles.php";
            ?>
        </head>

        <body>
            <div class="wrapper">
                <?php
                include_once __DIR__ . "/fontend/layouts/header.php";
                ?>
                <div class="clearfix"></div>
                <div class="container_fullwidth">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="products-details">
                                    <div class="preview_image">
                                        <div class="preview-small">
                                            <img id="zoom_03" src="<?php echo $image; ?>" data-zoom-image="" alt="<?php echo $name; ?>">
                                        </div>
                                    </div>
                                    <div class="products-description">
                                        <h5 class="name"><?php echo $product_name; ?></h5>
                                        <p>Thương hiệu: <span class="light-red"><?php echo $brand_name; ?></span></p>
                                        <p>Xuất xứ: <span class="light-red"><?php echo $origin_name; ?></span></p>
                                        <p>Danh Mục: <span class="light-red"><?php echo $category_name; ?></span></p>
                                        <hr class="border">
                                        <div class="price">
                                            Giá Tiền: <span class="new_price"><?php echo $formatted_price; ?><sup>VNĐ</sup></span>
                                        </div>
                                        <hr class="border">
                                        <div class="wided">
                                            <div class="button_group">
                                                <button class="button add-cart" type="button" data-product-id="<?php echo $product_id; ?>">Add To Cart</button>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="tab-box">
                                    <div id="tabnav">
                                        <ul>
                                            <li><a href="#Descraption">Mô Tả</a></li>
                                        </ul>
                                    </div>
                                    <div class="tab-content-wrap">
                                        <div class="tab-content" id="Descraption">
                                            <?php echo $description; ?>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <?php
                                include_once __DIR__ . "/fontend/layouts/sidebar.php";
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            include_once __DIR__ . "/scripts.php";
            ?>
            <!-- Thêm phần mã JavaScript sau khối HTML hiện có -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                // Xử lý sự kiện nhấp vào nút "Add to Cart"
                $(document).ready(function() {
                    $('.add-cart').click(function() {
                        var productId = $(this).data('product-id');

                        // Gửi yêu cầu thêm sản phẩm vào giỏ hàng qua Ajax
                        $.ajax({
                            url: 'add_to_cart.php',
                            type: 'POST',
                            data: {
                                productId: productId
                            },
                            success: function(response) {
                                alert('Sản phẩm đã được thêm vào giỏ hàng.');
                            },
                            error: function() {
                                alert('Đã xảy ra lỗi. Vui lòng thử lại sau.');
                            }
                        });
                    });
                });
            </script>
        </body>

        </html>

<?php
    } else {
        // Nếu không có dữ liệu sản phẩm, hiển thị thông báo
        echo "Không tìm thấy sản phẩm!";
    }
} else {
    // Nếu không có product_id trong URL, hiển thị thông báo
    echo "Không tìm thấy sản phẩm!";
}
?>