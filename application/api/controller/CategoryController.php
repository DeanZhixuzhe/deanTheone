<?php

namespace app\api\controller;

use think\Controller;
use think\Request;

class CategoryController extends Controller
{
    private $obj;
    public function _initialize(){
        $this->obj = model('Category');
    }

    public function getCategoryByCategoryName(Request $request){
        $name = $request->param('name');
        if (!$name) {
            $this->error('栏目名称不正确');
        }
        $categorys = $this->obj->getNormalCategorysByCategoryName($name);
        // $this->result();
        if (!$categorys) {
            return show(0,'error');
        }else{
            return show(1,'success',$categorys);            
        }
    }
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
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
