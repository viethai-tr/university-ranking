<html lang="">
	<head>
		<title>Xếp hạng đại học</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
	</head>
	<body id="top">
			<div class="wrapper row0">
			  <div id="topbar" class="hoc clear"> 
				<div class="fl_left">
				  <ul class="nospace">
					<li><a href="index.html"><i class="fas fa-home fa-lg"></i></a></li>
					<li><a href="#">Thông tin</a></li>
					<li><a href="#">Liên hệ</a></li>
					<li><a href="login.php">Đăng nhập</a></li>
					<li><a href="#">Đăng ký</a></li>
				  </ul>
				</div>
				<div class="fl_right">
				  <ul class="nospace">
					<li>Nhóm 6</li>
				  </ul>
				</div>
			  </div>
			</div>
			<div class="wrapper row1">
			  <header id="header" class="hoc clear"> 
				<div id="logo">
				  <h1 class="logoname"><a href="index.html"><span>Bảng xếp hạng đại học</span></a></h1>
				</div>
			  </header>
			  <nav id="mainav" class="hoc clear"> 
				<ul class="clear">
				  <li class="active"><a href="index.html">Trang chủ</a></li>
				  <li><a class="drop" href="#">Xếp theo vùng miền</a>
					<ul>
						<li><a href="pages/gallery.html">Miền 1</a></li>
						<li><a href="pages/gallery.html">Miền 2</a></li>
						<li><a href="pages/gallery.html">Miền 3</a></li>
						<li><a href="pages/gallery.html">Miền 4</a></li>
						<li><a href="pages/gallery.html">Miền 5</a></li>
					</ul>
				  </li>
				  <li><a class="drop" href="#">Xếp theo các tiêu chí</a>
					<ul>
						<li><a href="pages/gallery.html">TC 1</a></li>
						<li><a href="pages/gallery.html">TC 2</a></li>
						<li><a href="pages/gallery.html">TC 3</a></li>
						<li><a href="pages/gallery.html">TC 4</a></li>
						<li><a href="pages/gallery.html">TC 5</a></li>
					</ul>
				  </li>
				  <li><a href="#">So sánh</a></li>
				  <li><a href="#">Tìm kiếm</a></li>
				</ul>
			  </nav>
			</div>	
			<div class="wrapper">
				  <main class="hoc container clear bgded overlay" style="background-image:url('images/demo/backgrounds/01.png');"> 
					<div class="sectiontitle">
					  <h1 class="heading">Bảng xếp hạng</h1>
					  <p>Toàn thế giới</p>
					  <?php
					  	include "dbConn.php";
						$results_per_page = 20;
						 
						
						 
						$sql = "SELECT world_rank, university_name, country FROM data" ;
						$result = mysqli_query($conn, $sql);
			
						if (mysqli_num_rows($result) > 0) {
							echo "<table>";
							echo "<tr> <th> Thu hang </th><th> Ten </th> <th> Quoc gia </th> </tr>";
							// hiển thị dữ liệu trên trang
							while($row = mysqli_fetch_assoc($result)) {
								echo "<tr>";
								echo "<td>";
								echo $row["world_rank"];
								echo "</td>";
								echo "<td>";
								echo $row["university_name"];
								echo "</td>";
								echo "<td>";
								echo $row["country"];
								echo "</td>";
								echo "</tr>";
							}
							echo "</table>";
						} else {
							echo "0 results";
						}
						 
						mysqli_close($conn);
						?>
					  
					</div>
					<div class="clear"></div>
				  </main>
			</div>
	</body>


</html>