<!doctype HTML>
<html>
<head>
<meta name="keywords" content="GEofU,CityofU,CityU,香港城市大学,GE,精进课程,统计,GPA" />
<meta name="description" content="GEofU是一个提供CityU GE精进课程的统计型网站"/>
<link rel="shortcut icon" href="logo/logo.ico" type="image/x-icon"/>
<link href="logo/logo.png" rel="apple-touch-icon" />

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

<footer><q>"GEofU"是"CityofU"旗下网站</q></footer>
</div>
</body>
</html>