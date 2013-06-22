GEofU
=====

do stastic and ranking of GE course 



--------------------------------------------------



index.php: the home page and it use js to load GE course name according to GE code via GEcode.xml in the root directory;
{
  jspack.js: the js in the index.php, just used to simplify the index.php;

  loadXMLDoc.js: use to load GEcode.xml using HTTPRequest;

  makeGEArray.js: read the GEcode.xml and generate a array[GECode=>GEName];

  ranking.php: the file name is out of date, in fact it should be named loadComment.php(modified later),it loads _commentdata.xml and read all comments in that file, then generate arrays including comment information;
}

coursedetail.php: the page used to display specific GE course's detail, including{ GECode, GEname, the link to EDGE and 2Btable pages, avarage value of XXXXX, each comment content as well as a chart of GPA;}
{
  GetGEName.php: function getGEName($GEareanum,$GEcodenum){.....    return $GEname;};
}

courselist.php: list all GE course;
{
  loadXMLDoc.js;

  makeGEArray.js;
}

tocomment.php: get POST values from index.php, write to _commentdata.xml;

{
  mathuse.php: to calculate the avrage value of overallRange, gradeRange and ...(5 value);
}
