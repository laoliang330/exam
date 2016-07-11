<?php
namespace Home\Controller;
use Think\Controller;
class TestController extends Controller {
    public function index(){
        $this->assign("fmurl",U('Room/userRange'));
        $this->display();
    }

    public function addnodeconfirm(){
//        $User = D("Test");
//        if($User->create()){
//            $result = $User->add(); // 写入数据到数据库
//            echo $result;
//        }else{
//            echo $this->error($User->getError());;
//        }

        echo I('get.userRange1');
    }

    public function userRange(){
        $userRange=M(Org);
        $data=$userRange->field('id,orgName as name,parentId as parentId')->select();
        //$data='{"total":7,"rows":'.json_encode($data).'}';
        $data=json_encode($data);
        //dump(json_encode($data));
        echo $data;

    }
    public function bootstrap(){
        $this->display();
    }
}