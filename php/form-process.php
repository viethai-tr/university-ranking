<?php
include "../sources/dbConn.php";
$searchName = $_POST["searchName"];
$searchCountry= $_POST["searchCountry"];
$searchScoreFrom = $_POST["searchScoreFrom"];
$searchScoreTo = $_POST["searchScoreTo"];
$searchRankFrom = $_POST["searchRankFrom"];
$searchRankTo = $_POST["searchRankTo"];
$sql = "SELECT RANK() over ( order by total_score desc ) AS rank, university_id, university_name, country, total_score FROM data WHERE university_name LIKE '%".$searchName."%'" ; 
if ($searchCountry != "") {
	$sql = $sql."and country LIKE'%".$searchCountry."%' ";
}
if ($searchScoreFrom != "") {
	$sql = $sql."and total_score <= ".$searchScoreFrom." ";
}
if ($searchScoreTo != "") {
	$sql = $sql. "and total_score >= ".$searchScoreTo." ";
}
$result = mysqli_query($conn, $sql);
 
if (mysqli_num_rows($result) > 0) {
	
	echo "<div class=\"table-users\">";
	echo "<table>";
	echo "<tr> <th> Thứ hạng </th><th> Tên đại học </th> <th> Quốc gia </th> <th> Tổng điểm </th> </tr>";
	// hiển thị dữ liệu trên trang
	while($row = mysqli_fetch_assoc($result)) {
		$check = True;
		if ($searchRankFrom != "") {
			if ($row['rank'] < $searchRankFrom) $check = False;
		}
		if ($searchRankTo != "") {
			if ($row['rank'] > $searchRankTo) $check = False;
		}
		if ($check == True) {
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
	echo "</div>";
} else {
	echo "Không có kết quả";
}

mysqli_close($conn);
?>
