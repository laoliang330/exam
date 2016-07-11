/**
 * Created by liangming on 16/6/13.
 */


function edit(){

    //editingId=$('#tg').treegrid('select', editingId).id;
    //alert($('#tg').treegrid('select').id);
    if (editingId != undefined){
        $('#tg').treegrid('select', editingId);
        //alert($('#tg').treegrid('select', editingId));
        return;
    }
    var row = $('#tg').treegrid('getSelected');
    if (row){
        row.draggable=false;
        editingId = row.id
        $('#tg').treegrid('beginEdit', editingId);
    }
}
function save(){
    if (editingId != undefined){
        var t = $('#tg');
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
        $('#tg').treegrid('cancelEdit', editingId);
        editingId = undefined;
    }
}


function addnode(isuser){
    var node = $('#tg').treegrid('getSelected');
    if(node){
        if(node.isuser==1){
            myalert("提示，用户下不能添加节点!");
        }else{
            $('#isuser').switchbutton('enable');
            $('#tg').treegrid('expand',node.id);
            $('#dlg').dialog('open').dialog('center').dialog('setTitle','添加节点');
            $('#fm').form('clear');
            var hiddeninput ="<input type='hidden' name='parentid' id='parentid' value='"+node.id+"' />";
            //var hiddeninput2 ="<input type='hidden' name='op' id='op' value='add' />";
            $('#op').val('add');
            $('#fm').append(hiddeninput);
            //$('#fm').append(hiddeninput2);
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
    var node = $('#tg').treegrid('getSelected');
    if(node){

            $('#tg').treegrid('expand',node.id);
            $('#dlg').dialog('open').dialog('center').dialog('setTitle','编辑节点');
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
            $('#fm').append(hiddeninput);
            //$('#fm').append(hiddeninput2);
            $('#op').val('edit');

    }else{
        myalert("请选择节点!");
    }
}





var selfid=0;
var nodeid=0;
var nodename='';

function addnodeconfirm(){
    var node = $('#tg').treegrid('getSelected');
    nodename=$("#nodename").textbox('getValue');
    nodeid=node.id;
    $('#parentid').val(node.id);
    //alert($('#isuser').switchbutton('options').checked);
    $('#fm').submit();
}

function removenode(){
    var node = $('#tg').treegrid('getSelected');
    if(node){
        //alert($('#tg').treegrid('getChildren',node.id).length);
        if($('#tg').treegrid('getChildren',node.id).length>0){
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
    $("#tg").tree('disableDnd');
    //}
    //}
}


function onContextMenu(e,row){
    if (row){
        e.preventDefault();
        $(this).treegrid('select', row.id);
        $('#mm').menu('show',{
            left: e.pageX,
            top: e.pageY
        });
    }
}

function collapse(){
    var node = $('#tg').treegrid('getSelected');
    if (node){
        $('#tg').treegrid('collapse', node.id);
    }
}
function expand(){
    var node = $('#tg').treegrid('getSelected');
    if (node){
        $('#tg').treegrid('expand', node.id);
    }
}


function myalert(alerinfo){
    $.messager.alert('提示',alerinfo,'info');
}


function closedlg(){
    $('#fm').form('clear');
    $('#dlg').dialog('close');
}