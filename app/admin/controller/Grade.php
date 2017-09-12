<?php

namespace app\admin\controller;

use houdunwang\view\View;
use system\model\Grade as GradeModel;

class Grade extends Common
{
    /**
     * 加载班级管理页面
     * @return mixed
     */
    public function index()
    {
        //通过命名空间与继承
        //调取所有数据在页面显示使用
        //GradeModel 为当前类Grade的别名
        $model = GradeModel::getAll();
        //如果调取有数据将它变成需要的数组类型
        //如果没有数据默认各一个空数组
        $data = $model ? $model->toArray() : [];
        //调用make方法加载与方法同名的页面
        //分配data变量用作页面显示
        return View::make()->with(compact('data'));
    }

    /**
     * 添加班级
     * @return mixed
     */
    public function add()
    {
        //当数据传入的方式为post的时候
        //进入if判断代码
        if (IS_POST) {
            //实例化GradeModel类
            //调用其中的添加方法执行数据库的添加
            $res = (new GradeModel())->add($_POST);
            //当添加返回的code值是真的时候
            if ($res['code']) {
                //弹出成功提示并返回主页
                $this->setRedirect(u('index'))->message($res['msg']);
            //当添加返回的code值是假的时候
            } else {
                //弹出失败提示并返回主页
                $this->setRedirect()->message($res['msg']);
            }
        }
        //通过mke方法加载同类名同方法名路径的页面
        return View::make();
    }

    /**
     * 修改班级方法
     * @return mixed
     */
    public function edit()
    {
        //dd($_GET);die;
        //获取由网页中传入的get参数
        //将get参数中的gid存入变量保存使用
        $gid = $_GET['gid'];
        //dd($gid);die;
        //当数据传入的方式是post传入是
        //进入if判断
        if (IS_POST) {
            //实例化system\model\中的Grade类
            //并调用其中的修改方法
            //传入gid辨别修改的是第几条数据
            //传入从网页中获得的post数据用来修改数据
            $res = (new GradeModel())->edit($gid,$_POST);
            //当其中返回的值是真的时候
            //说明修改成功
            if ($res['code']) {
                //调用方法跳转主页弹出提示
                $this->setRedirect(u('index'))->message($res['msg']);
            //当返回值是假的时候
            //说明修改失败
            } else {
                //调用方法返回上级页面弹出提示
                $this->setRedirect()->message($res['msg']);
            }
        }
        //通过get数据中的gid判断要修改的数据是第几条
        //从数据库中提出这条数据从对象转换成数组
        //用于修改时旧数据展示
        $oldData = GradeModel::find($gid)->toArray();
        //dd($oldData);
        //加载网页的同时分配变量
        //这样变量就可以在网页中使用
        return View::make()->with(compact('oldData'));
    }

    /**
     * 删除方法
     */
    public function del()
    {
        //获取网页中传入的get参数
        //保留其中的gid
        $gid = $_GET['gid'];
        //dd($gid);
        //通过调用destory方法并传入gid来判断删除哪条数据
        GradeModel::destory($gid);
        //删除成功后返回主页弹出提示
        $this->setRedirect(u('index'))->message('删除成功');
    }
}


