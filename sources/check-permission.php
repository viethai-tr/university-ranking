<?php
    if ($_SESSION['permission'] == 1) {
      echo "main-admin.php";
    } else if ($_SESSION['permission'] == 2) {
      echo "main-moderator.php";
    }
?>