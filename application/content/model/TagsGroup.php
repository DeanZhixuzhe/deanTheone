<?php
namespace app\content\model;

use think\Model;

class TagsGroup extends Base
{
	protected $type = [
		'relation_id' => 'integer',
		'showdown' => 'integer',
	];
	
	public function tagss(){
		return $this->belongsToMany('Tags','TagsGroupRelation');
	}
	public function categorys(){
		return $this->belongsToMany('Category','Column','category_id','tags_group_id');
	}
	public function tagsGroupRelations(){
		return $this->hasMany('TagsGroupRelation');
	}
	public function getStatusAttr($value){
		$status = [0 => '待审',1 => '正常',-1 => '删除',2 => '错误'];
		return $status[$value];
	}
	public function add($data,$relation){
		$group = $this->allowField(true)->save($data);
		if ($group) {
			return $this->allowField(true)->tagsGroupRelations()->saveAll($relation);
		}else{
			return false;
		}
	}

	public function put($data,$relation){
		$group = $this->allowField(true)->save($data,['id'=>intval($data['id'])]);
		if ($group) {
			return $this->allowField(true)->columnGroupRelations()->saveAll($relation);
		}else{
			return false;
		}
		// return $this->allowField(true)->save($data,['id'=>$data['id']]);
	}

	public function getContent($id){
		$group = $this->get(['id' => $id]);
		return $group->column_group_relations();
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