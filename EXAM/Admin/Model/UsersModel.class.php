<?php
namespace Admin\Model;
use Think\Model;
Class UsersModel extends Model{

    protected $_map = array(
        'nodename' =>'userName', // 把表单中nodename映射到数据表的username字段
        'parentid' =>'parentId',
        'userrole' => 'userRole'
    );
    // 定义自动验证
    protected $_validate    =   array(
        array('userName','require','必须填写用户名！'),
        array('parentId','require','父节点id丢失！'),
        array('userName','','用户名已经存在！',0,'unique',3),
    );

    // 定义自动完成
    protected $_auto    =   array(
        array('userPass','111'),
        array('userPass','md5',3,'function'),
        //array('userRole','2'),
        array('isuser','1'),
        //array('memo','time',1,'function'),

    );
}