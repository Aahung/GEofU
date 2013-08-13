<div class="navbar navbar-fixed-top">
    <div class="container">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand"  href="index.php">GEofU精进课程统计(v1.1.0)</a>
        <div class="nav-collapse collapse navbar-responsive-collapse">
            <ul class="nav navbar-nav">
                <li><a href="../">前往CityofU</a></li>
                <li><a href="#" data-toggle="modal" data-target="#comment">我要提供评价</a></li>
                <li><a href="#" data-toggle="modal" data-target="#advice">我要报错</a></li>
                <li><a href="courselist.php" target="new">GE课程列表</a></li>
                <li><a href="#" data-toggle="modal" data-target="#geBase">我要提供基础数据</a></li>
            </ul>
        </div>
    </div>  
</div>

<!-- modals -->
<script type="text/javascript">
    function showRange(id) {
        displayId = id + "Display";
        document.getElementById(displayId).value = document.getElementById(id).value;
    }
</script>
<div class="modal fade" id="comment">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">我要提供评价</h4>
            </div>
            <div class="modal-body">
                <?php include_once("part_form_comment_global.php") ?>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="geBase">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">我要提供基础数据</h4>
            </div>
            <div class="modal-body">
                <?php include_once("part_form_geBase_global.php") ?>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="advice">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">我要提供基础数据</h4>
            </div>
            <div class="modal-body">
                <form id="form3" method="post" action="advice.php">
                        <h1>我要报错<a id="3"></a></h1>
                        <h3>（如果你发现了有课程遗漏，有课程名称错误，或是有其他的bug，都欢迎告诉我们）</h2>
                        <li>姓名：<input type="text" name="name"></li>
                        <li>邮箱：<input type="email" name="email" multiple></li>
                        <li><pre>遗漏或者错误的课程：
                        GE<input type="num" name="Misscode"></pre></li>
                        <li>其他：<br/><textarea name="othercomment" rows="10" cols="40"></textarea></li>
                        <input type="submit">
                </form>
            </div>
        </div>
    </div>
</div>
