<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>

    <link rel="stylesheet" href="/thinkphp/public/jqueryeasyui/themes/default/easyui.css">
    <link rel="stylesheet" href="/thinkphp/public/jqueryeasyui/themes/default/layout.css">
    <link rel="stylesheet" href="/thinkphp/public/jqueryeasyui/themes/icon.css">
    <link rel="stylesheet" href="/thinkphp/public/css/my.css">
    <script src="/thinkphp/public/jqueryeasyui/jquery.min.js"></script>
    <script src="/thinkphp/public/jqueryeasyui/jquery.easyui.min.js"></script>
    <script src="/thinkphp/public/jqueryeasyui/locale/easyui-lang-zh_CN.js"></script>
    <script src="/thinkphp/public/jqueryeasyui/treegrid-dnd.js"></script>
    <script src="/thinkphp/public/js/datagrid_detailviews.js"></script>

</head>
<body>


<div id="dlgexamPaper" class="easyui-dialog"
     closed="false" buttons="#dlglogin-buttons" closable="false" title="登录">
    <form id="fmLogin" method="post" action="/thinkphp/index.php/Admin/Adminlogin/checkLogin" novalidate>
        <div class="fitem">
            <label>账号:</label>
            <input name="username"  id="username" class="easyui-textbox" required="true" missingMessage="必填">
        </div>
        <div class="fitem">
            <label>密码:</label>
            <input name="password"  id="userpass" type="password" class="easyui-textbox" required="true" missingMessage="必填">
        </div>
    </form>
</div>

<div id="dlglogin-buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="$('#fmLogin').submit()">登录</a>
</div>
</body>

</html>