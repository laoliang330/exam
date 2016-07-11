<?php
namespace Admin\Controller;
use Think\Controller;
class UsersController extends Controller {
    public function index(){
        $User = D("UsersView");
        $User->create();
        $Org = D("Admin/Org");
        $Org->create();
        $map['inUse']=1;
        $userdata=$User->field('id,username as name,parentid as _parentId,isuser,roleid,roletitle')->where($map)->select();
        $orgdata = $Org->field('id,orgname as name,parentid as _parentId,isuser')->select();

        for($i=0;$i<count($orgdata);$i++){
            $orgdata[$i]["id"]=intval($orgdata[$i]["id"]);
            if ($orgdata[$i]["_parentid"]!=null){
                $orgdata[$i]["_parentid"]=intval($orgdata[$i]["_parentid"]);
            }
        }
        for($i=0;$i<count($userdata);$i++){

            if ($userdata[$i]["_parentid"]!=null){
                $userdata[$i]["_parentid"]=intval($userdata[$i]["_parentid"]);
                $userdata[$i]["id"]=intval($userdata[$i]["id"]);
                $userdata[$i]["iconCls"]="icon-man";
            }
        }

        $data=array_merge($orgdata,$userdata);

        $data='{"total":7,"rows":'.json_encode($data).'}';
        $data=str_replace('parentid','parentId',$data);
        //print($data);
        $this->assign('fmurl',U('Users/addUserConfirm'));
        $this->assign("data",$data);
        $role = M("Role");
        $roledata=$role->select();
        $roledata=json_encode($roledata);
        $this->assign("roledata",$roledata);
        $this->display();
    }

    public function addUserConfirm(){
        $isuser=I('post.isuser');
        $userRole=I('post.userrole');
        $op=I('post.op');

        if($isuser) {
            $tablename="Users";
        }else{
            $tablename = 'Admin/Org';
        }

        if ($op == 'add') {
            $User = D($tablename);
            if($User->create()) {
                if (!$userRole) {
                    $User->userRole = 3;
                }
                    $result = $User->add(); // 写入数据到数据库
                    echo $result;


                } else {
                    echo $User->getError();
                }
        }

        if($op=='edit'){

            if($tablename=="Users"){
                //$tablename="Users";
                $data = array('userName'=>I('post.nodename'),'userRole'=>I('post.userrole'));
            }else{
                //$tablename='Org';
                $data = array('orgName'=>I('post.nodename'));
            }
            $wherestr='id='.I('post.id');
            $User = D($tablename);
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

    public function removeNodeConfirm(){
        $isuser=I('get.isuser');
        $nodeid=I('get.nodeid');
        echo '$isuser:'.$isuser;
        if($isuser) {
            $tablename="Users";

        }else{
            $tablename = 'Org';
        }
        if($tablename){
            $wherestr='id='.$nodeid;
            $User=M($tablename);
            if($tablename=='Users'){
                $result=$User->where($wherestr)->setField('inUse',0);
            }else{
                $result=$User->where($wherestr)->delete();
            }

        }
        echo $result;
    }


    /*{"total":7,"rows":[
        {"id":1,"name":"All Tasks","begin":"3/4/2010","end":"3/20/2010","size":60,"iconCls":"icon-ok"},
        {"id":2,"name":"Designing","begin":"3/4/2010","end":"3/10/2010","size":100,"_parentId":1,"state":"closed"},
        {"id":21,"name":"Database","persons":2,"begin":"3/4/2010","end":"3/6/2010","size":100,"_parentId":2},
        {"id":22,"name":"UML","persons":1,"begin":"3/7/2010","end":"3/8/2010","progress":100,"_parentId":2},
        {"id":23,"name":"Export Document","persons":1,"begin":"3/9/2010","end":"3/10/2010","progress":100,"_parentId":2},
        {"id":3,"name":"Coding","persons":2,"begin":"3/11/2010","end":"3/18/2010","progress":80},
        {"id":4,"name":"Testing","persons":1,"begin":"3/19/2010","end":"3/20/2010","progress":20},
        {"id":25,"name":"1","persons":1,"begin":"3/9/2010","end":"3/10/2010","progress":100,"_parentId":2},
        {"id":26,"name":"2","persons":1,"begin":"3/9/2010","end":"3/10/2010","progress":100,"_parentId":2}

    ]}
        {"total":7,"rows":[
        {"id":1,"name":"\u6839\u8282\u70b9","_parentId":1},
        {"id":2,"name":"\u5b50\u8282\u70b91","_parentId":1},
        {"id":3,"name":"\u5b50\u8282\u70b92","_parentId":1},
        {"id":4,"name":"\u5b50\u8282\u70b91-\u5b50\u8282\u70b91","_parentId":2}]}
    ]}


    */
}
