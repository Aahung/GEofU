<!doctype HTML>
<html>
<head>
<meta name="keywords" content="GEofU,CityofU,CityU,香港城市大学,GE,精进课程,统计,GPA" />
<meta name="description" content="GEofU是一个提供CityU GE精进课程的统计型网站"/>
<link rel="shortcut icon" href="logo/logo.ico" type="image/x-icon"/>
<link href="logo/logo.png" rel="apple-touch-icon" />
<!-- Magnific Popup core CSS file -->
<link rel="stylesheet" href="css/magnific-popup.css">
<meta charset="UTF-8">
<script src="loadXMLDoc.js"></script>
<script src="makeGEarray.js"></script>
<link rel="stylesheet" href="css/main.css" />
<style>
	div.multi-column
	{
		column-count:5;
		-moz-column-count:5;
		-webkit-column-count:5;
		column-rule:3px dashed white;		
	}
	li a
	{
		text-decoration:none;
		color: white;

	}
	li a.selected {
	  text-shadow: none;
	  color: white;
	}
</style>
</head>
<body>
<header class="header top-fixed">
	<div id="nav-shell">
		<div id="nav-content">
			<ul id="nav-ul">
				<li><a href="index.php">GEofU</a></li>
				<li><span>GEofU精进课程统计(v1.0.1.9.5)</span></li>
				<li><a href="#form" class="open-popup-link">我要提供评价</a></li>
				<li><a href="#form3" class="open-popup-link">我要报错</a></li>
				<li><a href="courselist.php" target="new">GE课程列表</a></li>
				<li><a href="#form2" class="open-popup-link">我要提供基础数据</a></li>
			</ul>
		</div>
	</div>
</header>

<div id="bodyContainer">
	<h2><a href="index.php">返回首页</a></h2>
	<div class="multi-column">
<script>
	var AREA=new Array();
	AREA[1] = makeGEarray('AREA1');
	AREA[2] = makeGEarray('AREA2');
	AREA[3] = makeGEarray('AREA3');
	AREA[4] = makeGEarray('AREA4');
	AREA[5] = makeGEarray('AREA5');
	for(j=1;j<=5;j++){
		if (j==4) {
		document.write("<section><div style='border:dashed;border-color:white'><h1>GE English</h1></div><article>");	//code
		}
		else if (j==5) {
		document.write("<section><div style='border:dashed;border-color:white'><h1>CCIV</h1></div><article>");	//code
		}
		else{
		document.write("<section><div style='border:dashed;border-color:white'><h1>Area"+j+"</h1></div><article>");	//code		
		}
		for (i=0; i < AREA[j].length; i++){
		document.write("<li><a href="+"'"+"coursedetail.php?a="+j+"&c="+AREA[j][i][2]+AREA[j][i][3]+AREA[j][i][4]+AREA[j][i][5]+"'>"+AREA[j][i]+"</a></li>");
		}
		document.write("</article></section>")
	}
</script>
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
                    <select onChange="changearea()" name="GEArea">
                    	<option value="AREA1">area 1</option>
                    	<option value="AREA2">area 2</option>
                    	<option value="AREA3">area 3</option>
                    	<option value="AREA4">English</option>
                    	<option value="AREA5">CCIV</option>
                    </select>
                    <em id="gsbefore" class="hidden">GE:</em>
                    <select id="GEcode" name="GECode">
                    </select>
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
                    <select onChange="changearea2()" name="GEarea" disabled>
                    	<option value="AREA1">area 1</option>
                    	<option value="AREA2">area 2</option>
                    	<option value="AREA3">area 3</option>
                    	<option value="AREA4">English</option>
                    	<option value="AREA5">CCIV</option>
                    </select>
                    <em id="gsbefore2">GE:</em>
                    <select id="GEcode2" name="GECode" disabled>
                    </select>
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
<!--Jquery-->
<script src="jquery-1.8.3.min.js"></script>
<!--Jquery结束-->
<!-- Magnific Popup core JS -->
<script src="js/magnific-popup.js"></script>
<script>
$(document).ready(function() {
  $('.open-popup-link').magnificPopup({type:'inline'});
});	
</script>
<!-- Magnific Popup core JS 结束 -->
<!--Magnific Popup弹出form的js-->
<script src="jspack.js" charset="utf-8"></script>

</html>