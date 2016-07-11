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
            <a class="icon icon-left pull-left back" href="/thinkphp/index.php/Home/Class/"></a>
            <h1 class="title">标题</h1>
            <a class="icon icon-me pull-right" href="/thinkphp/index.php/Home/User/"></a>
        </header>

        <!-- 工具栏 -->
        <nav class="bar bar-tab">
            <a class="tab-item external" href="/thinkphp/index.php/Home/Index">
                <span class="icon icon-home"></span>
                <span class="tab-label">首页</span>
            </a>
            <a class="tab-item external  active" href="#">
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
            <?php if(is_array($class)): $i = 0; $__LIST__ = $class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="content-block-title"><?php echo ($vo["classname"]); ?></div>
            <div class="card facebook-card">
                <div class="card-header no-border">
                    <div class="facebook-avatar"><img src="" width="34" height="34"></div>
                    <div class="facebook-name">创建人：<?php echo ($vo["username"]); ?></div>
                    <div class="facebook-date">创建时间：<?php echo ($vo["createtime"]); ?></div>
                </div>
                <div class="card-content content-padded">
                    <div class="row no-gutter">
                        <div class="col-20">课堂说明：<?php echo ($vo["memo"]); ?></div>
                        <div class="col-80"><?php echo ($memo); ?></div>
                    </div>
                </div>
                <div class="card-footer no-border">
                    <a href="#" class="link" onclick="ratedClass('<?php echo ($vo["id"]); ?>')">
                        <span id="span">
                        评分:
                            <span id="ratedScore">
                        <?php if(($vo["ratedscore"] == 0)): ?>0
                            <?php else: ?> <?php echo (round($vo[ratedscore]/$vo[ratedtime],2)); endif; ?>
                            </span>
                        分(共<span id="ratedTime"><?php echo ($vo["ratedtime"]); ?></span>人)
                        </span>
                    </a>
                    <a href="#" class="link">评论:<?php echo ($passScore); ?>条</a>
                </div>
            </div>
            <div class="content-block-title">附件列表</div>
            <div class="list-block content-block">
                <ul>
                    <?php if(is_array($attach)): $i = 0; $__LIST__ = $attach;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                            <a target="_blank" href="/thinkphp/upload/<?php echo ($vo["savedpath"]); ?>/<?php echo ($vo["savedfilename"]); ?>" class="item-content">
                                <div class="item-media"></div>
                                <div class="item-inner">
                                    <div class="item-title"><?php echo ($vo["originalfilename"]); ?></div>
                                    <div class="item-after"><?php echo ($vo["filesize"]); ?>MB</div>
                                </div>
                            </a>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>


    </div>
</div>

<script>
    function ratedClass(id){
        $.prompt('谨慎打分，确认后不可更改！', '请输入分数', function (value) {
            //$.alert('Your name is "' + value + '". You clicked Ok button');
            var url='/thinkphp/index.php/Home/Class/rated';

            $.ajax({
                type: 'POST',
                url: url ,
                data: {'ratedClassId':id,'ratedScore':value} ,
                success: function(result){
                    //alert(result);
                    if(result>0){
                        var rt=Number($('#ratedTime').html())+1
                        var rs=(parseFloat($('#ratedScore').html())*Number($('#ratedTime').html())+parseFloat(value))/rt
                        rs=rs.toFixed(2);
                        $('#ratedTime').html(rt)
                        $('#ratedScore').html(rs);
                        $.toast("操作成功");
                    }
                    if(result==0){
                        $.toast("发生错误，请联系管理员！");
                    }
                    if(result==-1){
                        $.toast("输入有误，请检查！！");
                    }
                    if(result==-2){
                        $.toast("您已评过分了！！");
                    }

                },
                error: function(){
                    $.toast("操作失败");
                },

                dataType: 'json',
            });
        });
    }
</script>
</body>

</html>