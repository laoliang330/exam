<?php
namespace Admin\Model;
use Think\Model\ViewModel;
class QuestionViewModel extends ViewModel {
    public $viewFields = array(
        'Question'=>array('id'=>'id','questionName','questionContent','questionType','questionHowMany','answer','questionShare','comment','status', 'createTime','inUse'),
        'Users'=>array('id'=>'userid','username','_on'=>'Question.ownerId=Users.id'),
        'Questiontype'=>array('typeName','_on'=>'Question.questionType=Questiontype.id'),

    );
}