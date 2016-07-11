<?php
namespace Admin\Controller;
use Think\Controller;
class QuestionSelectedController extends Controller {
    public function index(){
        //$this->display();
    }

    public function paperList(){
        $Room = D("Paper");
        $Room->create();
        $roomDate=$Room->order('id desc')->select();
        echo json_encode($roomDate);
    }

    public function questionSelected(){
        $wherestr='paperId='.I('get.id');
        $Room = D("QuestionSelected");
        if($Room->create()){
            $roomDate=$Room->where($wherestr)->select();
            echo(json_encode($roomDate));
        }
    }

    public function save(){
        $forceEnd=I('post.ForceEnd');
        $op=I('post.op');

        $User = D('Paper');

        if($op=='add'){
            if($User->create()) {
                $User->userRang=I('post.userRange');
                if(I('post.forceEnd')){
                    $User->forceEnd=1;
                }else{
                    $User->forceEnd=0;
                }
                if(I('post.status')){
                    $User->status=1;
                }else{
                    $User->status=0;
                }
                $result = $User->add(); // 写入数据到数据库
                echo $result;
                //echo I('post.userRange').$User->getLastSql();
            } else {
                echo $User->getError();
            }
        }

        if($op=='edit'){
            if(I('post.forceEnd')){
                $forceEnd=1;
            }else{
                $forceEnd=0;
            }

            if(I('post.status')){
                $status=1;
            }else{
                $status=0;
            }

            $data = array('roomName'=>I('post.roomName'),'paper'=>I('post.paper'),'startTime'=>I('post.startTime'),
                'endTime'=>I('post.endTime'),'timeLimit'=>I('post.timeLimit'),'userRange'=>I('post.userRange'),
                'memo'=>I('post.memo'),'forceEnd'=>$forceEnd,'status'=>$status);

            $wherestr='id='.I('post.id');

            if($User->create()){

                $result =$User->where($wherestr)->setField($data);


                //dump($isuser);
                if($result){
                    echo I('post.id');
                }else{
                    echo $User->getError();
                }
            }else{
                echo $User->getError();
            }
        }


    }

    public function destroy(){
        echo I('post.id');
        if(I('post.id')){
            $wherestr='id='.I('post.id');
            $User=M(Paper);
            $result=$User->where($wherestr)->delete();
            echo $result;
        }else{
            echo 0;
        }

    }


}