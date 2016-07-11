<?php
namespace Admin\Controller;
use Think\Controller;
class RoomController extends Controller {
    public function index(){
        $this->display();
    }

    public function roomList(){
        $map['Room.inUse']=1;
        $map['ownerId']=session('userid');
        $Room = D("RoomView");
        //$Room->create();
        $roomDate=$Room->where($map)->order('room.id desc')->select();
        echo json_encode($roomDate);
    }

    public function save(){
        function shuffle_assoc($list,$num) {
            if (!is_array($list)) return $list;
            $keys = array_keys($list);
            shuffle($keys);
            $keys=array_rand($keys,$num);
            $random = array();
            foreach ($keys as $key)
                $random[$key] = $list[$key];
            return $random;
        }

        //$forceEnd=I('post.ForceEnd');
        $op=I('post.op');

        $User = D('Room');

        if($op=='add'){
            //对于新增考场，先判断试卷的类型是手工选择还是自动组卷
            if(I('post.paper')>0){//如果传过来的paper不为空，则不管后面的选择，按照手工选择了试卷来对待
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

                    $User->paperAuto=0;//因为是手工组卷，所以不管paperAuto传过来的是什么，都写入0

                    $result = $User->add(); // 写入数据到数据库
                    echo $result;
                    //echo I('post.userRange').$User->getLastSql();
                } else {
                    echo $User->getError();
                }
            }else{//如果为自动组卷，则判断自动组卷的各项条件
                if(!I('post.paperAuto')){
                    echo '未选择试卷！如需自动组卷，请设置相关参数！';
                }else{
                    $gta=intval(I('gradeTotalAuto'));

                    $qt1=intval(I('post.questionType1'));
                    $qt2=intval(I('post.questionType2'));
                    $qt3=intval(I('post.questionType3'));
                    $qt4=intval(I('post.questionType4'));

                    $gradeTotal=intval(I('post.gradeTotalAuto'));

                    $qhm=$qt1+$qt2+$qt3+$qt4;


                    if($qhm<=1 or $gradeTotal<1){
                        echo '自动组卷参数有误，请检查更正后再试!';
                    }else{
                        //开始计算自动组卷所需的参数
//                        $questionHowManyType1=ceil($qt1/$qrate*$qhm);
//                        $questionHowManyType2=ceil($qt2/$qrate*$qhm);
//                        $questionHowManyType3=ceil($qt3/$qrate*$qhm);
//                        $questionHowManyType4=ceil($qt4/$qrate*$qhm);



                        //先按照自动组卷条件，通过两次随机处理筛选出足够数目不同类型的题目
                        $question=M('question');
                        $map['inUse']=array('EQ',1);//开始准备选题条件
                        $map['status']=array('EQ',1);
                        $map['_string']='ownerId='.session('userid').' or questionShare=1';

                        $questionSelected1=[];
                        $questionSelected2=[];
                        $questionSelected3=[];
                        $questionSelected4=[];

                        if($qt1>0){
                            $map['questionType']=1;
                            $questionResultType1=$question->field('id')->where($map)->select();
                            if(count($questionResultType1)>=$qt1){
                                $num=$qt1;
                            }else{
                                $num=count($questionResultType1);
                            }
                            $questionSelected1=shuffle_assoc($questionResultType1,$num);

                        }
                        if($qt2>0){
                            $map['questionType']=2;
                            $questionResultType2=$question->field('id')->where($map)->select();
                            if(count($questionResultType2)>=$qt2){
                                $num=$qt2;
                            }else{
                                $num=count($questionResultType2);
                            }
                            $questionSelected2=shuffle_assoc($questionResultType2,$num);
                        }
                        if($qt3>0){
                            $map['questionType']=3;
                            $questionResultType3=$question->field('id')->where($map)->select();
                            if(count($questionResultType3)>=$qt3){
                                $num=$qt3;
                            }else{
                                $num=count($questionResultType3);
                            }
                            $questionSelected3=shuffle_assoc($questionResultType3,$num);
                        }
                        if($qt4>0){
                            $map['questionType']=4;
                            $questionResultType4=$question->field('id')->where($map)->select();
                            if(count($questionResultType4)>=$qt4){
                                $num=$qt4;
                            }else{
                                $num=count($questionResultType4);
                            }
                            $questionSelected4=shuffle_assoc($questionResultType4,$num);
                        }

                        $questionSelected=array_merge($questionSelected1,$questionSelected2,$questionSelected3,$questionSelected4);

                        if(!$questionSelected){
                            echo '试题数量不足，请手工组卷或者修改参数！';
                        }else{
                            $paperData['paperName']='A-'.I('post.roomName').'-'.session('uname').'-'.date('Y-m-d H:i:s');
                            $paperData['paperRule1']=1;
                            $paperData['paperRule2']=1;
                            $paperData['paperRule3']=0;
                            $paperData['gradeTotal']=$gradeTotal;
                            $paperData['paperShare']=0;
                            $paperData['status']=1;
                            $paperData['memo']='本试卷为系统自动组卷，组卷人：'.session('uname').',组卷试卷：'.date('Y-m-d H:m:s');
                            $paperData['ownerId']=session('userid');
                            $paperData['inUse']=1;
                            $paperData['isAuto']=1;
                            $paperData['createTime']=date('Y-m-d H:m:s');
                            $paperData['questionHowMany']=$qhm;

                            $paper=M('paper');
                            $paperResult=$paper->data($paperData)->add();//先插入试卷数据，以获得paperId

                            if(!$paperResult){
                                echo '组卷时发生错误，请联系管理员！！';
                            }else{
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

                                    $User->paperAuto=1;//因为是手工组卷，所以不管paperAuto传过来的是什么，都写入0
                                    $User->paper=$paperResult;
                                    $User->questionHowMany=$qhm;

                                    $roomResult = $User->add(); // 写入数据到数据库

                                    if(!$roomResult){
                                        echo '创建考场时发生错误,请联系管理员！！';
                                    }else{
                                        $questonGradeSetted=round(($gradeTotal/count($questionSelected)),2);//计算每题的分数

                                        foreach($questionSelected as $k){
                                            $questionFinalInsertData[]=array('questionId'=>$k['id'],'paperId'=>$paperResult,'gradeSetted'=>$questonGradeSetted);
                                        }

                                        $questionTable=M('questionselected');
                                        $questionResult=$questionTable->addAll($questionFinalInsertData);

                                        if(!$questionResult){
                                            echo '处理试题过程中发生错误，请联系管理员！！';
                                        }else{
                                            echo 1;
                                        }
                                    }

                                } else {
                                    echo $User->getError();
                                }
                            }
                        }
                    }
                }
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

            if(I('post.startTime')){
                $startTime=I('post.startTime');
            }else{
                $startTime=null;
            }
            if(I('post.endTime')){
                $endTime=I('post.endTime');
            }else{
                $endTime=null;
            }
            if(I('post.paperAuto')){
                $pau=1;
            }else{
                $pau=0;
            }

            $data = array('roomName'=>I('post.roomName'),'paper'=>I('post.paper'),'startTime'=>$startTime,
                'endTime'=>$endTime,'timeLimit'=>I('post.timeLimit'),'userRange'=>I('post.userRange'),
                'memo'=>I('post.memo'),'forceEnd'=>$forceEnd,'status'=>$status,'passScore'=>I('passScore'),
                'paperAuto'=>$pau,'questionHowMany'=>I('post.questionHowMany'),
                'questionType1'=>I('post.questionType1'),'questionType2'=>I('post.questionType2'),
                'questionType3'=>I('post.questionType3'),'questionType4'=>I('post.questionType4')
                );

            $wherestr='id='.I('post.id');

            if($User->create()){

                $result =$User->where($wherestr)->setField($data);

                //echo $User->getLastSql();
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
            $User=M(Room);
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