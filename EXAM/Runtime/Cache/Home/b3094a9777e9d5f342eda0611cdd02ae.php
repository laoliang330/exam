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

<script>


    sTotal=parseInt(<?php echo ($timeLimit); ?>)*60;
    forceEnd=parseInt(<?php echo ($forceEnd); ?>);
    function startTime()
    {
        if(sTotal>0){
            m=parseInt(sTotal/60);
            s=parseInt(sTotal%60);
            m=checkTime(m);
            s=checkTime(s);
            document.getElementById('countdown').innerHTML=m+":"+s;

            t=setTimeout('startTime()',1000);
            sTotal-=1;
        }else{
            if(forceEnd>0){
                submitFm();

            }
        }
    }

    function checkTime(i)
    {
        if (i<10)
        {i="0" + i}
        return i
    }
</script>

<div class="page-group">
    <!-- 单个page ,第一个.page默认被展示-->
    <div class="page" id="start">
        <!-- 标题栏 -->
        <header class="bar bar-nav">

            <h1 class="title">
                <?php if(($timeLimit > 0)): ?><span id="countdown"></span>
                    <script>
                        startTime()
                    </script>
                    <?php if(($forceEnd > 0)): ?><span style="color: red;font-size: small">(到时强制交卷)</span><?php endif; endif; ?>
            </h1>
            <button class="button button-fill button-danger pull-left" onclick="quitExamRoom()">
                退出
            </button>
            <button class="button button-fill pull-right" onclick="submitExamRoom()">
                交卷
            </button>
        </header>

        <!-- 这里是页面内容区 -->
        <div class="content">
            <form id="fmQuestionList" method="post">
            <div class="list-block cards-list">
                <ul>
                    <?php if(is_array($questionList)): $k = 0; $__LIST__ = $questionList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><li class="card">
                        <div class="card-header"><span id="span<?php echo ($vo["questionidselected"]); ?>"><?php echo ($k); ?>、<?php echo ($vo["questionnameseleted"]); ?></span></div>
                        <div class="card-content">
                            <div class="card-content-inner">题目内容：<?php echo ($vo["questioncontent"]); ?></div>
                        </div>
                        <div id="textarea<?php echo ($vo["questionidselected"]); ?>" style="background-color :lightgrey" class="card-footer">
                            <textarea cols="40" rows="8" name="answer[]" id="<?php echo ($vo["questionidselected"]); ?>" onblur="setcolor($(this))" placeholder="请填写答案。多个答案直接使用 ‘/’ 进行分隔"></textarea>
                            <input type="hidden" name='questionId[]' value="<?php echo ($vo["questionidselected"]); ?>">
                        </div>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
                <input type="hidden" id='roomId' name="roomId" value="<?php echo ($roomId); ?>">
                <input type="hidden" id='paperId' name="paperId" value="<?php echo ($paperId); ?>">
            </form>
        </div>
    </div>
</div>



<script>
    function setcolor(item){
        var spanid='#span'+item.attr('id');
        var textareaid='#textarea'+item.attr('id');
        if($.trim(item.val())){
            $(spanid).css('color','red');
            $(textareaid).removeAttr('style');
        }else{
            $(spanid).removeAttr('style');
            $(textareaid).css('background-color','lightgrey');
        }

    }

    //防止用户点击浏览器后退按钮退出考试
    $(document).ready(function(e) {
        var counter = 0;
        if (window.history && window.history.pushState) {
            $(window).on('popstate', function () {
                window.history.pushState('forward', null, '#');
                window.history.forward(1);
                //$("#label").html("第" + (++counter) + "次单击后退按钮。");
            });
        }
        window.history.pushState('forward', null, '#'); //在IE中必须得有这两行
        window.history.forward(1);
    });

    function quitExamRoom(){
        $.confirm('退出考试将不保存答题结果！您确定要退出吗？',
                function () {
                    $.router.load("/thinkphp/index.php/Home/");
                },
                function () {
                    $.toast("请继续答题！");
                });
    }

    function submitFm(){
        $.post('/thinkphp/index.php/Home/Grade/Index',
                $('#fmQuestionList').serialize(),
                function(response){
                    if(response==0){
                        $.toast("交卷失败！请再试一次或联系管理员！");
                    }
                    if(response==1){
                        $.toast("交卷成功！已提交老师判卷。");
                        $.router.load("/thinkphp/index.php/Home/");
                    }
                    if(response==-1){
                        $.toast("系统错误，请再试一次或联系管理员！。");
                    }
                })
    }

    function submitExamRoom(){
        $.confirm("确定答题完毕并交卷吗？",
                function() {
                    submitFm();
                },
                function(){
                    $.toast("请继续答题！");
                });

    }


</script>
</body>

</html>