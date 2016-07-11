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


<header class="bar bar-nav">
    <h1 class='title'>用户登录</h1>
</header>
<div class="content">
    <form method="post" action="/thinkphp/index.php/Home/Login/checkLogin" id="login">
    <div class="list-block">
        <ul>
            <!-- Text inputs -->
            <li>
                <div class="item-content">
                    <div class="item-media"><i class="icon icon-form-name"></i></div>
                    <div class="item-inner">
                        <div class="item-title label">账号</div>
                        <div class="item-input">
                            <input type="text" name="username" placeholder="请输入账号">
                        </div>
                    </div>
                </div>
            </li>

            <li>
                <div class="item-content">
                    <div class="item-media"><i class="icon icon-form-password"></i></div>
                    <div class="item-inner">
                        <div class="item-title label">密码</div>
                        <div class="item-input">
                            <input type="password" name="password" placeholder="请输入密码" class="">
                        </div>
                    </div>
                </div>
            </li>

        </ul>
    </div>
    </form>
    <div class="content-block">
        <div class="row">
            <div class="col-20">&nbsp;</div>
            <div class="col-60"><a href="#" class="button button-big button-fill button-success" onclick="$('#login').submit()">登录</a></div>
            <div class="col-20">&nbsp;</div>
        </div>
    </div>
</div>
</body>

</html>