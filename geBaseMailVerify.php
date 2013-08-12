<?php 
$date = new DateTime();
$time = $date->getTimestamp();
require("data_process/connect.php");
require("private/mail_initial.php");
$safeCode = $_GET['safeCode'];
$sql1 = "SELECT * FROM mailVerify WHERE used = 0 AND safeCode = '" . $safeCode . "'";
$st1 = $conn -> prepare( $sql1 );
$st1 -> execute();
$rows = $st1 -> fetchAll();
if (count($rows) != 0){
	$verifyResult = true;
	$row = $rows[0];
	$sql2 = "UPDATE ge SET name_CN = :name_CN, lang = :lang, quiz = :quiz, finalExam = :finalExam, 
			presentation = :presentation, report = :report, groupMember = :groupMember, 
			updatedBy = :user, lastUpdate = :lastUpdate  WHERE code = :geCode
			";
	try {
		$st = $conn -> prepare( $sql2 );
		$st -> bindValue( ":geCode", $row['geCode'], PDO::PARAM_STR);
		$st -> bindValue( ":name_CN", $row['name_CN'], PDO::PARAM_STR);
		$st -> bindValue( ":lang", $row['lang'], PDO::PARAM_STR);
		$st -> bindValue( ":quiz", $row['quiz'], PDO::PARAM_INT);
		$st -> bindValue( ":finalExam", $row['finalExam'], PDO::PARAM_INT);
		$st -> bindValue( ":presentation", $row['presentation'], PDO::PARAM_INT);
		$st -> bindValue( ":report", $row['report'], PDO::PARAM_INT);
		$st -> bindValue( ":groupMember", $row['groupMember'], PDO::PARAM_STR);
		$st -> bindValue( ":user", $row['user'], PDO::PARAM_STR);
		$st -> bindValue( ":lastUpdate", $time, PDO::PARAM_STR);
		$st -> execute();
	}catch (PDOException $e) {
		$message = $e -> getMessage();
		$post = json_encode($_POST);
		$message = $message . "\n\n" . $post;
		$to = "landxh@gmail.com";
		$subject = "提交失败信息";
		$headers = $_POST;
		sendMail($to,$subject,$message);
	}
	$sql3 = "UPDATE mailVerify SET used = 1 WHERE used = 0 AND safeCode = '" . $safeCode . "'";
	$conn -> query( $sql3 );
}
else {
	$verifyResult = false;
}
?>
<!doctype HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<meta name="keywords" content="GEofU,CityofU,CityU,香港城市大学,GE,精进课程,统计,GPA" />
<meta name="description" content="<?php echo "GE课程 $GECode --$GEName"?>"/>
<link rel="shortcut icon" href="logo/logo.ico" type="image/x-icon"/>
<link href="logo/logo.png" rel="apple-touch-icon" />
<!--Jquery-->
<script src="jquery-1.8.3.min.js"></script>
<!-- Magnific Popup core CSS file -->
<link rel="stylesheet" href="css/magnific-popup.css">
<title>邮箱验证</title>
<!-- bootstrap css -->
<link rel="stylesheet" href="css/bootstrap.css" />
<link rel="stylesheet" href="css/main.css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>
<body>
<?php include_once("analyticstracking.php") ?>
<div class="container">
<?php include("part_nav.php") ?>
	<div class="container">
		<div class="row">
			<div class="panel">
				<div class="panel-heading">
					<h1 class="panel-title">邮件认证<?php if ($verifyResult == true) echo "成功"; else echo "失败"; ?></h1>
				</div>
				<?php if ($verifyResult == true) echo "您提供的信息已经实时更新在课程" .$row['geCode']. "的页面上，<a href='http://cityofu.com/ge/coursedetail.php?course=" . $row['geCode'] . "'>点击此处查看</a>。"; else echo "此链接为无效链接，可能已经被使用过或者不存在。"; ?>
			</div>
		</div>
	</div>
</div>
<!-- bootstrap js -->
<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>