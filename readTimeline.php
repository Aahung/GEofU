<!--此文件用于暂时显示Timeline的信息，之后会被整合在index.php中-->
<!--此文件只用javascript 的xmlHTTPRequest-->
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <script type="application/x-javascript" src='loadXMLDoc.js'></script>
        <script type="application/x-javascript">
            function loadTimeline() {
                xmlDoc = loadXMLDoc('_commentTimeline.xml');
                comments =  xmlDoc.getElementsByTagName('comment');
                length = comments.length;
                data = '';
                for (i= length-1; i>=0; i--) {
                    data += "GE编号"
                    data += comments[i].childNodes[0].childNodes[0].nodeValue;
                    data += '时间';
                    try {
                        comment = comments[i];
                    data += comment.getAttrbute("id");
                        
                    } catch(e) {
                        alert(e);
                        alert(comment.nodeType );
                        alert(comment);
                    }
                    data += '总体评价：';
                    data += comments[i].childNodes[1].childNodes[0].nodeValue;
                    data += '所得成绩：';
                    data += comments[i].childNodes[2].childNodes[0].nodeValue;
                    data += '课程难度：';
                    data += comments[i].childNodes[3].childNodes[0].nodeValue;
                    data += '课程负担：';
                    data += comments[i].childNodes[4].childNodes[0].nodeValue;
                    data += '课程价值：';
                    data += comments[i].childNodes[5].childNodes[0].nodeValue;
                    data += '评论：';
                    data += comments[i].childNodes[6].childNodes[0].nodeValue;
                    document.getElementById('Timeline').innerHTML = data;
                }
            }
        </script>
    </head>
    <body>
        <button onclick='loadTimeline()'>点击显示</button>
        <pre id='Timeline'>
            Timeline将在此处显示。
        </pre>
    </body>
</html>