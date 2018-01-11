<?php

namespace app\content\model;

use think\Model;

class TagsGroupRelation extends Base
{
	protected $autoWriteTimestamp = false;

	public function columnGroupRelationtable(){
		return $this->morphTo(['relation_type','relation_id']);
	}
	public function getStatusAttr($value){
		$status = [0 => '待审',1 => '正常',-1 => '删除',2 => '错误'];
		return $status[$value];
	}
}
