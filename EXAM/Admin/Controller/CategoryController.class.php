<?php
namespace Admin\Controller;
use Think\Controller;
class CategoryController extends Controller
{
    public function index()
    {
        $this->assign('url',U('Category/clist'));
        $this->display();
    }

    public function clist(){
        $Room = D("Category");
        $Room->create();
        $cdata = $Room->field('id,orgname as name,parentid as _parentId,isuser')->select();
        echo json_encode($cdata);
        for($i=0;$i<count($cdata);$i++){
            $cdata[$i]["id"]=intval($cdata[$i]["id"]);
            if ($orgdata[$i]["_parentid"]!=null){
                $orgdata[$i]["_parentid"]=intval($orgdata[$i]["_parentid"]);
            }
        }
        $data='{"total":7,"rows":'.json_encode($cdata).'}';
        echo $data;

    }
}