<!doctype html>
  <!--代码除“isotope”&"Jqplot"插件部分其余均归@刘心鸿所有，不许拷贝不许乱来= =-->
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="GEofU,CityofU,CityU,香港城市大学,GE,精进课程,统计,GPA" />
<meta name="description" content="GEofU是一个提供CityU GE精进课程的统计型网站"/>
<link rel="shortcut icon" href="logo/logo.ico" type="image/x-icon"/>
<link href="logo/logo.png" rel="apple-touch-icon" />
<!--Jquery-->
<script src="jquery-1.8.3.min.js"></script>
<!--Jquery结束-->
<!-- Magnific Popup core CSS file -->
<link rel="stylesheet" href="css/magnific-popup.css">
<title>GEofU精进课程统计</title>
<!-- bootstrap css -->
<link rel="stylesheet" href="css/bootstrap.css" />
<!--isotope 的css文件-->
<link rel="stylesheet" href="css/isotope.css" />
<link rel="stylesheet" href="css/main.css" />
</head>

<body>
<?php include_once("analyticstracking.php") ?>
<div class="container">
    <?php include("part_nav.php") ?>
    <div class="container" id="isotope">
    	<!--isotope部分  -->
    	<div class="nav" id="options">
    	      <ul id="filters" class="option-set nav nav-pills pull-left" data-option-key="filter">
    		<li><a href="#filter" data-option-value="*" class="selected">显示全部</a></li>
    		<li><a href="#filter" data-option-value=".AREA1">AREA1</a></li>
    		<li><a href="#filter" data-option-value=".AREA2">AREA2</a></li>
    		<li><a href="#filter" data-option-value=".AREA3">AREA3</a></li>
    		<li><a href="#filter" data-option-value=".AREA4">English</a></li>
    		<li><a href="#filter" data-option-value=".AREA5">CCIV</a></li>
    	      </ul>
    	      <ul id="sort-by" class="option-set nav nav-pills pull-right" data-option-key="sortBy">
    		<li><a href="#sortBy=original-order" data-option-value="original-order" onmousedown="$('#container').isotope({sortAscending : true});" class="selected" data>不排序</a></li>
    		<li><a href="#sortBy=ACV" data-option-value="ACV" onclick="$('#container').isotope({sortAscending : false});">价值<small>↓</small></a></li>
    		<li><a href="#sortBy=ACL" data-option-value="ACL" onclick="$('#container').isotope({sortAscending : true});">任务<small>↑</small></a></li>
    		<li><a href="#sortBy=ACD" data-option-value="ACD" onclick="$('#container').isotope({sortAscending : true});">难度<small>↑</small></a></li>
    		<li><a href="#sortBy=AGR" data-option-value="AGR" onclick="$('#container').isotope({sortAscending : false});">GPA<small>↓</small></a></li>
    		<li><a href="#sortBy=AOR" data-option-value="AOR" onclick="$('#container').isotope({sortAscending : false});">总评<small>↓</small></a></li>
    	      </ul>
    	      
    	    <ul id="sort-direction" class="option-set clearfix" data-option-key="sortAscending" style="display: none">
    	      <li><a href="#sortAscending=true" data-option-value="true" class="selected">sort ascending</a></li>
    	      <li><a href="#sortAscending=false" data-option-value="false">sort descending</a></li>
    	    </ul>
    	</div>
    	
    	<section id="isotopecontainer">	
            <div id="container" class="clearfix">
    	<?php
            include_once("data_process/connect.php");
            $sql = "SELECT summary.*, ge.area, ge.name
                    FROM summary
                    LEFT JOIN ge
                    ON summary.geCode=ge.code
                    ORDER BY summary.geCode";
            $rows = $conn -> query( $sql );
    		foreach ($rows as $row){
                $area = "AREA" . $row['area'];
                $code = $row["geCode"];
                $name = $row["name"];
                $AOR = (int)$row['overallRange'];
                $AGR = number_format($row['gradeRange'], 1);
                $ACD = (int)$row['difficulty'];
                $ACL = (int)$row['loads'];
                $ACV = (int)$row['value'];
                $cNum = $row['commentNum'];

    			echo "<div title='$name' onClick='window.open(\"coursedetail.php?course=$code\")'
                 class='element $area'>\n";
    				echo "	<p class='GEarea' style='display:none'>$area</p>\n";
    				echo "	<span class='GEcode'>$code</span>\n";
    				echo "	<span class='commentNum'><big>$cNum</big><small>个评价</small></span>\n";
    				echo "	<span class='AOR'>$AOR</span>\n";
    				echo "	<span class='AGR'>$AGR</span>\n";
    				echo "	<span class='ACD'>$ACD</span>\n";
    				echo "	<span class='ACL'>$ACL</span>\n";
    				echo "	<span class='ACV'>$ACV</span>\n";
    			echo "</div>\n";
    		}
    	?>
    		<a href="#" data-toggle="modal" data-target="#comment">
                <div class='element addnew'>
        			<img src="img/addnew.png">
        			<span class='AOR' style="display: none">-1</span>
        			<span class='AGR' style="display: none">-1</span>
        			<span class='ACD' style="display: none">101</span>
        			<span class='ACL' style="display: none">101</span>
        			<span class='ACV' style="display: none">-1</span>
        		</div>
            </a>
            </div>
    	  </section>
</div>
  <!--isotope部分结束-->

</div>  
<footer>
	<div id="footer-shell">
		<div id="footer-content">
			GEofU是<a href="../">CityofU</a>旗下的工具类网站，由Hung(mail:<a href="mailto:landxh@gmail.com">landxh@gmail.com</a>)开发，旨在为城大学生提供一个参考GE课程的平台，仅供参考，本站并不提供任何数据，所有数据均来自互联网。
		</div>
	</div>
</footer>
</div>

</body>
<!-- bootstrap js -->
<script type="text/javascript" src="js/bootstrap.js"></script>
<!-- bootstrap js 结束 -->
<!--isotope JS-->
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
<!--Isotope JS 结束-->
</html>