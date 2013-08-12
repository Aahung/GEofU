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



// 导入数据
$GEnamelist = simplexml_load_file("GEcode.xml");
for ($GEareanum = 1; $GEareanum < 6; $GEareanum++) {
	$GEarea = "AREA".$GEareanum;
    $GEcourses = $GEnamelist->xpath("$GEarea/child::TR[TD='GE']");
    for ($i=0; $i<count($GEcourses);$i++){
    	$GEcourse = $GEcourses[$i];
	    $GEnames = $GEcourse->xpath("child::TD");
	    $GEcodenum = $GEnames[2];
	    $GEname = $GEnames[3];
	    $GEcode = "GE" . $GEcodenum;
	    $sql = "INSERT INTO ge (
		code, area, name, lastUpdate) 
		VALUES ( :code, :area, :name, :lastUpdate ) 
		;";
		try{
			$st = $conn -> prepare( $sql );
			$st -> bindValue( ":code", $GEcode, PDO::PARAM_STR );
			$st -> bindValue( ":area", $GEareanum, PDO::PARAM_INT );
			$st -> bindValue( ":name", $GEname, PDO::PARAM_STR );
			$st -> bindValue( ":lastUpdate", $lastUpdate, PDO::PARAM_STR );
			$st -> execute();
		}
		catch ( PDOException $e) {
		echo "Connection failed: " . $e -> getMessage();
	    }
	}
}


?>