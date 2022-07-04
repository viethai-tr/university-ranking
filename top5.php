<!DOCTYPE html>
<html lang="en"><!-- Basic -->
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
   
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
     <!-- Site Metas -->
    <title>Bảng xếp hạng TOP 5</title>  
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
    <link rel="stylesheet" href="css/table.css">    

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
	<!-- Start header -->
	<?php include "php/header.php" ?>
	<!-- End header -->
	
	<!-- Start All Pages -->
	<div class="all-page-title page-breadcrumb">
		<div class="container text-center">
			<div class="row">
				<div class="col-lg-12">
					<h1>Bảng xếp hạng TOP 5</h1>
				</div>
			</div>
		</div>
	</div>
	<!-- End All Pages -->
	
	<?php
		include "sources/dbConn.php";
		$sql = "SELECT  RANK() over ( order by total_score desc ) AS rank, university_id, university_name, country, total_score FROM data";
		$result = mysqli_query($conn, $sql);
		$sql_score = "SELECT RANK() over ( order by total_score desc ) AS rank, teaching, international, research, citations, total_score FROM data";
		$result_score = mysqli_query($conn, $sql_score);
		$avg_score = 0;
		$avg_teaching = 0;
		$avg_international = 0;
		$avg_research = 0;
		$avg_citations = 0;
		$count = 0;
		while ($row_score = mysqli_fetch_assoc($result_score)) {
			if ($row_score["rank"] <= 5) {
				$avg_score += $row_score["total_score"];
				$avg_teaching += $row_score["teaching"];
				$avg_international += $row_score["international"];
				$avg_research += $row_score["research"];
				$avg_citations += $row_score["citations"];
				$count ++;
			}
		}
		$avg_score /= $count;
		$avg_teaching /= $count;
		$avg_international /= $count;
		$avg_research /= $count;
		$avg_citations /= $count;
	?>

		<div class="header">
		<table><tr><td>
		Điểm trung bình TOP 5: 
		<b><span style="color:#b53843; font-size:28px">
		<?=round($avg_score, 2)?></b></span>.
		</td></tr></table>
		</div>
	<?php
						
						if (mysqli_num_rows($result) > 0) {
							echo "<br>";
							echo "<table>";
							echo "<tr><td>";
							echo "<span class=\"score\">";
							echo "Điểm trung bình theo tiêu chí: Dạy học: ";
							echo "<b>";
							echo round($avg_teaching, 2);
							echo "</b>";
							echo ". Quốc tế: ";
							echo "<b>";
							echo round($avg_international, 2);
							echo "</b>";
							echo ". Nghiên cứu: ";
							echo "<b>";
							echo round($avg_research, 2);
							echo "</b>";
							echo ". Trích dẫn: ";
							echo "<b>";
							echo round($avg_citations, 2);
							echo "</b>.</span>";
							echo "</span>";
							echo "</td></tr></table><br>";
							echo "<table>";
							echo "<tr> <th> Thứ hạng </th><th> Tên đại học </th> <th> Quốc gia </th> <th> Điểm </th> </tr>";
							// hiển thị dữ liệu trên trang
							while($row = mysqli_fetch_assoc($result)) {
								if ($row["rank"] <= 5) {
									echo "<tr>";
									echo "<td>";
									echo $row["rank"];
									echo "</td>";
									echo "<td>";
									echo "<a href=\"detail.php?id=";
									echo $row['university_id'];
									echo "\">";
									echo "<b>";
									echo $row["university_name"];
									echo "</b>";
									echo "</a>";
									echo "</td>";
									echo "<td>";
									echo $row["country"];
									echo "</td>";
									echo "<td>";
									echo $row["total_score"];
									echo "</td>";
									echo "</tr>";
								}
							}
							echo "</table>";
						} else {
							echo "0 results";
						}
						mysqli_close($conn);
						?>		
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