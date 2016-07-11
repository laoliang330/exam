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

            <h1 class="title">标题</h1>

            <a class="icon icon-me pull-right" href="/thinkphp/index.php/Home/User/"></a>
        </header>
        <div class="bar bar-header-secondary">
            <div class="searchbar">
                <a class="searchbar-cancel">取消</a>
                <div class="search-input">
                    <label class="icon icon-search" for="search"></label>
                    <input type="search" id='search' placeholder='输入关键字...'/>
                </div>
            </div>
        </div>
        <!-- 工具栏 -->
        <nav class="bar bar-tab">
            <a class="tab-item external" href="/thinkphp/index.php/Home/Index/">
                <span class="icon icon-home"></span>
                <span class="tab-label">首页</span>
            </a>
            <a class="tab-item external active" href="/thinkphp/index.php/Home/Class/index">
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

            <div class="content-block-title">课堂列表</div>
            <div class="list-block media-list">
                <ul>
                    <?php if(is_array($class)): $i = 0; $__LIST__ = $class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                            <a href="/thinkphp/index.php/Home/Class/showDetail/id/<?php echo ($vo["id"]); ?>" class="item-link item-content"  data-panel="#panelClass" id="<?php echo ($vo["id"]); ?>">
                                <div class="item-media"><img src="/thinkphp/Public/img/icon_nav_article.png" style='width: 2rem;'></div>
                                <div class="item-inner">
                                    <div class="item-title-row">
                                        <div class="item-title"><?php echo ($vo["classname"]); ?></div>
                                        <?php if(($vo["ratedscore"] == 0)): ?><div class="item-after">0</div>
                                            <?php else: ?> <div class="item-after"><?php echo (round($vo[ratedscore]/$vo[ratedtime],2)); ?></div><?php endif; ?>
                                    </div>
                                    <div class="item-subtitle">创建人:<?php echo ($vo["username"]); ?></div>
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
<div class="panel panel-left panel-reveal"  id="panelClass">

</div>

<script>
    function setClassData(id){
        $('#p').html(id);
    }
</script>
</body>

</html>