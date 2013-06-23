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