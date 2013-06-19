<?php
//迅速获取课程名字
include "GetGEName.php";
$GEAreaNum=$_GET['a'];
$GECodeNum=$_GET['c'];
$GEName = getGEName($GEAreaNum,$GECodeNum);
$GECode="GE".$GECodeNum;
?>


<!doctype HTML>
<html>
<head>
<meta name="keywords" content="GEofU,CityofU,CityU,香港城市大学,GE,精进课程,统计,GPA" />
<meta name="description" content="GEofU是一个提供CityU GE精进课程的统计型网站"/>
<link rel="shortcut icon" href="logo/logo.ico" type="image/x-icon"/>
<link href="logo/logo.png" rel="apple-touch-icon" />
<title>
    <?php
	//创建函数用于：修正GEArea显示不出CCIV和English的问题
	function CorrectGEArea($GEAreaNum){
	  if ($GEAreaNum == "4")return "English";
	  elseif ($GEAreaNum == "5")return "CCIV";
	  else return "AREA".$GEAreaNum;
	}
        //显示GECode和正常的GEArea；
        $GEAreaCorrected = CorrectGEArea($GEAreaNum);
        echo $GECode . "--" . $GEAreaCorrected;
    ?>
</title>
<meta charset='utf-8'>
<link rel="stylesheet" href="css/main.css" />
<style>
    .jqplot-table-legend
    {
        background-color: black;
    }
    #chartset
    {
        width: 100%;
        float: left;
        border: dashed;
        border-color: white;
    }
    #coutainer
    {
    }
    #commentset
    {
    }
    .comment
    {
        border: dashed;
        border-color: white;
        width: 100%;
        margin: 5px;
    }
    .element
    {
        width: 250px !important;
        height: 250px !important;
        margin: 30px !important;
    }
    .element p
    {
      font-size: larger !important;
      text-align: right;
    }
    .element h2
    {
      font-size: 1.8em !important;
      margin: 0;
    }
    .element h1
    {
      float: right;
      font-size: 3em !important;
    }

</style>
<link rel="stylesheet" type="text/css" href="jqplot/jquery.jqplot.min.css" />
<!--[if lt IE 9]><script language="javascript" type="text/javascript" src="../excanvas.js"></script><![endif]-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<style type="text/css">

    .jqplot-data-label {
      /*color: #444;*/
/*      font-size: 1.1em;*/
    }
    .float-right
    {
        float: right;
    }
    div.img
    {
        display: inline-block;
        padding: 0px !important;
        margin: 5px;
        cursor: pointer;
    }
    div.img img
    {
        margin: 0px !important;
    }
    /*pop提示css*/
    span{
        background:#F8F8F8;
        border: 5px solid #DFDFDF;
        color: #717171;
        font-size: 13px;
        height: 30px;
        letter-spacing: 1px;
        line-height: 30px;
        position: fixed;
        text-align: center;
        text-transform: uppercase;
        display:none;
        padding:0 20px;        
    }
    
    div.img:hover span{
        display:block;
    }
</style>
<script class="include" type="text/javascript" src="jqplot/jquery.jqplot.min.js"></script>
<script class="include" language="javascript" type="text/javascript" src="jqplot/jqplot.pieRenderer.min.js"></script>

</head>
<body>
    
<div id="bodyContainer">
    
<h1>
    <?php
        //显示GECode和正常的GEArea（GEAreaCorrected）
        echo $GECode . "--" . $GEAreaCorrected;
    ?>
    </h1>
<h2>
    <?php
        //显示GEName
        echo $GEName
    ?>
</h2>
<a href="index.php"><h3 style="display: inline-block">返回首页</h3></a><br/>
<a href="courselist.php"><h4 style="display: inline-block">返回课程列表页</h4></a><br/>
<div class="float-right">
    
    <div class="img" onclick="window.open('http://www6.cityu.edu.hk/ge_info/courses/materials/html/<?php echo $GECode; ?>.html')"><span>点击进入EDGE页面查看细节</span><img src="img/EDGE.PNG" /></div>
    <div class="img" onclick="window.open('http://eportal.cityu.edu.hk/bbcswebdav/institution/APPL/Course/Current/<?php echo $GECode; ?>.htm')"> <span>点击进入2B页面查看课程内容和要求</span> <img src="img/2BTable.PNG"/></div>
</div>
<?php
        $courseList = simplexml_load_file("_commentdata.xml");
        $courses=$courseList->xpath("child::course[GEcode='$GECode']");
        if(empty($courses[0])){
        echo "<a href='index.php#comment'><h4 style='display: inline-block'>暂时没有评论，你来创建吧～</h4></a><br/>";
        }
        else{
        echo "<a href='index.php#comment'><h4 style='display: inline-block'>此课程已经有人评论过了，一起来评论吧～</h4></a><br/>
        ";
        $courses=$courseList->xpath("child::course[GEcode='$GECode']");
        $course = $courses[0];
        $comments = $course->xpath("child::comment");
        
        for($i=0;$i<count($comments);$i++){
        $comment = $comments[$i];
        $submitTimestamps[$i] = $comment['id'];//$comment['id']是获取comment 下的名为id的属性值；
        $overallRanges[$i] = (int)$comment -> OverallRange;
        $gradeRanges[$i] = (float)$comment -> GradeRange;
        $gradeRangeForCharts[$i] = (string)$comment -> GradeRange;/*这个为了下面array_count_values用，因为必须为string*/
        $courseDifficultys[$i] = (int)$comment -> CourseDifficulty;
        $courseLoads[$i] = (int)$comment -> CourseLoad;
        $courseValues[$i] = (int)$comment -> CourseValue;
        $customComments[$i] = (string)$comment -> CustomComment;
        }
?>
    <div id="chartset">
        <?php
            //导入数学程式进行平均值计算
            include 'mathuse.php';
            $AOR = (int)calculate_average($overallRanges);
            $AGR = number_format(calculate_average($gradeRanges), 2, '.', '');
            $ACD = (int)calculate_average($courseDifficultys);
            $ACL = (int)calculate_average($courseLoads);
            $ACV = (int)calculate_average($courseValues);
        ?>

        <div id="container">
            <div id="coursecube" class='element <?php echo $GEAreaCorrected; ?>'>
                 <p class='GEarea'><?php echo $GEAreaCorrected; ?></p>
                 <h1 class='GEcode'><?php echo $GECode ?></h1>
                 <h2 class='AOR'><?php echo $AOR ?></h2>
                 <h2 class='AGR'><?php echo $AGR ?></h2>
                 <h2 class='ACD'><?php echo $ACD ?></h2>
                 <h2 class='ACL'><?php echo $ACL ?></h2>
                 <h2 class='ACV'><?php echo $ACV ?></h2>
         </div>
        </div>
        <div id="charttitle" style=" width:500px; float: right;">GPA分布饼图</div>
        <div id="chart1" style="height:300px; width:500px; float: right; margin-right: 30px;"></div>
    </div>

    <div id="commentset">
        <?php
        echo "<li>平均总体评价：" .$AOR;
        echo "<li>平均所得成绩：" .$AGR;
        echo "<li>平均课程难度：" .$ACD;
        echo "<li>平均课程任务：" .$ACL;
        echo "<li>平均课程价值：" .$ACV;
        ?>
        <div style="clear: both"></div>
            <?php
            for($i=0;$i<count($comments);$i++){
            $comment = $comments[$i];
            //为了让时间戳为北京时间
            date_default_timezone_set('PRC');
            echo "<div class='comment'><ul>";
            echo "<li>提交时间：";
            $iiiid = (string)$comment['id'];
            $submitTime = date("Y-m-d H:i:s", $iiiid);
            echo $submitTime;
            echo "</li><li>总体评价：";
            echo  $comment -> OverallRange;
            echo "</li><li>所得成绩：";
            echo  $comment -> GradeRange;
            echo "</li><li>课程难度：";
            echo  $comment -> CourseDifficulty;
            echo "</li><li>课程任务：";
            echo  $comment -> CourseLoad;
            echo "</li><li>课程价值：";
            echo  $comment -> CourseValue;
            echo "</li><li>客观评价：";
            echo  $comment -> CustomComment;
            echo "</li><br>";
            echo "</ul></div>";
            }
        }
        ?>
    </div>
<script type="text/javascript">/*图标js*/
$(document).ready(function(){
    var data = [
        <?php
        $countGrade = array_count_values($gradeRangeForCharts);
            foreach ($countGrade as $key => $value){
            echo "['$key',$value],";
        }
        
        ?>
    ];
    var plot1 = jQuery.jqplot ('chart1', [data], 
    { 
      seriesDefaults: {
        // Make this a pie chart.
        renderer: jQuery.jqplot.PieRenderer, 
        rendererOptions: {
          // Put data labels on the pie slices.
          // By default, labels show the percentage of the slice.
          showDataLabels: true,dataLabels: 'value'
         
        }
      }, 
      legend: { show:true, location: 'e' }
    }
  );
});
</script>

</div>
</body>
</html>