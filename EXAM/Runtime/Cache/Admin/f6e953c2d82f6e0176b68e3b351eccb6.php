<?php if (!defined('THINK_PATH')) exit();?>
<table id="dgClass" title="课堂管理" class="easyui-datagrid ContextMenu"
       data-options="
            url:'/thinkphp/index.php/Admin/Class/classList',
            singleSelect: true,
            onRowContextMenu: onRowContextMenuClass,
            fit:true,
            rownumbers:true,
            fitColumns:true,
            pagination:true,
        "
       toolbar="#toolbarClass" >
    <thead>
    <tr>
        <th field="classname" editor="{type:'text',options:{required:true}}"  width="50">课堂名称</th>
        <th field="ratedtime">评价人数</th>
        <th field="ratedscore">评价得分</th>
        <th field="classattach">附件</th>
        <th field="status">当前状态</th>
        <th field="username">创建人</th>
        <th field="createtime">创建时间</th>
    </tr>
    </thead>
</table>
<div id="toolbarClass">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newExamClass(0)">新建</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="newExamClass(1)">编辑</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="openAttachWindows()">附件</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyExamClass()">删除</a>
</div>

<div id="mmClass" class="easyui-menu" style="width:120px;">
    <div onclick="newExamClass(0)" data-options="iconCls:'icon-add'">添加课堂</div>
    <div class="menu-sep"></div>
    <div onclick="newExamClass(1)" data-options="iconCls:'icon-edit'">编辑课堂</div>
    <div class="menu-sep"></div>
    <div onclick="openAttachWindows()" data-options="iconCls:'icon-save'">添加附加</div>
    <div class="menu-sep"></div>
    <div onclick="destroyExamClass()" data-options="iconCls:'icon-remove'">删除课堂</div>

</div>

<div id="dlgexamClass" class="easyui-dialog"
     closed="true" buttons="#dlgExamClass-buttons">
    <div class="ftitle">请填写课堂信息</div>
    <form id="fmClass" method="post" enctype="multipart/form-data" novalidate>
        <div class="fitem">
            <label>课堂名称:</label>
            <input name="className"  id="className" class="easyui-textbox" required="true" missingMessage="必填">
        </div>

        <!--<div class="fitem">
            <label>上传附件:</label>
            <a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-add'" onclick="openAttachWindows()">添加附件</a><div id="attachSelected">
        </div>
        </div>-->

        <div class="fitem">
            <label>相关选项:</label>
            <input class="easyui-switchbutton"  checked name="status" id="'status1" data-options="onText:'开放状态',offText:'锁定状态'" style="width:100px;">
        </div>

        <div class="fitem">
            <label>备注说明:</label>
            <input class="easyui-textbox" name="memo" id="memo" data-options="multiline:true,height:44" />
        </div>
        <input type="hidden" id="opc" name="opc" value="add">
        <input type="hidden" id="id" name="id" value="0">
    </form>

</div>

<div id="dlgexamClassAttach" class="easyui-dialog"
     buttons="#dlgExamClassAttach-buttons" data-options="modal:true,closed:true,closable:false"  style="height: 400px; width: 500px">
    <div class="ftitle">请选择要上传的附件</div>
    <form id="fmClassAttach" method="post" enctype="multipart/form-data" novalidate>
        <div class="fitem">
            <label>附件1:</label>
            <input type="file" id="attach" name="attach[]">
            <a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-add'" onclick="addAttachInput()"></a>
            <a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-remove'" onclick="removeAttachInput()"></a>
        </div>
        <input type="hidden" id="classAttachToId" name="classAttachToId" value="0">
    </form>
    <br>
    <table id="dgClassAttach" title="已上传附件" class="easyui-datagrid ContextMenu"
           data-options="
            fit:true,
            rownumbers:true,
            fitColumns:true,
            pagination:false,
            toolbar:toolbarClassAttach
        "
          style="width: 400px">
        <thead>
        <tr>
            <th data-options="field:'id',checkbox:true"></th>
            <th field="originalfilename" >文件名称</th>
            <th field="createtime">上传时间</th>
            <th field="filesize">文件大小(MB)</th>
            <th data-options="field:'_operate',align:'center',formatter:formatOper">操作</th>
        </tr>
        </thead>

    </table>
    <div id="toolbarClassAttach">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyExamClassAttach($('#classAttachToId').val())">删除</a>
    </div>

</div>

<div id="dlgExamClass-buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveExamClass()">保存</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgexamClass').dialog('close')" style="width:90px">取消</a>
</div>

<div id="dlgExamClassAttach-buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveExamClassAttach()">保存</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="closeExamClassAttach()" style="width:90px">取消</a>
</div>

<script>

    var rowIndex;

    function onRowContextMenuClass(e,index,row){
        if (row){
            e.preventDefault();
            $(this).datagrid('selectRow', index);
            $('#mmClass').menu('show',{
                left: e.pageX,
                top: e.pageY
            });
        }
    }




    function newExamClass(i){
        if(i==0){
            $('#dlgexamClass').dialog('open').dialog('center').dialog('setTitle','新建课堂');

            $('#fmClass').form('clear');
            $('#opc').val('add');

        }
        if(i==1){
            row = $('#dgClass').datagrid('getSelected');
            if(!row){
                $.messager.alert('提示','请选择要编辑的课堂！','info');
            }else{
                $('#dlgexamClass').dialog('open').dialog('center').dialog('setTitle','编辑课堂');
                //row = $('#dgClass').datagrid('getSelected');

                if(row.status==1){
                    ssb='on';
                }else{
                    ssb='';
                }

                $('#fmClass').form('load',{
                    className:row.classname,
                    memo:row.memo,
                    status:ssb,
                    opc:'edit',
                    id:row.id
                });
            }
        }
    }

    function saveExamClass(){
        $('#fmClass').form('submit',{
            url: '/thinkphp/index.php/Admin/Class/save',
            onSubmit: function(){
                //return $(this).form('validate');
            },
            success: function(result){
                //alert(result);
                if (result>0){

                    $('#dlgexamClass').dialog('close');        // close the dialog
                    $('#dgClass').datagrid('reload');    // reload the user data
                    $.messager.show({
                        msg:'操作成功！',
                        timeout:2000,
                        showType:'slide'
                    });

                } else {
                    $.messager.alert('提示',result,'info');

                }
            }
        });
    }


    function destroyExamClass() {
        var row = $('#dgClass').datagrid('getSelected');
        if (row) {
            $.messager.confirm('提示','确定删除?', function (r) {
                if (r) {
                    $.post('/thinkphp/index.php/Admin/Class/destroy', {id: row.id}, function (result) {
                        if (result>0) {
                            $('#dgClass').datagrid('reload');    // reload the user data
                            $.messager.show({
                                msg:'操作成功！',
                                timeout:2000,
                                showType:'slide'
                            });
                        } else {
                            $.messager.alert('提示',result,'info');
                        }
                    });
                }
            });
        }
    }

    function openAttachWindows(){
        row = $('#dgClass').datagrid('getSelected');
        if(!row){
            $.messager.alert('提示','请选择要操作的课堂！','info');
        }else {

            $('#dlgexamClassAttach').dialog('open').dialog('center').dialog('setTitle', '添加附件');
            $('#fmClassAttach').form('load',{
                classAttachToId:row.id,
            });

            listAttach(row.id);

        }
    }

    function saveExamClassAttach(){
        $('#fmClassAttach').form('submit',{
            url: '/thinkphp/index.php/Admin/Class/uploadAttach',
            onSubmit: function(){
                $.messager.progress();
            },
            success: function(result){
                $.messager.progress('close');
                if (result>0){
                    listAttach(result);
                    $('fmClassAttach').form('clear');
                    $.messager.show({
                        msg:'操作成功！',
                        timeout:2000,
                        showType:'slide'
                    });

                } else {
                    $.messager.alert('提示',result,'info');

                }
            }
        });

    }

    var attachIndex=0;
    function addAttachInput(){

        $("#fmClassAttach").append('<div class="fitem" id="attachDiv'+(attachIndex+1)+'">'+
                '<label>附件'+(attachIndex+2)+':</label>'+
                '<input type="file" id="attach'+(attachIndex+1)+'" name="attach[]"'+'>'+
                '</div>'
        );
        attachIndex++;
    }

    function removeAttachInput(){
        if(attachIndex){
            var attachId='#attachDiv'+attachIndex;
            $(attachId).remove();
            attachIndex--;
        }
    }


    function closeExamClassAttach(){
        for(var i=1;i<=attachIndex;i++){
            var attachId='#attachDiv'+i;
            $(attachId).remove();
        }
        $('#fmClassAttach').form('clear');
        attachIndex=0;
        $('#dlgexamClassAttach').dialog('close');
    }


    function listAttach(classId){
        var url='/thinkphp/index.php/Admin/Class/attachList';
        $.ajax({
            type: 'post',
            url: url ,
            data: {'classId':classId} ,
            success: function(result){
                $('#dgClassAttach').datagrid('loadData',result);

            },
            error: function(){
            },

            dataType: 'json',
        });

    }

    function formatOper(val,row,index){
        return '<a href=/thinkphp/upload/'+row.savedpath +'/'+row.savedfilename+' target="_blank"">下载</a>';
    }

    function destroyExamClassAttach(classId){
        var checkedItems = $('#dgClassAttach').datagrid('getChecked');
        var attachDelArr=[];
        $.each(checkedItems, function(index, item){
            if(item.id){
                attachDelArr.push(item.id);
            }
        });
        $.messager.confirm("提示", "您确定要执行操作吗？", function (data) {
            if (data) {
                //alert('selected:'+questionSelectedidArr.join(',')+'/deleted'+questionDeletedidArr.join(','));
                $.ajax({
                    url: '/thinkphp/index.php/Admin/Class/destroyAttach',    //请求的url地址
                    async: true, //请求是否异步，默认为异步，这也是ajax重要特性
                    data: { "attachId": attachDelArr},    //参数值
                    type: "post",   //请求方式
                    beforeSend: function() {
                        //请求前的处理
                    },
                    success: function(result) {

                        if(result){
                            listAttach(classId);
                            $.messager.show({
                                msg:'操作成功！！',
                                timeout:3000,
                                showType:'slide'
                            });
                        }else{
                            $.messager.show({
                                msg:'操作失败！！',
                                timeout:3000,
                                showType:'slide'
                            });
                        }
                    },
                    complete: function() {
                        //请求完成的处理
                    },
                    error: function() {
                        $.messager.show({
                            msg:'发送错误！！',
                            timeout:3000,
                            showType:'slide'
                        });
                    }
                });
            }
            else {
                $.messager.show({
                    msg:'未执行任何操作！！',
                    timeout:3000,
                    showType:'slide'
                });
            }
        });
    }

    function ajaxLoading(){
        $("<div class=\"datagrid-mask\"></div>").css({display:"block",width:"100%",height:$(window).height()}).appendTo("body");
        $("<div class=\"datagrid-mask-msg\"></div>").html("正在处理，请稍候。。。").appendTo("body").css({display:"block",left:($(document.body).outerWidth(true) - 190) / 2,top:($(window).height() - 45) / 2});
    }
    function ajaxLoadEnd(){
        $(".datagrid-mask").remove();
        $(".datagrid-mask-msg").remove();
    }




</script>