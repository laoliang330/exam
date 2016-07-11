<?php
namespace Admin\Model;
use Think\Model;
Class QuestionModel extends Model{

    protected $_map = array(
        //'nodename' =>'orgName', // 把表单中nodename映射到数据表的username字段
        //'parentid' =>'parentId'
    );
    // 定义自动验证
    protected $_validate    =   array(
        array('questionName','require','必须填写试题名称！'),
        //array('questionName','','试题名已经存在！',0,'unique',3),
        array('questionContent','require','必须填写试题内容！'),
        array('answer','require','必须填写试题答案！'),
    );

    // 定义自动完成
    protected $_auto    =   array(
        array('createTime','mydate',1,'callback'),
        array('ownerId','10001'),
        //array('startTime','formatTime',3,'callback'),
        //array('endTime','formatTime',3,'callback'),

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
}