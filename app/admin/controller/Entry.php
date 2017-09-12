<?php

namespace app\admin\controller;

use houdunwang\view\View;
use system\model\Admin;

class Entry extends Common
{
    public function index()
    {
        return View::make();
    }

    public function edit()
    {
        //echo 1;die;
        //当数据传入的方式为post的时候
        //进入if判断
        if (IS_POST) {
            //实例化Admin并调用其中的edit方法
            //实现密码修改
            $res = (new Admin())->edit($_POST);
            //如果返回的code值布尔值是真
            //说面密码修改成功
            if ($res['code']) {
                //删除session设定
                session_unset();
                session_destroy();
                //session保存时间归零
                setcookie(session_name(), session_id(), 0, '/');
                //为了防止错误将session中phrase的值变成空
                $_SESSION['phrase'] = '';
                //返回登录页面并弹出成功提示
                $this->setRedirect(u('entry.index'))->message($res['msg']);
                //code代码返回的布尔值是假的时候
            } else {
                //说米密码修改不成功
                //弹出错误原因 并返回上级页面
                $this->setRedirect()->message($res['msg']);
            }

        }
        //加载与方法同名的页面
        return View::make();
    }

    public function out()
    {
        //echo 1;die;
        //清除session
        session_unset();
        session_destroy();
        //将session设定归0
        setcookie(session_name(), session_id(), 0, '/');
        //为了防止错误将session中phrase的值变成空
        $_SESSION['phrase'] = '';
        //返回上级页面并弹出提示
        //因为清除的session所以会返回登录页面
        //header ('location:?s=admin/login/index');exit;
        //$obj = new Admin();
        $this->setRedirect()->message('退出成功');
    }
}