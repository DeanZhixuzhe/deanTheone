<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Url;
use think\Response;
use think\Config;
use app\content\model\Area;
use app\content\model\AreaGroup;
use app\content\model\AreaGroupRelation;
use app\content\model\Category;
use app\content\model\Column;
use app\content\model\Tags;
use app\content\model\TagsGroup;
use app\content\model\TagsGroupRelation;
use app\content\model\Friendlink;
use app\content\model\ContentRelation;
use app\content\model\Article;

class BaseController extends Controller
{
    protected $template;
    protected $area;
    protected $areaGroup;
    protected $areaGroupRelation;
    protected $category;
    protected $column;
    protected $tags;
    protected $tagsGroup;
    protected $tagsGroupRelation;
    protected $friendlink;
    protected $contentRelation;
    protected $article;
    function __construct(Area $area,AreaGroup $areaGroup,AreaGroupRelation $areaGroupRelation,Column $column,Category $category,Tags $tags,TagsGroup $tagsGroup,TagsGroupRelation $tagsGroupRelation,Friendlink $friendlink,ContentRelation $contentRelation,Article $article){
        parent::__construct();
        $this->template = Config::get('template.path').Config::get('template.style').'/';
        //赋值模型类库
        $this->area = $area;
        $this->areaGroup = $areaGroup;
        $this->areaGroupRelation = $areaGroupRelation;
        $this->column = $column;
        $this->category = $category;
        $this->tags = $tags;
        $this->tagsGroup = $tagsGroup;
        $this->tagsGroupRelation = $tagsGroupRelation;
        $this->friendlink = $friendlink;
        $this->contentRelation = $contentRelation;
        $this->article = $article;
    }

    public function _initialize(){
        $cfg['webname'] = 'TheOne浪漫策划公司';
        $cfg['template'] = Config::get('template.path').Config::get('template.style').'/';
        $cfg['domain'] = 'http://theone.me';
        $this->assign('cfg',$cfg);
    }

    
}
