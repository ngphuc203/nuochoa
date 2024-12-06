<?php
// Kết nối đến cơ sở dữ liệu
include_once __DIR__ . "/../../dbconnect.php";

// Truy vấn banners từ CSDL
$query = "SELECT banner_id, image FROM banners";
$result = mysqli_query($conn, $query);
?>

<div id="banner-carousel" class="carousel slide" data-ride="carousel">
   <!-- Indicators -->
   <ol class="carousel-indicators">
      <?php
      // Hiển thị các chỉ số
      $numBanners = mysqli_num_rows($result);
      for ($i = 0; $i < $numBanners; $i++) {
         $activeClass = ($i == 0) ? "active" : "";
         echo '<li data-target="#banner-carousel" data-slide-to="' . $i . '" class="' . $activeClass . '"></li>';
      }
      ?>
   </ol>

   <!-- Wrapper for slides -->
   <div class="carousel-inner">
      <?php
      // Hiển thị các banner
      $activeClass = "active";
      while ($row = mysqli_fetch_assoc($result)) {
         $banner_id = $row['banner_id'];
         $image = 'backend/core/uploads/banner/' . $row['image']; // Thay đổi đường dẫn ảnh ở đây

         echo '<div class="item ' . $activeClass . '">';
         echo '<img src="' . $image . '" alt="Banner ' . $banner_id . '" style="width: 100%; height: auto;">';
         echo '</div>';

         $activeClass = "";
      }
      ?>
   </div>

   <!-- Controls -->
   <a class="left carousel-control" href="#banner-carousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
   </a>
   <a class="right carousel-control" href="#banner-carousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
   </a>
</div>


