<?php

namespace app\admin\controller;

use houdunwang\view\View;
use system\model\Student as StudentModel;

class Student extends Common
{
    /**
     * 数据展示方法
     * @return mixed
     */
    public function index()
    {
        //echo 1;
        //$data = [];
        //将学生表与班级表两表关联获取数据
        $data = StudentModel::query("select * from student s join grade g on s.gid = g.gid");
        //加载与方法同名的页面
        //并分配变量用作网页展示使用
        return View::make()->with(compact('data'));
    }

    /**
     * 学生添加方法
     * @return mixed
     */
    public function add()
    {
        //$getGradeData = $this->getGradeData();
        //$getMaterialData = $this->getMaterialData();
        //dd($getMaterialData);dd($getGradeData);die;
        //当数据传入方式为POST的时候
        //进入if判断
        if(IS_POST){
            //通过引用命名空间并实例化Student别名
            //调用add方法来进行数据库添加数据
            //返回值用res存储
            $res = (new StudentModel)->add($_POST);
            //当返回值是真的时候说明数据添加成功
            if($res['code']){
                //弹出成功提示并返回主页
                $this->setRedirect (u('index'))->message ($res['msg']);
            //如果返回的是假
            }else{
                //弹出失败提示并返回上一级页面
                $this->setRedirect ()->message ($res['msg']);
            }
        }
        //通过调用getGradeData方法来获取班级信息
        $getGradeData = $this->getGradeData();
        //通过调用getMaterialData方法来获取素材信息
        $getMaterialData = $this->getMaterialData();
        //加载与方法同名的页面
        //分配变量传入网页中使用
        return View::make()->with(compact('getGradeData','getMaterialData'));
    }

    public function edit()
    {
        //通过获取get值中的mid
        //来判断应该修改数据库中的哪条数据
        $sid = $_GET['sid'];
        //当数据传入方式为POST的时候
        //进入if判断
        if(IS_POST){
            //通过引用命名空间并实例化Student别名
            //调用edit方法来进行数据库添加数据
            //返回值用res存储
            $res = (new StudentModel)->edit($sid,$_POST);
            //当返回值是真的时候说明数据添加成功
            if($res['code']){
                //弹出成功提示并返回主页
                $this->setRedirect (u('index'))->message ($res['msg']);
            //如果返回的是假
            }else{
                //弹出失败提示并返回上一级页面
                $this->setRedirect ()->message ($res['msg']);
            }
        }
        //通过调用getGradeData方法来获取班级信息
        $getGradeData = $this->getGradeData();
        //通过调用getMaterialData方法来获取素材信息
        $getMaterialData = $this->getMaterialData();
        //从数据库中获取与get值相同的那条数据
        //并将其转换成数组用作网页展示
        $oldData = StudentModel::find($sid)->toArray();
        //加载与方法同名的页面
        //分配变量传入网页中使用
        return View::make()->with(compact('getGradeData','getMaterialData','oldData'));
    }

    public function del()
    {
        //通过获取get值中的mid
        //来判断应该删除数据库中的哪条数据
        $sid = $_GET['sid'];
        StudentModel::destory($sid);
        //弹出成功提示并返回主页
        $this->setRedirect(u('index'))->message('删除成功');
    }


    /**
     * 获取班级数据
     * @return array
     */
    public function getGradeData()
    {
        //通过命名空间找表名相同的类名
        //并获取全部数据
        $data = \system\model\Grade::getAll();
        //为了防止报错加入判断
        //如果有数据就将其转换成数组使用，没有数据就返回空数组
        $data = $data ? $data->toArray() : [] ;
        //将获得的数据返回
        return $data;
    }

    /**
     * 获取素材数据
     * @return array
     */
    public function getMaterialData()
    {
        //通过命名空间找表名相同的类名
        //并获取全部数据
        $data = \system\model\Material::getAll();
        //为了防止报错加入判断
        //如果有数据就将其转换成数组使用，没有数据就返回空数组
        $data = $data ? $data->toArray() : [] ;
        //将获得的数据返回
        return $data;
    }



}