<?php
namespace Admin\Model;
use Think\Model;
Class ClassModel extends Model{

    protected $_map = array(
        //'nodename' =>'orgName', // 把表单中nodename映射到数据表的username字段
        //'parentid' =>'parentId'
    );
    // 定义自动验证
    protected $_validate    =   array(
        array('className','require','必须填写课堂名称！'),
        array('className','','课堂名已经存在！',0,'unique',3),
    );

    // 定义自动完成
    protected $_auto    =   array(
        array('createTime','mydate',1,'callback'),
        array('ownerId','getSession',1,'callback'),


    );

    protected function formatTime($data){
        if($data){
            return $data;
        }else{
            return null;
        }
    }

    protected function mydate(){
        return date("Y-m-d H:i:s");
    }

    protected function getSession()
    {
        return session('userid');
    }
}