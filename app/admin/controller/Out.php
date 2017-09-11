<?php
namespace app\admin\controller;

use houdunwang\core\Controller;

class Out extends Controller
{
    /**
     * 退出方法
     */
    public function out()
    {
        //echo 1;die;
        //清除session
        session_unset();
        session_destroy();
        //将session设定归0
        setcookie(session_name(),session_id(),0,'/');
        //为了防止错误将session中phrase的值变成空
        $_SESSION['phrase']='';
        //返回上级页面并弹出提示
        //因为清除的session所以会返回登录页面
        $this->setRedirect()->message('退出成功');
    }
}