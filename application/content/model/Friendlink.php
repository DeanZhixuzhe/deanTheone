<?php
namespace app\content\model;

use think\Model;

class Friendlink extends Base
{
	public function setDirAttr($value){
		return strtolower($value);
	}
	public function getStatusAttr($value){
		$status = ['0' => '待审','1' => '正常','-1' => '删除',];
		return $status[$value];
	}
	public function add($data){
		$theId = $this->max('id')+1;
		if ($data['parent_id'] == 0) {
			$data['path'] = $theId;
		}else{
			$category = $this->get(['id' => $data['parent_id']]);
			$data['path'] = $category->path.'-'.$theId;
		}
		$data['status'] = 1;
		$data['listorder'] = 0;
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