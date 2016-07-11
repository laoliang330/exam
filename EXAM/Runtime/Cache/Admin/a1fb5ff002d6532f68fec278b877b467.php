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


<div id="cc" class="easyui-layout" style="width:100%;height:500px;" fit="true">
    <div data-options="region:'north',split:true" style="height:45px;" border="false">
        <div class="easyui-panel" align="right">
            <a href="#" class="easyui-splitbutton" data-options="menu:'#mm1',iconCls:'icon-user'" style="height:45px;"><?php echo ($username); ?></a>
            &nbsp; &nbsp;
            <a href="#" class="easyui-splitbutton" data-options="menu:'#mm2',iconCls:'icon-message'" style="height:45px;">消息</a>
            <!--
            <a href="#" class="easyui-menubutton" data-options="menu:'#mm3',iconCls:'icon-help'" style="height:45px;">Help</a>
            -->
        </div>
        <div id="mm1" style="width:150px;">
            <div data-options="iconCls:'icon-undo',name:'logout'">退出</div>
            <div data-options="iconCls:'icon-redo',name:'changepass'">修改密码</div>
            <div class="menu-sep"></div>

        </div>
        <div id="mm2" style="width:100px;">
            <div data-options="iconCls:'icon-ok'">查看</div>
            <div data-options="iconCls:'icon-cancel'">管理</div>
        </div>
    </div>



    <div data-options="region:'east',title:'工具栏',split:true,collapsed:true,hideCollapsedContent:false"  style="width:100px;"></div>

    <div data-options="region:'west',title:'菜单列表',split:true" style="width:150px;">
        <div class="easyui-panel" style="padding:5px">
            <ul class="easyui-tree">
                <li>
                    <span>系统管理员</span>
                    <ul>
                        <li><span><a onclick="addTab('用户管理','Users')">用户管理</a></span></li>
                        <li><span><a onclick="addTab('分类管理','Category')">分类管理</a></span></li>
                        <li>角色权限</li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="easyui-panel" style="padding:5px">
            <ul class="easyui-tree">
                <li>
                    <span>教师功能</span>
                    <ul>
                        <li><span><a onclick="addTab('试题管理','Question')">试题管理</a></span></li>
                        <li><span><a onclick="addTab('试卷管理','Paper')">试卷管理</a></span></li>
                        <li><span><a onclick="addTab('考场管理','Room')">考场管理</a></span></li>
                        <li><a onclick="addTab('课堂管理','Class')">课堂管理</a></li>
                        <li>批阅试卷</li>
                        <li>统计分析</li>

                    </ul>
                </li>
            </ul>
        </div>
    </div>


    <div style="padding:5px;background:#eee;" data-options="region:'center'," >

        <div class="easyui-tabs" fit="true" id="myTab" data-options="
            region:'center',
            onSelect:function(title,index){
                if(title=='试题管理'){
                    expandPanel('east','试题分类');
                }else{
                    collapsePanel('east');
                }
            },

            ">
            <div title="新闻">
                <p style="font-size:14px">在此放置系统新闻、通知</p>
                <ul>
                    <li>新闻一</li>
                    <li>通知一</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    $('#mm1').menu({
        onClick:function(item){
            switch(item.name)
            {
                case 'logout':
                    $(window.location).attr('href', '/thinkphp/index.php/Admin/Adminlogin/logout');
                    break;
                case changepass:
                    //执行代码块 2
                    break;
                default:
                    //n 与 case 1 和 case 2 不同时执行的代码
            }
           // alert(item.name);
        }
    });

    function addTab(mytitle,myurl){
       // myurl="$"+myurl+"";
       // $('#mytab').tabs('option');
       // $('#mytab').tabs('close','About')
        myurl='/thinkphp/index.php/Admin/'+myurl;
        if(!$('#myTab').tabs('exists',mytitle)){
            $('#myTab').tabs('add',{
                title:mytitle,
                //content:'aaa'+'<?php echo ($adminKaochang); ?>',
                href: myurl,
                closable:true,
                tools:[{
                    iconCls:'icon-mini-refresh',
                    handler:function(){
                        var tab = $('#myTab').tabs('getSelected');
                        tab.panel('refresh', myurl);
                    }
                }]
            });
            bindMouseEnter();
        }else{
            $('#myTab').tabs('select',mytitle)
        }
        if(mytitle=='试题管理'){
            expandPanel('east','试题分类');
        }else{
            collapsePanel("east");
        }
    }

    function bindMouseEnter(){
        var tabs = $('#myTab').tabs().tabs('tabs');
        for(var i=0; i<tabs.length; i++){
            tabs[i].panel('options').tab.unbind().bind('mouseenter',{index:i},function(e){
                $('#myTab').tabs('select', e.data.index);
            });
        }
        if($('#myTab').tabs('options','title')=="试题管理"){
            expandPanel('east','试题分类');
        }else{
            collapsePanel("east");
        }
    }
    $(function(){
        bindMouseEnter();
    });

    function addPanel(region,title){
        var region = region;
        var options = {
            region: region
        };
        if (region=='north' || region=='south'){
            options.height = 50;
        } else {
            options.width = 100;
            options.split = true;
            options.title = title;
        }
        $('#cc').layout('add', options);
    }
    function removePanel(region){
        $('#cc').layout('remove', region);
    }
    function collapsePanel(region){
        $('#cc').layout('collapse', region);
    }
    function expandPanel(region){
        $('#cc').layout('expand', region);
    }
</script>
</body>

</html>