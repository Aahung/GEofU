<?php
//输入两个变量，一个是areanum，数字，比如“2”，另一个是课程code，数字，比如“1319”
function getGEName($GEareanum,$GEcodenum){
    $GEnamelist = simplexml_load_file("GEcode.xml");
    $GEarea = "AREA".$GEareanum;
    $GEcourses = $GEnamelist->xpath("$GEarea/child::TR[TD='$GEcodenum']");
    $GEcourse = $GEcourses[0];
    $GEnames = $GEcourse->xpath("child::TD");
    $GEname = $GEnames[3];
    return $GEname;
}
?>