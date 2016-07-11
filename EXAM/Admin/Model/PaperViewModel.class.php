<?php
namespace Admin\Model;
use Think\Model\ViewModel;
class PaperViewModel extends ViewModel {
    public $viewFields = array(
        'Users'=>array('id'=>'userId','username'),
        'Paper'=>array('id'=>'id','paperName','paperRule1','paperRule2','paperRule3','paperShare','status', 'memo','createTime','gradeTotal','_on'=>'Paper.ownerId=Users.id'),
    );
}