<<<<<<< HEAD
/*这是用来在改变选框（name：GEarea）选项后作出改变后继选框（id=GEcode）选项内容的函数*/
	function changearea(){
		while(document.getElementById('GEcode').options.length>0){ 
			document.getElementById('GEcode').removeChild(document.getElementById('GEcode').options[0]); 
		}
		/*以上函数用于清空之前的选项*/
		var area = document.getElementById('form').GEArea.value;
		var area1 = makeGEarray(area);
		var a1_l = area1.length;
		for ( i=0; i < a1_l; i++) {
			document.getElementById('GEcode').options[i] = new Option(area1[i],area1[i])
				}
	}
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

/*这是用来在改变选框（name：GEarea）选项后作出改变后继选框（id=GEcode2）选项内容的函数*/
	function changearea2(){
		while(document.getElementById('GEcode2').options.length>0){ 
			document.getElementById('GEcode2').removeChild(document.getElementById('GEcode2').options[0]); 
		}
		/*以上函数用于清空之前的选项*/
		var area = document.getElementById('form2').GEarea.value;
		var area1 = makeGEarray(area);
		var a1_l = area1.length;
		for ( i=0; i < a1_l; i++) {
			document.getElementById('GEcode2').options[i] = new Option(area1[i],area1[i])
				}
	}
=======
//一定放在末尾！！
/*这是用来在改变选框（name：GEarea）选项后作出改变后继选框（id=GEcode）选项内容的函数*/
	function changearea(){
		while(document.getElementById('GEcode').options.length>0){ 
			document.getElementById('GEcode').removeChild(document.getElementById('GEcode').options[0]); 
		}
		/*以上函数用于清空之前的选项*/
		var area = document.getElementById('form').GEArea.value;
		var area1 = makeGEarray(area);
		var a1_l = area1.length;
		for ( i=0; i < a1_l; i++) {
			document.getElementById('GEcode').options[i] = new Option(area1[i],area1[i])
				}
	}
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

/*这是用来在改变选框（name：GEarea）选项后作出改变后继选框（id=GEcode2）选项内容的函数*/
	function changearea2(){
		while(document.getElementById('GEcode2').options.length>0){ 
			document.getElementById('GEcode2').removeChild(document.getElementById('GEcode2').options[0]); 
		}
		/*以上函数用于清空之前的选项*/
		var area = document.getElementById('form2').GEarea.value;
		var area1 = makeGEarray(area);
		var a1_l = area1.length;
		for ( i=0; i < a1_l; i++) {
			document.getElementById('GEcode2').options[i] = new Option(area1[i],area1[i])
				}
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

	
/*用于初始选项（id=GEcode）的选项值，调用GEcode.xml的数据*/
	var area1 = makeGEarray('AREA1');
	var a1_l = area1.length;
	for ( i=0; i < a1_l; i++) {
		document.getElementById('GEcode').options[i] = new Option(area1[i],area1[i])
	}
/*用于初始选项（id=GEcode2）的选项值，调用GEcode.xml的数据*/
	var area1 = makeGEarray('AREA1');
	var a1_l = area1.length;
	for ( i=0; i < a1_l; i++) {
		document.getElementById('GEcode2').options[i] = new Option(area1[i],area1[i])
	}

>>>>>>> 1.0.2
