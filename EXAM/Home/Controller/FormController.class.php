<?php
namespace Home\Controller;
use Think\Controller;
class FormController extends Controller{

    public function _empty($cityName){
        $this->city($cityName);
    }
    protected function city($cityName){
        echo $cityName;
    }

    public function add(){
        $this->display();
    }

    public function insert(){
        $Form   =   D('Form');
        if($Form->create()) {
            $result =   $Form->add();
            if($result) {
                $this->success('数据添加成功！');
            }else{
                $this->error('数据添加错误！');
            }
        }else{
            $this->error($Form->getError());
        }
    }

    public function read($id=10){
        $Form   =   M('test');
        // 读取数据
        $data =   $Form->find($id);
        if($data) {
            $this->assign('data',$data);// 模板变量赋值
        }else{
            $this->error('数据错误');
        }
        $list = $Form->select();
        $this->assign('list',$list);
        $this->display();
    }

    public function edit($id=0){
        $Form   =   M('test');
        $this->assign('vo',$Form->find($id));
        $this->display();
    }
    public function update(){
        $Form   =   D('Form');
        if($Form->create()) {
            $result =   $Form->save();
            if($result) {
                $this->success('操作成功！');
            }else{
                $this->error('写入错误！');
            }
        }else{
            $this->error($Form->getError());
        }
    }

    public function deldata($id=0){
        $Form   =   M('test');
        $result=$Form->delete($id);
        if($result){
            $this->success("删除操作成功");
        }else{
            $this->error("删除操作失败");
        }
        //$this->display();
    }
}