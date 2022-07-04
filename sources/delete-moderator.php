<?php
	include "dbConn.php"; // Using database connection file here
	$id = $_GET['id'];
	$del = mysqli_query($conn,"DELETE FROM account where accid = '$id'"); // delete query
	if($del)
	{
		$message = "Xóa thành công!";
	}
	else
	{
		$message = "Xóa thất bại!"; // display error message if not delete
	}
	echo "<script type='text/javascript'>alert('$message');</script>";
	header("refresh:0; url=list-moderators.php");
?>