<!DOCTYPE html>
<html lang="en"><!-- Basic -->
<head>
	<?php
		include "sources/dbConn.php";
		$id = $_GET["id"];
		$sql = "SELECT university_name AS name FROM data WHERE university_id = '".$id."' " ; 
		$sql_image = "SELECT university_images.file_name AS file_name FROM data, university_images WHERE data.university_id = university_images.university_id AND data.university_id ='".$id."'";
		$result_header = mysqli_query($conn, $sql);
		$result_image = mysqli_query($conn, $sql_image);
		if (mysqli_num_rows($result_header) > 0) {
			while ($row_header = mysqli_fetch_assoc($result_header)) {
				$name = $row_header["name"];
			}
		}
		if (mysqli_num_rows($result_image) > 0) {
			while ($row_image = mysqli_fetch_assoc($result_image)) {
				$file_name = $row_image["file_name"];
			}
		}
	?>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
   
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
     <!-- Site Metas -->
    <title>Chi tiết trường <?=$name?></title>  
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">    
	<!-- Site CSS -->
    <link rel="stylesheet" href="css/stylenew.css">    
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">   

    <style>
    	.page-breadcrumb {
    		<?php
    			if ($file_name != "") {
    				echo "background: url(uploads/$file_name) no-repeat;";
    			} else {
    				echo "background: url(images/all-bg.jpg) no-repeat;";
    			}
    		?>
    </style>

</head>

<body>
	<style>
	 td:not(:first-child) {
		 clear: both;
		 margin-left: 100px;
		 padding: 10px 30px 10px 100px;
		 position: relative;
	}
		
		.score-detail {
			width: 118%;
		}
	</style>

	<!-- Start header -->
	<?php include "php/header.php" ?>
	<!-- End header -->
	
	<!-- Start All Pages -->
	<div class="all-page-title page-breadcrumb">
		<div class="container text-center">
			<div class="row">
				<div class="col-lg-12">
					<h1><?=$name?></h1>
				</div>
			</div>
		</div>
	</div>
	<!-- End All Pages -->
	
	

	<div class="contact-box-detail">
		<div class="container">
		
		<?php
			$sql_detail = "SELECT university_id, university_name, country, teaching, international, research, citations, income, total_score, num_students, student_staff_ratio, international_students, female_male_ratio, country.continent AS continent FROM data, country WHERE data.country = country.country_name AND data.university_id = '".$id."' " ; 
			$sql_rank = "SELECT university_id, RANK() over ( order by data.total_score desc ) AS rank_overall, RANK() over ( order by data.teaching desc ) AS rank_teaching, RANK() over ( order by data.international desc ) AS rank_international, RANK() over ( order by data.research desc ) AS rank_research, RANK() over ( order by data.citations desc ) AS rank_citations, RANK() over ( order by data.income desc ) AS rank_income, RANK() over ( order by data.num_students desc ) AS rank_num_students, RANK() over ( order by data.student_staff_ratio desc ) AS rank_student_staff_ratio, RANK() over ( order by data.international_students desc ) AS rank_international_students FROM data";
			$result = mysqli_query($conn, $sql_detail);
			$result_rank = mysqli_query($conn, $sql_rank);				
							if (mysqli_num_rows($result) > 0) {
								while($row = mysqli_fetch_assoc($result)) {
									while ($row_rank = mysqli_fetch_assoc($result_rank)) {
										if ($row["university_id"] == $row_rank["university_id"]) {
											echo "<div class=\"row score-detail\" style=\"font-size: 20px\">";
											echo "<div class=\"col-lg-5\">";
											echo "<table>";
											echo "<tr>";
											echo "<td><b></b></td>";
											echo "</tr>";
											echo "<tr>";
											echo "<td><b>Tên: </b></td>";
											echo "<td>";
											echo $row['university_name'];
											echo "</td>";
											echo "</tr><tr>";
											echo "<td><b>Vùng: </b></td>";
											echo "<td>Châu ";
											if ($row["continent"] == "Africa") echo "Phi";
											if ($row["continent"] == "America") echo "Mỹ";
											if ($row["continent"] == "Asia") echo "Á";
											if ($row["continent"] == "Australia") echo "Úc";
											if ($row["continent"] == "Europe") echo "Âu";
											echo "</td>";
											echo "</tr><tr>";
											echo "<td><b>Quốc gia: </b></td>";
											echo "<td>";
											echo $row["country"];
											echo "</td>";
											echo "</tr><tr>";
											echo "<td><b>Điểm: </b></td>";
											echo "<td>";
											echo $row["total_score"];
											echo "</td>";
											echo "</tr><tr>";
											echo "<td><b>Xếp hạng: </b></td>";
											echo "<td>";
											echo $row_rank["rank_overall"];
											echo "</td>";
											echo "</tr>";
											echo "</table>";
											echo "</div>";

											echo "<div class=\"col-lg-7\">";
											echo "<table>";
											echo "<tr style=\"color: #1f56ad\">";
											echo "<td><b>Tiêu chí</b></td>";
											echo "<td><b>Điểm</b></td>";
											echo "<td><b>Xếp hạng</b></td>";
											echo "</tr><tr>";
											echo "<td><b>Dạy học: </b></td>";
											echo "<td>";
											echo $row['teaching'];
											echo "</td>";
											echo "<td>";
											echo $row_rank['rank_teaching'];
											echo "</td>";
											echo "</tr><tr>";
											echo "<td><b>Quốc tế: </b></td>";
											echo "<td>";
											echo $row['international'];
											echo "</td>";
											echo "<td>";
											echo $row_rank['rank_international'];
											echo "</td>";
											echo "</tr><tr>";
											echo "<td><b>Nghiên cứu: </b></td>";
											echo "<td>";
											echo $row['research'];
											echo "</td>";
											echo "<td>";
											echo $row_rank['rank_research'];
											echo "</td>";
											echo "</tr><tr>";
											echo "<td><b>Trích dẫn: </b></td>";
											echo "<td>";
											echo $row['citations'];
											echo "</td>";
											echo "<td>";
											echo $row_rank['rank_citations'];
											echo "</td>";
											echo "</tr><tr>";
											echo "<td><b>Số sinh viên: </b></td>";
											echo "<td>";
											echo $row['num_students'];
											echo "</td>";
											echo "<td>";
											echo $row_rank['rank_num_students'];
											echo "</td>";
											echo "</tr><tr>";
											echo "<td><b>Sinh viên / nhân viên: </b></td>";
											echo "<td>";
											echo $row['student_staff_ratio'];
											echo "</td>";
											echo "<td>";
											echo $row_rank['rank_student_staff_ratio'];
											echo "</td>";
											echo "</tr><tr>";
											echo "<td><b>Tỉ lệ sinh viên quốc tế: </b></td>";
											echo "<td>";
											echo $row['international_students'];
											echo "</td>";
											echo "<td>";
											echo $row_rank['rank_international_students'];
											echo "</td>";
											echo "</tr>";
											echo "</table>";
											echo "</div></div>";
										}
									}
								}
							}
									
							mysqli_close($conn);
							?>	

		</div>
	</div>

	<!-- Start Footer -->
	<?php include "php/footer.php" ?>
	<!-- End Footer -->
	
	<a href="#" id="back-to-top" title="Back to top" style="display: none;"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></a>

	<!-- ALL JS FILES -->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <!-- ALL PLUGINS -->
	
	<script src="js/jquery.superslides.min.js"></script>
	<script src="js/images-loded.min.js"></script>
	<script src="js/isotope.min.js"></script>
	<script src="js/baguetteBox.min.js"></script>
	<script src="js/form-validator.min.js"></script>
    <script src="js/contact-form-script.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>