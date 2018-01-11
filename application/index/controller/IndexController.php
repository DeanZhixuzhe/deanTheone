<?php
namespace app\index\controller;

use think\Loader;

class IndexController extends BaseController
{
    public function index()
    {
        return $this->fetch($this->template.'index.php');
    }
}
