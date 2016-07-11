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
    var data=<?php echo ($data); ?>;
    var roledata=<?php echo ($roledata); ?>;
    $('#fmUser').form({
        url: 'Users/addUserConfirm',

        onSubmit: function () {

        },
        success: function (data) {
           // alert(data);
            if ($('#op').val() == 'edit') {
                //alert($('#userrole').combobox('getValue'));
                selfid=data;
                if(selfid>0){
                    $('#tgUser').treegrid('update',{
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
                    $('#tgUser').treegrid('append', {
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
    <a href="javascript:void(0)" class="easyui-linkbutton" onclick="editnode()">编辑</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" onclick="addnode()">添加节点</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" onclick="removenode()">删除节点</a>
</div>
<table id="tgUser" class="easyui-treegrid ContextMenu" fit="false"
       data-options="
                rownumbers: true,
                animate: true,
                collapsible: false,
                fitColumns: true,
                data: data,
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
<div id="mmUser" class="easyui-menu" style="width:120px;">
    <div onclick="addnode(0)" data-options="iconCls:'icon-add'">添加分类节点</div>
    <div onclick="addnode(1)" data-options="iconCls:'icon-man'">添加用户节点</div>
    <div onclick="editnode()" data-options="iconCls:'icon-edit'">编辑节点</div>

    <div class="menu-sep"></div>
    <div onclick="removenode()" data-options="iconCls:'icon-remove'">删除节点</div>
    <div class="menu-sep"></div>
    <div onclick="expand()">展开</div>
    <div onclick="collapse()">收起</div>
</div>



<div id="dlgUser" class="easyui-dialog" style="width:500px;height:400px;padding:10px 20px"
     closed="true" buttons="#dlgUser-buttons">
    <div class="ftitle">请填写节点信息</div>
    <form id="fmUser" method="post" novalidate>
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

<div id="dlgUser-buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="addnodeconfirm()" style="width:90px">保存</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="closedlg()" style="width:90px">取消</a>
</div>
<script>

    function edit(){

        //editingId=$('#tg').treegrid('select', editingId).id;
        //alert($('#tg').treegrid('select').id);
        if (editingId != undefined){
            $('#tgUser').treegrid('select', editingId);
            //alert($('#tg').treegrid('select', editingId));
            return;
        }
        var row = $('#tgUser').treegrid('getSelected');
        if (row){
            row.draggable=false;
            editingId = row.id
            $('#tgUser').treegrid('beginEdit', editingId);
        }
    }
    function save(){
        if (editingId != undefined){
            var t = $('#tgUser');
            t.treegrid('endEdit', editingId);
            editingId = undefined;
            var persons = 0;
            var rows = t.treegrid('getChildren');
            for(var i=0; i<rows.length; i++){
                var p = parseInt(rows[i].persons);
                if (!isNaN(p)){
                    persons += p;
                }
            }
        }
    }
    function cancel(){
        if (editingId != undefined){
            $('#tgUser').treegrid('cancelEdit', editingId);
            editingId = undefined;
        }
    }


    function addnode(isuser){
        var node = $('#tgUser').treegrid('getSelected');
        if(node){
            if(node.isuser==1){
                myalert("提示，用户下不能添加节点!");
            }else{
                $('#isuser').switchbutton('enable');
                $('#tgUser').treegrid('expand',node.id);
                $('#dlgUser').dialog('open').dialog('center').dialog('setTitle','添加节点');
                $('#fmUser').form('clear');
                var hiddeninput ="<input type='hidden' name='parentid' id='parentid' value='"+node.id+"' />";
                //var hiddeninput2 ="<input type='hidden' name='op' id='op' value='add' />";
                $('#op').val('add');
                $('#fmUser').append(hiddeninput);
                $('#userrole').combobox('select',3);
                if(isuser==1){
                    $('#isuser').switchbutton('check');
                }
            }
        }else{
            myalert("请选择节点!");
        }
    }


    function editnode(){
        /*onLoadSuccess: function (data) {
         if (data) {
         $('#userrole').combobox('select',data[2].id);
         }
         }*/
        var node = $('#tgUser').treegrid('getSelected');
        if(node){

            $('#tgUser').treegrid('expand',node.id);
            $('#dlgUser').dialog('open').dialog('center').dialog('setTitle','编辑节点');
            $('#nodename').textbox('setValue',node.name);
            if(node.isuser==1){
                $('#isuser').switchbutton('check');
                //alert($('#isuser').switchbutton('options').checked);
            }else{
                $('#isuser').switchbutton('uncheck');
            }
            //$('#isuser').switchbutton('disable');
            $('#userrole').combobox('select',node.roleid);
            var hiddeninput ="<input type='hidden' name='id' id='id' value='"+node.id+"' />";
            //var hiddeninput2 ="<input type='hidden' name='op' id='op' value='edit' />";
            $('#fmUser').append(hiddeninput);
            $('#op').val('edit');

        }else{
            myalert("请选择节点!");
        }
    }





    var selfid=0;
    var nodeid=0;
    var nodename='';

    function addnodeconfirm(){
        var node = $('#tgUser').treegrid('getSelected');
        nodename=$("#nodename").textbox('getValue');
        nodeid=node.id;
        $('#parentid').val(node.id);
        //alert($('#isuser').switchbutton('options').checked);
        $('#fmUser').submit();
    }

    function removenode(){
        var node = $('#tgUser').treegrid('getSelected');
        if(node){
            //alert($('#tg').treegrid('getChildren',node.id).length);
            if($('#tgUser').treegrid('getChildren',node.id).length>0){
                myalert("节点下有数据，不能删除!");
            }else{
                //alert(node.id);
                var request = $.ajax({
                    url: "Users/removeNodeConfirm",
                    type: "GET",
                    async: false,
                    data: {nodeid:node.id,isuser:node.isuser},
                    // contentType: "charset=utf-8",
                    cache: false,
                    success: function (result) {
                        $('#tg').treegrid('remove',node.id);
                        if(result){
                            myalert('删除成功！');
                        }else{
                            myalert('删除失败！');
                        }

                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) { alert(XMLHttpRequest.readyState+errorThrown); }
                });

            }

        }else{
            myalert("请选择要删除的节点!");
        }

        //$('#tg').treegrid('refresh',node.id);
    }

    function stopdrag(){
        //onLoadSuccess: function(){
        $("#tgUser").tree('disableDnd');
        //}
        //}
    }


    function onContextMenu(e,row){
        if (row){
            e.preventDefault();
            $(this).treegrid('select', row.id);
            $('#mmUser').menu('show',{
                left: e.pageX,
                top: e.pageY
            });
        }
    }

    function collapse(){
        var node = $('#tgUser').treegrid('getSelected');
        if (node){
            $('#tgUser').treegrid('collapse', node.id);
        }
    }
    function expand(){
        var node = $('#tgUser').treegrid('getSelected');
        if (node){
            $('#tgUser').treegrid('expand', node.id);
        }
    }


    function myalert(alerinfo){
        $.messager.show({
            msg:alerinfo,
            timeout:2000,
            showType:'slide'
        });
    }


    function closedlg(){
        $('#fmUser').form('clear');
        $('#dlgUser').dialog('close');
    }
</script>



</body>

</html>