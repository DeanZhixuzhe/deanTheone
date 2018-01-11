<?php
namespace app\content\model;

use think\Model;

class Article extends Base
{
	public function categorys(){
		return $this->belongsTo('Category');
	}
	public function areas(){
		return $this->belongsTo('Area');
	}
	public function tagss(){
		return $this->belongsToMany('Tags','ContentRelation','tags_id','content_id');
	}
	public function contentRelations(){
		return $this->hasMany('ContentRelation','content_id');
	}
	public function getContentAttr($value){
		return html_entity_decode($value);
	}

	public function getArticle(){
		return $this->where('status',1)
			// ->where('id','not in',$notId)
			// ->where('category_id','in')
			// ->where('area_id',1)
			->order(['update_time' => 'desc','id' => 'desc',])
			->select();
	}
	public function add($data,$relation=''){
		if (empty($relation)) {
			return $this->allowField(true)->save($data);
		}else{
			$result = $this->allowField(true)->save($data);
			if ($result) {
				return $this->allowField(true)->contentRelations()->saveAll($relation);
			}else{
				return false;
			}
		}
	}

	public function put($data,$relation=''){
		if (empty($relation)) {
			return $this->allowField(true)->save($data,['id' => $data['id']]);
		}else{
			$result = $this->allowField(true)->save($data,['id' => $data['id']]);
			if ($result) {
				$contentRelation = new \app\content\model\ContentRelation;
				return $contentRelation->allowField(true)->saveAll($relation);
			}else{
				return false;
			}
		}
	}
}