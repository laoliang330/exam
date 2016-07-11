<?php
namespace Admin\Controller;
use Think\Controller;
class ExamQuestionController extends Controller {
    public function index(){
        $this->assign('adminExamRoom',U('./Admin/ExamRoom/'));
        $this->display();
    }
}