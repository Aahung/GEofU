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
<meta name="description" content="<?php echo "GE课程 $GECode --$GEName"?>"/>
<link rel="shortcut icon" href="logo/logo.ico" type="image/x-icon"/>
<link href="logo/logo.png" rel="apple-touch-icon" />
<!-- Magnific Popup core CSS file -->
<link rel="stylesheet" href="css/magnific-popup.css">
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
    div.img span{
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
    	.element
	{
		height: 100px;
		width: 100px;
		margin: 5px;
		float: left;
		vertical-align: baseline;
	}
	.element.AREA1
	{
		background-color: #FF6100;
	}
	.element.AREA2
	{
		background-color: #E80CDA;
	}
	.element.AREA3
	{
		background-color: #002EFF;
	}
	.element.English
	{
		background-color: #0CE892;
	}
	.element.CCIV
	{
		background-color: #D1FF0D;
	}

</style>
<script class="include" type="text/javascript" src="jqplot/jquery.jqplot.min.js"></script>
<script class="include" language="javascript" type="text/javascript" src="jqplot/jqplot.pieRenderer.min.js"></script>

</head>

<?php
        $courseList = simplexml_load_file("_commentdata.xml");
        $courses=$courseList->xpath("child::course[GEcode='$GECode']");
        if(empty($courses[0])){
        echo "<a href='index.php#comment'><h4 style='display: inline-block'>暂时没有评论，你来创建吧～</h4></a><br/>";
        }
        else{
	//获取所评论内容
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
	//获取总体summary
	$summarys = $course->xpath("child::summary");
	$summary = $summarys[0];
	$AOR = (int)$summary -> AOR;
	$AGR = $summary -> AGR;
	$ACD = (int)$summary -> ACD;
	$ACL = (int)$summary -> ACL;
	$ACV = (int)$summary -> ACV;
?>
<body>
<?php include_once("analyticstracking.php") ?>
<!--//facebook分享-->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<header class="header top-fixed">
	<div id="nav-shell">
		<div id="nav-content">
			<ul id="nav-ul">
				<li><a href="index.php">GEofU</a></li>
				<li><span><?php echo $GECode . "--" . $GEAreaCorrected;?>课程细节</span></li>
				<li><a href="#form" class="open-popup-link">我要提供评价</a></li>
				<li><a href="#form3" class="open-popup-link">我要报错</a></li>
				<li><a href="courselist.php" target="new">GE课程列表</a></li>
				<li><a href="#form2" class="open-popup-link">我要提供基础数据</a></li>
			</ul>
		</div>
	</div>
</header>

<div id="bodyContainer">
<a class="bshareDiv" href="http://www.bshare.cn/share">分享按钮</a><script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/buttonLite.js#uuid=&amp;style=3&amp;fs=4&amp;textcolor=#fff&amp;bgcolor=#19D&amp;text=分享到"></script>
<h1>
    <?php
        //显示GECode和正常的GEArea（GEAreaCorrected）
        echo $GECode . "--" . $GEAreaCorrected;
    ?>
<!--微博分享-->
<script type="text/javascript" charset="utf-8">
(function(){
  var _w = 142 , _h = 66;
  var param = {
    url:location.href,
    type:'4',
    count:'1', /**是否显示分享数，1显示(可选)*/
    appkey:'1682786871', /**您申请的应用appkey,显示分享来源(可选)*/
    title:'今天在GEofU看到一个GE：<?php echo $GECode .": ". $GEName; ?>，已经有<?php echo count($comments) ?>个评价了，分享给大家，好赞的哦～', /**分享的文字内容(可选，默认为所在页面的title)*/
    pic:'http://cityofu.com/ge/img/GEofUcapture.PNG', /**分享图片的路径(可选)*/
    ralateUid:'', /**关联用户的UID，分享微博会@该用户(可选)*/
    language:'zh_cn', /**设置语言，zh_cn|zh_tw(可选)*/
    dpc:1
  }
  var temp = [];
  for( var p in param ){
    temp.push(p + '=' + encodeURIComponent( param[p] || '' ) )
  }
  document.write('<iframe allowTransparency="true" frameborder="0" scrolling="no" src="http://service.weibo.com/staticjs/weiboshare.html?' + temp.join('&') + '" width="'+ _w+'" height="'+_h+'"></iframe>')
})()
</script>
<!--人人分享-->
<script type="text/javascript" src="http://widget.renren.com/js/rrshare.js"></script>
<a name="xn_share" onclick="shareClick()" type="button_large" href="javascript:;"></a>
<script type="text/javascript">
	function shareClick() {
		var rrShareParam = {
			resourceUrl : location.href,	//分享的资源Url
			srcUrl : location.href,	//分享的资源来源Url,默认为header中的Referer,如果分享失败可以调整此值为resourceUrl试试
			pic : 'http://cityofu.com/ge/img/GEofUcapture.PNG',		//分享的主题图片Url
			title : '分享一个GE',		//分享的标题
			description : '今天在GEofU看到一个GE：<?php echo $GECode .": ". $GEName; ?>，已经有<?php echo count($comments) ?>个评价了，分享给大家，好赞的哦～'	//分享的详细描述
		};
		rrShareOnclick(rrShareParam);
	}
</script>
<!--facebook分享-->
<div class="fb-like" data-href=location.href data-send="false" data-layout="button_count" data-width="450" data-show-faces="true" data-font="arial" data-colorscheme="dark"></div>    <div id="fb-root"></div>
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

    <div id="chartset">

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
	//显示总体summary
        echo "<li>平均总体评价：" .$AOR;
        echo "<li>平均所得成绩：" .$AGR;
        echo "<li>平均课程难度：" .$ACD;
        echo "<li>平均课程任务：" .$ACL;
        echo "<li>平均课程价值：" .$ACV;
        ?>
        <div style="clear: both"></div>
            <?php
	    //逐条显示评论
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


</div>
<footer>
	<div id="footer-shell">
		<div id="footer-content">
			GEofU是<a href="../">CityofU</a>旗下的工具类网站，由Hung(mail:<a href="mailto:landxh@gmail.com">landxh@gmail.com</a>)开发，旨在为城大学生提供一个参考GE课程的平台，仅供参考，本站并不提供任何数据，所有数据均来自互联网。
		</div>
	</div>
</footer>
<form id="form" method="post" action="tocomment.php" class="white-popup mfp-hide">
			<h1>我要提供评价</h1>
            	<li>
                    GE: area:
                    <input type="text" name="GEArea" value="AREA<?php echo $GEAreaNum ?>">
                    <em id="gsbefore" class="hidden">GE:</em>
                    <input type="text"  name="GECode" value="<?php echo $GECode ?>">
                </li>
                <li>
                	总体评价：<input type="range" name="OverallRange" id="OverallRange" value="0" onChange="showgrade()"><em id="graderangedisplay">0</em>分/100分
                </li>
                <li>
                	所得成绩：<select id="GradeRange" name="GradeRange">
                    	<option value="4.3">A+</option>
                    	<option value="4.0">A</option>
                    	<option value="3.7">A-</option>
                    	<option value="3.3">B+</option>
                    	<option value="3.0">B</option>
                    	<option value="2.7">B-</option>
                    	<option value="2.3">C+</option>
                    	<option value="2.0">C</option>
                    	<option value="1.7">C-</option>
                    	<option value="1.3">D+</option>
                    	<option value="1.0">D</option>
                    	<option value="0.7">D-</option>
                    	<option value="0.0">F</option>
                    </select>
                <li>
                	给分满意度：<input type="range" name="GradeSatisfication" id="GradeSatisfication" value="0" onChange="showsatisfication()"><em id="gradesatisficationdisplay">0</em>分/100分
                </li>
                <li>
                	难度：<input type="range" name="CourseDifficulty" id="CourseDifficulty" onChange="ChangeCourseDifficultyExplain()"><em id="CourseDifficultyExplain">请拉动之</em>
                </li>
                <li>
                	任务繁重程度：<input type="range" name="CourseLoad" id="CourseLoad" onChange="ChangeCourseLoadExplain()"><em id="CourseLoadExplain">请拉动之</em>
                </li>
                <li>
                	学习价值：<input type="range" name="CourseValue" id="CourseValue" onChange="ChangeCourseValueExplain()"><em id="CourseValueExplain">请拉动之</em>
                </li>
                <li>
                	评论：<br /><textarea rows="10" cols="40" name="CustomComment" placeholder="如果大家要填写'选对老师很重要'的话，希望能够明确老师的名字，thank you～"></textarea>
                </li>
                <input type="submit">
</form>
<form style="background-color:rgba(255,0,0,0.4)" id="form2" method="post" action="tobasic.php" class="white-popup mfp-hide">
        <h1>我要奉献基础数据(暂时不开放)<a id="4"></a></h1>	
            	<li>
                	选择GE: 
                    <em> area:</em>
                    <input type="text" name="GEArea" value="AREA<?php echo $GEAreaNum ?>">
                    <em id="gsbefore" class="hidden">GE:</em>
                    <input type="text"  name="GECode" value="<?php echo $GECode ?>">
                </li>
                <li>
                	教学语言：
                    <input type="checkbox" name="islang-CN" disabled>中文 <input type="checkbox" name="islang-En" disabled>英文
                </li>
                <li>
                	测验：Quiz <select name="QuizNum" id="QuizNumSel" disabled><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option></select> <input type="checkbox" name="HasFinal" id="HasFinal" value=1 disabled>Final
                </li>
                <li>
                	Presentation:<select name="NumPresent" id="NumPresent" disabled>
                    	<option value="0">0</option>
                    	<option value="1">1</option>
                    	<option value="2">2</option>
                    	<option value="3">3</option>
                    	<option value="4">4</option>
                    </select>

                </li>
                <li>
                	Report:<select name="NumReport" id="NumReport" disabled>
                    	<option value="0">0</option>
                    	<option value="1">1</option>
                    	<option value="2">2</option>
                    	<option value="3">3</option>
                    	<option value="4">4</option>
                    	<option value="5">5</option>
                    	<option value="6">6</option>
                    </select>

                </li>
                <li>
                	Group:<select name="NumGroup" id="NumGroup" disabled>
                    	<option value="1">individual</option>
                    	<option value="2-3">2-3</option>
                    	<option value="4-5">4-5</option>
                    	<option value="5-">多余五人</option>
                    </select>

                </li>
                <input type="submit" disabled>
</form>
<form id="form3" method="post" action="advice.php" class="white-popup mfp-hide">
	    <h1>我要报错<a id="3"></a></h1>
	    <h3>（如果你发现了有课程遗漏，有课程名称错误，或是有其他的bug，都欢迎告诉我们）</h2>
		<li>姓名：<input type="text" name="name"></li>
		<li>邮箱：<input type="email" name="email" multiple></li>
		<li><pre>遗漏或者错误的课程：
		GE<input type="num" name="Misscode"></pre></li>
		<li>其他：<br/><textarea name="othercomment" rows="10" cols="40"></textarea></li>
		<input type="submit">
</form>
</body>
<!--饼图JS-->
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
<!--饼图JS结束-->
<!-- Magnific Popup core JS -->
<script src="js/magnific-popup.js"></script>
<script>
$(document).ready(function() {
  $('.open-popup-link').magnificPopup({type:'inline'});
});	
</script>
<!-- Magnific Popup core JS 结束 -->
<!--Magnific Popup弹出form的js-->
<script>
    //一定放在末尾！！
/*用于改变拉条（id=OverallRange）右边的值*/
	function showgrade(){
		var grade = document.getElementById('OverallRange').value;
		document.getElementById('graderangedisplay').innerHTML = grade;
	}
/*用于改变拉条（id=GradeSatisfication）右边的值*/
	function showsatisfication(){
		var grade = document.getElementById('GradeSatisfication').value;
		document.getElementById('gradesatisficationdisplay').innerHTML = grade;
	}

//改变课程难度id=CourseDifficulty的解释
function ChangeCourseDifficultyExplain(){
	var C_D = document.getElementById('CourseDifficulty').value;
	if(C_D<=20)document.getElementById('CourseDifficultyExplain').innerHTML='可以躺着过';
	else if(C_D<=40)document.getElementById('CourseDifficultyExplain').innerHTML='躺着有点伤';
	else if(C_D<=60)document.getElementById('CourseDifficultyExplain').innerHTML='还是坐着认真学吧';
	else if(C_D<=80)document.getElementById('CourseDifficultyExplain').innerHTML='有点吃力';
	else document.getElementById('CourseDifficultyExplain').innerHTML='选你妹的课！！！';
}
//改变课程任务id=CourseLoad的解释
function ChangeCourseLoadExplain(){
	var C_D = document.getElementById('CourseLoad').value;
	if(C_D<=20)document.getElementById('CourseLoadExplain').innerHTML='难得有事做';
	else if(C_D<=40)document.getElementById('CourseLoadExplain').innerHTML='还是有点事情做的';
	else if(C_D<=60)document.getElementById('CourseLoadExplain').innerHTML='每周大概做做就没了';
	else if(C_D<=80)document.getElementById('CourseLoadExplain').innerHTML='每周得花上一两天做';
	else document.getElementById('CourseLoadExplain').innerHTML='选你妹的课！！';
}
//改变课程价值id=CourseValue的解释
function ChangeCourseValueExplain(){
	var C_D = document.getElementById('CourseValue').value;
	if(C_D<=20)document.getElementById('CourseValueExplain').innerHTML='浪费时间';
	else if(C_D<=40)document.getElementById('CourseValueExplain').innerHTML='学不到什么';
	else if(C_D<=60)document.getElementById('CourseValueExplain').innerHTML='不是特别值得';
	else if(C_D<=80)document.getElementById('CourseValueExplain').innerHTML='值得自己的时间';
	else document.getElementById('CourseValueExplain').innerHTML='很超值，很有用';
}

</script>

</html>