<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="/thinkphp/public/sui/dist/css/sm.min.css">
    <script src="/thinkphp/public/sui/dist/js/zepto.min.js"></script>
    <script src="/thinkphp/public/sui/dist/js/sm.min.js"></script>

</head>
<body>


<div class="page-group">
    <!-- 单个page ,第一个.page默认被展示-->
    <div class="page">
        <!-- 标题栏 -->
        <header class="bar bar-nav">

            <h1 class="title"></h1>
            <a class="icon icon-me pull-right" href="/thinkphp/index.php/Home/user/"></a>
        </header>

        <!-- 工具栏 -->
        <nav class="bar bar-tab">
            <a class="tab-item external active" href="#">
                <span class="icon icon-home"></span>
                <span class="tab-label">首页</span>
            </a>
            <a class="tab-item external" href="/thinkphp/index.php/Home/Class/index">
                <span class="icon icon-star"></span>
                <span class="tab-label">课堂</span>
            </a>
            <a class="tab-item external" href="#">
                <span class="icon icon-app"></span>
                <span class="tab-label">发现</span>
            </a>
        </nav>

        <!-- 这里是页面内容区 -->
        <div class="content">
            <div class="content-block-title">正在开放的考场列表</div>
            <div class="list-block">
                <ul>
                    <?php if(is_array($room)): $i = 0; $__LIST__ = $room;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                            <a href="/thinkphp/index.php/Home/Index/detail/id/<?php echo ($vo["id"]); ?>" class="item-content item-link">
                                <div class="item-media"></div>
                                <div class="item-inner">
                                    <div class="item-title"><?php echo ($vo["roomname"]); ?></div>
                                    <div class="item-after"></div>
                                </div>
                            </a>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- 其他的单个page内联页（如果有） -->
    <div class="page">...</div>
</div>

<!-- popup, panel 等放在这里 -->
<div class="panel-overlay"></div>
<!-- Left Panel with Reveal effect -->
<div class="panel panel-left panel-reveal">
    <div class="content-block">
        <p>这是一个侧栏</p>
        <p></p>
        <!-- Click on link with "close-panel" class will close panel -->
        <p><a href="#" class="close-panel">关闭</a></p>
    </div>
</div>
</body>

</html>