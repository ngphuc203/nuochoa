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
            <div class="news-content">
               <?php
               // Bước 1: Kết nối đến cơ sở dữ liệu
               include_once __DIR__ . "/dbconnect.php";

               // Bước 2: Lấy ID tin tức từ tham số truyền vào
               $news_id = $_GET['news_id'];

               // Bước 3: Thực hiện câu truy vấn SQL để lấy nội dung tin tức dựa trên ID
               $query = "SELECT title, content FROM news WHERE news_id = $news_id";
               $result = mysqli_query($conn, $query);

               // Kiểm tra xem có dữ liệu trả về hay không
               if (mysqli_num_rows($result) > 0) {
                  // Bước 4: Hiển thị nội dung tin tức trong mã HTML
                  $row = mysqli_fetch_assoc($result);
                  $title = $row['title'];
                  $content = $row['content'];
               ?>
                  <h3 class="title"><?php echo $title; ?></h3>
                  <div class="content"><?php echo $content; ?></div>
               <?php
               } else {
                  // Hiển thị thông báo nếu không có dữ liệu
                  echo "Không tìm thấy tin tức.";
               }

               // Bước 5: Đóng kết nối
               mysqli_close($conn);
               ?>
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
