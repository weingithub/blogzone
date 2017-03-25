<html>
<head>
    <title>管理平台</title>
    <base href="<?php  echo base_url();?>"/>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="resource/admin.css">
</head>
<body>
<div id="navigate" class="navigate">
<ul id="accordion" class="accordion">
        <li>
            <div class="link"><i class="fa fa-paint-brush"></i>标签管理<i class="fa fa-chevron-down"></i></div>
            <ul class="submenu">
                <li><a href="/cityadmin/look_tag" target="view_frame">标签一览</a></li>
                <li><a href="add_tag.php" target="view_frame">标签新增</a></li>
                <li><a href="del_tag.php" target="view_frame">标签删除</a></li>
                <li><a href="javacript:void()">标签修改</a></li>
            </ul>
        </li>
        <li>
            <div class="link"><i class="fa fa-code"></i>用户管理<i class="fa fa-chevron-down"></i></div>
            <ul class="submenu">
                <li><a href="javacript:void()">密码修改</a></li>
            </ul>
        </li>
        <li>
            <div class="link"><i class="fa fa-mobile"></i>帖子管理<i class="fa fa-chevron-down"></i></div>
            <ul class="submenu">
                <li><a href="javacript:void()">文章误删恢复</a></li>
                <li><a href="javacript:void()">文章删除</a></li>
            </ul>
        </li>
        <li><div class="link"><i class="fa fa-globe"></i>主流搜索引擎<i class="fa fa-chevron-down"></i></div>
            <ul class="submenu">
                <li><a href="https://google.com" target="_blank">Google</a></li>
                <li><a href="https://www.bing.com/" target="_blank">Bing</a></li>
                <li><a href="https://www.yahoo.com/" target="_blank">Yahoo</a></li>
                <li><a href="https://www.baidu.com/" target="_blank">Baidu</a></li>
            </ul>
        </li>
    </ul>
</div>

<div id="container" class="container">
    <iframe id="adminpart" class="adminpart"  src="" width="600px" height="600px" name="view_frame" bgcolor="white">
    </iframe>
</div>
<?php


?>
</body>
</html>
<script src= "resource/jquery-3.1.0.js"></script>
<script src="resource/admin.js"></script>
