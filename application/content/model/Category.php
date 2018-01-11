<?php
namespace app\content\model;

use think\Model;

class Category extends Base
{
	public function areaGroups(){
		return $this->belongsToMany('areaGroup','Column');
	}
	public function tagsGroups(){
		return $this->belongsToMany('tagsGroup','Column');
	}
	public function articles(){
		return $this->hasMany('Article');
	}
	public function columns(){
		return $this->hasMany('Column');
	}
	public function setDirAttr($value){
		return strtolower($value);
	}
	public function getStatusAttr($value){
		$status = ['0' => '待审','1' => '正常','-1' => '删除',];
		return $status[$value];
	}
	public function add($data){
		if ($data['parent_id'] == 0) {
			$data['path'] = 0;
		}else{
			$category = $this->get(['id' => $data['parent_id']]);
			$data['path'] = $category->path.'-'.$category->id;
		}
		$data['status'] = 1;
		$data['listorder'] = 0;
		return $this->allowField(true)->save($data);
	}

	public function put($data){
		if ($data['parent_id'] == 0) {
			$data['path'] = 0;
		}else{
			$category = $this->get(['id' => $data['parent_id']]);
			$data['path'] = $category->path.'-'.$category->id;
		}
		return $this->allowField(true)->save($data,['id'=>$data['id']]);
	}
	
	public function getNormalFirstCategory($pid = 0){
		$data = [
			'status' => 1,
			'parent_id' => $pid,
		];
		$oredr = [
			'listorder' => 'asc',
			'id' => 'desc',
		];
		return $this->where($data)
			->order($oredr)
			->select();
	}

	public function getFirstCategory($pid=0){
		$data = [
			'status' => ['neq',-1],
			'parent_id' => $pid,
		];
		$oredr = [
			'listorder' => 'asc',
			'id' => 'desc',
		];
		$result = $this->where($data)
			->order($oredr)
			->paginate();
		// echo $this->getLastSql();
		return $result;
	}
}