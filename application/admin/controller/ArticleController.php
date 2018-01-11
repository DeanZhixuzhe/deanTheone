<?php
namespace app\admin\controller;

class ArticleController extends BaseController
{
	public function index(){
		$pid = $this->request->param('pid',0,'intval');
		$list = $this->article->with('categorys')->select();
		return $this->fetch('',['list' => $this->list]);
	}

	public function add(){
		$categoryAll = $this->infinite($this->category->all(),'category','',1);
		$categorys = $categoryAll;

		$areaList = $this->category->with('areaGroups.areas')->find(1)->toArray();
		$tagsList = $this->category->with('tagsGroups.tagss')->find(1)->toArray();

		return $this->fetch('',['categorys' => $categorys,'areaList' => $areaList['area_groups'],'tagsList' => $tagsList['tags_groups']]);
	}

	public function edit($id=0){
		if (intval($id) < 1) {
			return $this->error();
		}
		$me = $this->article->with('tagss')->find($id);
		$categoryAll = $this->infinite($this->category->all(),'category','',1);
		$categorys = $categoryAll;

		$areaGroupId = $this->column->distinct(true)->field('area_group_id')->where('category_id',1)->select();
		$tagsGroupId = $this->column->distinct(true)->field('tags_group_id')->where('category_id',1)->select();
		foreach ($areaGroupId as $value) {
			if ($value->area_group_id != 0) {
				$areaList[] = $this->areaGroup->with('areas')->find($value->area_group_id);
			}
		}
		foreach ($tagsGroupId as $value) {
			if ($value->tags_group_id != 0) {
				$tagsList[] = $this->tagsGroup->with('tagss')->find($value->tags_group_id);
			}
		}

		return $this->fetch('',['categorys' => $categorys,'me' => $me,'areaList' => $areaList,'tagsList' => $tagsList]);
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

		if (!empty($data['tags_id'])) {
			for($i=0;$i<count($data['tags_id']);$i++){
				$tags_id[$i]['tags_id'] = $data['tags_id'][$i];
			}
		}else{
			$tags_id = '';
		}

		if (!empty($data['id'])) {
			$result = $this->article->put($data,$tags_id);
			if ($result) {
				return $this->success('更新成功');
			}else{
				return $this->error('更新失败');
			}
		}

		//把$data提交Model层
		$result = $this->article->add($data,$tags_id);
		if ($result) {
			return $this->success('添加成功');
		}else{
			return $this->error('添加失败');
		}
	}
	public function update(){
		if (!$this->request->isPost()) {
			$this->error('请求失败');
		}
		$data = $this->request->param();

		if (!$this->verify->check($data)) {
			$this->error($this->verify->getError());
		}
		$source = $this->contentRelation->all(['content_id' => $data['id']]);
		
		if (!empty($data['tags_id']) && empty($source)) {
			for($i=0;$i<count($data['tags_id']);$i++){
				$tags_id[$i]['content_id'] = $data['id'];
				$tags_id[$i]['tags_id'] = $data['tags_id'][$i];
			}
		}elseif (empty($data['tags_id']) && !empty($source)) {
			
		}elseif (!empty($data['tags_id']) && !empty($source)) {
			for($i=0;$i<count($data['tags_id']);$i++){
				$tags_id[$i]['content_id'] = $data['id'];
				$tags_id[$i]['tags_id'] = $data['tags_id'][$i];
			}
			$result = array_diff();
		}else{
			$tags_id = '';
		}
		dump($source);exit;

		if (!empty($data['id'])) {
			$result = $this->article->put($data,$tags_id);
			if ($result) {
				return $this->success('更新成功');
			}else{
				return $this->error('更新失败');
			}
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
		$result = $this->article->save(['status'=>$data['status']],['id'=>$data['id']]);
		if ($result) {
			return $this->result($_SERVER['HTTP_REFERER'],1,'成功');
		}else{
			$this->result($_SERVER['HTTP_REFERER'],0,'失败');
		}
	}
}