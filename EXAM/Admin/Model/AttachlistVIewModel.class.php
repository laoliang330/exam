<?php
namespace Admin\Model;
use Think\Model\ViewModel;
class AttachlistViewModel extends ViewModel {
    public $viewFields = array(
        'attach'=>array('id','classId','ownerId','createTime','status','originalFileName','savedFileName','savedPath','fileSize'),
        'Users'=>array('id'=>'userid','username','_on'=>'Users.id=Class.ownerId'),
    );
}