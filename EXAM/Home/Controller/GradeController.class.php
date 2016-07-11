<?php
namespace Home\Controller;
//use Think\Controller;
use Home\Controller\CommonController;
class GradeController extends CommonController {

    public function index(){

        function datalist($roomId,$paperId,$questionArr,$answerArr,$gradeResultId){
            $questionIdArray=$questionArr;
            $submitAnswerArr=$answerArr;

            foreach($questionIdArray as $x=>$x_value) {
                $dataList[]= Array('questionId'=>$x_value,'submitAnswer'=>$submitAnswerArr[$x],
                    'ownerId'=>session('userid'),'roomId'=>$roomId,
                    'paperId'=>$paperId,'gradeFinal'=>0.00,'gradeResultId'=>$gradeResultId
                );
            }
            return $dataList;
        }

        if(I('post.roomId') and I('post.paperId') and I('post.questionId')){

            $roomId=I('post.roomId');
            $paperId=I('post.paperId');

            $DataPaper=M('paper');
            $resultPaper=$DataPaper->where('id=%d',array($paperId,))->find();

            $DataRoom=M('Room');
            $resultRoom=$DataRoom->where('id=%d',array($roomId,))->find();

            if(!($resultRoom and $resultPaper)){
                echo '-1';
                exit;
            }

            if($resultPaper['paperrule1']){
                echo datalist($roomId,$paperId,I('post.questionId'),I('post.answer'),1);
            }else{

                $DataGradeResultArr['roomId']=$roomId;
                $DataGradeResultArr['paperId']=$paperId;
                $DataGradeResultArr['ownerId']=session('userid');
                $DataGradeResultArr['createTime']=date("Y-m-d H:i:s");
                $DataGradeResultArr['startTime']=session('startTime');
                $DataGradeResultArr['scoredTeacherId']=$resultRoom['ownerid'];
                $DataGradeResultArr['paperRule1']=$resultPaper['paperrule1'];
                $DataGradeResultArr['paperRule2']=$resultPaper['paperrule2'];
                $DataGradeResultArr['paperRule3']=$resultPaper['paperrule3'];
                $DataGradeResultArr['gradeSetted']=0;

                $DataGradeResult=M('graderesult');
                $resultGradeResult=$DataGradeResult->add($DataGradeResultArr);

                $dataList=datalist($roomId,$paperId,I('post.questionId'),I('post.answer'),$resultGradeResult);

                $DataGrade = M('grade');
                $resultGrade=$DataGrade->addAll($dataList);

                $sql='UPDATE exam_grade INNER JOIN exam_questionselected SET exam_grade.gradeSetted = exam_questionselected.gradeSetted '.
                      ' WHERE  exam_grade.questionId = exam_questionselected.id'.
                      ' AND exam_grade.gradeResultId = '.$resultGradeResult .
                      ' AND exam_questionselected.paperId='.$paperId.
                      ' AND exam_grade.ownerId='.session('userid').
                      ' AND exam_grade.paperId='.$paperId;


                $gradeSetted=M();

                $res = $gradeSetted->execute($sql);

                session('startTime',null);

                if($resultGrade and $resultGradeResult and $res){
                    echo '1';
                }else{
                    echo '0';
                }
            }
        }else{
            echo 0;
        }


    }


}