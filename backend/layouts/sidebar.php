<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>sidebar</title>
  <?php include_once __DIR__ . "/../styles.php" ?>
  <style>
    .sidebar {
      background-color: #ffffff;
      padding: 20px;
      height: 100%;
    }
    .sidebar ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }
    .sidebar li {
      margin-bottom: 10px;
    }
    .sidebar a {
      text-decoration: none;
      color: #000;
    }
    .sidebar a:hover {
      color: #2be4d6;
    }
    .sidebar .category {
      font-weight: bold;
      border-bottom: 1px solid #ddd;
      cursor: pointer;
    }
    .sidebar .category i {
      margin-right: 5px;
    }
    .sidebar .category:active {
      background-color: #f8f9fa;
      color: #fff;
    }
    .sidebar .sub-menu {
      padding-left: 20px;
      display: none;
      background-color: #ffffff;
    }
    .sidebar .category.active .sub-menu {
      display: block;
    }
    .sidebar .list-group-item.active {
      z-index: 2;
      color: #f70000;
      background-color: #ffffff;
      border-color: #186ec4;
    }
  </style>
  <script>
    // Xử lý hiển thị / ẩn sub-menu khi click vào category
    function toggleSubMenu(event) {
      const category = event.target.closest('.category');
      category.classList.toggle('active');
    }
  </script>
</head>
<body>
  <div class="sidebar">
    <ul class="list-group">
      <li class="list-group-item"><a href="/webnuochoa/backend/dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
      <li class="list-group-item category" onclick="toggleSubMenu(event)">
        <i class="fas fa-list"></i> Danh Mục
        <ul class="sub-menu">
          <li><a href="/webnuochoa/backend/admin/sanpham/index.php"><i class="fas fa-cubes"></i> Sản Phẩm</a></li>
          <li><a href="/webnuochoa/backend/admin/xuatxu/index.php"><i class="fas fa-globe"></i> Xuất Xứ</a></li>
          <li><a href="/webnuochoa/backend/admin/danhmuc/index.php"><i class="fas fa-tags"></i> Danh Mục</a></li>
          <li><a href="/webnuochoa/backend/admin/thuonghieu/index.php"><i class="fas fa-band-aid"></i> Thương Hiệu</a></li>
          <li><a href="/webnuochoa/backend/admin/donhang/index.php"><i class="fas fa-shopping-cart"></i> Đơn Hàng</a></li>
        </ul>
        <li class="list-group-item category" onclick="toggleSubMenu(event)">
        <i class="fas fa-tools"></i> Cấu Hình Web
        <ul class="sub-menu">
          <li><a href="/webnuochoa/backend/admin/banner/index.php"><i class="fas fa-image"></i> Banner</a></li>
          <li><a href="/webnuochoa/backend/admin/tintuc/index.php"><i class="fas fa-book-open"></i> Tin Tức</a></li>
        </ul>
      </li>
      <li class="list-group-item category" onclick="toggleSubMenu(event)">
      <i class="fas fa-users-cog"></i> Setting Users
        <ul class="sub-menu">
          <li><a href="/webnuochoa/backend/admin/user/index.php"><i class="fas fa-user"></i> User</a></li>
          <li><a href="/webnuochoa/backend/admin/quyenhang/index.php"><i class="fas fa-star"></i> Quyền Hạng</a></li>
        </ul>
      </li>
    </ul>
  </div>
  <?php include_once __DIR__ . "/../scripts.php"  ?>
</body>
</html>
