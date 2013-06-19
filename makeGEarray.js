// JavaScript Document
//这是用来输出GEcode至一个array中然后return它，使用格式：makeGEarray('AREA1');注意引号的使用。
function makeGEarray(area){
	var array = new Array();
	xmlDoc = loadXMLDoc('GEcode.xml');
	areanum = xmlDoc.getElementsByTagName(area)[0];
	var lengthareanum = areanum.childElementCount;
	var i = 3;
	while (i<lengthareanum){
		course1 = areanum.getElementsByTagName('TR')[i];
		coursename1 = course1.getElementsByTagName('TD')[1];
		coursename2 = course1.getElementsByTagName('TD')[2];
		coursename1txt = coursename1.childNodes[0];
		coursename2txt = coursename2.childNodes[0];
		array[i-3] = coursename1txt.nodeValue + coursename2txt.nodeValue;
		i++;
	}
	return array;
}
