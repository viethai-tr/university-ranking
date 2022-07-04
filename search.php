<!DOCTYPE html>
<html lang="en"><!-- Basic -->
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
   
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
     <!-- Site Metas -->
    <title>Tìm kiếm</title>  
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

<body style="margin: 0px">
	<!-- Start header -->
	<?php include "php/header.php" ?>
	<!-- End header -->
	<?php
		include "sources/dbConn.php";
    	$sql_country = "SELECT country_name FROM country ORDER BY country_name";
    	$res_data2 = mysqli_query($conn,$sql_country);
  	?>
	<!-- Start All Pages -->
	<div class="all-page-title page-breadcrumb">
		<div class="container text-center">
			<div class="row">
				<div class="col-lg-12">
					<h1>Tìm kiếm</h1>
				</div>
			</div>
		</div>
	</div>
	<!-- End All Pages -->
	<div class="contact-box">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<form id="contactForm">
						<div class="row">
							<table>
								<tr>
									<td colspan=2>
										<div class="col-md-12">
											<div class="form-group">
												<input type="text" class="form-control" id="searchName" name="searchName" placeholder="Tên trường">
											</div>                                 
										</div>
									</td>
								</tr>
								<tr>
									<td colspan=2>
										<div class="col-md-12">
											<div class="form-group">
												<select id="searchCountry" name="searchCountry" class="form-control">
							                        <option value="" name="">Quốc gia</option>
							                        <?php
							                          while ($row2 = mysqli_fetch_assoc($res_data2)) {
							                            echo "<option value=\"";
							                            echo $row2['country_name'];
							                            echo "\" name=\"";
							                            echo $row2['country_name'];
							                            echo "\"";
							                            echo ">";
							                            echo $row2['country_name'];
							                            echo "</option>";
							                          }
							                        ?>
							                      </select>
											</div>                                 
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="col-md-12">
											<div class="form-group">
												<input type="text" class="form-control" id="searchScoreFrom" name="searchScoreFrom" placeholder="Điểm từ">
												<div class="help-block with-errors"></div>
											</div>                                 
										</div>
									</td>
									<td>
										<div class="col-md-12">
											<div class="form-group">
												<input type="text" class="form-control" id="searchScoreTo" name="searchScoreTo" placeholder="đến">
												<div class="help-block with-errors"></div>
											</div>                                 
										</div>
									</td>
								</tr>	
								<tr>
									<td>
										<div class="col-md-12">
											<div class="form-group">
												<input type="text" class="form-control" id="searchRankFrom" name="searchRankFrom" placeholder="Hạng từ">
												<div class="help-block with-errors"></div>
											</div>                                 
										</div>
									</td>
									<td>
										<div class="col-md-12">
											<div class="form-group">
												<input type="text" class="form-control" id="searchRankTo" name="searchRankTo" placeholder="đến">
												<div class="help-block with-errors"></div>
											</div>                                 
										</div>
									</td>
								</tr>
								<tr>
									<td colspan=2>
										<div class="submit-button text-center">
											<button class="btn btn-common" id="submit" type="submit">Tìm kiếm</button>
											<br> &nbsp
											<div id="msgSubmit" class="h3 text-center hidden"></div> 
											<div class="clearfix"></div> 
										</div>

									</td>
								</tr>
							</table>
						</div>
					</form>
				</div>
			</div>
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