<?php
namespace Admin\Controller;
use Admin\Model\QuestionselectedViewModel;
use Think\Controller;
class PaperController extends Controller {
    public function index(){
        $this->display();
    }

    public function paperList(){
        $Room = D("PaperView");
        $map['paper.inUse']=1;
        $map['ownerId']=session('userid');

        $roomDate=$Room->where($map)->order('paper.id desc')->select();
        echo json_encode($roomDate);
    }

    public function questionSelected(){
        $wherestr='Questionselected.paperId='.I('get.paperid');
        $Room = D("QuestionselectedView");
        $roomDate=$Room->where($wherestr)->select();
        echo(json_encode($roomDate));
        //echo $Room->getLastSql();
    }

    public function questionList(){
        $wherestr='paperId='.I('get.paperid');
        $qs=M('Questionselected');
        $qsdata=$qs->where($wherestr)->getField('id,questionId');
        $Room = M("Question");
        if($qsdata){
            $map['id'] = array('NOT IN',$qsdata);
            $roomDate=$Room->field('id,questionName')->where('inUse=1')->where($map)->select();
            //echo $Room->getLastSql();
        }else{
            $roomDate=$Room->field('id,questionName')->where('inUse=1')->select();
        }

        echo(json_encode($roomDate));
    }


    public function save(){

        $op=I('post.opp');

        $User = D('Paper');

        if($op=='add'){
            if($User->create()) {
                if(I('post.paperShare')){
                    $User->paperShare=1;
                }else{
                    $User->paperShare=0;
                }
                if(I('post.status')){
                    $User->status=1;
                }else{
                    $User->status=0;
                }
                if(I('post.paperRule1')){
                    $User->paperRule1=1;
                }else{
                    $User->paperRule1=0;
                }
                if(I('post.paperRule2')){
                    $User->paperRule2=1;
                }else{
                    $User->paperRule2=0;
                }
                if(I('post.paperRule3')){
                    $User->paperRule3=1;
                }else{
                    $User->paperRule3=0;
                }

                $result = $User->add(); // 写入数据到数据库
                echo $result;
                //echo I('post.userRange').$User->getLastSql();
            } else {
                echo $User->getError();
            }
        }

        if($op=='edit'){
            if(I('post.paperShare')){
                $paperShare=1;
            }else{
                $paperShare=0;
            }

            if(I('post.status')){
                $status=1;
            }else{
                $status=0;
            }
            if(I('post.paperRule1')){
               $paperRule1=1;
            }else{
                $paperRule1=0;
            }
            if(I('post.paperRule2')){
                $paperRule2=1;
            }else{
                $paperRule2=0;
            }
            if(I('post.paperRule3')){
                $paperRule3=1;
            }else{
                $paperRule3=0;
            }
            $data = array('paperName'=>I('post.paperName'),'paperRule1'=>$paperRule1,'paperRule2'=>$paperRule2,'paperRule3'=>$paperRule3,
                'memo'=>I('post.memo'),'paperShare'=>$paperShare,'status'=>$status,'gradeTotal'=>I('post.gradeTotal'));

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
            $User=M('Paper');
            $result=$User->where($wherestr)->setField('inUse',0);
            echo $result;
        }else{
            echo 0;
        }

    }

//    public function userRange(){
//        $userRange=M(Org);
//        $data=$userRange->field('id,orgName as name,parentId as parentId')->select();
//        //$data='{"total":7,"rows":'.json_encode($data).'}';
//        $data=json_encode($data);
//        //dump(json_encode($data));
//        echo $data;
//
//    }

    public function saveQuestion(){//保存新加入的试卷的试题，并同时可以删除从试卷中剔除的试题
        if(I('get.paperid')){
            $paperid=intval(I('get.paperid'));
            $paper=M('paper');

            if(I('get.add')){
                $add=D('Questionselected');
                $addArr=I('get.add');
                foreach($addArr as $qid){
                    $dataAdd['questionId']=intval($qid);
                    $dataAdd['paperId']=$paperid;
                    $data1[]=$dataAdd;
                }
                //dump($data);
                //exit;
                if($add->create($data1)){
                    $result=$add->addAll($data1);
                    echo 'add:'.$result;
                }else{
                    echo $add->getError();
                }

                $paper->where('id='.$paperid)->setInc('questionHowMany',count($addArr));//修改paper中的试题数量

            }
            if(I('get.del')){
                $del=M('Questionselected');
                $delArr=I('get.del');
                foreach($delArr as $qid){
                    $data2[]=intval($qid);
                }
                //$delstr=explode(',',$data);
                $map1['id'] = array('IN',$data2);
                $result=$del->where($map1)->delete();

                $paper->where('id='.$paperid)->setDec('questionHowMany',count($delArr));//修改paper中的试题数量

                echo $result;
            }
        }else{
            echo -1;
        }
    }

    public function gradeSetted(){

        //dump(I('post.data')[0]['gradesetted'].'-'.I('post.data')[0]['questionidselected']);
        if(I('post.data') and I('post.paperId'))
        {
            $sql = "UPDATE exam_questionselected SET gradeSetted = CASE id ";
            $rowList=I('post.data');
            $paperId=I('post.paperId');
            foreach($rowList as $row){
                $sql .= sprintf("WHEN %d THEN %d ", $row['questionidselected'], $row['gradesetted']);
            }
            $sql .= "END WHERE paperId=".$paperId;

            $gradeSetted=M();
            $res = $gradeSetted->execute($sql);
            if($res){
                echo '操作成功！';
            }else{
                echo '操作失败！！';
            }

        }else{
            echo '提交错误';
        }


    }
}