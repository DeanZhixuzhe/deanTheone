<?php
namespace app\admin\controller;


class CategoryController extends BaseController
{
	public function index(){
		$pid = $this->request->param('pid',0,'intval');
		$list = $this->category->all();
		return $this->fetch('',['list' => $list]);
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

		$category = $this->category->get($id);
		$categorys = $this->category->getNormalFirstCategory();
		$this->assign('categorys',$categorys);
		return $this->fetch('',['category'=>$category]);
	}

	//保存
	public function save(){
		if (!$this->request->isPost()) {
			$this->error('请求失败');
		}
		$data = $this->request->param();
		$validate = $this->loader->validate('Category');
		if (!$validate->check($data)) {
			$this->error($validate->getError());
		}
		if (!empty($data['id'])) {
			return $this->update($data);
		}
		//把$data提交Model层
		$result = $this->category->add($data);
		if ($result) {
			$this->success('添加成功');
		}else{
			$this->error('添加失败');
		}
	}
	public function update($data){
		$res = $this->category->allowField(true)->save($data,['id'=>intval($data['id'])]);
		if ($res) {
			$this->success('更新成功');
		}else{
			$this->error('更新失败');
		}
	}
	//排序
	public function listorder(){
		$result = $this->category->save(['listorder'=>$this->request->param('listorder')],['id'=>$request->param('id')]);
		if ($result) {
			$this->result($_SERVER['HTTP_REFERER'],1,'成功');
		}else{
			$this->result($_SERVER['HTTP_REFERER'],0,'失败');
		}
	}

	//修改状态
	public function status(){
		$data = $this->request->param();
		// $validate = validate('Category');
		// if (!$validate->scene('status')->check($data)) {
		// 	$this->error($validate->getError());
		// }
		$result = $this->category->save(['status'=>$data['status']],['id'=>$data['id']]);
		if ($result) {
			return $this->result($_SERVER['HTTP_REFERER'],1,'成功');
		}else{
			$this->result($_SERVER['HTTP_REFERER'],0,'失败');
		}
	}
}