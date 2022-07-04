<?php
  session_start();
  if (isset($_SESSION['permission'])) {
    if ($_SESSION['permission'] == 1) {
      header("Location: main-admin.php");
    } else if ($_SESSION['permission'] == 2) {
      header("Location: main-moderator.php");
    }
  }
?>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Nhóm 6: ĐĂNG NHẬP</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../images/favicon.png" />
</head>

<body>
  <?php
    include "dbConn.php";
    if (isset($_POST['submit'])) {
      $username = $_POST["username"];
      $password = $_POST["password"];
      if ($username == "" || $password == "") {
        $message = "Vui lòng nhập tên đăng nhập và mật khẩu";
        echo "<script type='text/javascript'>alert('$message');</script>";
      } else {
        $sql = "SELECT * FROM account WHERE username='$username'";
          $query = mysqli_query($conn, $sql);
          $num_rows = mysqli_num_rows($query);
          $row = mysqli_fetch_assoc($query);
          if ($num_rows == 0) {
            $message = "Tên đăng nhập hoặc mật khẩu không đúng";
            echo "<script type='text/javascript'>alert('$message');</script>";
          } else {
            if (password_verify($password, $row['pass'])) {
              $_SESSION['username'] = $username;
              $_SESSION['name'] = $row['name'];
              $_SESSION['id'] = $row['accid'];
              $_SESSION['permission'] = $row['permission'];
              if ($row['permission'] == 1) {
                header("refresh:0; url=main-admin.php");
              } else if ($row['permission'] == 2) {
                header("refresh:0; url=main-moderator.php");
              }
            } else {
              $message = "Tên đăng nhập hoặc mật khẩu không đúng";
              echo "<script type='text/javascript'>alert('$message');</script>";
            }
          }
        }
      }
  ?>

  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
              <div class="login-logo">
                <img src="../images/loginLogo.png">
              </div>
              <br>
              <h4>Chào mừng!</h4>
              <h6 class="font-weight-light">Đăng nhập để tiếp tục</h6>
              <form class="pt-3" method="POST" action="login.php">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="username" name="username" placeholder="Tên đăng nhập">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Mật khẩu">
                </div>
                <div class="mt-3">
                  <button class="btn btn-block btn-gradient-warning btn-lg font-weight-medium auth-form-btn text-black" name="submit">ĐĂNG NHẬP</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../vendors/js/vendor.bundle.base.js"></script>
  <script src="../vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="../js/off-canvas.js"></script>
  <script src="../js/misc.js"></script>
  <!-- endinject -->
</body>

</html>
