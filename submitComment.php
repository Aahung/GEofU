<?php
	$submitCondition = 1;
	$date = new DateTime();
	$time = $date->getTimestamp();
	require("data_process/connect.php");
	require("private/mail_initial.php");
	$sql = "INSERT INTO comments (time, geCode, overallRange, gradeRange, 
			gradeSatisfaction, difficulty, loads, value, comment) VALUES 
			(:time, :geCode, :overallRange, :gradeRange, 
			:gradeSatisfaction, :difficulty, :loads, :value, :comment)";
	try {
		$st = $conn -> prepare( $sql );
		$st -> bindValue( ":time", $time, PDO::PARAM_STR);
		$st -> bindValue( ":geCode", $_POST["geCode"], PDO::PARAM_STR);
		$st -> bindValue( ":overallRange", $_POST["overallRange"], PDO::PARAM_INT);
		$st -> bindValue( ":gradeRange", $_POST["gradeRange"], PDO::PARAM_STR);
		$st -> bindValue( ":gradeSatisfaction", $_POST["gradeSatisfaction"], PDO::PARAM_INT);
		$st -> bindValue( ":difficulty", $_POST["difficulty"], PDO::PARAM_INT);
		$st -> bindValue( ":loads", $_POST["loads"], PDO::PARAM_INT);
		$st -> bindValue( ":value", $_POST["value"], PDO::PARAM_INT);
		$st -> bindValue( ":comment", $_POST["comment"], PDO::PARAM_STR);
		$st -> execute();
	} catch(PDOException $e) {
		$submitCondition = 0;
		$message = $e -> getMessage();
		$post = json_encode($_POST);
		$message = $message . "\n\n" . $post;
		$to = "landxh@gmail.com";
		$subject = "提交失败信息";
		$headers = $_POST;
		sendMail($to,$subject,$message);
		$messageSent = 1;
	}
	//update summary
	$sql_comment = "SELECT * FROM comments WHERE geCode = '" . $_POST["geCode"] . "'";
	$rows = $conn -> query( $sql_comment);
	$overallRange = $gradeRange = $gradeSatisfaction = $difficulty = $loads = $value = $commentNum = 0;
	foreach ($rows as $row) {
		$overallRange += $row['overallRange'];
		$gradeRange += $row['gradeRange'];
		$gradeSatisfaction += $row['gradeSatisfaction'];
		$difficulty += $row['difficulty'];
		$loads += $row['loads'];
		$value += $row['value'];
		$commentNum ++;
	}
	if ($commentNum == 1) {
		$sql_summary = "INSERT INTO summary (geCode, overallRange, gradeRange, gradeSatisfaction,
						difficulty, loads, value, commentNum) VALUES (:geCode, :overallRange, :gradeRange,
						:gradeSatisfaction, :difficulty, :loads, :value, :commentNum)
						";
	}
	else {
		$sql_summary = "UPDATE summary SET overallRange = :overallRange, 
						gradeRange = :gradeRange, gradeSatisfaction = :gradeSatisfaction,
						difficulty = :difficulty, loads = :loads, value = :value,
						commentNum = :commentNum WHERE geCode = :geCode
						";
	}
	try {
		$st_summary = $conn -> prepare( $sql_summary );
		$st_summary -> bindValue( ":geCode", $_POST["geCode"], PDO::PARAM_STR);
		$st_summary -> bindValue( ":overallRange", $overallRange/$commentNum, PDO::PARAM_STR);
		$st_summary -> bindValue( ":gradeRange", $gradeRange/$commentNum, PDO::PARAM_STR);
		$st_summary -> bindValue( ":gradeSatisfaction", $gradeSatisfaction/$commentNum, PDO::PARAM_STR);
		$st_summary -> bindValue( ":difficulty", $difficulty/$commentNum, PDO::PARAM_STR);
		$st_summary -> bindValue( ":loads", $loads/$commentNum, PDO::PARAM_STR);
		$st_summary -> bindValue( ":value", $value/$commentNum, PDO::PARAM_STR);
		$st_summary -> bindValue( ":commentNum", $commentNum, PDO::PARAM_INT);
		$st_summary -> execute();
	} catch(PDOException $e) {
		$message = $e -> getMessage();
		$post = json_encode($_POST);
		$message = $message . "\n\n" . $post;
		$to = "landxh@gmail.com";
		$subject = "提交更新summary失败信息";
		$from = "submitBugRopert@cityofu.com";
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
					<h1 class="panel-title"><?php if ($submitCondition) echo "提交成功！"; else echo "提交失败:-("; ?></h1>
				</div>
				<?php 
					if ($submitCondition) echo '
						感谢您的提交，非常感谢。提交结果已经实时出现在'.$_POST["geCode"].'的评论列表中，<a href="http://cityofu.com/ge/coursedetail.php?course='. $_POST["geCode"] .'">请点击查看</a>
					';
					elseif ($submitCondition == 0) {
						echo '
							很抱歉告诉您，您的提交出现了一些问题，
						';
						if ($messageSent) {
							echo '问题已经被反馈，';
						}
						else {
							echo '问题反馈失败，';
						}
						echo "您可以选择重试或者联系landxh@gmail.com 留下您的联系方式，以便找到问题后可以及时联系到您，对带来的麻烦深感抱歉。";
					}
				?>
			</div>
		</div>
	</div>
</div>
</body>
</html>