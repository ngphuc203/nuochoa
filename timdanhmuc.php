<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
   <meta name="description" content="">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="shortcut icon" href="images/favicon.png">
   <title>Welcome to Fesata Shop</title>
   <!-- Thêm các tệp CSS của Bootstrap và FontAwesome -->

   <?php
   include_once __DIR__ . "/styles.php";
   ?>
</head>
<body id="home">
   <div class="wrapper">
      <?php
      include_once __DIR__ . "/fontend/layouts/header.php";
      ?>
      <div class="container_fullwidth">
         <div class="container">
            <div class="hot-products">
               <h3 class="title"><strong>Sản Phẩm</strong> Theo Danh Mục</h3>
               <div class="control"><a id="prev_hot" class="prev" href="#">&lt;</a><a id="next_hot" class="next" href="#">&gt;</a></div>
               <ul id="hot">
                  <li>
                     <div class="row">
                        <?php
                        // Bước 1: Kết nối đến cơ sở dữ liệu
                        include_once __DIR__ . "/dbconnect.php";

                        // Bước 2: Kiểm tra xem category_id có được truyền từ URL hay không
                        if (isset($_GET['category_id'])) {
                           $categoryId = $_GET['category_id'];

                           // Bước 3: Thực hiện câu truy vấn SQL với điều kiện category_id
                           $query = "SELECT product_id, name, description, price, image, category_id, brand_id, origin_id FROM products WHERE category_id = $categoryId";
                        } else {
                           // Nếu không có category_id được truyền, hiển thị tất cả sản phẩm
                           $query = "SELECT product_id, name, description, price, image, category_id, brand_id, origin_id FROM products";
                        }

                        $result = mysqli_query($conn, $query);

                        // Kiểm tra xem có dữ liệu trả về hay không
                        if (mysqli_num_rows($result) > 0) {
                           // Bước 4: Hiển thị dữ liệu trong mã HTML
                           while ($row = mysqli_fetch_assoc($result)) {
                              // Lấy các trường dữ liệu từ mỗi hàng
                              $product_id = $row['product_id'];
                              $name = $row['name'];
                              $description = $row['description'];
                              $price = $row['price'];
                              $formatted_price = number_format($price); // Định dạng số giá tiền
                              $image = 'backend/core/uploads/img/' . $row['image']; // Thay đổi đường dẫn hình ảnh ở đây
                              $category_id = $row['category_id'];
                              $brand_id = $row['brand_id'];
                              $origin_id = $row['origin_id'];

                              // Hiển thị dữ liệu trong mã HTML
                        ?>
                              <div class="col-md-3 col-sm-6">
                                 <div class="products">
                                    <div class="thumbnail"><a href="details.php?product_id=<?php echo $product_id; ?>"><img src="<?php echo $image; ?>" alt="<?php echo $name; ?>" style="height: 200px;"></a></div>
                                    <div class="productname"><?php echo $name; ?></div>
                                    <h4 class="price"><?php echo $formatted_price; ?> VNĐ</h4>
                                    <div class="button_group">
                                       <button class="button add-cart" type="button" data-product-id="<?php echo $product_id; ?>">Add To Cart</button>
                                       <a href="details.php?product_id=<?php echo $product_id; ?>">
                                          <button class="button compare" type="button"><i class="fa fa-search"></i></button>
                                       </a>
                                    </div>
                                 </div>
                              </div>
                        <?php
                           }
                        } else {
                           // Hiển thị thông báo nếu không có dữ liệu
                           echo "Không có sản phẩm nào.";
                        }

                        // Bước 5: Đóng kết nối
                        mysqli_close($conn);
                        ?>
                     </div>
                  </li>
               </ul>
            </div>
            <div class="clearfix"></div>
         </div>
      </div>
      <div class="clearfix"></div>
      <?php
      include_once __DIR__ . "/fontend/layouts/footer.php";
      ?>
   </div>
   <?php
   include_once __DIR__ . "/scripts.php";
   ?>
   <!-- Thêm thư viện jQuery và tệp JavaScript của Bootstrap -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.min.js"></script>
   <!-- Thêm phần mã JavaScript sau khối PHP hiện có -->
   <script>
      // Xử lý sự kiện nhấp vào nút "Add to Cart"
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
   </script>
</body>
</html>
