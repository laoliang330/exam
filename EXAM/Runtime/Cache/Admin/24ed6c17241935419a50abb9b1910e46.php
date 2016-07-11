<?php if (!defined('THINK_PATH')) exit();?><table id="dgpaper" title="试卷管理" class="easyui-datagrid ContextMenu"
       data-options="
            url:'/thinkphp/index.php/Admin/Paper/PaperList',
            singleSelect: true,
            fitColumns: true,
            onRowContextMenu: onRowContextPaperMenu,
            fit:true,
            pagination:true,
            rownumbers:true,
       "
       toolbar="#toolbarPaper">
    <thead>
    <tr>
        <th field="papername" editor="{type:'text',options:{required:true}}"  width="50">试卷名称</th>
        <th field="paperrule1">判卷方式</th>
        <th field="papershare">是否共享</th>
        <th field="status">当前状态</th>
        <th field="username">创建人</th>
        <th field="createtime">创建时间</th>
    </tr>
    </thead>
</table>
<div id="toolbarPaper">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newExamPaper(0)">新建试卷</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="newExamPaper(1)">编辑试卷</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-sum" plain="true" onclick="addPaperQuestion()">添加试题</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyExamPaper()">删除</a>
</div>

<div id="mmPaper" class="easyui-menu" style="width:120px;">
    <div onclick="newExamPaper(0)" data-options="iconCls:'icon-add'">新增</div>
    <div class="menu-sep"></div>
    <div onclick="newExamPaper(1)" data-options="iconCls:'icon-edit'">编辑</div>
    <div class="menu-sep"></div>
    <div onclick="addPaperQuestion()" data-options="iconCls:'icon-sum'">试题</div>
    <div class="menu-sep"></div>
    <div onclick="destroyExamPaper()" data-options="iconCls:'icon-remove'">删除</div>
</div>


<div id="dlgexamPaper" class="easyui-dialog"
     closed="true" buttons="#dlgPaper-buttons">
    <div class="ftitle">请填写试卷信息</div>
    <form id="fmPaper" method="post" novalidate>
        <div class="fitem">
            <label>试卷名称:</label>
            <input name="paperName"  id="paperName" class="easyui-textbox" required="true" missingMessage="必填">
        </div>
        <div class="fitem">
            <label>判卷方式:</label>
            <input class="easyui-switchbutton" name="paperRule1" id="'paperRule1" data-options="onText:'自动判卷',offText:'手动判卷'"  style="width:150px;">
        </div>
        <div class="fitem">
            <label>评分方式:</label>
            <input class="easyui-switchbutton" name="paperRule2" id="'paperRule2" data-options="onText:'每题分数相同',offText:'手动设置每题分数'"  style="width:150px;">
        </div>
        <div class="fitem" id="gradeTotal">
            <label>卷面总分:</label>
            <input  name="gradeTotal" class="easyui-numberspinner"  value="100" style="width:150px;"  min=0 >
        </div>
        <div class="fitem">
            <label>填空题:</label>
            <input class="easyui-switchbutton" name="paperRule3" id="'paperRule3" data-options="onText:'每空单独得分',offText:'整题对才得分'"  style="width:150px;">
        </div>
        <div class="fitem">
            <label>相关设置:</label>
            <input class="easyui-switchbutton" name="paperShare" id="'paperShare" data-options="onText:'共享',offText:'不共享'" style="width:100px;">
            <input class="easyui-switchbutton" name="status" id="'status" data-options="onText:'开放状态',offText:'锁定状态'"  style="width:100px;">

        </div>
        <div class="fitem">
            <label>相关说明:</label>
            <input class="easyui-textbox" name="memo" id="memo" data-options="multiline:true,height:44" />
        </div>
        <input type="hidden" id="opp" name="opp" value="add">
        <input type="hidden" id="id" name="id" value="0">
    </form>
</div>

<div id="dlgPaper-buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveExamPaper()">保存</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgexamPaper').dialog('close')" style="width:90px">取消</a>
</div>

<div id="wQuestion" class="easyui-window" title="" data-options="
        modal:true,
        closed:true,
        iconCls:'icon-save',
        collapsible:false,
        closable:false,
        minimizable:false
        "
        style="width:800px;height:500px;padding:5px;">
    <div class="easyui-layout" data-options="fit:true" id="paperLayout">
        <div data-options="region:'west',split:true" style="width:45%;">
            <table id="dgpaperQuestion" title="可选试题" class="easyui-datagrid"
                   data-options="
                        url:'',
                        fitColumns: true,
                        fit:true,
                        pagination:true,
                        multiple: true,
                        rownumbers:true,
                        rowStyler: function(index,row){
                            if(row.questionidselected){
                                return 'background-color:red;color:#fff;font-weight:bold;';
                            }
                         },
                   "
                    >
                <thead>
                <tr>
                    <th data-options="field:'id',checkbox:true"></th>
                    <th field="questionname" width="100%">试题名称</th>
                </tr>
                </thead>
            </table>
        </div>

        <div data-options="region:'center',title:'center title'" style="text-align:center;padding:5px 0 0;background:#eee;">
            <p><a class="easyui-linkbutton" data-options="iconCls:'icon-add'" href="javascript:void(0)" onclick="addPaperQuestionTo()" style="width:60px">添加</a></p>
            <p><a class="easyui-linkbutton" data-options="iconCls:'icon-remove'" href="javascript:void(0)" onclick="delPaperQuestionFr()" style="width:60px">删除</a></p>
            <p><a class="easyui-linkbutton" data-options="iconCls:'icon-edit'" href="javascript:void(0)" onclick="gradeSetted()" style="width:60px">设置分数</a></p>
        </div>

        <div data-options="region:'east',split:true" style="width:45%;">
            <table id="dgpaperQuestionSelected" title="已选试题" class="easyui-datagrid"
                   data-options="
                        url:'',
                        fitColumns: true,
                        fit:true,
                        pagination:true,
                        multiple: true,
                        rownumbers:true,
                        rowStyler: function(index,row){
                            if(row.id){
                                return 'background-color:#6293BB;color:#fff;font-weight:bold;';
                            }
                        }
                   "
                    >
                <thead>
                <tr>
                    <th data-options="field:'questionidselected',checkbox:true"></th>
                    <th field="questionnameseleted" width="100%">试题名称</th>
                </tr>
                </thead>
            </table>
        </div>

        <div data-options="region:'south',border:false" style="text-align:right;padding:0px 0 0;">
            <a class="easyui-linkbutton" data-options="iconCls:'icon-ok'" href="javascript:void(0)" onclick="addPaperQuestionSave()" style="width:80px">保存</a>
            <a class="easyui-linkbutton" data-options="iconCls:'icon-cancel'" href="javascript:void(0)" onclick="closeWindow()" style="width:80px">取消</a>
        </div>
    </div>
</div>

<div id="wQuestionGradeSetted" class="easyui-window" title="" data-options="
        modal:true,
        closed:true,
        iconCls:'icon-save',
        collapsible:false,
        closable:false,
        minimizable:false
        "
     style="width:800px;height:500px;padding:5px;" onclick="cancelEdit()">

    <div class="easyui-layout" data-options="fit:true" id="paperLayoutGradeSetted">
        <div data-options="region:'center',split:true" style="width:45%;">
            <table id="dgpaperQuestionGradeSetted" title="已选试题" class="easyui-datagrid"
                   data-options="
                        url:'',
                        fitColumns: true,
                        fit:true,
                        pagination:false,
                        multiple: false,
                        rownumbers:true,
                        singleSelect:true,
                        remoteSort:false,
                        onDblClickRow: function(row){
                            rowEdit(row);
                            },
                        onSelect: function(row){
                            rowSelected(row);
                            },
                        onRowContextMenu: onRowContextGradeSettedMenu,
                   "
                   toolbar="#toolbarPaperGradeSetted">
                <thead>
                <tr>
                    <th field="questionnameseleted" width="50%" sortable="true">试题名称</th>
                    <th field="gradesetted" width="20%" sortable="true" editor="{type:'numberbox'}">分值</th>
                    <th field="typename" width="30%" sortable="true">试题类型</th>
                </tr>
                </thead>
            </table>
        </div>

        <div data-options="region:'south',border:false" style="text-align:right;padding:0px 0 0;">
            <a class="easyui-linkbutton" data-options="iconCls:'icon-ok'" href="javascript:void(0)" onclick="addPaperQuestionGradeSettedSave()" style="width:80px">保存</a>
            <a class="easyui-linkbutton" data-options="iconCls:'icon-cancel'" href="javascript:void(0)" onclick="$('#wQuestionGradeSetted').window('close')" style="width:80px">取消</a>
        </div>
    </div>
</div>
<div id="toolbarPaperGradeSetted">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="rowEdit($('#dgpaperQuestionGradeSetted').datagrid('getRowIndex',$('#dgpaperQuestionGradeSetted').datagrid('getSelected')))">编辑</a>
</div>
<div id="mmGradeSetted" class="easyui-menu" style="width:120px;">
    <div onclick="rowEdit($('#dgpaperQuestionGradeSetted').datagrid('getRowIndex',$('#dgpaperQuestionGradeSetted').datagrid('getSelected')))" data-options="iconCls:'icon-add'">编辑</div>
</div>


<script type="text/javascript">
    $(function(){

        $('#dgpaper').datagrid({
            view: detailview,
            detailFormatter:function(index,row){
                return '<div style="padding:2px"><table class="ddv"></table></div>';
            },
            onExpandRow: function(index,row){
                var ddv = $(this).datagrid('getRowDetail',index).find('table.ddv');
                var url='/thinkphp/index.php/Admin/Paper/questionSelected/paperid/'+row.id;
                ddv.datagrid({
                    url:url,
                    fitColumns:true,
                    singleSelect:true,
                    rownumbers:true,
                    loadMsg:'',
                    height:'auto',
                    pagination:true,
                    columns:[[
                        //{field:'orderid',title:'Order ID',width:200},
                        {field:'questionnameseleted',title:'试题名称',width:100,align:'right'},
                        {field:'questioncontent',title:'试题内容',width:100,align:'right'}
                    ]],
                    onResize:function(){
                        $('#dgpaper').datagrid('fixDetailRowHeight',index);
                    },
                    onLoadSuccess:function(){
                        setTimeout(function(){
                            $('#dgpaper').datagrid('fixDetailRowHeight',index);
                        },0);
                    }
                });
                $('#dgpaper').datagrid('fixDetailRowHeight',index);
            }
        });
    });

    function onRowContextPaperMenu(e,index,row){
        if (row){
            e.preventDefault();
            $(this).datagrid('selectRow', index);
            $('#mmPaper').menu('show',{
                left: e.pageX,
                top: e.pageY
            });
        }
    }


    function newExamPaper(i){

        if(i==0){
            $('#dlgexamPaper').dialog('open').dialog('center').dialog('setTitle','新增试卷');

            $('#fmPaper').form('clear');
            $('#opp').val('add');

        }
        if(i==1){
            var row = $('#dgpaper').datagrid('getSelected');
            if(!row){
                $.messager.alert('提示','请选择要编辑的试卷！','info');
            }else{
                $('#dlgexamPaper').dialog('open').dialog('center').dialog('setTitle','编辑试卷');
                //row = $('#dgPaper').datagrid('getSelected');
                if(row.papershare==1){
                    pShare='on';
                }else{
                    pShare='';
                }
                if(row.status==1){
                    ssb='on';
                }else{
                    ssb='';
                }
                if(row.paperrule1==1){
                    rule1='on';
                }else{
                    rule1='';
                }
                if(row.paperrule2==1){
                    rule2='on';
                }else{
                    rule2='';
                }
                if(row.paperrule3==1){
                    rule3='on';
                }else{
                    rule3='';
                }
                $('#fmPaper').form('load',{
                    paperName:row.papername,
                    memo:row.memo,
                    paperShare:pShare,
                    status:ssb,
                    paperRule1:rule1,
                    paperRule2:rule2,
                    paperRule3:rule3,
                    gradeTotal:row.gradetotal,
                    opp:'edit',
                    id:row.id
                });
            }
        }

//        alert($('#paperRule1').val());
//        var obj=$('#paperRule2');
//        $.each(obj, function(i, val) {
//            text = text + "Key:" + i + ", Value:" + val;
//            alert(text);
//        });
//
//        if($('#paperRule2').checked){
//            $('#gradeTotal').show();
//        }else{
//            $('#gradeToatal').hide()
//        }
    }

    function saveExamPaper(){
        $('#fmPaper').form('submit',{
            url: '/thinkphp/index.php/Admin/Paper/save',
            onSubmit: function(){
                //return $(this).form('validate');
            },
            success: function(result){
                if (result>0){
                    $.messager.show({
                        msg:'操作成功！',
                        timeout:2000,
                        showType:'slide'
                    });
                    $('#dlgexamPaper').dialog('close');        // close the dialog
                    $('#dgpaper').datagrid('reload');    // reload the user data

                } else {
                    $.messager.alert('提示',result,'info');
                }
            }
        });
    }


    function destroyExamPaper() {
        var row = $('#dgpaper').datagrid('getSelected');
        if (row) {
            $.messager.confirm('提示','确定删除?', function (r) {
                if (r) {
                    $.post('/thinkphp/index.php/Admin/Paper/destroy', {id: row.id}, function (result) {
                        if (result) {
                            $('#dgpaper').datagrid('reload');    // reload the  data
                            $.messager.show({
                                msg:'操作成功！',
                                timeout:2000,
                                showType:'slide'
                            });
                        } else {
                            $.messager.show({    // show error message
                                title: '提示',
                                msg: '删除失败！'
                            });
                        }
                    }, 'json');
                }
            });
        }
    }

    var paperSelectedId=0;
    function addPaperQuestion(){
        row = $('#dgpaper').datagrid('getSelected');
        if(!row){
            $.messager.alert('提示','请选择要操作的试卷！','info');
        }else {
            paperSelectedId=row.id;
            //$('#wQuestion').window('open');
            $('#wQuestion').window({title:row.papername});
            $('#wQuestion').window('open');

            $('#dgpaperQuestion').datagrid({
                url: '/thinkphp/index.php/Admin/Paper/questionList/paperid/'+row.id,
            });

            $('#dgpaperQuestionSelected').datagrid({
                url: '/thinkphp/index.php/Admin/Paper/questionSelected/paperid/'+row.id,
            });
        }
    }


    var questionSelectedidArr = [];
    var questionDeletedidArr = [];
    function addPaperQuestionTo(){
        var checkedItems = $('#dgpaperQuestion').datagrid('getChecked');
        var insertindex=0;
        if (checkedItems.length > 0)
        {
            var checkedItemsLength = checkedItems.length;
            for (var i = 0; i < checkedItemsLength; i++)
            {
                var checkedRow = checkedItems[i];
                var checkedRowIndex = $('#dgpaperQuestion').datagrid('getRowIndex', checkedRow);
                $('#dgpaperQuestion').datagrid('deleteRow', checkedRowIndex);
            }
        }

        $.each(checkedItems, function(index, item){
            if(item.id){
                $('#dgpaperQuestionSelected').datagrid('insertRow',{
                    index: insertindex,	// index start with 0
                    row: {
                        id:item.id,
                        questionnameseleted: item.questionname,
                    },
                });
                questionSelectedidArr.push(item.id);
            }
            if(item.questionidselected){
                $('#dgpaperQuestionSelected').datagrid('insertRow',{
                    index: insertindex,	// index start with 0
                    row: {
                        questionidselected:item.questionidselected,
                        questionnameseleted: item.questionname,
                    },
                });
                questionDeletedidArr.splice(jQuery.inArray(item.questionidselected,questionDeletedidArr),1);
                //questionSelectedid.push(item.id);
            }
            insertindex++;
        });
    }

    function delPaperQuestionFr(){
        var checkedItems = $('#dgpaperQuestionSelected').datagrid('getChecked');
        var insertindex=0;
        if (checkedItems.length > 0)
        {
            var checkedItemsLength = checkedItems.length;
            for (var i = 0; i < checkedItemsLength; i++)
            {
                var checkedRow = checkedItems[i];
                var checkedRowIndex = $('#dgpaperQuestionSelected').datagrid('getRowIndex', checkedRow);
                $('#dgpaperQuestionSelected').datagrid('deleteRow', checkedRowIndex);
            }
        }

        $.each(checkedItems, function(index, item){
            if(item.id){
                $('#dgpaperQuestion').datagrid('insertRow',{
                    index: insertindex,	// index start with 0
                    row: {
                        id:item.id,
                        questionname: item.questionnameseleted,
                    },
                });

                questionSelectedidArr.splice(jQuery.inArray(item.id,questionSelectedidArr),1);
            }
            if(item.questionidselected){
                $('#dgpaperQuestion').datagrid('insertRow',{
                    index: insertindex,	// index start with 0
                    row: {
                        questionidselected:item.questionidselected,
                        questionname: item.questionnameseleted,
                    },
                });
                questionDeletedidArr.push(item.questionidselected);
            }
            insertindex++;
        });
    }

    function closeWindow(){
        questionaSelectedidArr = [];
        questionDeletedidArr = [];
        $('#wQuestion').window('close');
    }

    function addPaperQuestionSave(){
        $.messager.confirm("提示", "您确定要执行操作吗？", function (data) {
            if (data) {
                //alert('selected:'+questionSelectedidArr.join(',')+'/deleted'+questionDeletedidArr.join(','));
                $.ajax({
                    url: '/thinkphp/index.php/Admin/Paper/saveQuestion',    //请求的url地址
                    async: true, //请求是否异步，默认为异步，这也是ajax重要特性
                    data: { "add": questionSelectedidArr,"del":questionDeletedidArr,'paperid':paperSelectedId },    //参数值
                    type: "GET",   //请求方式
                    beforeSend: function() {
                        //请求前的处理
                    },
                    success: function(result) {
                        if(result){
                            //alert(result);
                            questionSelectedidArr = [];
                            questionDeletedidArr = [];
                            $.messager.show({
                                msg:'操作成功！',
                                timeout:2000,
                                showType:'slide'
                            });
                            //$('#wQuestion').window('close');
                            $('#dgpaperQuestionSelected').datagrid('reload');
                            $('#dgpaperQuestion').datagrid('reload');
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

    function gradeSetted(){
        row = $('#dgpaper').datagrid('getSelected');
        if(!row){
            $.messager.alert('提示','请选择要操作的试卷！','info');
        }else {
            paperSelectedId=row.id;
            //$('#wQuestion').window('open');
            $('#wQuestionGradeSetted').window({title:row.papername});
            $('#wQuestionGradeSetted').window('open');

            $('#dgpaperQuestionGradeSetted').datagrid({
                url: '/thinkphp/index.php/Admin/Paper/questionSelected/paperid/'+row.id,
            });
        }
    }

    function addPaperQuestionGradeSettedSave(){
        data=$('#dgpaperQuestionGradeSetted').datagrid('getRows');
        $.ajax({
            url: '/thinkphp/index.php/Admin/Paper/gradeSetted',    //请求的url地址
            async: true, //请求是否异步，默认为异步，这也是ajax重要特性
            data: { "data": data,'paperId':paperSelectedId},    //参数值
            type: "POST",   //请求方式
            beforeSend: function() {
                //请求前的处理
            },
            success: function(result) {
                $.messager.show({
                    msg:result,
                    timeout:2000,
                    showType:'slide'
                });
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

    function onRowContextGradeSettedMenu(e,index,row){
        if (row){
            e.preventDefault();
            $(this).datagrid('selectRow', index);
            $('#mmGradeSetted').menu('show',{
                left: e.pageX,
                top: e.pageY
            });
        }
    }


    var qrowIndex=0;
    function rowEdit(row){
        $('#dgpaperQuestionGradeSetted').datagrid('beginEdit', row);
        qrowIndex=row;
    }
    function rowSelected(row){
        if(row!=qrowIndex){
            $('#dgpaperQuestionGradeSetted').datagrid('endEdit', qrowIndex);
        }
    }
    function cancelEdit(){
        $('#dgpaperQuestionGradeSetted').datagrid('endEdit', qrowIndex);
    }
</script>