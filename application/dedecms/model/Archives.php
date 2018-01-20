<?php
namespace app\dedecms\model;

use think\Model;

/**
* 
*/
class Archives extends Base
{
	// protected $field = ['id','typeid','typeid2','sortrank','flag','channel','arcrank','click','title','shorttitle','writer','source','litpic','pubdate','senddate','keywords','description','filename'];
	public function article(){
		return $this->hasOne('Addonarticle','aid');
	}
	public function cases(){
		return $this->hasOne('Addoncase','aid');
	}
	public function shop(){
		return $this->hasOne('Addonshop','aid');
	}
	public function video(){
		return $this->hasOne('Addonvideo','aid');
	}
	public function arctype(){
		return $this->hasOne('Arctype','id','typeid');
	}
}