<?php 
date_default_timezone_set('PRC');
$lastUpdate = time();
// Create connection
$dsn = "mysql: host=localhost; dbname=hypearls_GEofU";
$username = "hypearls_geofu";
$password = "Q)GOvo#@[.zI";

try {
	$conn = new PDO( $dsn, $username, $password);
	$conn -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch ( PDOException $e) {
	echo "Connection failed: " . $e -> getMessage();
}

$geCode = "GE1101";
$or = 0;
$gr = 0;
$gs = 0;
$di = 0;
$lo = 0;
$va = 0;
$cNum = 0;

$sql = "SELECT * FROM comments ORDER BY geCode";
$sql2 = "INSERT INTO summary (
		geCode, overallRange, gradeRange, gradeSatisfaction, difficulty, loads, value, commentNum) 
		VALUES ( 
		:geCode, :overallRange, :gradeRange, :gradeSatisfaction, :difficulty, :loads, :value, :commentNum) ;";
$rows = $conn -> query( $sql );
foreach ($rows as $row) {
	if ($row["geCode"] == $geCode) {
		$or += $row["overallRange"];
		$gr += $row["gradeRange"];
		$gs += $row["gradeSatisfaction"];
		$di += $row["difficulty"];
		$lo += $row["loads"];
		$va += $row["value"];
		$cNum ++;
	}
	else {
		try{
			$st = $conn -> prepare( $sql2 );
			$st -> bindValue( ":geCode", $geCode, PDO::PARAM_STR );
			$st -> bindValue( ":overallRange", $or / $cNum, PDO::PARAM_STR );
			$st -> bindValue( ":gradeRange", $gr / $cNum, PDO::PARAM_STR );
			$st -> bindValue( ":gradeSatisfaction", $gs / $cNum, PDO::PARAM_STR );
			$st -> bindValue( ":difficulty", $di / $cNum, PDO::PARAM_STR );
			$st -> bindValue( ":loads", $lo / $cNum, PDO::PARAM_STR );
			$st -> bindValue( ":value", $va / $cNum, PDO::PARAM_STR );
			$st -> bindValue( ":commentNum", $cNum, PDO::PARAM_STR );
			$st -> execute();
		}
		catch ( PDOException $e) {
		echo "Connection failed: " . $e -> getMessage();
	    }

		$geCode = $row["geCode"];
		$or = $row["overallRange"];
		$gr = $row["gradeRange"];
		$gs = $row["gradeSatisfaction"];
		$di = $row["difficulty"];
		$lo = $row["loads"];
		$va = $row["value"];
		$cNum = 1;
	}
}

?>