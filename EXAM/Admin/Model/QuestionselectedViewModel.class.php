<?php
namespace Admin\Model;
use Think\Model\ViewModel;
Class QuestionselectedViewModel  extends ViewModel {

    public $viewFields = array(
        'Question'=>array('questionName'=>'questionNameSeleted','questioncontent'),
        'Questionselected'=>array('id'=>'questionIdSelected','paperId'=>'paperId','gradeSetted','_on'=>'Question.id=Questionselected.questionId'),
        'questiontype'=>array('typeName','_on'=>'questiontype.id=Question.questionType')
    );

}