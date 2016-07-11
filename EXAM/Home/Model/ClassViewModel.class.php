<?php
namespace Home\Model;
use Think\Model\ViewModel;
class ClassViewModel extends ViewModel {
    public $viewFields = array(
        'Class'=>array('id','className','memo','ownerId','createTime','status','ratedScore','ratedTime','classAttach'),
        'Users'=>array('id'=>'userid','username','_on'=>'Users.id=Class.ownerId'),
//        'Classrated'=>array('')
    );
}