<?php

namespace app\admin\controller;

use houdunwang\view\View;
use system\model\Material as MaterialModel;

class Material extends Common
{
    /**
     * 数据展示页
     * @return mixed
     */
    public function index()
    {
        //$data = [];
        //获取Material里面的数据
        //引入命名空间 再通过继承调用了getAll方法
        //用作页面展示
        $data = MaterialModel::getAll();
        //当没有数据时
        //为了防止报错设定的判断条件
        //当数据不是空的时候将数据变成数组
        //没有数据的时候返回一个空数组
        $data = $data ? $data->toArray() : [] ;
        //加载网页并分配变量
        //不分配不能使用
        return View::make()->with(compact('data'));
    }

    /**
     * 素材添加方法
     * @return mixed
     */
    public function add()
    {
        //当数据传入方式为POST的时候
        //进入if判断
        if (IS_POST){
            //dd($_POST);
            //通过引用命名空间并实例化Material别名
            //调用add方法来进行数据库添加数据
            //返回值用res存储
            $res = (new MaterialModel())->add();
            //dd($res['code']);die;
            //当返回值是真的时候说明数据添加成功
            if ($res['code']){
                //弹出成功提示并返回主页
                $this->setRedirect(u('index'))->message($res['msg']);
            //如果返回的是假
            }else{
                //弹出失败提示并返回上一级页面
                $this->setRedirect()->message($res['msg']);
            }
        }
        //加载与方法同名的页面
        return View::make();
    }

    /**
     * 素材删除方法
     */
    public function del()
    {
        //通过获取get值中的mid
        //来判断应该删除数据库中的哪条数据
        $mid = $_GET['mid'];
        //从数据库中调取与get值中mid相同的数据并将对象转换成数组
        $data = MaterialModel::find($mid)->toArray();
        //删除同时删除文件
        //判断数据中存储路径是否有图片
        if(file_exists ($data['mpath'])){
            //如果有图片
            //删除图片
            unlink ($data['mpath']);
        }
        //删除与get数据相同的数据库中的数据
        MaterialModel::destory($mid);
        //弹出成功提示并返回主页
        $this->setRedirect(u('index'))->message('删除成功');
    }

}