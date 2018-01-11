<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class AreaController extends BaseController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(){
        $alist = $this->infinite($this->allList,'area','',1);
        
        $pid = $this->request->param('pid',0,'intval');
        $list = $this->area->order(['path','id'],'asc')->paginate();
        return $this->fetch('',['list' => $alist]);
    }

    public function add(){
        // $list = $this->area->all();
        $list = $this->infinite($this->allList,'area','',1);
        $this->assign('list',$list);
        return $this->fetch('');
    }

    public function edit($id=0){
        if (intval($id) < 1) {
            return $this->error();
        }

        $area = $this->area->get($id);
        $areas = $this->area->all();
        $this->assign('areas',$areas);
        return $this->fetch('',['area'=>$area]);
    }

    //保存
    public function save(){
        if (!$this->request->isPost()) {
            $this->error('请求失败');
        }
        $data = $this->request->param();
        $validate = $this->loader->validate('Area');
        if (!$validate->check($data)) {
            $this->error($validate->getError());
        }
        if (!empty($data['id'])) {
            return $this->update($data);
        }
        //把$data提交Model层
        $result = $this->area->add($data);
        if ($result) {
            $this->success('添加成功');
        }else{
            $this->error('添加失败');
        }
    }
    public function update($data){
        $res = $this->area->put($data);
        if ($res) {
            $this->success('更新成功');
        }else{
            $this->error('更新失败');
        }
    }


    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */


    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */


    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */


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
