<?php
namespace Home\Model;
use Think\Model\ViewModel;
Class QuestionViewModel  extends ViewModel {

    public $viewFields = array(
        'Question'=>array('questionName'=>'questionNameSeleted','questionContent','questionHowMany','questionType'),
        'Questionselected'=>array('id'=>'questionIdSelected','questionId','paperId','_on'=>'Question.id=Questionselected.questionId'),
        'Questiontype'=>array('typeName','_on'=>'Questiontype.id=Question.questionType'),
        //'Room'=>array('timeLimit','forenceEnd','passScore','_on'=>''),
        );

}