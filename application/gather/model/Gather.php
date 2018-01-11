<?php
namespace app\gather\model;

use think\Model;

class Gather extends Model
{
	
	public function add($data){
		if ($data['parent_id'] == 0) {
			$data['path'] = 0;
		}else{
			$area = $this->get(['id' => $data['parent_id']]);
			$data['path'] = $area->path.'-'.$area->id;
		}
		$data['listorder'] = 0;
		return $this->allowField(true)->save($data);
	}

	public function put($data){
		if ($data['parent_id'] == 0) {
			$data['path'] = 0;
		}else{
			$area = $this->get(['id' => $data['parent_id']]);
			$data['path'] = $area->path.'-'.$area->id;
		}
		return $this->allowField(true)->save($data,['id'=>$data['id']]);
	}
}