<?php
	include "dbConn.php";
    $ud_university_id = $_POST['university_id'];
    $ud_university_name = $_POST["ud_university_name"];
    $ud_country = $_POST["ud_country"];
    $ud_teaching = $_POST["ud_teaching"];
    $ud_international = $_POST["ud_international"];
    $ud_research = $_POST["ud_research"];
    $ud_citations = $_POST["ud_citations"];
    $ud_income = $_POST["ud_income"];
    $ud_total_score = $_POST["ud_total_score"];
    $ud_num_students = $_POST["ud_num_students"];
    $ud_student_staff_ratio = $_POST["ud_student_staff_ratio"];
    $ud_international_students = $_POST["ud_international_students"];
    $ud_female_male_ratio = $_POST["ud_female_male_ratio"];
    $uploadname = basename($_FILES['ud_university_image']['name']);
    $maxsize = 2097152;
        $sql = "UPDATE data SET university_name=?, country=?, teaching=?, international=?, research=?, citations=?, income=?, total_score=?, num_students=?, student_staff_ratio=?, international_students=?, female_male_ratio=? WHERE university_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssddddddddssi", $ud_university_name, $ud_country, $ud_teaching, $ud_international, $ud_research, $ud_citations, $ud_income, $ud_total_score, $ud_num_students, $ud_student_staff_ratio, $ud_international_students, $ud_female_male_ratio, $_POST['university_id']);
        if ($stmt->execute()) {
            if ($uploadname != "") {
                if (($_FILES['ud_university_image']['size'] >= $maxsize || $_FILES['ud_university_image']['size'] == 0)) {
                    $message = "Ảnh quá lớn. Dung lượng ảnh < 2MB";
                } else {
                    $path = $_FILES['ud_university_image']['name'];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    $new_name = $ud_university_id.".".$ext;
                    $sql_empty = "SELECT file_name FROM university_images WHERE university_id = $ud_university_id";
                    $check_empty = mysqli_query($conn, $sql_empty);
                    if (mysqli_num_rows($check_empty) != 0) {
                        $update = "UPDATE university_images SET file_name = '$new_name', upload_time = NOW() WHERE university_id = $ud_university_id";
                        if (mysqli_query($conn, $update)) {
                            move_uploaded_file($_FILES['ud_university_image']['tmp_name'], "../uploads/$new_name");
                            $message = "Sửa thông tin thành công!";
                        }
                    } else {
                        $insert = "INSERT INTO university_images(university_id, file_name, upload_time) VALUES('$ud_university_id', '$new_name', NOW())";
                        if (mysqli_query($conn, $insert)) {
                            move_uploaded_file($_FILES['ud_university_image']['tmp_name'], "../uploads/$new_name");
                            $message = "Sửa thông tin thành công!";
                        }
                    }
                }
            } else {
                $message = "Sửa thông tin thành công!";
            } 
        } else {
            $message = "Sửa thông tin thất bại!";
        }
    echo "<script type='text/javascript'>alert('$message');</script>";
    header("refresh:0; url=list-universities.php");
?>