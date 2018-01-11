<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

class ListController extends BaseController
{

    private $urlRule = [
        [
            'rule' => 'default',
            'title' => '',  //当前栏目名称
            'position' => '',   //当前位置的面包屑导航
            'content' => 'category_id',    //当前栏目内容取值
            'relatedCategory' => '',    //当前栏目的相关栏目
        ],
        [
            'rule' => 'category',
            'title' => '',  //当前栏目名称
            'position' => '',   //当前位置的面包屑导航
            'content' => 'category_id',    //当前栏目内容取值
            'relatedCategory' => '',    //当前栏目的相关栏目
        ],
        [
            'rule' => 'area',
            'title' => '',  //当前栏目名称
            'position' => '',   //当前位置的面包屑导航
            'content' => 'category_id',    //当前栏目内容取值
            'relatedCategory' => '',    //当前栏目的相关栏目
        ],
        
        [
            'rule' => 'category/category/',
            'title' => '',  //当前栏目名称
            'position' => '',   //当前位置的面包屑导航
            'content' => 'category_id',    //当前栏目内容取值
            'relatedCategory' => '',    //当前栏目的相关栏目
        ],
        [
            'rule' => 'category/area/',
            'level' => 2,
            //当前栏目名称 $curRule['data'][1]['area']->name.$curRule['data'][0]['category']->name
            'title' => [
                ['sub' => 1,'name' => 'area'],
                ['sub' => 0,'name' => 'category']
            ],
            //当前位置 $curRule['data'][0]['category']->dir > $curRule['data'][0]['category']->dir.$curRule['data'][1]['area']->usname
            'position' => [
                ['sub' => 0,'name' => 'category','dir' => 'dir',],
                ['sub' => 1,'name' => 'area','dir' => 'usname',]
            ],   //当前位置的面包屑导航
            'content' => 'category_id,area_id',    //当前栏目内容取值
            'relatedCategory' => '',    //当前栏目的相关栏目
        ],
        [
            'rule' => 'category/tag/',
            'title' => 'area.tag.category',  //当前栏目名称
            'position' => 'category/tag',   //当前位置的面包屑导航
            'content' => 'category_id,area_id',    //当前栏目内容取值
            'relatedCategory' => '',    //当前栏目的相关栏目
        ],
        [
            'rule' => 'category/category/tag/',
            'title' => 'area.tag.category',  //当前栏目名称
            'position' => 'category/area',   //当前位置的面包屑导航
            'content' => 'category_id,area_id',    //当前栏目内容取值
            'relatedCategory' => '',    //当前栏目的相关栏目
        ],
        [
            'rule' => 'category/area/tag/',
            'title' => 'area.tag.category',  //当前栏目名称
            'position' => 'category/area/tag',   //当前位置的面包屑导航
            'content' => 'category_id,area_id,tag_id',    //当前栏目内容取值
            'relatedCategory' => '',    //当前栏目的相关栏目
        ],
        [
            'rule' => 'category/area/category/',
            'title' => 'area.tag.category',  //当前栏目名称
            'position' => 'category/area/tag',   //当前位置的面包屑导航
            'content' => 'category_id,area_id,tag_id',    //当前栏目内容取值
            'relatedCategory' => '',    //当前栏目的相关栏目
        ],
        [
            'rule' => 'category/area/category/tag/',
            'title' => 'area.tag.category',  //当前栏目名称
            'position' => 'category/area/tag',   //当前位置的面包屑导航
            'content' => 'category_id,area_id,tag_id',    //当前栏目内容取值
            'relatedCategory' => '',    //当前栏目的相关栏目
        ],
        //每一级的栏目名称
        //每一级的URL
        //栏目页面内容取值范围
        //相关栏目取值范围
    ];
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //1、定位模板文件
        //2、面包屑导航
        //3、栏目名
        //4、栏目所属内容
        //5、相关栏目
        // $url = '';
        $dir = $this->request->param('dir');
        $curRule = $this->checkUrl($dir);
        // var_dump($curRule['data'][0]['category']->name);
        // var_dump(is_array($curRule['data'][0]['category']));
        // var_dump(is_object($curRule['data'][0]['category']));
        if (!$curRule) {
            return $this->fetch('./template/tot/404.html');
        }
        if (count($curRule['data']) == 1) {
            $list = $this->getOneList($curRule);
        }else{
            $list = $this->getList($curRule);
        }
        
        $this->assign('list',$list);
        return $this->fetch('./template/tot/list_article.htm');


        
        // preg_match_all('/\/+/', $dir,$matches);
        // var_dump(count($matches[0]));
        // // var_dump($this->urlRule);
        // switch (count($matches[0])) {
        //     case 0:
        //         var_dump('111');
        //         $cat = $this->category->get(['dir' => $dir]);
        //         $are = $this->area->get(['usname' => $dir]);
        //         if ($cat) {
        //             // $current = $cat;
        //             // $this->getOne('category',$cat);
        //         }
        //         if ($are) {
        //             // $current = $are;
        //             $this->getOne('area',$cat);
        //         }
        //         break;
        //     case 1:
        //         var_dump('222');
        //         $cat = $this->category->get(['dir' => $dir]);
        //         $are = $this->area->get(['usname' => $dir]);
        //         // $this->getTwo('category',$cat);
        //         break;
        //     case 2:
        //         var_dump('333');
        //         break;
        //     case 3:
        //         var_dump('444');
        //         break;
        // }
        

        //$position
        //一级：
        //  分类：取dir、name的值
        //  地区：取usname、name的值
        //二级：
        //  分类/分类
        //      1分类：取dir、name的值
        //      2分类：取本级dir和上级dir的值及name的值
        //  分类/地区
        //      1分类：取dir、name的值
        //      2地区：取地区usname的值和1分类dir的值及name的值
        //  分类/标签
        //      1分类：取dir、name的值
        //      2标签：取标签dir的值和1分类dir的值及标签name、分类name的值
        //      

        //判断URL地址是否有效
        // if (strpos($dir,'/') === false) {
        //     //查找是否是栏目
        //     $current = $this->category->get(['dir' => $dir]);
        //     //如果没有栏目，查找是否是城市
        //     if (!$current) {
        //         $current = $this->area->get(['usname' => $dir]);
        //     }
        //     if (empty($current)) {
        //         return $this->fetch('./template/tot/404.html');
        //     }
        // }else{
        //     //需要循环判断每个层级的URL参数是否正确
        //     $currents = explode('/',$dir);
        //     for ($i=0; $i < count($currents) ; $i++) {
        //         $cat = $this->category->get(['dir' => $currents[$i]]);
        //         $are = $this->area->get(['usname' => $currents[$i]]);
        //         if ($cat) {
        //             $cur[$i]['type'] = 'category';
        //             $cur[$i]['content'] = $cat;
        //         }elseif($are){
        //             $cur[$i]['type'] = 'area';
        //             $cur[$i]['content'] = $are;
        //         }else{
        //             return $this->fetch('./template/tot/404.html');
        //         }
        //     }
            
        //     $current = end($cur)['content'];
        // }
        // // var_dump($current);
        
        // $conTotal = '';
        // $relatedCategory = '';
        // $content = '';
        // $position = '<a href="/'.$current->dir.'">'.$current->name.'</a>';

        // $this->assign('position',$position);    //当前位置
        // $this->assign('conTotal',$conTotal);    //内容总数量
        // $this->assign('current',$current);  //当前列表页信息
        // $this->assign('relatedCategory',$relatedCategory);  //相关栏目
        // $this->assign('content',$content);  //当前列表页的内容
        // var_dump($this->request->param('dir'));
        
    }
    public function getOneList(){
    }
    public function getList($curRule){
        $list['title'] = '';
        $list['position'] = '';
        $list['url'] = '';
        //根据data数组的长度判断层级
        for ($i=0; $i < count($curRule['data']); $i++) { 
            $list['title'] .= $curRule['data'][$curRule['title'][$i]['sub']][$curRule['title'][$i]['name']]->name;
            $list['url'] .= strtolower($curRule['data'][$curRule['position'][$i]['sub']][$curRule['position'][$i]['name']]->$curRule['position'][$i]['dir']).'/';
            if ($i == 0) {
                $list['position'] .= '<a href="/'.$list['url'].'">'.$curRule['data'][$curRule['position'][$i]['sub']][$curRule['position'][$i]['name']]->name.'</a> > ';
            }else{
                $list['position'] .= '<a href="/'.$list['url'].'">'.$list['title'].'</a> > ';
            }
            
        }
        var_dump($list);
        return $list;
    }

    public function getListContent(){
        
    }
    public function checkUrl($dir){
        if (strpos($dir,'/') === false) {
            //查找是否是栏目
            $cat = $this->category->get(['dir' => $dir]);
            $are = $this->area->get(['usname' => $dir]);
            //如果没有栏目，查找是否是城市
            if ($cat) {
                $type = 'category';
            }elseif ($are) {
                $type = 'area';
            }else{
                return $this->fetch('./template/tot/404.html');
            }
        }else{
            $currents = explode('/',$dir);
            $type = '';
            //循环判断每个层级的URL参数是否正确，如果不正确直接返回false
            for ($i=0; $i < count($currents) ; $i++) {
                $cat = $this->category->get(['dir' => $currents[$i]]);
                $are = $this->area->get(['usname' => $currents[$i]]);
                if ($cat) {
                    $type .= 'category/';
                    $cur[$i]['type'] = 'category';
                    $cur[$i]['category'] = $cat;
                }elseif($are){
                    $type .= 'area/';
                    $cur[$i]['type'] = 'area';
                    $cur[$i]['area'] = $are;
                }else{
                    return false;
                }
            }
            // $current = end($cur)['content'];
        }
        //循环匹配规则，存在返回匹配规则的数组，如果不存在说明URL参数顺序错误，返回false
        foreach ($this->urlRule as $v) {
            if ($v['rule'] == $type) {
                $v['data'] = $cur;
                return $v;
            }
        }
        return false;
    }





    public function url(){
        //把URL中的所有元素逐一匹配设置好的规则，组成新数组，返回相关数据
        //文章地址  http://theone.me/proposal/333.html http://theone.me/proposal/333_2.html
        $articleUrl = "/(\w+):\/\/([^/:]+)?([^# ]*)/";
        //一级分类栏目    http://theone.me/proposal/          http://theone.me/proposal/2.html
        //一级城市栏目    http://theone.me/beijing/
        //二级分类栏目    http://theone.me/proposal/word/     http://theone.me/proposal/word/2.html
        //二级城市栏目    http://theone.me/proposal/beijing/  http://theone.me/proposal/beijing/2.html
        //二级标签栏目    http://theone.me/proposal/jiuba/    http://theone.me/proposal/jiuba/2.html
        $one = "/(\w+):\/\/([^/:]+)?([^# ]*)/";
        $two = "/(\w+):\/\/([^/:]+)?([^# ]*)/";
        $san = "/(\w+):\/\/([^/:]+)?([^# ]*)/";
        preg_match(pattern, subject);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
