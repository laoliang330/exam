<?php
namespace Home\Model;
use Think\Model\ViewModel;
Class UserViewModel  extends ViewModel {

    public $viewFields = array(
        'users'=>array('userName'),
        'role'=>array('roleTitle','_on'=>'role.id=users.userRole'),
    );

}