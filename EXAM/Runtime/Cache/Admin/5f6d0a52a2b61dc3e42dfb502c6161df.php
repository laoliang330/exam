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

<script type="text/javascript">
    var url=<?php echo ($url); ?>;
    var roledata=<?php echo ($roledata); ?>;
    $('#fm').form({
        url: 'Users/addUserConfirm',

        onSubmit: function () {

        },
        success: function (data) {
            // alert(data);
            if ($('#op').val() == 'edit') {
                //alert($('#userrole').combobox('getValue'));
                selfid=data;
                if(selfid>0){
                    $('#tg').treegrid('update',{
                        id: selfid,
                        row: {
                            name: nodename,
                            roletitle: $('#userrole').combobox('getText'),
                            roleid: $('#userrole').combobox('getValue'),
                        }
                    });

                    myalert('修改成功！');
                }else{

                    myalert(data);
                }

            } else {
                selfid = data;
                if (selfid > 0) {
                    //alert($('#isuser').switchbutton('options').checked);
                    if ($('#isuser').switchbutton('options').checked) {
                        icon = "icon-man";
                        var isuser=1;
                    } else {
                        var isuser=0;
                        icon = '';
                    }
                    $('#tg').treegrid('append', {
                        parent: nodeid,
                        data: [{
                            id: selfid,
                            name: nodename,
                            isuser: isuser,
                            roletitle: $('#userrole').combobox('getText'),
                            roleid: $('#userrole').combobox('getValue'),
                            iconCls: icon,
                        }]
                    });
                    //$('#dlg').dialog('close');
                    $('#nodename').textbox('clear');
                    myalert("添加成功！");
                    selfid = 0;
                } else {
                    //myalert("添加失败，请检查输入是否正确！");
                    myalert(data);
                }
            }
        }
    });


</script>

<div style="margin:20px 0;">
    <a href="javascript:void(0)" class="easyui-linkbutton" onclick="edit()">编辑</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" onclick="save()">保存</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" onclick="cancel()">取消</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" onclick="addnode()">添加节点</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" onclick="removenode()">删除节点</a>
</div>
<table id="tg" class="easyui-treegrid ContextMenu" fit="false"
       data-options="
                rownumbers: true,
                animate: true,
                collapsible: false,
                fitColumns: true,
                url: url,
                idField: 'id',
                treeField: 'name',
                showFooter: false,
                lines: true,
                singleSelect: true,
				onLoadSuccess: function(row){
                    $(this).treegrid('enableDnd', row?row.id:null);
                },
                onBeforeEdit: function(row){
                    $(this).treegrid('disableDnd');
                },
                onAfterEdit: function(row){
                    $(this).treegrid('enableDnd');
                },
                onCancelEdit: function(row){
                    $(this).treegrid('enableDnd');
                },
                onDblClickRow: function(row){
                    editnode();
                },
                onBeforeUnselect: function(row){
                    editingId=row.id
                    $(this).treegrid('cancelEdit', editingId);;
                },
                onContextMenu: onContextMenu
            ">
    <thead>
    <tr>
        <th data-options="field:'name',width:180,editor:'text'">节点名称</th>
        <th data-options="field:'roletitle',

                        editor:{
                            type:'combobox',
                            options:{
                                valueField:'roleid',
                                textField:'roletitle',
                                data: roledata,
                                required:true
                        }
                        }">节点角色
        </th>
    </tr>
    </thead>

</table>
<div id="mm" class="easyui-menu" style="width:120px;">
    <div onclick="addnode(0)" data-options="iconCls:'icon-add'">添加分类节点</div>
    <div onclick="addnode(1)" data-options="iconCls:'icon-man'">添加用户节点</div>
    <div onclick="editnode()" data-options="iconCls:'icon-edit'">编辑节点</div>

    <div class="menu-sep"></div>
    <div onclick="removenode()" data-options="iconCls:'icon-remove'">删除节点</div>
    <div class="menu-sep"></div>
    <div onclick="expand()">展开</div>
    <div onclick="collapse()">收起</div>
</div>



<div id="dlg" class="easyui-dialog" style="width:500px;height:400px;padding:10px 20px"
     closed="true" buttons="#dlg-buttons">
    <div class="ftitle">请填写节点信息</div>
    <form id="fm" method="post" novalidate>
        <div class="fitem">
            <label>节点名称:</label>
            <input name="nodename"  id="nodename" class="easyui-textbox" required="true" missingMessage="必填" />
        </div>
        <div class="fitem">
            <label>节点属性:</label>
            <input id="isuser" name="isuser" class="easyui-switchbutton" style="width:120px" data-options="onText:'用户节点',offText:'分类节点'" />
        </div>
        <div class="fitem">
            <label>节点权限:</label>
            <input class="easyui-combobox" id="userrole" name="userrole"
                   data-options="
                    valueField:'id',
                    textField:'roletitle',
                    method:'get',
                    url:'Role',
                    required:true,
            ">
        </div>
        <input type='hidden' name='op' id='op' value='' />
    </form>
</div>

<div id="dlg-buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="addnodeconfirm()" style="width:90px">保存</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="closedlg()" style="width:90px">取消</a>
</div>
<script src="/thinkphp/public/js/my.js"></script>



</body>

</html>