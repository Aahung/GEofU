<?php
//排名程序
//使用方法：(举例)
//foreach ($GECodes_AORs as $key => $val) {
//	$GECodeNum = substr("$key", -4);
//	$GEAreaNum = substr("$key", -3,1);
//   echo "<li><a href='coursedetail.php?a=$GEAreaNum&c=$GECodeNum'>$key ： $val</a></li>";
//    }



$courseList = simplexml_load_file("_commentdata.xml");
$courses=$courseList->xpath("child::course");
for($i=0;$i<count($courses);$i++){
	$course = $courses[$i];
	$summary = $course -> summary;
	$GECodes[$i] = (string)$course -> GEcode;
	$GEAreaNums[$i] = substr("$GECodes[$i]", -3,1);
	$GEAreas[$i] = "AREA" .$GEAreaNums[$i];
	$AORs[$i] = (int)$summary -> AOR;
	$AGRs[$i] = (float)$summary -> AGR;
	$ACDs[$i] = (int)$summary -> ACD;
	$ACLs[$i] = (int)$summary -> ACL;
	$ACVs[$i] = (int)$summary -> ACV;
	$commentNums[$i] = (int)$summary -> commentNum;
	$GECodes_AORs[$GECodes[$i]]=$AORs[$i];
	$GECodes_AGRs[$GECodes[$i]]=$AGRs[$i];
	$GECodes_ACDs[$GECodes[$i]]=$ACDs[$i];
	$GECodes_ACLs[$GECodes[$i]]=$ACLs[$i];
	$GECodes_ACVs[$GECodes[$i]]=$ACVs[$i];
	$GECodes_commentNums[$GECodes[$i]]=$commentNums[$i];
	}

arsort($GECodes_AORs);
arsort($GECodes_AGRs);
asort($GECodes_ACDs);
asort($GECodes_ACLs);
asort($GECodes_ACVs);



?>