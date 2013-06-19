
<!--此文档为写入评论之用，分为几
个部分，首先获取创建评论comment tag，然后写入评论，然后更新summary信息，然后保存_commentdata.xml-->

<?php
//为了让时间戳为北京时间
date_default_timezone_set('PRC');
//设定时间戳
$submitTimeStamp = time();
//echo $time_id; //作为debugger之用
//print_r($_POST);//作为debugger之用

//读取评论列表文件_commentdata.xml
$courseList = simplexml_load_file("_commentdata.xml");
//获取post值
$GECode = $_POST['GECode'];

//尝试获取所选的GEcourse，并判断是否存在于_commentd
//ata.xml文件中，若没有，则创建，有，则定义
$courses=$courseList->xpath("child::course[GEcode='$GECode']");
if(empty($courses[0])){
//echo "This course does not exsit, and will be created as well as add comment";//debugger之用
$course = $courseList->addChild("course");
$course->addAttribute("GEarea",$_POST['GEArea']);
$course->addChild("GEcode",$GECode);
}
else{
//echo "this course already exsit, and will only add comment";//debugger之用
$courses=$courseList->xpath("child::course[GEcode='$GECode']");
$course = $courses[0];
}
//增加评论于course的tag中

$comment = $course->addChild("comment");
$comment->addAttribute("id",$submitTimeStamp);
$comment->addChild("OverallRange",$_POST['OverallRange']);
$comment->addChild("GradeRange",$_POST['GradeRange']);
$comment->addChild("GradeStisfication",$_POST['GradeSatisfication']);
$comment->addChild("CourseDifficulty",$_POST['CourseDifficulty']);
$comment->addChild("CourseLoad",$_POST['CourseLoad']);
$comment->addChild("CourseValue",$_POST['CourseValue']);
$comment->addChild("CustomComment",$_POST['CustomComment']);


//增加或者修改summary信息：
//如果summary信息存在，则计算所有评论并修改summary信息
//如果summary信息不存在，则create summary信息，同样计算所有comment并写入summary
//后期可以合并两种情况，让summary的create内嵌于course的create中
$summarys=$course->xpath("child::summary");
if(empty($summarys[0])){
echo "This course does not summary, and will be created";
$summary = $course -> addChild("summary");
$summary -> addChild("AOR");
$summary -> addChild("AGR");
$summary -> addChild("ACD");
$summary -> addChild("ACL");
$summary -> addChild("ACV");
$summary -> addChild("commentNum");

}
else{
echo "this course already have summary, but will modify it";
$summary = $summarys[0];
}


include 'mathuse.php';//用于读取计算平均值的php函数

//计算summary信息值
$comments = $course->xpath("child::comment");
for($i=0;$i<count($comments);$i++){
$comment = $comments[$i];
$submitTimeStamps[$i] = $comment['id'];
$OverallRange[$i] = (int)$comment -> OverallRange;
$GradeRange[$i] = (float)$comment -> GradeRange;
$CourseDifficulty[$i] = (int)$comment -> CourseDifficulty;
$CourseLoad[$i] = (int)$comment -> CourseLoad;
$CourseValue[$i] = (int)$comment -> CourseValue;
$CustomComment[$i] = (string)$comment -> CustomComment;
}


//此处调用mathuse.php中的函数
$AOR = calculate_average($OverallRange);
$AGR = number_format(calculate_average($GradeRange), 2, '.', '');
$ACD = calculate_average($CourseDifficulty);
$ACL = calculate_average($CourseLoad);
$ACV = calculate_average($CourseValue);
$commentNum = count($comments);

//写入summary中
$summary -> AOR = $AOR;
$summary -> AGR = $AGR;
$summary -> ACD = $ACD;
$summary -> ACL = $ACL;
$summary -> ACV = $ACV;
$summary -> commentNum = $commentNum;

//echo "<li>平均总体评价：" .calculate_average($OverallRange);
//echo "<li>平均所得成绩：" .number_format(calculate_average($GradeRange), 2, '.', '');
//echo "<li>平均课程难度：" .calculate_average($CourseDifficulty);
//echo "<li>平均课程任务：" .calculate_average($CourseLoad);//用于debugger
//echo "<li>平均课程使用价值：" .calculate_average($CourseValue);//用于debugger
echo "<li>有多少人评价：" .$commentNum;//用于debugger
?>



<!DOCTYPE HTML>
<html>
<head>
<meta charset='utf-8'>
    <title>感谢您的提交</title>
    <link rel="stylesheet" href="css/main.css" />

</head>
<body>
    <div id="bodyContainer">
<h1 style="text-align: center; margin-top: 300px;">感谢您的提交，您的每一个评价对我们都至关重要</h1>
<a href="index.php"><h2 style="display: inline-block">返回首页</h2></a>
<pre>
<?php


//echo htmlspecialchars(print_r($courseList, true));//debugger之用

//保存并覆写xml文档，防止输入空白课程；
if (empty($_POST['GECode']));
else
$courseList->asxml("_commentdata.xml");


?>
</pre>
    </div>
</body>
</html