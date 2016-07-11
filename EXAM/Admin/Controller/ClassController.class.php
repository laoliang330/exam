<?php
namespace Admin\Controller;
use Think\Controller;
class ClassController extends Controller {
    public function index(){
        $this->display();
    }

    public function classList(){
        $Room = D("ClassView");
        $map['class.inUse']=1;
        $map['class.ownerId']=session('userid');
        $Room->create();
        $roomDate=$Room->where($map)->order('class.id desc')->select();
        echo json_encode($roomDate);
    }

    public function uploadAttach(){
        $classId=I('post.classAttachToId');
        $config = array(
            'maxSize'    =>    52428800,
            'rootPath'   =>    './upload/',
            'savePath'   =>    '',
            'saveName'   =>    array('uniqid',''),
            'exts'       =>    array('jpg', 'gif', 'png', 'jpeg','zip','rar','doc','docx','ppt','pptx','pdf','mp3'),
            'autoSub'    =>    true,
            'subName'    =>    array('date','Ymd'),
        );
        $upload = new \Think\Upload($config);// 实例化上传类

        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            //$this->error($upload->getError());
            echo $upload->getError();
        }else{// 上传成功 获取上传文件信息
            foreach($info as $file){
                $dataList[] = array('classId'=>$classId,'originalFileName'=>$file['name'],'savedFileName'=>$file['savename'],
                                    'savedPath'=>$file['savepath'],'fileSize'=>round($file['size']/1000000,2),'ownerId'=>session('userid'),
                                    'createTime'=>date('y-m-d h:i:s',time()),
                );
                //$file['savepath'].$file['savename']

            }
            if($dataList){
                $File=M('attach');
                //dump($dataList);
                $File->addAll($dataList);
                echo $classId;

            }else{
                echo '文件保存失败！';
            }
        }
    }


    public function attachList(){
        $File=M('attach');
        if(I('post.classId')){
            $map['classId']=I('post.classId');
            $map['ownerId']=session('userid');
            $map['inUse']=1;
            $result=$File->where($map)->select();
            echo json_encode($result);
        }
    }


    public function save(){

        $op=I('post.opc');

        $User = D('Class');

        if($op=='add'){
            if($User->create()) {

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

            if(I('post.status')){
                $status=1;
            }else{
                $status=0;
            }

            $data = array('className'=>I('post.className'),'userRange'=>I('post.userRange'),
                'memo'=>I('post.memo'),'status'=>$status);

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
        if(I('post.id')){
            $wherestr='id='.I('post.id');
            $User=M('Class');
            $result=$User->where($wherestr)->where('ratedScore=0')->setField('inUse',0);
            if($result){
                echo $result;
            }else{
                echo '删除失败！不能删除已评分的课堂！';
            }
        }else{
            echo 0;
        }

    }

    public function destroyAttach(){
        dump(I('post.attachId'));
        $del=M('attach');
        $delArr=I('post.attachId');

        $map['id'] = array('IN',$delArr);
        $result=$del->where($map)->setField('inUse',0);

        echo $result;

    }

}