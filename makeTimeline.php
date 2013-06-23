<!--这个文件是用于tocomment.php文件的末尾，
每当有新评论被生成的时候，
自动生成副本在_commentTimeline.xml中，
并保证此文件中最多只有十个评论。-->
<?php

$commentTimeline = simplexml_load_file("_commentTimeline.xml");
$_comment = $commentTimeline -> addChild("comment");
$_GECode = $_comment -> addChild("GECode", $GECode);
$_comment->addAttribute("id",$submitTimeStamp);
$_comment->addChild("OverallRange",$_POST['OverallRange']);
$_comment->addChild("GradeRange",$_POST['GradeRange']);
$_comment->addChild("GradeStisfication",$_POST['GradeSatisfication']);
$_comment->addChild("CourseDifficulty",$_POST['CourseDifficulty']);
$_comment->addChild("CourseLoad",$_POST['CourseLoad']);
$_comment->addChild("CourseValue",$_POST['CourseValue']);
$_comment->addChild("CustomComment",$_POST['CustomComment']);

$_comments = $commentTimeline -> xpath("child::comment");
while (count($_comments)>=11){
    $_commentToBeRemoved = $_comments[10];
    $commentTimeline -> removeChild($_commentToBeRemoved);
}


$commentTimeline -> asxml("_commentTimeline.xml");
?>
