<?php

namespace app\api\controller;

use think\Controller;
use think\Request;

class MapController extends Controller
{
    /**
     * 根据地址来获取经纬度
     * @author deanyan 2017-09-07
     * @param  [type] $address [description]
     * @return [type]          [description]
     */
    public static function getLngLat($address){
        //http://api.map.baidu.com/geocoder/v2/?address=北京市海淀区上地十街10号&output=json&ak=E4805d16520de693a3fe707cdc962045&callback=showLocation
        $data = [
            'address' => $address,
            'ak' => config('map.ak'),
            'output' => 'json',
        ];
        $url = config('map.baidu_map_url').config('map.geocoder').'?'.http_build_query($data);
        $result = doCurl($url);
        return $result;
    }

    /**
     * [getStaticImage description]
     * @author deanyan 2017-09-08T03:13:27+0800
     * @link   www.deanyan.com
     * @param  [type]          $address [description]
     * @return [type]                   [description]
     */
    public static function getStaticImage($center){
        if ('' == $center) {
            return '';
        }
        $data = [
            'ak' => config('map.ak'),
            'width' => config('map.width'),
            'height' => config('map.height'),
            // 'center' => $center,
            'markers' => $center,
        ];
        $url = config('map.baidu_map_url').config('map.staticimage').'?'.http_build_query($data);
        $result = doCurl($url);
        return $result;
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
