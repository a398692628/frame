<?php

namespace system\model;

use houdunwang\model\Model;

class Grade extends Model
{

    /**
     * 数据添加方法
     * @param $data     从网页中获取的post数据
     * @return array
     */
    public function add($data)
    {
        //判断post中的值不能为空
        //如果为空返回代码0并提示
        if (!trim($data['gname'])) return ['code'=>0,'msg'=>'请输入班级名称'];
        //尝试获取数据库中与post数据中gname同名的那条数据
        $gradeData = $this->where("gname='{$data['gname']}'")->getAll();
        //如果有这条数据说明数据库中已经拥有同名的班级
        //为了数据不同命返回0并提示错误
        if ($gradeData) return ['code'=>0,'msg'=>'您输入的班级名重复'];
        //通过以上验证说明数据没有问题
        //调用insert方法写入数据
        $this->insert($data);
        //写入成功后返回1并提示成功
        return ['code'=>1,'msg'=>'添加成功'];
    }

    /**
     * 数据删除方法
     * @param $gid      get参数中的gid参数
     * @param $data     通过post传输的数据
     * @return array
     */
    public function edit($gid,$data)
    {
        //判断post中的值不能为空
        //如果为空返回代码0并提示
        if (!trim($data['gname'])) return ['code'=>0,'msg'=>'请输入班级名称'];
        //尝试获取数据库中与post数据中gname同名的那条数据
        //不包括用户输入的那条数据
        $gradeData = $this->where("gname='{$data['gname']}' and gid != {$gid}")->getAll();
        //dd($gradeData);die;
        //如果有这条数据说明数据库中已经拥有同名的班级
        //为了数据不同命返回0并提示错误
        if ($gradeData) return ['code'=>0,'msg'=>'班级名已存在'];
        //调用update方法更新数据库中gid为get数据传入的gid值一样的那条数据
        $res = $this->where("gid={$gid}")->update($data);
        //dd($res);die;
        //如果数据更新后会返回真
        if ($res){
            //这证明数据更新成功
            //返回1真并弹出成功提示
            return ['code'=>1,'msg'=>'数据更新成功'];
        }
        //否则数据就是没有更新
        //修改的数据与原来的一样
        //返回假并弹出数据未更新提示
        return ['code'=>0,'msg'=>'数据未更新'];
    }
}