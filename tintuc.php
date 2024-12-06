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
               <h3 class="title"><strong>Tin Tức</strong></h3>
               <div class="row">
                  <?php
                  // Bước 1: Kết nối đến cơ sở dữ liệu
                  include_once __DIR__ . "/dbconnect.php";

                  // Bước 2: Thực hiện câu truy vấn SQL
                  $query = "SELECT news_id, image, title, content FROM news";
                  $result = mysqli_query($conn, $query);

                  // Kiểm tra xem có dữ liệu trả về hay không
                  if (mysqli_num_rows($result) > 0) {
                     // Bước 3: Hiển thị dữ liệu trong mã HTML
                     while ($row = mysqli_fetch_assoc($result)) {
                        // Lấy các trường dữ liệu từ mỗi hàng
                        $news_id = $row['news_id'];
                        $image = 'backend/core/uploads/tintuc/' . $row['image']; // Thay đổi đường dẫn hình ảnh ở đây
                        $title = $row['title'];
                        $content = $row['content'];

                        // Hiển thị dữ liệu trong mã HTML
                  ?>
                        <div class="col-md-4">
                           <div class="news">
                              <a href="noidungtintuc.php?news_id=<?php echo $news_id; ?>">
                                 <div class="thumbnail"><img src="<?php echo $image; ?>" alt="<?php echo $title; ?>" style="width: 300px;"></div>
                                 <div class="newstitle"><?php echo $title; ?></div>
                              </a>
                           </div>
                        </div>
                  <?php
                     }
                  } else {
                     // Hiển thị thông báo nếu không có dữ liệu
                     echo "Không có tin tức nào.";
                  }

                  // Bước 4: Đóng kết nối
                  mysqli_close($conn);
                  ?>
               </div>
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
</body>
</html>
