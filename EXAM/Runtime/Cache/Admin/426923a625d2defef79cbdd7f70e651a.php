<?php if (!defined('THINK_PATH')) exit();?><script src="/thinkphp/public/js/datagrid-filter.js"></script>

<table id="dgQuestion" title="试题管理" class="easyui-datagrid ContextMenu"
       data-options="
            url:'/thinkphp/index.php/Admin/Question/questionList',
            multiple: true,
            rownumbers:true,
            fitColumns: true,
            onRowContextMenu: onRowContextQuestionMenu,
            fit:true,
            pagination:true,
            sortName:'typename',
            remoteSort:false,
            pageSize:50,
            pageList: [50,100,150],
            ctrlSelect:true,
       "
       toolbar="#toolbarQuestion"
       >
    <thead>
    <tr>
        <th data-options="field:'id',checkbox:true"></th>
        <th field="questionname" sortable="true"  width="50">试题名称</th>
        <th field="typename" sortable="true">试题类型</th>
        <th field="status" sortable="true">当前状态</th>
        <th field="username" sortable="true">创建人</th>
        <th field="createtime" sortable="true">创建时间</th>
    </tr>
    </thead>
</table>
<div id="toolbarQuestion">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newExamQuestion(0)">新增试题</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="newExamQuestion(1)">编辑试题</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyExamQuestion()">删除</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-reload" plain="true" onclick="">导入</a>
    <a href="#" class="easyui-linkbutton"  plain="true" onclick="">下载模板</a>
</div>

<div id="mmQuestion" class="easyui-menu" style="width:120px;">
    <div onclick="newExamQuestion(0)" data-options="iconCls:'icon-add'">新增</div>
    <div class="menu-sep"></div>
    <div onclick="newExamQuestion(1)" data-options="iconCls:'icon-edit'">编辑</div>
    <div class="menu-sep"></div>
    <div onclick="addQuestion()" data-options="iconCls:'icon-sum'">试题</div>
    <div class="menu-sep"></div>
    <div onclick="destroyExamQuestion()" data-options="iconCls:'icon-remove'">删除</div>
</div>


<div id="wQuestionEdit" class="easyui-window" title="请填写试题信息" data-options="
        modal:true,
        closed:true,
        iconCls:'icon-save',
        collapsible:false,
        closable:false,
        minimizable:false,
        "
     style="width:800px;height:500px;padding:5px;">
    <div class="easyui-layout" data-options="fit:true" id="questionLayout">
        <div data-options="region:'center'" style="width:45%;">
            <form id="fmQuestion" method="post" novalidate>
                <div class="fitem">
                    <label>试题名称:</label>
                    <input name="questionName"  id="questionName" class="easyui-textbox" required="true" missingMessage="必填">
                </div>
                <div class="fitem">
                    <label>试题内容:</label>
                    <input class="easyui-textbox" name="questionContent" id="questionContent" data-options="multiline:true,height:200" required="true" missingMessage="必填" />
                </div>
                <div class="fitem">
                    <label>试题答案:</label>
                    <input name="answer"  id="answer" class="easyui-textbox" required="true" missingMessage="必填!多个答案使用 '/' 号分隔。">
                </div>
                <div class="fitem">
                    <label>试题类型:</label>
                    <select id="questionType" class="easyui-combobox" name="questionType" required="true" style="width:120px;">
                        <option value="1">填空</option>
                        <option value="2">单选</option>
                        <option value="3">多选</option>
                        <option value="4">问答</option>
                    </select>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label>问题数量:</label>
                    <input name="questionHowMany" id="questionHowMany" value="1" class="easyui-numberspinner" style="width:120px;" required="true" data-options="min:1,max:10,editable:false">
                </div>
                <div class="fitem">
                    <label>相关选项:</label>
                    <input class="easyui-switchbutton" name="questionShare" id="'questionShare" data-options="onText:'共享',offText:'不共享'" style="width:100px;">
                    <input class="easyui-switchbutton" name="status" id="'status" data-options="onText:'开放状态',offText:'锁定状态'"  checked='true' style="width:100px;">

                </div>
                <div class="fitem">
                    <label>解答说明:</label>
                    <input class="easyui-textbox" name="comment" id="comment" data-options="multiline:true,height:80" />
                </div>
                <input type="hidden" id="qop" name="qop" value="add">
                <input type="hidden" id="qid" name="qid" value="0">
            </form>
        </div>
        <div data-options="region:'south',border:false" style="text-align:right;padding:0px 0 0;">
            <a class="easyui-linkbutton" data-options="iconCls:'icon-ok'" href="javascript:void(0)" onclick="saveExamQuestion()" style="width:80px">保存</a>
            <a class="easyui-linkbutton" data-options="iconCls:'icon-cancel'" href="javascript:void(0)" onclick="javascript:$('#wQuestionEdit').window('close');" style="width:80px">取消</a>
        </div>
    </div>

</div>


<script type="text/javascript">

    $(function(){
        var dg = $('#dgQuestion').datagrid();
        dg.datagrid('enableFilter', [
//            {
//                field:'id',
//                type:'numberbox',
//                options:{precision:1},
//                op:['equal','notequal','less','greater']
//            },
            {
                field:'username',
                type:'numberbox',
                options:{precision:1},
                op:['equal','notequal','less','greater']
            },
            {
                field:'createtime',
                type:'numberbox',
                options:{precision:1},
                op:['equal','notequal','less','greater']
            },

            {
            field:'questionname',
            type:'numberbox',
            options:{precision:1},
            op:['equal','notequal','less','greater']
            },
            {
            field:'status',
            type:'numberbox',
            options:{precision:1},
            op:['equal','notequal','less','greater']
            },
            {
            field:'typename',
            type:'combobox',
            options:{
                panelHeight:'auto',
                data:[{value:'',text:'All'},{value:'P',text:'P'},{value:'N',text:'N'}],
                onChange:function(value){
                    if (value == ''){
                        dg.datagrid('removeFilterRule', 'status');
                    } else {
                        dg.datagrid('addFilterRule', {
                            field: 'status',
                            op: 'equal',
                            value: value
                        });
                    }
                    dg.datagrid('doFilter');
                }
            }
        }]);

        $('#dgQuestion').datagrid({
            view: detailview,
            detailFormatter:function(index,row){
                return '<div id="p" class="easyui-panel" title="Basic Panel" style="padding:10px;">'+
                '<ul>'+
                '<li id="content"></li>'+
                '<li>easyui provides essential functionality for building modem, interactive, javascript applications.</li>'+
               ' </ul>'+
                '</div>'
            },
            onExpandRow: function(index,row){
                var ddv = $(this).datagrid('getRowDetail',index).find('#p');

                var content='<li>试题内容：'+row.questioncontent+'</li>';
                var answer='<li>试题答案：'+row.answer+'</li>';
                ddv.html(content+answer);

                $('#dgQuestion').datagrid('fixDetailRowHeight',index);
            }
        });
    });

    function onRowContextQuestionMenu(e,index,row){
        if (row){
            e.preventDefault();
            $(this).datagrid('selectRow', index);
            $('#mmQuestion').menu('show',{
                left: e.pageX,
                top: e.pageY
            });
        }
    }


    function newExamQuestion(i){
        if(i==0){
            //$('#dlgexamQuestion').dialog('open').dialog('center').dialog('setTitle','新增试题');
            $('#wQuestionEdit').window('open').window('center');
            $('#questionName').textbox('clear');
            $('#questionContent').textbox('clear');
            $('#answer').textbox('clear');
            $('#comment').textbox('clear');

            $('#qop').val('add');

        }
        if(i==1){
            var row = $('#dgQuestion').datagrid('getSelected');
            if(!row){
                $.messager.alert('提示','请选择要编辑的试题！','info');
            }else{
                $('#wQuestionEdit').window('open').window('center').window('setTitle','编辑试题');
                //row = $('#dgQuestion').datagrid('getSelected');
                if(row.questionshare==1){
                    pShare='on';
                }else{
                    pShare='';
                }
                if(row.status==1){
                    ssb='on';
                }else{
                    ssb='';
                }

                $('#fmQuestion').form('load',{
                    questionName:row.questionname,
                    questionContent:row.questioncontent,
                    answer:row.answer,
                    questionType:row.questiontype,
                    questionHowMany:row.questionhowmany,
                    comment:row.comment,
                    questionShare:pShare,
                    status:ssb,
                    qop:'edit',
                    qid:row.id
                });
            }
        }
    }

    function saveExamQuestion(){
        $('#fmQuestion').form('submit',{
            url: '/thinkphp/index.php/Admin/Question/save',
            onSubmit: function(){
                //return $(this).form('validate');
            },
            success: function(result){
                //alert(result);
                if (result>0){
                    $.messager.show({
                        msg:'操作成功！',
                        timeout:2000,
                        showType:'slide'
                    });
                    if($('#qop').val()=='add'){
                        $('#questionName').textbox('clear');
                        $('#questionContent').textbox('clear');
                        $('#answer').textbox('clear');
                        $('#comment').textbox('clear');
                    }else{
                        $('#wQuestionEdit').window('close');
                    }

                    $('#dgQuestion').datagrid('reload');    // reload the user data

                } else {
                    $.messager.alert('提示',result,'info');
                }
            }
        });
    }


    function destroyExamQuestion() {
        var checkedItems = $('#dgQuestion').datagrid('getChecked');
        if (checkedItems.length > 0) {
            $.messager.confirm('提示','确定删除?', function (r) {
                if (r) {
                    var questionIdArr=[];
                    for (var i = 0; i < checkedItems.length; i++)
                    {
                        questionIdArr.push(checkedItems[i].id);;
                    }
                    var url='/thinkphp/index.php/Admin/Question/destroy/'
                    $.post('/thinkphp/index.php/Admin/Question/destroy', {id: questionIdArr}, function (result) {
                        if (result) {
                            $('#dgQuestion').datagrid('reload');    // reload the  data
                            $.messager.show({
                                msg:'操作成功！',
                                timeout:2000,
                                showType:'slide'
                            });
                        } else {
                            $.messager.show({    // show error message
                                title: '提示',
                                msg: '操作失败！'
                            });
                        }
                    }, 'json');
                }
            });
        }
    }

    function addQuestion(){
        row = $('#dgQuestion').datagrid('getSelected');
        if(!row){
            $.messager.alert('提示','请选择要操作的试卷！','info');
        }else {
            QuestionSelectedId=row.id;
            //$('#wQuestion').window('open');
            $('#wQuestion').window({title:row.Questionname});
            $('#wQuestion').window('open');

            $('#dgQuestionQuestion').datagrid({
                url: '/thinkphp/index.php/Admin/Question/questionList/Questionid/'+row.id,
            });

            $('#dgQuestionQuestionSelected').datagrid({
                url: '/thinkphp/index.php/Admin/Question/questionSelected/Questionid/'+row.id,
            });
        }
    }




    function addQuestionSave(){
        $.messager.confirm("提示", "您确定要执行操作吗？", function (data) {
            if (data) {
                //alert('selected:'+questionSelectedidArr.join(',')+'/deleted'+questionDeletedidArr.join(','));
                $.ajax({
                    url: '/thinkphp/index.php/Admin/Question/saveQuestion',    //请求的url地址
                    async: true, //请求是否异步，默认为异步，这也是ajax重要特性
                    data: { "add": questionSelectedidArr,"del":questionDeletedidArr,'Questionid':QuestionSelectedId },    //参数值
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
                            $('#wQuestion').window('close');
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
</script>