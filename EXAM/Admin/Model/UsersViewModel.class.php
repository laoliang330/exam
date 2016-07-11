<?php
namespace Admin\Model;
use Think\Model\ViewModel;
class UsersViewModel extends ViewModel {
    public $viewFields = array(
        'Users'=>array('id','username','parentid','isuser','userrole'),
        'Role'=>array('id'=>'roleid','roletitle'=>'roletitle', '_on'=>'Users.userrole=Role.roleLevel'),
    );
}