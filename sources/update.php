<?php
	include "dbConn.php";

	$ud_world_rank = $_POST["ud_world_rank"];
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

    $sql = "UPDATE data SET world_rank=?, university_name=?, country=?, teaching=?, international=?, research=?, citations=?, income=?, total_score=?, num_students=?, student_staff_ratio=?, international_students=?, female_male_ratio=? WHERE university_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issddddddddssi", $ud_world_rank, $ud_university_name, $ud_country, $ud_teaching, $ud_international, $ud_research, $ud_citations, $ud_income, $ud_total_score, $ud_num_students, $ud_student_staff_ratio, $ud_international_students, $ud_female_male_ratio, $_POST['university_id']);
    if ($stmt->execute()) {
      $message = "Sửa thông tin thành công!";
    } else {
      $message = "Sửa thông tin thất bại!";
    }
    echo "<script type='text/javascript'>alert('$message');</script>";
    header("refresh:0; url=list-universities.php");
?>