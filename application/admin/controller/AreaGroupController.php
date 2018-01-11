<?php
namespace app\admin\controller;


class AreaGroupController extends BaseController
{
	public function index(){
		return $this->fetch('',['list' => $this->list]);
	}
	public function content(){
		$id = $this->request->param('id',0,'intval');
		$me = $this->areaGroup->with('areas')->find($id);
		$contentList = $me['areas'];
		
		return $this->fetch('',['me' => $me,'contentList' => $contentList]);
	}
	public function add(){
		$areaList = $this->infinite($this->area->all(),'area','',1);
		return $this->fetch('',['areaList' => $areaList]);
	}

	public function edit($id=0){
		if (intval($id) < 1) {
			return $this->error();
		}
		$tagsList = $this->tags->all();	//获取标签内容
		$areaList = $this->infinite($this->area->all(),'area','',1);	//获取地区内容
		$categorys = $this->category->all(['status' => 1]);	//获取分类内容
		$type = $this->columnGroup->get($id);	//获取当前编辑的内容
		switch ($type['type']) {	//根据type获取对应的分组内容
			case 'area':
				$me = $this->columnGroup->with('areas')->find($id);
				$contentList = $me['areas'];
				break;
			
			case 'tags':
				$me = $this->columnGroup->with('tagss')->find($id);
				$contentList = $me['tagss'];
				break;
		}
		foreach ($areaList as $v1) {	//处理地区数据，判断追加已经选中的地区
			foreach ($contentList as $v2) {
				isset($v1['checkbox'])&&$v1['checkbox']==1 ? $v1['cbox']=1 : $v1['checkbox'] = $v1['id'] == $v2['id'] ? 1:0;
			}
		}
		foreach ($tagsList as $v1) {	//处理标签数据，判断追加已经选中的标签
			foreach ($contentList as $v2) {
				isset($v1['checkbox'])&&$v1['checkbox']==1 ? $v1['cbox']=1 : $v1['checkbox'] = $v1['id'] == $v2['id'] ? 1:0;
			}
		}
		if (strpos($type['category_id'],',') !== false) {
			$category_ids = explode(',',$type['category_id']);
		}else{
			$category_ids[0] = $type['category_id'];
		}
		foreach ($categorys as $v1) {	//处理标签数据，判断追加已经选中的标签
			foreach ($category_ids as $v2) {
				isset($v1['checkbox'])&&$v1['checkbox']==1 ? $v1['cbox']=1 : $v1['checkbox'] = $v1['id'] == $v2 ? 1:0;
			}
		}
		
		if($this->request->isPost()){
			
		}
		return $this->fetch('',['me' => $me,'areaList' => $areaList,'tagsList' => $tagsList,'categorys' => $categorys]);
	}

	//保存
	public function save(){
		if (!$this->request->isPost()) {
			$this->error('请求失败');
		}
		$data = $this->request->param();
		// dump($data);exit;
		if (empty($data['area'])) {
			$this->error('错误');
		}else{
			foreach ($data['area'] as $value) {
				$areas[]['area_id'] = $value; 
			}
			$data['area'] = $areas;
		}
		// dump($data['area']);exit;
		if (!$this->verify->check($data)) {
			$this->error($this->verify->getError());
		}
		if (!empty($data['id'])) {
			return $this->update($data,$data['area']);
		}
		//把$data提交Model层
		$result = $this->areaGroup->add($data,$data['area']);
		if ($result) {
			$this->success('添加成功',null,'',120);
		}else{
			$this->error('添加失败',null,'',120);
		}
	}
	public function update($data,$relation){

		$res = $this->areaGroup->put($data,$relation);
		if ($res) {
			$this->success('更新成功');
		}else{
			$this->error('更新失败',null,'',120);
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
		if (!$this->verify->scene('status')->check($data)) {
			$this->error($this->verify->getError());
		}
		// $validate = validate('Category');
		// if (!$validate->scene('status')->check($data)) {
		// 	$this->error($validate->getError());
		// }

		$result = $this->columnGroup->save(['status'=>$data['status']],['id'=>$data['id']]);
		if ($result) {
			return $this->result($_SERVER['HTTP_REFERER'],1,'成功');
		}else{
			$this->result($_SERVER['HTTP_REFERER'],0,'失败');
		}
	}

	public function area(){
		return "area";
	}
	public function tags(){
		$list = $this->tags->all();
		return $this->fetch('',['list' => $list]);
	}
}