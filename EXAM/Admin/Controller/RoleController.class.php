<?php
namespace Admin\Controller;
use Think\Controller;
class RoleController extends Controller {
    public function index(){
        $User = M("Role");
        $data=$User->select();
        echo json_encode($data);

    }

}