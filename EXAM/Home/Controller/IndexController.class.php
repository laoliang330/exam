<?php
namespace Home\Controller;
//use Think\Controller;
use Home\Controller\CommonController;
class IndexController extends CommonController {

    public function index(){

        $Data = M('Room');// 实例化Data数据模型
        $map['inUse']=1;
        $map['status']=1;

        $map['startTime']=array(array('ELT',date('y-m-d',time())),array('EXP','IS NULL'),'or');
        $map['endTime']=array(array('EGT',date('y-m-d',time())),array('EXP','IS NULL'),'or');

        $map['_string']='find_in_set("'.session('parentid').'", userRange) or userRange is null or userRange=""';
        $result = $Data->where($map)->select();
        //echo $Data->getLastSql();
        //exit;

        $this->assign('room',$result);

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
                $this->assign('roomId',I('get.roomId'));
                $this->assign('paperId',I('get.paperId'));

                $Room=M('Room');
                $roomdata=$Room->where('id='.I('get.roomId'))->find();
                $this->assign('timeLimit',$roomdata['timelimit'])->assign('forceEnd',$roomdata['forceend']);
            }
        }

        session('startTime',date("Y-m-d H:i:s"));//记录开始答题时间

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