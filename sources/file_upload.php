<?php
include_once("dbConn.php");
if(!empty($_FILES)){     
    $upload_dir = "uploads/";
    $fileName = $_FILES['file']['name'];
    $uploaded_file = $upload_dir.$fileName;    
    if(move_uploaded_file($_FILES['file']['tmp_name'],$uploaded_file)){
        //insert file information into db table
		$mysql_insert = "INSERT INTO university_images (university_id, file_name, upload_time)VALUES(0, '".$fileName."','".date("Y-m-d H:i:s")."')";
		mysqli_query($conn, $mysql_insert) or die("database error:". mysqli_error($conn));
    }    
}
?>