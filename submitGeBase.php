<?php 
	require("data_process/connect.php");
	require("private/mail_initial.php");
	function generate_password( $length ) {  
	// 密码字符集，可任意添加你需要的字符  
	$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';  
	$password = '';  
	for ( $i = 0; $i < $length; $i++ )  
	{  
	// 这里提供两种字符获取方式  
	// 第一种是使用 substr 截取$chars中的任意一位字符；  
	// 第二种是取字符数组 $chars 的任意元素  
	// $password .= substr($chars, mt_rand(0, strlen($chars) – 1), 1);  
	$password .= $chars[ mt_rand(0, strlen($chars) - 1) ];  
	}  
	return $password;  
	} 
	$safeCode = generate_password(50);
	$link = "http://cityofu.com/ge/geBaseMailVerify.php?";
	$link .= "safeCode=";
	$link .= $safeCode;
	$mailto = $_POST['email'] . "-c@my.cityu.edu.hk";
	$body = "您好，感谢提供课程基础数据，请点击：\n\n" . $link;
	sendMail($mailto, "mailVerify testing", $body);
		if (PEAR::isError($mail)) {
		   $verifySent = false;
		  } else {
		   $verifySent = true;
		  }
	$sql = "INSERT INTO mailVerify (
			geCode, name, name_CN, lang, quiz, finalExam, 
			presentation, report, groupMember, user, safeCode) 
			VALUES (
			:geCode, :name, :name_CN, :lang, :quiz, :finalExam, 
			:presentation, :report, :groupMember, :user, :safeCode)
			";
	try {
		$st = $conn -> prepare( $sql );
		$st -> bindValue( ":geCode", $_POST['geCode'], PDO::PARAM_STR);
		$st -> bindValue( ":name", $_POST['name'], PDO::PARAM_STR);
		$st -> bindValue( ":name_CN", $_POST['name_CN'], PDO::PARAM_STR);
		$st -> bindValue( ":lang", $_POST['lang'], PDO::PARAM_STR);
		$st -> bindValue( ":quiz", $_POST['quiz'], PDO::PARAM_INT);
		$st -> bindValue( ":finalExam", $_POST['finalExam'], PDO::PARAM_INT);
		$st -> bindValue( ":presentation", $_POST['presentation'], PDO::PARAM_INT);
		$st -> bindValue( ":report", $_POST['report'], PDO::PARAM_INT);
		$st -> bindValue( ":groupMember", $_POST['groupMember'], PDO::PARAM_STR);
		$st -> bindValue( ":user", $_POST['email'], PDO::PARAM_STR);
		$st -> bindValue( ":safeCode", $safeCode, PDO::PARAM_STR);
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
<title>提交结果</title>
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
					<h1 class="panel-title">下一步：邮件认证</h1>
				</div>
				<?php 
				if ($verifySent) echo "您好，我们已经向您的邮箱".$mailto."发送了一封邮件，点开其中的链接即可完成。另外，学校邮箱的垃圾处理能力比较强，请直接查看垃圾箱。";
				else echo "您好，由于我们的邮箱服务器垃圾处理能力太强，邮件无法发送，请稍后再试或者手动报告给landxh@gmail.com让我们手动处理邮件，我们推荐后者。";
				?>
			</div>
		</div>
	</div>
</div>
<!-- bootstrap js -->
<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>