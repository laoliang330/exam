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
            <a class="icon icon-left pull-left back" href="/thinkphp/index.php/Home/Index/"></a>
            <h1 class="title">标题</h1>
            <a class="icon icon-me pull-right"></a>
        </header>

        <!-- 工具栏 -->
        <nav class="bar bar-tab">
            <a class="tab-item external active" href="#">
                <span class="icon icon-home"></span>
                <span class="tab-label">首页</span>
            </a>
            <a class="tab-item external" href="/thinkphp/index.php/Home/Class/Index">
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
            <div class="content-block-title"><?php echo ($roomName); ?></div>
            <div class="card facebook-card">
                <div class="card-header no-border">
                    <div class="facebook-avatar"><img src="" width="34" height="34"></div>
                    <div class="facebook-date">开始时间：<?php echo ($startTime); ?></div>
                    <div class="facebook-date">截止时间：<?php echo ($endTime); ?></div>
                </div>
                <div class="card-content content-padded">
                    <div class="row no-gutter">
                        <div class="col-20">考场说明：</div>
                        <div class="col-80"><?php echo ($memo); ?></div>
                    </div>
                </div>
                <div class="card-footer no-border">
                    <a href="#" class="link">考试限时:<?php echo ($timeLimit); ?>分钟</a>
                    <a href="#" class="link">及格分数:<?php echo ($passScore); ?></a>
                    <a href="#" class="link">允许超时:<?php echo ($forceEnd); ?></a>
                </div>
            </div>
            <div class="row">
                <div class="col-10">&nbsp;</div>
                <div class="col-80"><a href="/thinkphp/index.php/Home/Index/start/roomId/<?php echo ($roomId); ?>/paperId/<?php echo ($paperId); ?>" class="button button-fill">开始考试 </a></div>
                <div class="col-10">&nbsp;</div>
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