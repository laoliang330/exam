<?php
namespace Home\Model;
use Think\Model;
class FormModel extends Model {
    protected $tableName = 'test';
    // 定义自动验证
    protected $_validate    =   array(
        array('name','require','标题必须'),
    );
    // 定义自动完成
    protected $_auto    =   array(
        array('passWord','time',1,'function'),
        //array('memo','time',1,'function'),

    );

}