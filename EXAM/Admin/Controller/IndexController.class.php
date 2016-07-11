<?php
namespace Admin\Controller;
//use Think\Controller;
use Admin\Controller\CommonController;
class IndexController extends CommonController {
    public function index(){
        $this->assign('adminExamRoom',U('./Admin/ExamRoom/'));
        $this->assign('username',session('uname'));
        $this->display();
    }
}