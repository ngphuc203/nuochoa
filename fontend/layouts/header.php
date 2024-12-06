<div class="header">
   <div class="container">
      <div class="row">
         <div class="col-md-2 col-sm-2">
            <div class="logo"><a href="./index.php">
                  <h3 id="logo-text">Fesata Shop</h3>
               </a></div>

            <script>
               var colors = ["red", "orange", "yellow", "green", "blue", "indigo", "violet"];
               var index = 0;

               function changeLogoColor() {
                  var logoText = document.getElementById("logo-text");
                  logoText.style.color = colors[index];
                  index = (index + 1) % colors.length;
               }

               setInterval(changeLogoColor, 1000); // Thay đổi màu sắc mỗi giây (1000ms)
            </script>

         </div>
         <div class="col-md-10 col-sm-10">
            <div class="header_top">
            </div>
            <div class="clearfix"></div>
            <div class="header_bottom">
               <ul class="option">
                  <li class="option-cart">
                     <a href="cart.php" class="cart-icon">cart <span class="cart_no"></span></a>
                  </li>
               </ul>
               <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                     <span class="sr-only">Toggle navigation</span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                  </button>
               </div>
               <div class="navbar-collapse collapse">
                  <ul class="nav navbar-nav">
                     <li class="active dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Home</a>
                     </li>
                     <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Danh Mục</a>
                        <div class="dropdown-menu mega-menu">
                           <div class="row">
                              <div class="col-md-4 col-sm-4">
                                 <ul class="mega-menu-links">
                                    <?php
                                    // Kết nối đến cơ sở dữ liệu
                                    include_once __DIR__ . "/../../dbconnect.php";

                                    // Truy vấn danh mục
                                    $query = "SELECT category_id, name FROM categories";
                                    $result = mysqli_query($conn, $query);

                                    // Kiểm tra xem có dữ liệu trả về hay không
                                    if (mysqli_num_rows($result) > 0) {
                                       // Hiển thị danh mục
                                       while ($row = mysqli_fetch_assoc($result)) {
                                          $category_id = $row['category_id'];
                                          $name = $row['name'];
                                    ?>
                                          <li><a href="timdanhmuc.php?category_id=<?php echo $category_id; ?>"><?php echo $name; ?></a></li>
                                    <?php
                                       }
                                    } else {
                                       echo "<li>Không có danh mục.</li>";
                                    }

                                    ?>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </li>

                     <li><a href="tintuc.php">Tin Tức</a></li>
                     <li><a href="">Giới Thiệu</a></li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>