<?php
namespace Admin\Controller;
use Think\Controller;
class AdminloginController extends Controller {
    public function index(){
        $this->display();
    }

    public function login(){
        $this->display();
    }

    public function checkLogin(){
        $username=I('post.username','');
        $password=I('post.password','');
        //$verify_code=I('verify','');
        if($username==''||$password==''){
            $this->redirect("Admin/adminlogin/login");
        }
//        if(!$this->_verifyCheck($verify_code)){
//            $this->error("验证码错误！！！");
//        }
        $user=M('users')->where(array('userName'=>$username))->find();
        if(!$user||md5($password)!=$user['userpass']){
            $this->error("用户名或密码错误！！！");
        }

        if($user['userrole']>2){
            $this->error("权限不足！！！");
        }

        if(!$user['status']){   //status为0时表示锁定
            $this->error("用户被锁定！！！");
        }else{
//            $data['login_ip'] =  get_client_ip();
//            $data['last_login_time']=time();
//            if(M("user")->where(array('id'=>$user['id']))->save($data)){
//                M("user")->where(array('id'=>$user['id']))->setInc("login_num");
//            }
            session(C('ADMIN_AUTH_KEY'),$user['id']);
            session('userid',$user['id']);
            session(C('ADMIN_AUTH_LEVEL'),$user['userrole']);
            session('uname',$user['username']);
            $this->success("登录成功...",U("Index/index"));
        }
    }

    public function logout(){
        if($_SESSION[C('ADMIN_AUTH_KEY')]) {
            session(null);
            $this->redirect("/Admin/adminlogin/login");
        }else {
            $this->redirect("/Admin/adminlogin/login");
            //$this->error('已经登出！');
        }
    }
}