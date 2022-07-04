<?php
    $servername = "localhost";
    $username = "root";
    $password = "123456";
    $dbname = "web";
    $results_per_page = 20;
     
    // tạo connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // kiểm tra connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
?>