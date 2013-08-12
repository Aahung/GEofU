<?php 
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
$courseList = simplexml_load_file("_commentdata.xml");
	//获取所评论内容
$courses=$courseList->xpath("child::course");
for($j=0;$j<count($courses);$j++) {
	$course = $courses[$j];
	$geCode = (string)$course -> GEcode;
	$comments = $course->xpath("child::comment");

	for($i=0;$i<count($comments);$i++){

	$comment = $comments[$i];
	$submitTimestamps = $comment['id'];//$comment['id']是获取comment 下的名为id的属性值；
	$overallRanges = (int)$comment -> OverallRange;
	$gradeRanges = (float)$comment -> GradeRange;
	$gradeS = (int)$comment -> GradeStisfication;/*这个为了下面array_count_values用，因为必须为string*/
	$courseDifficultys = (int)$comment -> CourseDifficulty;
	$courseLoads = (int)$comment -> CourseLoad;
	$courseValues = (int)$comment -> CourseValue;
	$customComments = (string)$comment -> CustomComment;

	$sql = "INSERT INTO comments (
		time, geCode, overallRange, gradeRange, 
		gradeSatisfaction, difficulty, loads, value, comment) 
		VALUES ( :time, :geCode, :overallRange, :gradeRange, 
		:gradeSatisfaction, :difficulty, :loads,
		 :value, :comment ) ";

	try{
		$st = $conn -> prepare( $sql );
		$st -> bindValue( ":time", $submitTimestamps, PDO::PARAM_STR );
		$st -> bindValue( ":geCode", $geCode, PDO::PARAM_STR );
		$st -> bindValue( ":overallRange", $overallRanges, PDO::PARAM_INT );
		$st -> bindValue( ":gradeRange", $gradeRanges );
		$st -> bindValue( ":gradeSatisfaction", $gradeS, PDO::PARAM_INT );
		$st -> bindValue( ":difficulty", $courseDifficultys, PDO::PARAM_INT );
		$st -> bindValue( ":loads", $courseLoads, PDO::PARAM_INT );
		$st -> bindValue( ":value", $courseValues, PDO::PARAM_INT );
		$st -> bindValue( ":comment", $customComments, PDO::PARAM_STR );
		$st -> execute();
	}
	catch ( PDOException $e) {
	echo "Connection failed: " . $e -> getMessage();
}
	}
};
?>