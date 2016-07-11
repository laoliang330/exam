<?php
namespace Admin\Controller;
use Think\Controller;
class QuestionController extends Controller {
    public function index(){
        $this->display();
    }


    public function questionList(){
        $Room = D("QuestionView");
        $map['Question.inuse']=1;
        $map['userid']=session('userid');
        $roomDate=$Room->where($map)->order('question.createTime desc')->select();
        echo(json_encode($roomDate));
        //echo $Room->getLastSql();
    }

    public function questionDetail(){
        $Room = D("QuestionView");
        $whereStr='Question.id='.I('get.id');
        $roomDate=$Room->where($whereStr)->select();
        echo(json_encode($roomDate));
        //echo $Room->getLastSql();
    }

    public function save(){
        $op=I('post.qop');

        $User = D('Question');

        if($op=='add'){
            if($User->create()) {
                if(I('post.questionShare')){
                    $User->questionShare=1;
                }else{
                    $User->questionShare=0;
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
            $questionId=I('post.qid');
            if(I('post.questionShare')){
                $questionShare=1;
            }else{
                $questionShare=0;
            }

            if(I('post.status')){
                $status=1;
            }else{
                $status=0;
            }

            $data = array('questionName'=>I('post.questionName'),'questionContent'=>I('post.questionContent'),'questionHowMany'=>I('post.questionHowMany'),
                'comment'=>I('post.comment'),'questionType'=>I('post.questionType'),
                'answer'=>I('post.answer'),'questionShare'=>$questionShare,'status'=>$status);

            $wherestr='id='.$questionId;

            if($User->create()){

                $result =$User->where($wherestr)->setField($data);


                //dump($isuser);
                if($result){
                    echo $questionId;
                }else{
                    echo $User->getError();
                }
            }else{
                echo $User->getError();
            }
        }


    }

    public function destroy(){


        $del=M('Question');
        $delArr=I('post.id');
//        foreach($delArr as $qid){
//            $data[]=intval($qid);
//        }
        //$delstr=explode(',',$data);
        $map['id'] = array('IN',$delArr);
        $result=$del->where($map)->setField('inUse',0);

        echo $result;
        exit;
        echo I('post.id');
        if(I('post.id')){
            $wherestr='id in '.I('post.id');
            $User=M('Question');
            //$result=$User->where($wherestr)->delete();
            $result=$User->where($wherestr)->setField('inUse',0);
            echo $result;
        }else{
            echo 0;
        }

    }

    public function userRange(){
        $userRange=M(Org);
        $data=$userRange->field('id,orgName as name,parentId as parentId')->select();
        //$data='{"total":7,"rows":'.json_encode($data).'}';
        $data=json_encode($data);
        //dump(json_encode($data));
        echo $data;

    }
}