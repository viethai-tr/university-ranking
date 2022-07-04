<!DOCTYPE html>
<html lang="en"><!-- Basic -->
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
   
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
     <!-- Site Metas -->
    <title>Bảng xếp hạng đại học</title>  
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

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
	<!-- Start header -->
	<?php include "php/header.php" ?>
	<!-- End header -->
	
	<!-- Start slides -->
	<div id="slides" class="cover-slides">
		<ul class="slides-container">
			<?php
				include "sources/dbConn.php";
				
				$sql = "SELECT RANK() over ( order by total_score desc ) AS rank, university_name, university_id FROM data ORDER BY total_score DESC LIMIT 0,4";
				$result = mysqli_query($conn, $sql);

				while($row = mysqli_fetch_assoc($result)) {
					$university_id = $row['university_id'];
					$sql_image = "SELECT university_images.file_name AS file_name FROM university_images, data WHERE university_images.university_id = data.university_id AND data.university_id = $university_id";
					$result_image = mysqli_query($conn, $sql_image);

					echo "<li class=\"text-left\">";
					if (mysqli_num_rows($result_image) != 0) {
						while ($row_image = mysqli_fetch_assoc($result_image)) {
							echo "<img src=\"uploads/".$row_image["file_name"]."\" alt=\"\">";
						}
					}
					echo "<div class=\"container\">";
					echo "<div class=\"row\"> <div class=\"col-md-12\">";
					echo "<h1 class=\"m-b-20\"><strong>".$row["university_name"]."</strong></h1>";
					echo "<p class=\"m-b-40\"> Xếp thứ ".$row["rank"]."</p>";
					echo "<p><a class=\"btn btn-lg btn-circle btn-outline-new-white\" href=\"detail.php?id=".$row["university_id"]."\">Chi tiết</a></p>";
				}
			?>
		</ul>
		<div class="slides-navigation">
			<a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
			<a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
		</div>
	</div>
	<!-- End slides -->
		
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