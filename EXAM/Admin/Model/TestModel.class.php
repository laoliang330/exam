<?php
namespace Admin\Model;
use Think\Model;
class TestModel extends Model {

    protected $_validate    =   array(
        array('name','require','必须填写用户名！'),
        array('name','','用户名已经存在！',0,'unique',1),
    );

    // 定义自动完成
    protected $_auto    =   array(
        array('passWord','111',1,'string'),
        //array('memo','time',1,'function'),

    );
}