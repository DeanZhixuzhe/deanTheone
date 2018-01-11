<?php
namespace app\content\model;

use think\Model;

class Column extends Base
{
	public function categorys(){
		return $this->belongsTo('Category');
	}
	public function areaGroups(){
		return $this->belongsTo('AreaGroup');
	}
	public function tagsGroups(){
		return $this->belongsTo('TagsGroup');
	}
	public function getStatusAttr($value){
		$status = ['0' => '待审','1' => '正常','-1' => '删除',];
		return $status[$value];
	}
	public function add($data){
		return $this->allowField(true)->save($data);
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