<?php
namespace app\admin\controller;

class Common
{
    /**
     * 继承后一开始就会加载的构造函数
     * Common constructor.
     */
    public function __construct()
    {
        //检测session里面的id值是否存在
        if(!isset($_SESSION['admin_id'])){
            //头部函数
            //如果session中没有name_id就返回登录页面
            header('location:?s=admin/login/index');
            die;
        }
    }
}