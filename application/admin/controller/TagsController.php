<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class TagsController extends BaseController
{
    public function index(){
        $pid = $this->request->param('pid',0,'intval');
        return $this->fetch('',['list' => $this->list]);
    }

    public function add(){
        $list = $this->category->getNormalFirstCategory();
        $this->assign('list',$list);
        return $this->fetch('');
    }

    public function edit($id=0){
        if (intval($id) < 1) {
            return $this->error();
        }

        $me = $this->tags->get($id);
        // $categorys = $this->category->getNormalFirstCategory();
        // $this->assign('categorys',$categorys);
        return $this->fetch('',['me'=>$me]);
    }

    //保存
    public function save(){
        if (!$this->request->isPost()) {
            $this->error('请求失败');
        }
        $data = $this->request->param();
        if (!$this->verify->check($data)) {
            $this->error($this->verify->getError());
        }
        if (!empty($data['id'])) {
            return $this->update($data);
        }
        //把$data提交Model层
        $result = $this->tags->add($data);
        if ($result) {
            $this->success('添加成功');
        }else{
            $this->error('添加失败');
        }
    }
    public function update($data){
        $res = $this->tags->put($data);
        if ($res) {
            $this->success('更新成功');
        }else{
            $this->error('更新失败');
        }
    }

    

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
