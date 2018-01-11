<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Config;

class ContentController extends BaseController
{
	public function article(){
		$data = $this->request->param();
		//检查URL是否正确
		//判断请求URL的分类是否存在并且是可见的一级分类
		$category = $this->category->get(['dir' => $data['category'],'visible' => 1,'parent_id' => 0,'path' => '0'])->toArray();
		$categoryId = $category['id'];
		//查找请求分类的二级分类，处理ID变成字符串
		$categoryTwo = $this->category->all(['parent_id' => $category['id']]);
		foreach ($categoryTwo as $value) {
			$categoryId .= ','.$value['id'];
		}
		//根据请求URL的一级分类下面所有子分类查找文章是否存在
		$article = $this->article->with('tagss','categroys')
			->where('id',$data['id'])
			->where('category_id','in',$categoryId)
			->where('status',1)
			->find();
		//
		if ($article) {
			# 获取需要展示的数据，然后赋值到模板，进行渲染
			$article->url = '/'.$category['dir'].'/'.$article->id.'.html';
			$article->link = '<a href="'.$article->url.'" target="_blank">'.$article->title.'</a>';
			$column = $this->getColumn($categoryId);	//获得当前内容分类下的所有栏目
			$relationContent = $this->getRelationContent($article,$categoryId,$category['dir']);
			$position = $this->getPosition($article,$column);
			$newContent = $this->getNewContent($article,$categoryId,$category['dir']);
			$relationColumn = $this->getRelationColumn($article,$column);
			
			// return '';
			return $this->fetch($this->template.'article_article.htm',['me' => $article,'relaCon' => $relationContent,'position' => $position,'newContent' => $newContent,'relaCol' => $relationColumn]);
		}else{
			# 返回404提示页面
			echo "不存在，错误页面";exit;
			return $this->fetch($this->template.'404.html');
		}
	}

	public function getRelationColumn($article,$column){
		//判断内容包含的元素

		$whereArr = array();
		if ($article['area_id'] != 0) {
			$area['type'] = 'area';
			$area['id'] = $article['area_id'];
			$whereArr[] = $area;
		}
		$category['type'] = 'category';
		$pid = $this->category->field('parent_id')->find($article->category_id);
		if ($pid->parent_id == 0) {
			$cid = $this->category->field('id')->where('parent_id',$article['category_id'])->find();
			$category['id'] = $cid->id;
			dump($this->category->getLastSql());
		}else{
			$category['id'] = $article['category_id'];
		}
		$whereArr[] = $category;
		if (!empty($article['tagss'])) {
			foreach ($article['tagss'] as $value) {
				$value['type'] = 'tags';
				$whereArr[] = $value->toArray();
			}
		}
		for ($i=0; $i < count($whereArr); $i++) { 
			foreach ($column['two'] as $val) {
				if ($whereArr[$i]['type'] == $val['type'] && $whereArr[$i]['id'] == $val['id']) {
					$group_name = $val['group_name'];
					break;
				}
			}
			foreach ($column['two'] as $value) {
				if($value['group_name'] == $group_name){
					$arr[] = $value;
				}
			}
			$result = array_rand($arr,2);
			for ($j=0; $j < count($result); $j++) { 
				$results[] = $arr[$result[$j]];
			}
			$arr = array();
		}
		return $results;
	}

	public function getNewContent($article,$categoryId,$categoryUrl){
		$notid = $article['id'];
		if ($article['area_id'] != 0) {
			$result = $this->article->where('status',1)->where('id','not in',$notid)->where('category_id','in',$categoryId)->where('area_id',$article['area_id'])->order(['update_time' => 'desc','id' => 'desc'])->limit(10)->select();
			foreach ($result as $value) {
				$value['url'] = '/'.$categoryUrl.'/'.$value['id'].'.html';
				$value['link'] = '<a herf="'.$value['url'].'" target="_blank">'.$value['title'].'</a>';
				$resutls[] = $value;

			}
			if (count($result) < 10) {
				foreach ($result as $value) {
					$notid .= ','.$value['id'];
				}
				$result = $this->article->where('status',1)->where('id','not in',$notid)->where('category_id','in',$categoryId)->order(['update_time' => 'desc','id' => 'desc'])->limit(10)->select();
				foreach ($result as $value) {
					$value['url'] = '/'.$categoryUrl.'/'.$value['id'].'.html';
					$value['link'] = '<a herf="'.$value['url'].'" target="_blank">'.$value['title'].'</a>';
					$resutls[] = $value;
				}
			}
			return $resutls;
		}else{
			$result = $this->article->where('status',1)->where('id','not in',$notid)->where('category_id','in',$categoryId)->order(['update_time' => 'desc','id' => 'desc'])->limit(10)->select();
			foreach ($result as $value) {
				$value['url'] = '/'.$categoryUrl.'/'.$value['id'].'.html';
				$value['link'] = '<a herf="'.$value['url'].'" target="_blank">'.$value['title'].'</a>';
			}
			return $result;
		}
	}
	public function getPosition($article,$column){
		//判断内容包含的元素
		$whereArr = array();
		if ($article['area_id'] != 0) {
			$area['type'] = 'area';
			$area['id'] = $article['area_id'];
			$whereArr[] = $area;
		}
		$category['type'] = 'category';
		$category['id'] = $article['category_id'];
		$whereArr[] = $category;
		if (!empty($article['tagss'])) {
			foreach ($article['tagss'] as $value) {
				$value['type'] = 'tags';
				$whereArr[] = $value->toArray();
			}
		}
		$str = '';
		//获取二级栏目Link
		foreach ($whereArr as $value) {	//循环条件数组
			foreach ($column['two'] as $val) {
				// dump('当前判断条件');
				// dump($value);
				// dump('当前搜索内容');
				// dump($val);
				if($value['type'] == $val['type'] && $value['id'] == $val['id']){
					$str = $val['link'].' > ';
					break 2;
				}
			}
		}
		return $position = $column['link'].' > '.$str;
	}

	public function getRelationContent($article,$categoryId,$categoryUrl,$limit=10){
		$notid = $article['id'];
		//判断内容包含的元素
		$whereArr = array();
		if ($article['area_id'] != 0) {
			$area['type'] = 'area';
			$area['area_id'] = $article['area_id'];
			$whereArr[] = $area;
		}
		$category['type'] = 'category';
		$category['category_id'] = $article['category_id'];
		$whereArr[] = $category;
		if (!empty($article['tagss'])) {
			foreach ($article['tagss'] as $value) {
				$value['type'] = 'tags';
				$value['tags_id'] = $value['id'];
				$whereArr[] = $value;
			}
		}
		return $this->getRelationContents($limit,$notid,0,$whereArr,count($whereArr),$categoryId,$categoryUrl);
	}
	public function getRelationContents($limit=10,$notid=0,$num=0,$whereArr,$len,$categoryId,$categoryUrl){
		static $con = array();
		$num++;
		$aids = '';
		$tids = '';
		$cids = '';
		if ($len < 0) {
			return $con;
		}
		for($i=0;$i<$len;$i++){
			switch ($whereArr[$i]['type']) {
				case 'area':
					$aids = $whereArr[$i]['area_id'];
					break;
				case 'tags':
					$tids .= $whereArr[$i]['tags_id'].',';
					break;
				case 'category':
					$cids = $whereArr[$i]['category_id'];
					break;
			}
		}
		$len--;
		$cids = $cids == '' ? $categoryId : $cids;
		//处理相关SQL语句
		if (!empty($aids) && !empty($tids)) {
			//地区、标签都存在
			$relationContent = $this->article->hasWhere('contentRelations',function($query)use($tids){
					$query->where('tags_id','in',$tids);
			})->where('status',1)->where('category_id','in',$cids)->where('area_id',$aids)->where('id','not in',$notid)->select();
		}elseif (!empty($aids) && empty($tids)) {
			//地区存在、标签不存在
			$relationContent = $this->article->where('status',1)->where('category_id','in',$cids)->where('area_id',$aids)->where('id','not in',$notid)->select();
		}elseif (empty($aids) && !empty($tids)) {
			//地区不存在、标签存在
			$relationContent = $this->article->hasWhere('contentRelations',function($query)use($tids){
					$query->where('tags_id','in',$tids);
			})->where('status',1)->where('category_id','in',$cids)->where('id','not in',$notid)->select();
		}else{
			//地区标签都不存在
			$relationContent = $this->article->where('status',1)->where('category_id','in',$cids)->where('id','not in',$notid)->select();
		}

		if (empty($relationContent)) {
			$this->getRelationContents($limit,$notid,$num,$whereArr,$len,$categoryId,$categoryUrl);
		}else{
			foreach ($relationContent as $value) {
				$notid .= ','.$value->id;
				$value->url = '/'.$categoryUrl.'/'.$value->id.'.html';
				$value->link = '<a href="'.$value->url.'" target="_blank">'.$value->title.'</a>';
				$con[] = $value->toArray();
			}
			$limit = $limit-count($relationContent);
			if($limit > 0){
				$this->getRelationContents($limit,$notid,$num,$whereArr,$len,$categoryId,$categoryUrl);
			}
		}
		return $con;
	}
	/**
	 * 获取当前请求内容的一级分类下的所有栏目
	 * @author deanyan 2017-10-11T03:55:15+0800
	 * @copyright www.deanyan.com
	 * @param     string          $category 所有栏目ID
	 * @return    [type]                    [description]
	 */
	public function getColumn($categoryId){
		//获取当前分类下的所有绑定栏目
		$bindColum = $this->category->all(function($query)use($categoryId){
			$query->where('id','in',$categoryId);
		},'columns');
		
		foreach ($bindColum as $value) {
			switch (substr_count($value['path'],'-')) {
				case 0:	//一级分类
					$value->type = 'category';
					$value->column_name = $value->name;
					$value->group_name = '';
					$value->url = '/'.$value->dir.'/';
					$value->link = '<a href="'.$value->url.'">'.$value->column_name.'</a>';
					$column = $value->toArray();
					if(!empty($value['columns'])){	//处理绑定栏目
						foreach ($value['columns'] as $val) {
							if ($val['area_group_id'] != 0 && $val['tags_group_id'] == 0) {
								$bindArea = $this->areaGroup->with('areas')->find(['id' => $val['area_group_id'],'status' => 1])->toArray();
								foreach ($bindArea['areas'] as $v) {
									$v['type'] = 'area';
									$v['url'] = $value->url.strtolower($v['usname']).'/';
									$v['column_name'] = str_replace('市','',$v['name']).$value->column_name;
									$v['link'] = '<a href="'.$v['url'].'">'.$v['column_name'].'</a>';
									$v['group_name'] = $bindArea['name'];
									$column['two'][] = $v;
								}
							}elseif ($val['area_group_id'] == 0 && $val['tags_group_id'] != 0) {
								$bindTags = $this->tagsGroup->with('tagss')->find($val['tags_group_id'])->toArray();
								foreach ($bindTags['tagss'] as $v) {
									$v['type'] = 'tags';
									$v['url'] = $value->url.strtolower($v['dir']).'/';
									$v['column_name'] = $v['name'].$value->column_name;
									$v['link'] = '<a href="'.$v['url'].'">'.$v['column_name'].'</a>';
									$v['group_name'] = $bindTags['name'];
									$column['two'][] = $v;
								}
							}elseif ($val['area_group_id'] != 0 && $val['tags_group_id'] != 0) {
								$bindArea = $this->areaGroup->with('areas')->find($val['area_group_id'])->toArray();
								$bindTags = $this->tagsGroup->with('tagss')->find($val['tags_group_id'])->toArray();
								foreach ($bindArea['areas'] as $av) {
									foreach ($bindTags['tagss'] as $tv) {
										$tv['url'] = $value->url.strtolower($av['usname']).'/'.strtolower($tv['dir']).'/';
										$tv['column_name'] = str_replace('市','',$av['name']).$tv['name'].$value->column_name;
										$tv['link'] = '<a href="'.$tv['url'].'">'.$tv['column_name'].'</a>';
										$tv['group_name'] = $bindTags['name'];
										$column['three'][] = $tv;
									}
								}
							}else{
								return $this->error('数据错误');
							}
						}
					}
					break;
				case 1:	//二级分类
					$value->type = 'category';
					$value->column_name = $value->name;
					$value->group_name = '';
					$value->url = $column['url'].$value->dir.'/';
					$value->link = '<a href="'.$value->url.'">'.$value->column_name.'</a>';
					$column['two'][] = $value->toArray();
					if(!empty($value['columns'])){	//检测是否有绑定栏目
						foreach ($value['columns'] as $val) {
							
						}
					}
					break;
				case 2:	//三级分类
					# code...
					break;
				default:
					# code...
					break;
			}
			
		}
		return $column;
	}
	public function getArticlePosition($category,$article){
		$homeLink = '<a href="/">首页</a> > ';
		$categoryLink = '<a href="'.$category['dir'].'>'.$category['name'].'</a> > ';
		//查找content_relation是否存在标签
		$tags = $this->contentRelation->all(['content_id' => $article['id'],'category_id' => $article['category_id'],]);
		if ($article['area_id'] == 0) {
			$areaLink = '';
		}else{

		}
		$areaLink = '<a href="'.$category['dir'].'>'.$category['name'].'</a> > ';
		$tagsLink = '<a href="'.$category['dir'].'>'.$category['name'].'</a> > ';
		return $homeLink.$categoryLink.$areaLink.$tagsLink;
		//<a href="/proposal/">求婚</a> > 
	}
	public function urlCheck(){

	}
	public function columnone(){
		$dir = $this->request->param('column');
		$category = $this->category->get(['dir' => $dir,'status' => 1,'visible' => 1,'parent_id' => 0]);
		if ($category) {
			$category->title = empty($category->title) ? $category->name : $category->title;
			$category->url = '/'.$category->dir.'/';
			$category->column_name = $category->name;
			$category->link = '<a href="'.$category->url.'">'.$category->column_name.'</a>';
			$category->linkb = '<a href="'.$category->url.'" target="_blank">'.$category->column_name.'</a>';
			$position = $category->link.' > ';
			//
			$pathWhere = $category->path.'-'.$category->id.'%';
			$categoryChild = $this->category->where('path','like',$pathWhere)->select();

			$categoryAllId = $category->id;
			foreach ($categoryChild as $value) {
				$categoryAllId .= ','.$value->id;
				$value->column_name = $value->name;
				$value->url = $category->url.$value->dir.'/';
				$value->link = '<a href="'.$value->url.'">'.$value->column_name.'</a>';
				$value->linkb = '<a href="'.$value->url.'" target="_blank">'.$value->column_name.'</a>';
			}
			$cityColumn = $this->getColumnById(1,4);
			$cdColumn = $this->getColumnById(2);
			$jrColumn = $this->getColumnById(3);
			dump($categoryAllId);
			$articleList = $this->article->with('tagss')->where('status',1)
				->where('category_id','in',$categoryAllId)
				->order(['update_time' => 'desc','id' => 'desc',])
				->paginate();
			//包含的元素链接--分类、城市、标签

			foreach ($articleList as &$value) {
				$value->url = $category->url.$value->id.'.html';
				$value->link = '<a href="'.$value->url.'">'.$value->title.'</a>';
				$value->linkb = '<a href="'.$value->url.'" target="_blank">'.$value->title.'</a>';
			}
			
			return $this->fetch($this->template.'list_article.htm',[
					'me' => $category,
					'position' => $position,
					'list' => $articleList,
					'childColumn' => $categoryChild,
					'cityColumn' => $cityColumn,
					'cdColumn' => $cdColumn,
					'jrColumn' => $jrColumn,
				]);
		}else{
			return $this->fetch($this->template.'404.html');
		}
	}

	public function getColumnById($columnId,$num=0){
		$bindColumn = $this->column->with('categorys')->find(['id' => $columnId,'status' => 1])->toArray();
		$category['url'] = '/'.$bindColumn['categorys']['dir'].'/';
		$category['column_name'] = $bindColumn['categorys']['name'];
		if ($bindColumn['area_group_id'] == 0 && $bindColumn['tags_group_id'] != 0) {
			$bindTags = $this->tagsGroup->with('tagss')->find(['id' => $bindColumn['tags_group_id'],'status' => 1,])->toArray();
			foreach ($bindTags['tagss'] as $v) {
				$v['type'] = 'tags';
				$v['url'] = $category['url'].strtolower($v['dir']).'/';
				$v['column_name'] = $v['name'].$category['column_name'];
				$v['link'] = '<a href="'.$v['url'].'">'.$v['column_name'].'</a>';
				$v['linkb'] = '<a href="'.$v['url'].'" target="_blank">'.$v['column_name'].'</a>';
				$v['group_name'] = $bindTags['name'];
				$column['two'][] = $v;
			}
		}elseif($bindColumn['area_group_id'] != 0 && $bindColumn['tags_group_id'] == 0){
			$bindArea = $this->areaGroup->with('areas')->find(['id' => $bindColumn['area_group_id'],'status' => 1,])->toArray();
			foreach ($bindArea['areas'] as $v) {
				$v['type'] = 'area';
				$v['url'] = $category['url'].strtolower($v['usname']).'/';
				$v['column_name'] = str_replace('市','',$v['name']).$category['column_name'];
				$v['link'] = '<a href="'.$v['url'].'">'.$v['column_name'].'</a>';
				$v['linkb'] = '<a href="'.$v['url'].'" target="_blank">'.$v['column_name'].'</a>';
				$v['group_name'] = $bindArea['name'];
				$column['two'][] = $v;
			}
		}elseif($bindColumn['area_group_id'] != 0 && $bindColumn['tags_group_id'] != 0){
			$bindArea = $this->areaGroup->with('areas')->find(['id' => $bindColumn['area_group_id'],'status' => 1,])->toArray();
			$bindTags = $this->tagsGroup->with('tagss')->find(['id' => $bindColumn['tags_group_id'],'status' => 1,])->toArray();
			foreach ($bindArea['areas'] as $av) {
				foreach ($bindTags['tagss'] as $tv) {
					$tv['url'] = $value->url.strtolower($av['usname']).'/'.strtolower($tv['dir']).'/';
					$tv['column_name'] = str_replace('市','',$av['name']).$tv['name'].$category['column_name'];
					$tv['link'] = '<a href="'.$tv['url'].'">'.$tv['column_name'].'</a>';
					$tv['linkb'] = '<a href="'.$tv['url'].'" target="_blank">'.$tv['column_name'].'</a>';
					$tv['group_name'] = $bindTags['name'];
					$column['three'][] = $tv;
				}
			}
		}else{
			return false;
		}
		if ($num != 0 && count($column['two']) >= $num) {
			$rand = array_rand($column['two'],$num);
			if ($num == 1) {
				$column['two'] = $column['two'][$rand];
			}else{
				for ($i=0; $i < $num; $i++) { 
					$s[] = $column['two'][$rand[$i]];
				}
				$column['two'] = $s;
			}
		}
		return $column['two'];
	}
}