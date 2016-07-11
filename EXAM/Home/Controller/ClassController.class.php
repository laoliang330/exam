<?php
namespace Home\Controller;
use Think\Controller;
class ClassController extends Controller {

    public function index(){

        $Data = D('ClassView');// 实例化Data数据模型
        $map['class.inUse']=1;
        $result = $Data->where($map)->order('Class.id desc')->select();
        $this->assign('class',$result);

        $this->display();
    }

    public function showDetail(){
        if(I('get.id')){

            $whereStr='Class.id='.I('get.id');

            $Data=D('ClassView');
            $result = $Data->where($whereStr)->select();
            $this->assign('class',$result);

            $attach=M('attach');
            $map['classId']=I('get.id');
            $map['inUse']=1;
            $result=$attach->where($map)->select();
            $this->assign('attach',$result);
        }
        $this->display();

    }

    public function teacher(){
        $this->display();
    }

    public function rated(){

        if(I('post.ratedClassId')){
            $Rated=M('classrated');
            $map['ratedClassId']=I('post.ratedClassId');
            $map['rateduserId']=session('userid');
            $result=$Rated->where($map)->find();

            if($result){
                echo -2;
                exit;
            }
            if(100>=I('post.ratedScore') and I('post.ratedScore')>0) {
                $Data = D('Classrated');
                if ($Data->create()) {
                    if (!I('post.ratedComment')) {
                        $Data->ratedComment = '未评价';
                    }
                    $result = $Data->add();
                    if ($result) {
                        $whereStr = 'id=' . I('ratedClassId');
                        $Class = M('Class');
                        $Class->where($whereStr)->setInc('ratedTime');
                        $Class->where($whereStr)->setInc('ratedScore', I('post.ratedScore'));
                    }
                    echo $result;
                } else {
                    echo $Data->getError();
                }
            }else{
                echo -1;
            }
        }else{
            echo 0;
        }
    }

    public function detail(){
        if(I('get.id')){
            $Data = M('Room');// 实例化Data数据模型
            $whereStr='id='.I('get.id');
            $result = $Data->where($whereStr)->select();
            $this->assign('roomId',$result[0]['id']);
            $this->assign('roomName',$result[0]['roomname']);
            $this->assign('startTime',date('Y-m-d',strtotime($result[0]['starttime'])));
            $this->assign('endTime',date('Y-m-d',strtotime($result[0]['endtime'])));
            $this->assign('timeLimit',$result[0]['timelimit']);
            $this->assign('passScore',$result[0]['passscore']);
            $this->assign('paperId',$result[0]['paper']);
            if($result[0]['forceEnd']){
                $forceEnd='是';
            }else{
                $forceEnd='否';
            }
            $this->assign('forceEnd',$forceEnd);
            $this->assign('memo',$result[0]['memo']);
//            dump($result);
//            exit;
            $this->display();
        }
    }

    public function start(){
        if(I('get.roomId')){
            if(I('get.paperId')){
                $Data = D('QuestionView');
                $whereStr='paperId='.I('get.paperId');
                $result = $Data->where($whereStr)->select();
//                dump($result);
//                exit;
                $this->assign('questionList',$result);
            }
        }
        $this->display();

    }

    public function questionList(){
        if(I('get.roomId')){
            if(I('get.paperId')){
                $Data = D('QuestionView');
                $whereStr='paperId='.I('get.paperId');
                $result = $Data->where($whereStr)->select();
                echo $result ;
                //$this->assign('questionList',$result);
            }
        }
    }
}