<?php
namespace Home\Controller;
use Think\Controller;
class ExamController extends Controller {
    public function index(){
        if(I('get.id')){
            $Data = M('Room');// 实例化Data数据模型
            $whereStr='id='.I('get.id');
            $result = $Data->where($whereStr)->select();

            $this->assign('roomName',$result[0]['roomname']);
            $this->assign('startTime',date('Y-m-d',strtotime($result[0]['starttime'])));
            $this->assign('endTime',date('Y-m-d',strtotime($result[0]['endtime'])));
            $this->assign('questionList',U('Exam/questionList'));
//            dump($result);
//            exit;
            $this->display();
        }
    }

    public function examShow(){

    }

    public function questionList(){
        $this->display();
    }


}