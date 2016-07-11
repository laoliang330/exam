<?php
namespace Home\Controller;
//use Think\Controller;
use Home\Controller\CommonController;
class UserController extends CommonController {

    public function index(){

        $Data = D('userView');// 实例化Data数据模型
        $map['users.id']=session('userid');
        $result = $Data->where($map)->find();

        $this->assign('username',$result['username']);
        $this->assign('userrole',$result['roletitle']);

        $this->display();
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

    public function changePassWord(){
        $User=M('users');
        $map['userPass']=MD5(I('post.oldPass'));
        $map['id']=session('userid');
        $result=$User->where($map)->find();

        if(!$result){
            echo '原密码错误！';
        }else{
            if(I('post.newPass')!=I('post.newPassConfirm')){
                echo '两次输入的新密码不相同！';
            }else{
                $result=$User->where($map)->setField('userPass',MD5(I('post.newPass')));
                echo '操作成功！您可以使用新密码登录！';
            }
        }

    }
}