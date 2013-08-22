<?php
$geCode=$_GET['course'];
require("data_process/connect.php");
$sql_summary = "SELECT * FROM summary WHERE geCode = :geCode";
$sql_ge = "SELECT * FROM ge WHERE code = :geCode";
$sql_comment = "SELECT * FROM comments WHERE geCode = :geCode";

try {
    $st_summary = $conn -> prepare ( $sql_summary );
    $st_summary -> bindValue( ":geCode", $geCode, PDO::PARAM_STR );
    $st_summary -> execute();
    $rows_summary = $st_summary -> fetchAll();
}
catch (PDOException $e){
    echo "Wrong, summary: " . $e;
}
try {
    $st_ge = $conn -> prepare ( $sql_ge );
    $st_ge -> bindValue( ":geCode", $geCode, PDO::PARAM_STR );
    $st_ge -> execute();
    $rows_ge = $st_ge -> fetchAll();
}
catch (PDOException $e){
    echo "Wrong, ge: " . $e;
}
try {
    $st_comment = $conn -> prepare ( $sql_comment );
    $st_comment -> bindValue( ":geCode", $geCode, PDO::PARAM_STR );
    $st_comment -> execute();
    $rows_comment = $st_comment -> fetchAll();
}
catch (PDOException $e){
    echo "Wrong, comment: " . $e;
}

$overallRange = (int)$rows_summary[0]["overallRange"];
$gradeRange = number_format($rows_summary[0]["gradeRange"],1);
$gradeSatisfaction = (int)$rows_summary[0]["gradeSatisfaction"];
$difficulty = (int)$rows_summary[0]["difficulty"];
$loads = (int)$rows_summary[0]["loads"];
$value = (int)$rows_summary[0]["value"];
$commentNum = $rows_summary[0]["commentNum"];
$name = $rows_ge[0]["name"];
$name_CN = $rows_ge[0]["name_CN"];
$lang = $rows_ge[0]["lang"];
    if ($lang == "en") $lang = "English"; if ($lang == "CH") $lang = "中文";
$quiz = $rows_ge[0]["quiz"];
$finalExam = $rows_ge[0]["finalExam"];
    if ($finalExam) $finalExam = "有"; if (!$finalExam) $finalExam = "无";
$presentation = $rows_ge[0]["presentation"];
$report = $rows_ge[0]["report"];
$groupMember = $rows_ge[0]["groupMember"];
    if ($groupMember == 0) $groupMember = "没有小组"; if (($groupMember != 0) && ($groupMember) ) $groupMember += "个一组";
$updatedBy = $rows_ge[0]["updatedBy"];
$lastUpdate = $rows_ge[0]["lastUpdate"];
    $lastUpdate = date("Y-m-d H:i:s", $lastUpdate);
$fillGeBase = '';
if ((!$lang)||(!quiz)||(!finalExam)) {
    $fillGeBase = '
                    <div class="list-group">
                        <a class="list-group-item">第一个提供数据，把眼睛移向右下角。</a>
                    </div>';
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
<title><?php echo $geCode . "-" . $name ?></title>
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
            <div class="page-header">
                <h1><?php echo $geCode ?><small><?php echo $name ?></small><small><?php if (!$name_CN) { echo "<a href='#geBaseProvide'>点击此处提供中文翻译</a>";} else echo $name_CN ?></small></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <ul class="list-group">
                    <li class="list-group-item">平均总体评价：<?php echo $overallRange ?></li>
                    <li class="list-group-item">平均所得成绩：<?php echo $gradeRange ?></li>
                    <li class="list-group-item">平均成绩满意：<?php echo $gradeSatisfaction ?></li>
                    <li class="list-group-item">平均难度感知：<?php echo $difficulty ?></li>
                    <li class="list-group-item">平均课业感知：<?php echo $loads ?></li>
                    <li class="list-group-item">平均价值感知：<?php echo $value ?></li>
                    <li class="list-group-item">得到评价数量：<?php echo $commentNum ?></li>
                </ul>
            </div>
            <div class="col-lg-4">
                <?php echo $fillGeBase ?>
                <ul style = "<?php if ($fillGeBase != '') echo 'display:none' ?>" class="list-group">
                    <li class="list-group-item">教学语言：<?php echo $lang ?></li>
                    <li class="list-group-item">quiz：<?php echo $quiz ?>个</li>
                    <li class="list-group-item">final：<?php echo $finalExam ?></li>
                    <li class="list-group-item">presentation：<?php echo $presentation ?>个</li>
                    <li class="list-group-item">report：<?php echo $report ?>个</li>
                    <li class="list-group-item">小组成员:<?php echo $groupMember ?></li>
                    <li class="list-group-item"><small>updated by <?php echo $updatedBy ?> at <?php echo $lastUpdate ?></small></li>
                </ul>
            </div>
            <div class="col-lg-4">
                <div class="list-group">
                    <a href="http://www6.cityu.edu.hk/ge_info/courses/materials/html/<?php echo $geCode ?>.html" target="_blank" class="list-group-item"><img class="img-responsive" src="img/EDGE.PNG"><label><small>点击进入EDGE</small></label></a>
                    <a href="http://eportal.cityu.edu.hk/bbcswebdav/institution/APPL/Course/Current/<?php echo $geCode ?>.htm" target="_blank" class="list-group-item"><img class="img-responsive" src="img/2BTable.PNG"><label><small>点击进入2BTable</small></label></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <legend>评论列表</legend>
        <?php
            foreach ($rows_comment as $row_comment) {
                $per_overallRange = $row_comment["overallRange"];
                $per_gradeRange = $row_comment["gradeRange"];
                $per_gradeSatisfaction = $row_comment["gradeSatisfaction"];
                $per_difficulty = $row_comment["difficulty"];
                $per_loads = $row_comment["loads"];
                $per_value = $row_comment["value"];
                $per_comment = $row_comment["comment"];
                    if ($per_comment == '') $per_comment = "我是懒鬼，我懒得写评价。";
                $per_time = $row_comment["time"];
                $per_time = date("Y-m-d H:i:s", $per_time);
                echo '
                <div class="panel col-lg-12">
                    <div class="panel-heading">' . $per_time .'</div>
                        <legend>总体评价：' . $per_overallRange . '</legend>
                        <div class="row">
                            <div class="col-lg-2">
                                <label>所得成绩：</label>
                                <span>' . $per_gradeRange . '</span>
                            </div>
                            <div class="col-lg-3">
                                <label>成绩满意度：</label>
                                <span>' . $per_gradeSatisfaction . '</span>
                            </div>
                            <div class="col-lg-2">
                                <label>课程难度：</label>
                                <span>' . $per_difficulty . '</span>
                            </div>
                            <div class="col-lg-2">
                                <label>课程负担：</label>
                                <span>' . $per_loads . '</span>
                            </div>
                            <div class="col-lg-2">
                                <label>课程价值：</label>
                                <span>' . $per_value . '</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12"
                                <label>客观评价：</label>
                                <span>' . $per_comment . '</span>
                            </div>
                        </div>
                </div>';
            };
        ?>
            </div>
            <div class="col-lg-4" id="commentForm">
                <legend>注意到这里！！</legend>
                <div class="panel col-lg-12">
                    <legend>我要提供评价</legend>
                    <?php include_once("part_form_comment.php") ?><a name="geBaseProvide"></a>
                </div>
                <div class="panel col-lg-12">
                    <legend>我要提供基础数据</legend>
                    <?php include_once("part_form_geBase.php"); ?>
                </div>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function showRange(id) {
        displayId = id + "Display";
        document.getElementById(displayId).value = document.getElementById(id).value;
    }
</script>
<!-- =========== -->

<footer>
    <div id="footer-shell">
        <div id="footer-content">
            GEofU是<a href="../">CityofU</a>旗下的工具类网站，由Hung(mail:<a href="mailto:landxh@gmail.com">landxh@gmail.com</a>)开发，旨在为城大学生提供一个参考GE课程的平台，仅供参考，本站并不提供任何数据，所有数据均来自互联网。
        </div>
    </div>
</footer>
</body>
<!--饼图JS-->
<!-- bootstrap js -->
<script type="text/javascript" src="js/bootstrap.js"></script>
<!-- bootstrap js 结束 -->


</html>