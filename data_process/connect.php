<?php 
date_default_timezone_set('Asia/Shanghai');
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



?>