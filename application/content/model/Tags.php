<?php
namespace app\content\model;

use think\Model;

class Tags extends Base
{
	public function tagsGroups(){
		return $this->belongsToMany('TagsGroup','TagsGroupRelation');
	}
	public function articles(){
		return $this->belongsToMany('Article','ContentRelation','content_id','id');
	}
	public function setDirAttr($value){
		return strtolower($value);
	}
	public function getStatusAttr($value){
		$status = ['0' => '待审','1' => '正常','-1' => '删除',];
		return $status[$value];
	}
	public function add($data){
		$data['status'] = 1;
		$data['listorder'] = 0;
		return $this->allowField(true)->save($data);
	}

	public function put($data){
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