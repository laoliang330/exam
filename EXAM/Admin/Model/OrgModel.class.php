<?php
namespace Admin\Model;
use Think\Model;
Class OrgModel extends Model{

    protected $_map = array(
        'nodename' =>'orgName', // 把表单中nodename映射到数据表的username字段
        'parentid' =>'parentId'
    );
    // 定义自动验证
    protected $_validate    =   array(
        array('orgName','require','必须填写节点名称！'),
        array('parentId','require','父节点id丢失！'),
        array('orgName','','节点名已经存在！',0,'unique',3),
    );

    // 定义自动完成
    protected $_auto    =   array(
        array('isuser','0'),
        //array('userPass','111'),
        //array('userRole','2'),
        //array('memo','time',1,'function'),

    );
}