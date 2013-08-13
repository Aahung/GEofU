<?php 
	require("private/mail_initial.php");
	$body = json_encode($_POST);
	sendMail("landxh@gmail.com", "bug提交", $body);
		if (PEAR::isError($mail)) {
		   $verifySent = false;
		  } else {
		   $verifySent = true;
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
<title>bug报告</title>
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
					<h1 class="panel-title">bug报告</h1>
				</div>
				<?php 
				if ($verifySent) echo "非常感谢！";
				else {
					echo "	您好，由于我们的邮箱服务器垃圾处理能力太强，邮件无法发送，请稍后再试或者手动报告给landxh@gmail.com，我们推荐后者。";
					echo "这是您提供的信息：\n";
					echo json_encode($_POST);
				}?>
			</div>
		</div>
	</div>
</div>
<!-- bootstrap js -->
<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>