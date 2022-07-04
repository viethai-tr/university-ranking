<?php
    session_start();
	include "dbConn.php";

    $ud_username = $_POST['ud_username'];
    $ud_password_hash = password_hash($_POST['ud_password'], PASSWORD_DEFAULT);
    $ud_password = $_POST['ud_password'];
    $ud_reenter_password = $_POST['reenter_password'];
    $ud_name = $_POST['ud_name'];
    $ud_email = $_POST['ud_email'];
    $ud_phone = $_POST['ud_phone'];
    $id = $_POST['ud_accid'];

    if ($ud_password == "") {
        $message = "Vui lòng nhập mật khẩu";
        echo "<script type='text/javascript'>alert('$message');</script>";
        if ($_SESSION['permission'] == 1) 
            header("refresh:0; url=edit-moderator.php?id=$id");
        else if ($_SESSION['permission'] == 2)
            header("refresh:0; url=edit-info.php?id=$id");
    } else {
        if ($ud_password == $ud_reenter_password) {
            $sql = "UPDATE account SET username=?, pass=?, name=?, email=?, phone=? WHERE accid=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssi", $ud_username, $ud_password_hash, $ud_name, $ud_email, $ud_phone, $_POST['ud_accid']);
            if ($stmt->execute()) {
              $message = "Sửa thông tin thành công!";
              $_SESSION['name'] = $_POST['ud_name'];
            } else {
              $message = "Sửa thông tin thất bại!";
            }
            echo "<script type='text/javascript'>alert('$message');</script>";
            if ($_SESSION['permission'] == 1) {
				header("refresh:0; url=list-moderators.php");
			} else {
				header("refresh:0; url=main-moderator.php");
			}
        } else {
            $message = "Xác nhận mật khẩu sai";
            echo "<script type='text/javascript'>alert('$message');</script>";
            if ($_SESSION['permission'] == 1) 
                header("refresh:0; url=edit-moderator.php?id=$id");
            else if ($_SESSION['permission'] == 2)
                header("refresh:0; url=edit-info.php?id=$id");
        }
    }
?>