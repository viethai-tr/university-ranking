<?php
session_start();
//tiến hành kiểm tra là người dùng đã đăng nhập hay chưa
//nếu chưa, chuyển hướng người dùng ra lại trang đăng nhập
if (!isset($_SESSION['username'])) {
   header('Location: login.php');
}
if ($_SESSION['permission'] == 1) {
  $per = "Quản trị viên";
} else if ($_SESSION['permission'] == 2) {
  $per= "Nhân viên";
}
$id = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Nhóm 6: THÊM TRƯỜNG ĐẠI HỌC</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" type="text/css" href="../css/dropzone.css" />
  <script type="text/javascript" src="../js/dropzone.js"></script>
  <!-- endinject -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../images/favicon.png" />
</head>
<body>
    <?php
      include "dbConn.php";
      $sql_country = "SELECT country_name FROM country ORDER BY country_name";
      $res_data2 = mysqli_query($conn,$sql_country);

    ?>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="<?php
                include "check-permission.php";
              ?>"><img src="../images/husLogo.png" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="<?php
                include "check-permission.php";
              ?>"><img src="images/husMini.png" alt="logo"/></a>
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
            <a class="nav-link" href="<?php
                include "check-permission.php";
              ?>">
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
          <?php 
            if ($_SESSION['permission'] == 1) {
              echo "
                <li class=\"nav-item\">
                    <a class=\"nav-link\" data-toggle=\"collapse\" href=\"#moderator\" aria-expanded=\"false\" aria-controls=\"ui-basic\">
                        <span class=\"menu-title\">Danh sách nhân viên</span>
                        <i class=\"menu-arrow\"></i>
                        <i class=\"mdi mdi-crosshairs-gps menu-icon\"></i>
                    </a>
                    <div class=\"collapse\" id=\"moderator\">
                        <ul class=\"nav flex-column sub-menu\">
                            <li class=\"nav-item\"> <a class=\"nav-link\" href=\"list-moderators.php\">Danh sách</a></li>
                            <li class=\"nav-item\"> <a class=\"nav-link\" href=\"add-moderator.php\">Thêm</a></li>
                        </ul>
                    </div>
                </li> ";
            } else if ($_SESSION['permission'] == 2) {
              echo "
                <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"edit-info.php?id=$id\">
                <span class=\"menu-title\">Sửa thông tin cá nhân</span>
                <i class=\"mdi mdi-account-settings-variant menu-icon\"></i>
            </a>
          </li>
              ";
            }

          ?>
          
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="page-header">
                  <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                      <i class="mdi mdi-playlist-plus"></i>
                    </span>
                    Thêm trường Đại học
                  </h3>
                </div>
              <form class="forms-sample" method="POST" action="add-uni.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="exampleInputName1">Tên</label>
                    <input type="text" class="form-control" name = "university_name" placeholder="Tên">
                </div>
                <div class="row">
                  <div class="form-group col-4">
                      <label for="exampleInputName1">Quốc gia</label><br>
                      <select id="country" name="country" class="form-control btn">
                        <option value=" " name="" disabled selected></option>
                        <?php
                          while ($row2 = mysqli_fetch_assoc($res_data2)) {
                            echo "<option value=\"";
                            echo $row2['country_name'];
                            echo "\" name=\"";
                            echo $row2['country_name'];
                            echo "\">";
                            echo $row2['country_name'];
                            echo "</option>";
                          }
                        ?>
                      </select>
                  </div>
                </div>
                <div class="row">
                    <div class="form-group col-4">
                        <label for="exampleInputEmail3">Điểm giảng dạy</label>
                        <input type="text" class="form-control" name = "teaching" placeholder="Số điểm">
                    </div>
                    <div class="form-group col-4">
                        <label for="exampleInputEmail3">Điểm quốc tế</label>
                        <input type="text" class="form-control" name = "international" placeholder="Số điểm">
                    </div>
                    <div class="form-group col-4">
                        <label for="exampleInputEmail3">Nghiên cứu</label>
                        <input type="text" class="form-control" name = "research" placeholder="Số điểm">
                    </div>
                </div>
                <div class="row">
                  <div class="form-group col-4">
                      <label for="exampleInputEmail3">Điểm trích dẫn</label>
                      <input type="text" class="form-control" name = "citations" placeholder="Số điểm">
                  </div>
                  <div class="form-group col-4">
                      <label for="exampleInputEmail3">Income</label>
                      <input type="text" class="form-control" name = "income" placeholder="Số điểm">
                  </div>
                  <div class="form-group col-4">
                      <label for="exampleInputEmail3">Tổng điểm</label>
                      <input type="text" class="form-control" name = "total_score" placeholder="Số điểm">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-6">
                      <label for="exampleInputEmail3">Số sinh viên</label>
                      <input type="text" class="form-control" name = "num_students" placeholder="Số lượng">
                  </div>
                  <div class="form-group col-6">
                      <label for="exampleInputEmail3">Tỉ lệ sinh viên / nhân viên</label>
                      <input type="text" class="form-control" name = "student_staff_ratio" placeholder="Tỉ lệ">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-6">
                      <label for="exampleInputEmail3">Số sinh viên nước ngoài</label>
                      <input type="text" class="form-control" name = "international_students" placeholder="Số lượng">
                  </div>
                  <div class="form-group col-6">
                      <label for="exampleInputEmail3">Tỉ lệ nữ / nam</label>
                      <input type="text" class="form-control" name = "female_male_ratio" placeholder="Tỉ lệ">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-6">
                    <label>Ảnh (< 2MB)</label><br>
                    <input type="file" name="university_image" accept="image/*">
                  </div>
                </div>

                <button type="submit" name="submit" class="btn bg-gradient-primary mr-2">Submit</button>
                <a href="list-universities.php"><button type="button" class="btn btn-light">Cancel</button></a>
            </form>
           
          </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
          
  </script>
  <!-- container-scroller -->
  <style>
      .dropzone {
          border: 2px dashed #f7a804;
          border-radius: 5px;
          background: white;
      }
  </style>

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
