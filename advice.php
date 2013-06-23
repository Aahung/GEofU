<!DOCTYPE HTML>
<html>
<head><meta charset="utf-8" /></head>
<body>
<a href="index.php"><h1>返回首页</h1></a>
<?php
$to = "landxh@gmail.com";
$subject = "GEofU bug report";
$message ="name:". $_POST['name'] . "\n email:" . $_POST['email'] . "\n Misscode:" . $_POST['Misscode'] . "\n othercomment" . $_POST['othercomment'] . "\n"  ;
$from = "GEofUbugreport@cityofu.com";
$headers = "From:" . $from;
mail($to,$subject,$message,$headers);
echo "内容<pre>". $message ."</pre>";
echo "Sent.";
?>
</body>
</html>