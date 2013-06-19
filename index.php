<!doctype html>
  <!--代码除“isotope”&"Jqplot"插件部分其余均归@刘心鸿所有，不许拷贝不许乱来= =-->
<html>
<head>
<meta name="keywords" content="GEofU,CityofU,CityU,香港城市大学,GE,精进课程,统计,GPA" />
<meta name="description" content="GEofU是一个提供CityU GE精进课程的统计型网站"/>
<link rel="shortcut icon" href="logo/logo.ico" type="image/x-icon"/>
<link href="logo/logo.png" rel="apple-touch-icon" />
<!-- Magnific Popup core CSS file -->
<link rel="stylesheet" href="css/magnific-popup.css">
<meta charset="utf-8">
<title>GEofU精进课程统计</title>
<!--一下两个script文件是用于读取GEcode.xml（GEcode.xml提取并改进自CityU 的aims）
并用于生成一个GEcourse 的code的array-->
<script src="loadXMLDoc.js"></script>
<script src="makeGEarray.js"></script>

<script src="jspack.js" charset="utf-8"></script>
<!--isotope 的css文件-->
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="css/main.css" />
<style>
	#options ul,#title-nav ul {
		margin: 0;
		list-style: none;
	}
	#options ul:first-child li {
		float: left;
		margin-bottom: 0.2em;
	      }
	#options ul:nth-child(2) li {
		float: right;
		margin-bottom: 0.2em;
	      }
	#title-nav ul li {
		float: left;
		
	      }

	#title-nav li a
	{
	  border-radius: 7px 7px 7px 7px;
	}
	#options li a,#title-nav li a {
		display: block;
		padding: 0.4em 0.5em;
		background-color: #DDD;
		color: #222;
		font-weight: bold;
		text-shadow: 0 1px hsla( 0, 0%, 100%, 0.5 );
		background-image: -webkit-linear-gradient( top, hsla( 0, 0%, 100%, 0.5 ), hsla( 0, 0%, 100%, 0.0 ) );
		background-image:    -moz-linear-gradient( top, hsla( 0, 0%, 100%, 0.5 ), hsla( 0, 0%, 100%, 0.0 ) );
		background-image:     -ms-linear-gradient( top, hsla( 0, 0%, 100%, 0.5 ), hsla( 0, 0%, 100%, 0.0 ) );
		background-image:      -o-linear-gradient( top, hsla( 0, 0%, 100%, 0.5 ), hsla( 0, 0%, 100%, 0.0 ) );
		background-image:         linear-gradient( top, hsla( 0, 0%, 100%, 0.5 ), hsla( 0, 0%, 100%, 0.0 ) );
	}

	#options li a:hover,#title-nav li a:hover {
	  background-color: #5BF;
	}
	
	#options li a:active, #title-nav li a:active {
	  background-color: #39D;
	  -webkit-box-shadow: inset 0 2px 8px hsla( 0, 0%, 0%, 0.6 );
	     -moz-box-shadow: inset 0 2px 8px hsla( 0, 0%, 0%, 0.6 );
	       -o-box-shadow: inset 0 2px 8px hsla( 0, 0%, 0%, 0.6 );
		  box-shadow: inset 0 2px 8px hsla( 0, 0%, 0%, 0.6 );
	}
	
	#options li a,#title-nav li a {
	  border-left:  1px solid hsla( 0, 0%, 100%, 0.3 );
	  border-right: 1px solid hsla( 0, 0%,   0%, 0.2 );
	  text-decoration:none;
	}
	
	#options ul:nth-child(2) li:last-child a, #options ul:first-child li:first-child a {
	  border-radius: 7px 0 0 7px;
	  border-left: none;
	}
	
	#options ul:first-child li:last-child a, #options ul:nth-child(2) li:first-child a{
	  border-radius: 0 7px 7px 0;
	}
	
	#options li a.selected {
	  background-color: #13F;
	  text-shadow: none;
	  color: white;
	}
	#container p
	{
	  font-size: smaller;
	  text-align: right;
	}
	#container h2
	{
	  font-size: xx-small;
	  margin: 0;
	}
	#container h1
	{
	  float: right;
	  font-size: larger;
	}
	#container div
	{
	  padding: 1px;
	}
	#title, #title div
	{
	  float: left;
	}
	#isotope-demo
	{
	  float:right;
	}
	#isotope-demo img
	{
	  height: 160px;
	  width: 320px;
	  margin-top: 5px;
	}
	#comment, #basicinfo, #advice
	{
	  border: dashed;
	  border-color:white;
	  margin-top: 10px;
	  padding: 50px;
	}
	header
	{
		z-index: 1000;
		position: fixed;
		background-color: rgba(0,0,0,0.8);
		top: 0px;
		width: 100%;
		height: 50px;
	}
	header #nav-shell
	{
		height: 50px;
	}
	header #nav-shell #nav-content
	{
		min-width: 900px;
		max-width: 1200px;
		margin: auto;
	}
	header div div ul
	{
		list-style: none;
	}
	header div div ul li
	{
		float: left;
		margin: 0 14px;
		display: block;
	}
	header div div ul li a
	{
		display: block;
		color: white;
		padding: 14px 0.5em;
		background: transparent;
		font-weight: bold;
		text-decoration: none;
	}
	header div div ul li span
	{
		display: block;
		color: black;
		padding: 14px 0.5em;
		background: gray;
		font-weight: bold;
		text-decoration: none;
	}
	header div div ul li a:hover
	{
		color: black;
		background: white;
	}
	.white-popup {
		position: relative;
		background: rgba(0,0,0,0.7);
		padding: 50px;
		width: auto;
		max-width: 500px;
		margin: 20px auto;
	}
	form li
	{
		display: block;
	}
	form h1
	{
		margin-bottom: 20px;
	}
	form h1, form li, form h3, form h2, form em
	{
		color: white;
	}
	form select
	{
		color: white;
		background: #444;
		width: auto;
		padding: 5px;
		font-size: 16px;
		line-height: 1;
		border-radius: 0;
		-webkit-appearance: none;
	}
	form select option
	{
		color: white;
	}
	form input[type="range"]
	{
		-webkit-appearance:none;
		-moz-apperance:none;
		height:1px;
		margin-bottom: 5px;
	}
	form input[type="text"],form input[type="email"],form input[type="num"], form textarea, form input[type="submit"]
	{
		background: transparent;
		border-color: white;
		color: white;
	}
	form button
	{
		color: white !important;
	}
</style>
</head>

<body>
<header class="header top-fixed">
	<div id="nav-shell">
		<div id="nav-content">
			<ul id="nav-ul">
				<li><a href="../">CityofU</a></li>
				<li><span>GEofU精进课程统计(v1.0.1.5)</span></li>
				<li><a href="#form" class="open-popup-link">我要提供评价</a></li>
				<li><a href="#form3" class="open-popup-link">我要报错</a></li>
				<li><a href="courselist.php" target="new">GE课程列表</a></li>
				<li><a href="#form2" class="open-popup-link">我要提供基础数据</a></li>
			</ul>
		</div>
	</div>
</header>
<div id="bodyContainer">
<!--isotope部分  -->

<div id="isotope"><a id="1"></a>
	<div class="nav">
  <section id="options" class="clearfix">
      <ul id="filters" class="option-set clearfix" data-option-key="filter">
        <li><a href="#filter" data-option-value="*" class="selected">显示全部</a></li>
        <li><a href="#filter" data-option-value=".AREA1">AREA1</a></li>
        <li><a href="#filter" data-option-value=".AREA2">AREA2</a></li>
        <li><a href="#filter" data-option-value=".AREA3">AREA3</a></li>
        <li><a href="#filter" data-option-value=".English">English</a></li>
        <li><a href="#filter" data-option-value=".CCIV">CCIV</a></li>
      </ul>
      <ul id="sort-by" class="option-set clearfix" data-option-key="sortBy">
	<li><a href="#sortBy=original-order" data-option-value="original-order" class="selected" data>不排序</a></li>
	<li><a href="#sortBy=ACV" data-option-value="ACV" onclick="$('#container').isotope({sortAscending : false});">价值<small>↓</small></a></li>
	<li><a href="#sortBy=ACL" data-option-value="ACL" onclick="$('#container').isotope({sortAscending : true});">任务<small>↑</small></a></li>
	<li><a href="#sortBy=ACD" data-option-value="ACD" onclick="$('#container').isotope({sortAscending : true});">难度<small>↑</small></a></li>
	<li><a href="#sortBy=AGR" data-option-value="AGR" onclick="$('#container').isotope({sortAscending : false});">GPA<small>↓</small></a></li>
	<li><a href="#sortBy=AOR" data-option-value="AOR" onclick="$('#container').isotope({sortAscending : false});">总评<small>↓</small></a></li>
      </ul>
      <div></div>
      
    <ul id="sort-direction" class="option-set clearfix" data-option-key="sortAscending" style="display: none">
      <li><a href="#sortAscending=true" data-option-value="true" class="selected">sort ascending</a></li>
      <li><a href="#sortAscending=false" data-option-value="false">sort descending</a></li>
    </ul>
<div style="clear: both;"></div>
  </section> <!-- #options -->
  <br>
	</div>
	
  <section id="isotopecontainer">
	
  <div id="container" class="clearfix">
   <?php include"ranking.php" ?>
<?php
	//创建函数用于：修正GEArea显示不出CCIV和English的问题
	function CorrectGEArea($GEAreaNum){
	  if ($GEAreaNum == "4")return "English";
	  elseif ($GEAreaNum == "5")return "CCIV";
	  else return "AREA".$GEAreaNum;
	}
	foreach ($GECodes as $key => $val){
		$GEAreaNum = substr("$val", -3,1);
		$GECodeNum = substr("$val", -4,4);
		//把4和5 area改为正常名字
		$GEAreaCorrected = CorrectGEArea($GEAreaNum);
		echo "<div onClick='window.open(\"coursedetail.php?a=$GEAreaNum&c=$GECodeNum\")' class='element $GEAreaCorrected'>\n";
			echo "	<p class='GEarea'>$GEAreaCorrected</p>\n";
			echo "	<h1 class='GEcode'>$val</h1>\n";
			echo "	<h1 class='commentNum'><big>$GECodes_commentNums[$val]</big><small>个评价</small></h1>\n";
			echo "	<h2 class='AOR'>$GECodes_AORs[$val]</h2>\n";
			echo "	<h2 class='AGR'>$GECodes_AGRs[$val]</h2>\n";
			echo "	<h2 class='ACD'>$GECodes_ACDs[$val]</h2>\n";
			echo "	<h2 class='ACL'>$GECodes_ACLs[$val]</h2>\n";
			echo "	<h2 class='ACV'>$GECodes_ACVs[$val]</h2>\n";
		echo "</div>\n";
	}
?>
    
  </div> <!-- #container -->
  </section>
  <script src="jquery-1.8.3.min.js"></script>
  <script src="js/jquery.isotope.min.js"></script>
  <script>
    $(function(){
      var $container = $('#container');

      $container.isotope({
        itemSelector : '.element',
        getSortData : {
          AOR : function( $elem ) {
            return parseInt( $elem.find('.AOR').text(), 10 );
          },
          AGR : function( $elem ) {
            return parseFloat( $elem.find('.AGR').text() );
          },
          ACD : function( $elem ) {
            return parseInt( $elem.find('.ACD').text(), 10 );
          },
          ACL : function( $elem ) {
            return parseInt( $elem.find('.ACL').text(), 10 );
          },
          ACV : function( $elem ) {
            return parseInt( $elem.find('.ACV').text(), 10 );
          },
        }
      });
       
      
      var $optionSets = $('#options .option-set'),
          $optionLinks = $optionSets.find('a');

      $optionLinks.click(function(){
        var $this = $(this);
        // don't proceed if already selected
        if ( $this.hasClass('selected') ) {
          return false;
        }
        var $optionSet = $this.parents('.option-set');
        $optionSet.find('.selected').removeClass('selected');
        $this.addClass('selected');
  
        // make option object dynamically, i.e. { filter: '.my-filter-class' }
        var options = {},
            key = $optionSet.attr('data-option-key'),
            value = $this.attr('data-option-value');
        // parse 'false' as false boolean
        value = value === 'false' ? false : value;
        options[ key ] = value;
        if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
          // changes in layout modes need extra logic
          changeLayoutMode( $this, options )
        } else {
          // otherwise, apply new options
          $container.isotope( options );
        }
        
        return false;
      });

      
    });
  </script>
</div>
  <!--isotope部分结束-->
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
                    <script>
						function ChangeCourseDifficultyExplain(){
							var C_D = document.getElementById('CourseDifficulty').value;
							if(C_D<=20)document.getElementById('CourseDifficultyExplain').innerHTML='可以躺着过';
							else if(C_D<=40)document.getElementById('CourseDifficultyExplain').innerHTML='躺着有点伤';
							else if(C_D<=60)document.getElementById('CourseDifficultyExplain').innerHTML='还是坐着认真学吧';
							else if(C_D<=80)document.getElementById('CourseDifficultyExplain').innerHTML='有点吃力';
							else document.getElementById('CourseDifficultyExplain').innerHTML='选你妹的课！！！';
						}
					</script>
                </li>
                <li>
                	任务繁重程度：<input type="range" name="CourseLoad" id="CourseLoad" onChange="ChangeCourseLoadExplain()"><em id="CourseLoadExplain">请拉动之</em>
                    <script>
						function ChangeCourseLoadExplain(){
							var C_D = document.getElementById('CourseLoad').value;
							if(C_D<=20)document.getElementById('CourseLoadExplain').innerHTML='难得有事做';
							else if(C_D<=40)document.getElementById('CourseLoadExplain').innerHTML='还是有点事情做的';
							else if(C_D<=60)document.getElementById('CourseLoadExplain').innerHTML='每周大概做做就没了';
							else if(C_D<=80)document.getElementById('CourseLoadExplain').innerHTML='每周得花上一两天做';
							else document.getElementById('CourseLoadExplain').innerHTML='选你妹的课！！';
						}
					</script>
                </li>
                <li>
                	学习价值：<input type="range" name="CourseValue" id="CourseValue" onChange="ChangeCourseValueExplain()"><em id="CourseValueExplain">请拉动之</em>
                    <script>
						function ChangeCourseValueExplain(){
							var C_D = document.getElementById('CourseValue').value;
							if(C_D<=20)document.getElementById('CourseValueExplain').innerHTML='浪费时间';
							else if(C_D<=40)document.getElementById('CourseValueExplain').innerHTML='学不到什么';
							else if(C_D<=60)document.getElementById('CourseValueExplain').innerHTML='不是特别值得';
							else if(C_D<=80)document.getElementById('CourseValueExplain').innerHTML='值得自己的时间';
							else document.getElementById('CourseValueExplain').innerHTML='很超值，很有用';
						}
					</script>
                </li>
                <li>
                	评论：<br /><textarea rows="10" cols="40" name="CustomComment" placeholder="如果大家要填写'选对老师很重要'的话，希望能够明确老师的名字，thank you～"></textarea>
                </li>
                <input type="submit">
          </form>
            <script>
			/*用于初始选项（id=GEcode）的选项值，调用GEcode.xml的数据*/
				var area1 = makeGEarray('AREA1');
				var a1_l = area1.length;
				for ( i=0; i < a1_l; i++) {
					document.getElementById('GEcode').options[i] = new Option(area1[i],area1[i])
				}
			</script>
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
<script>
			/*用于初始选项（id=GEcode2）的选项值，调用GEcode.xml的数据*/
				var area1 = makeGEarray('AREA1');
				var a1_l = area1.length;
				for ( i=0; i < a1_l; i++) {
					document.getElementById('GEcode2').options[i] = new Option(area1[i],area1[i])
				}
</script>
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
 <!-- Magnific Popup core JS file -->
<script src="js/magnific-popup.js"></script>

<script>
$(document).ready(function() {
  $('.open-popup-link').magnificPopup({type:'inline'});
});	
	
</script>

</body>
</html>