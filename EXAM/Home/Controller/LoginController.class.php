<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
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
            $this->redirect("Home/Login/login");
        }
//        if(!$this->_verifyCheck($verify_code)){
//            $this->error("验证码错误！！！");
//        }
        $user=M('users')->where(array('userName'=>$username))->find();
        if(!$user||md5($password)!=$user['userpass']){
            $this->error("用户名或密码错误！！！");
        }
        if(!$user['status']){   //status为0时表示锁定
            $this->error("用户被锁定！！！");
        }else{
//            $data['login_ip'] =  get_client_ip();
//            $data['last_login_time']=time();
//            if(M("user")->where(array('id'=>$user['id']))->save($data)){
//                M("user")->where(array('id'=>$user['id']))->setInc("login_num");
//            }
            session(C('USER_AUTH_KEY'),$user['id']);
            session('userid',$user['id']);
            session('uname',$user['username']);
            session('parentid',$user['parentid']);
            $this->success("登录成功...",U("Index/index"));
        }
    }

    public function logout(){
        if($_SESSION[C('USER_AUTH_KEY')]) {
            session(null);
            $this->redirect("/Home/Login/login");
        }else {
            $this->redirect("/Home/Login/login");
            //$this->error('已经登出！');
        }
    }
}