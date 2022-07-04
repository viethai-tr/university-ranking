<?php
      include "dbConn.php";
      $results_per_page = 20;
      $university_name = $_POST['university_name'];
      if (isset($_POST['country'])) {
        $country = $_POST['country'];
      } else {
        $country = "Australia";
      }
      if (isset($_POST['submit'])) {
        $sql = "INSERT INTO data(university_name, country, teaching, international, research, citations, income, total_score, num_students, student_staff_ratio, international_students, female_male_ratio) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssddddddddss", $_POST['university_name'], $country, $_POST['teaching'], $_POST['international'], $_POST['research'], $_POST['citations'], $_POST['income'], $_POST['total_score'], $_POST['num_students'], $_POST['student_staff_ratio'], $_POST['international_students'], $_POST['female_male_ratio']);
        $maxsize = 2097152;
        $uploadname = basename($_FILES['university_image']['name']);
        if ($stmt->execute()) {
          if ($uploadname != "") {
            if ($_FILES['university_image']['size'] >= $maxsize || $_FILES['university_image']['size'] == 0) {
              $message = "Ảnh quá lớn. Dung lượng ảnh < 2MB";
            } else {
                $get_university_id = "SELECT university_id FROM data WHERE university_name = '$university_name' AND country = '$country'";
                $res_data = mysqli_query($conn, $get_university_id);
                while ($row2 = mysqli_fetch_assoc($res_data)) {
                    $path = $_FILES['university_image']['name'];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    $new_name = $row2['university_id'].".".$ext;
                    $university_id = $row2['university_id'];
                    $insert = "INSERT INTO university_images(university_id, file_name, upload_time) VALUES('$university_id', '$new_name', NOW())";
                    if (mysqli_query($conn, $insert)) {
                      move_uploaded_file($_FILES['university_image']['tmp_name'], "../uploads/$new_name");
                      $message = "Thêm thành công!";
                    }
                }
              }
            } else {
              $message = "Thêm thành công!";
            }
        } else {
          $message = "Thêm thất bại!";
        }
      }
      echo "<script type='text/javascript'>alert('$message');</script>";
      header("refresh:0; url=list-universities.php");
?>