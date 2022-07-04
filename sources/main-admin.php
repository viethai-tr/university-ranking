<?php
session_start();
if (!isset($_SESSION['username'])) {
   header('Location: login.php');
}
if ($_SESSION['permission'] == 1) {
  $per = "Quản trị viên";
} else if ($_SESSION['permission'] == 2) {
  $per = "Nhân viên";
  $message = "Bạn không có quyền truy cập trang này";
  echo "<script type='text/javascript'>alert('$message');</script>";
    header("refresh:0; url=main-moderator.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Nhóm 6: TỔNG QUAN</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../images/favicon.png" />
</head>
<body>
   <?php
            include "dbConn.php";
            $results_per_page = 20;
             
            $sql = "SELECT world_rank, university_name, country FROM data" ;
            $result = mysqli_query($conn, $sql);
    ?>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="main-admin.php"><img src="../images/husLogo.png" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="main-admin.php"><img src="../images/husMini.png" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-stretch">
        
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <div class="nav-profile-img">
                <img src="../images/faces/face1.jpg" alt="image">
                <span class="availability-status online"></span>             
              </div>
              <div class="nav-profile-text">
                <p class="mb-1 text-black"><?=$_SESSION['name']?></p>
              </div>
            </a>
            <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="logout.php">
                <i class="mdi mdi-logout mr-2 text-primary"></i>
                Signout
              </a>
            </div>
          </li>
          <li class="nav-item d-none d-lg-block full-screen-link">
            <a class="nav-link">
              <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="mdi mdi-bell-outline"></i>
              <span class="count-symbol bg-danger"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <h6 class="p-3 mb-0">Notifications</h6>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="mdi mdi-calendar"></i>
                  </div>
                </div>
                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                  <h6 class="preview-subject font-weight-normal mb-1">Event today</h6>
                  <p class="text-gray ellipsis mb-0">
                    Just a reminder that you have an event today
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="mdi mdi-settings"></i>
                  </div>
                </div>
                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                  <h6 class="preview-subject font-weight-normal mb-1">Settings</h6>
                  <p class="text-gray ellipsis mb-0">
                    Update dashboard
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="mdi mdi-link-variant"></i>
                  </div>
                </div>
                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                  <h6 class="preview-subject font-weight-normal mb-1">Launch Admin</h6>
                  <p class="text-gray ellipsis mb-0">
                    New admin wow!
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <h6 class="p-3 mb-0 text-center">See all notifications</h6>
            </div>
          </li>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
              <div class="nav-profile-image">
                <img src="../images/faces/face1.jpg" alt="profile">
                <span class="login-status online"></span> <!--change to offline or busy as needed-->              
              </div>
              <div class="nav-profile-text d-flex flex-column">
                <span class="font-weight-bold mb-2"><?=$_SESSION['name']?></span>
                <span class="text-secondary text-small"><?=$per?></span>
              </div>
              <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="main-admin.php">
                <span class="menu-title">Tổng quan</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#university" aria-expanded="false" aria-controls="ui-basic">
                  <span class="menu-title">Danh sách trường ĐH</span>
                  <i class="menu-arrow"></i>
                  <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              </a>
              <div class="collapse" id="university">
                  <ul class="nav flex-column sub-menu">
                      <li class="nav-item"> <a class="nav-link" href="list-universities.php">Danh sách</a></li>
                      <li class="nav-item"> <a class="nav-link" href="add-university.php">Thêm</a></li>
                  </ul>
              </div>
          </li>
          <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#moderator" aria-expanded="false" aria-controls="ui-basic">
                  <span class="menu-title">Danh sách nhân viên</span>
                  <i class="menu-arrow"></i>
                  <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              </a>
              <div class="collapse" id="moderator">
                  <ul class="nav flex-column sub-menu">
                      <li class="nav-item"> <a class="nav-link" href="list-moderators.php">Danh sách</a></li>
                      <li class="nav-item"> <a class="nav-link" href="add-moderator.php">Thêm</a></li>
                  </ul>
              </div>
          </li>
          
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-home"></i>             
              </span>
              Tổng quan
            </h3>
          </div>
          <h3>Dữ liệu</h3>
          <br>
          <div class="row">
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                  <img src="../images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>
                  <h4 class="font-weight-normal mb-3">TỔNG CỘNG CÓ
                    <i class="mdi mdi-school mdi-24px float-right"></i>
                  </h4>
                  <h2 class="mb-5">
                    <?php
                      $result = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) as total FROM data"));
                      echo  $result[0];
                    ?>
                  </h2>
                  <h6 class="card-text">TRƯỜNG ĐẠI HỌC</h6>
                </div>
              </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                  <img src="../images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>                  
                  <h4 class="font-weight-normal mb-3">ĐẾN TỪ
                    <i class="mdi mdi-earth mdi-24px float-right"></i>
                  </h4>
                  <h2 class="mb-5">
                    <?php
                      $result = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(DISTINCT country) as totalCountry FROM data"));
                      echo  $result[0];
                    ?>
                  </h2>
                  <h6 class="card-text">QUỐC GIA</h6>
                </div>
              </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                  <img src="../images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>                                    
                  <h4 class="font-weight-normal mb-3">XẾP HẠNG THEO
                    <i class="mdi mdi-sort-descending mdi-24px float-right"></i>
                  </h4>
                  <h2 class="mb-5">10</h2>
                  <h6 class="card-text">HẠNG MỤC</h6>
                </div>
              </div>
            </div>
          </div>
          <h3>Nhân sự</h3>
          <br>
          <div class="row">
            <div class="col-md-6 stretch-card grid-margin">
              <div class="card bg-gradient-dark card-img-holder text-white">
                <div class="card-body">
                  <img src="../images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>
                  <h4 class="font-weight-normal mb-3">ĐANG CÓ
                    <i class="mdi mdi-account-key mdi-24px float-right"></i>
                  </h4>
                  <h2 class="mb-5">
                    <?php
                      $result = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) as total FROM account WHERE permission = 1"));
                      echo  $result[0];
                    ?>
                  </h2>
                  <h6 class="card-text">NGƯỜI QUẢN TRỊ</h6>
                  <i>(Administrators)</i>
                </div>
              </div>
            </div>
            <div class="col-md-6 stretch-card grid-margin">
              <div class="card bg-gradient-warning card-img-holder text-white">
                <div class="card-body">
                  <img src="../images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>
                  <h4 class="font-weight-normal mb-3">VÀ
                    <i class="mdi mdi-account-multiple mdi-24px float-right"></i>
                  </h4>
                  <h2 class="mb-5">
                    <?php
                      $result = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) as total FROM account WHERE permission = 2"));
                      echo  $result[0];
                    ?>
                  </h2>
                  <h6 class="card-text">NHÂN VIÊN</h6>
                  <i>(Moderators)</i>
                </div>
              </div>
            </div>
          </div>
          <h3>Thành viên nhóm</h3>
          <br>
          <table class="table">
            <thead>
              <tr>
                <th>STT</th>
                <th>Họ tên</th>
                <th>Mã sinh viên</i></th>
                <th>Email</th>
                <th>Số điện thoại</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td><b>Hồ Trọng Nguyên</b>&nbsp&nbsp&nbsp<i class="badge-warning mdi mdi-crown"></i></td>
                <td>17000215</td>
                <td><a href="mailto:hotrongnguyen_t62@hus.edu.vn">hotrongnguyen_t62@hus.edu.vn</a></td>
                <td></td>
              </tr>
              <tr>
                <td>2</td>
                <td>Hồ Tuấn Hải</td>
                <td>17000176</td>
                <td><a href="mailto:hotuanhai_t62@hus.edu.vn">hotuanhai_t62@hus.edu.vn</a></td>
                <td></td>
              </tr>
              <tr>
                <td>3</td>
                <td>Trịnh Việt Hải</td>
                <td>17000200</td>
                <td><a href="mailto:trinhviethai_t62@hus.edu.vn">trinhviethai_t62@hus.edu.vn</a></td>
                <td>0961317991</td>
              </tr>
              <tr>
                <td>4</td>
                <td>Lê Hồ Tuấn Phong</td>
                <td>17001634</td>
                <td><a href="mailto:lehotuanphong_t62@hus.edu.vn">lehotuanphong_t62@hus.edu.vn</a></td>
                <td></td>
              </tr>
              <tr>
                <td>5</td>
                <td>Ngô Thị Diệu Linh</td>
                <td>17000894</td>
                <td><a href="mailto:ngothidieulinh_t62@hus.edu.vn">ngothidieulinh_t62@hus.edu.vn</a></td>
                <td></td>
              </tr>
              <tr>
                <td>6</td>
                <td>Vương Trọng Nghĩa</td>
                <td>17000702</td>
                <td><a href="mailto:vuongtrongnghia_t62@hus.edu.vn">vuongtrongnghia_t62@hus.edu.vn</a></td>
                <td></td>
              </tr>
            </tbody>
          </table>


<!--           <div class="row">
            <div class="col-md-7 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="clearfix">
                    <h4 class="card-title float-left">Visit And Sales Statistics</h4>
                    <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>                                     
                  </div>
                  <canvas id="visit-sale-chart" class="mt-4"></canvas>
                </div>
              </div>
            </div>
            <div class="col-md-5 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Traffic Sources</h4>
                  <canvas id="traffic-chart"></canvas>
                  <div id="traffic-chart-legend" class="rounded-legend legend-vertical legend-bottom-left pt-4"></div>                                                      
                </div>
              </div>
            </div>
          </div> -->
        
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="../vendors/js/vendor.bundle.base.js"></script>
  <script src="../vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="../js/off-canvas.js"></script>
  <script src="../js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../js/dashboard.js"></script>
  <!-- End custom js for this page-->
</body>

</html>
