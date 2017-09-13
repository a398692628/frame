<?php

namespace system\model;

use houdunwang\model\Model;

class Student extends Model
{
    /**
     * 数据库学生添加方法
     * @param $data     post数据
     * @return array
     */
    public function add($data)
    {
        //判断输入的姓名不能为空
        if (!trim($data['sname'])) return ['code'=>0,'msg'=>'请输入学生姓名'];
        //判断必须选择一个性别
        if (!isset($data['ssex'])) return ['code'=>0,'msg'=>'请选择一个性别'];
        //判断必须选择一个头像
        if (!isset($data['mid'])) return ['code'=>0,'msg'=>'请选择一个头像'];
        //判断必须输入学生年龄
        if (!trim($data['sage'])) return ['code'=>0,'msg'=>'请输入学生年龄'];
        //判断必须选择班级
        if (!$data['gid']) return ['code'=>0,'msg'=>'请选择学生班级'];
        //通过以上判断说明数据可以写入
        //通过调用insert方法传入data数据写入数据
        $this->insert($data);
        //返回成功代码并弹出提示
        return ['code'=>1,'msg'=>'添加成功'];
    }

    /**
     * 学生表修改方法
     * @param $sid      get参数 数据库中第几条数据
     * @param $data     post传入的数据
     * @return array
     */
    public function edit($sid,$data)
    {
        //判断输入的姓名不能为空
        if (!trim($data['sname'])) return ['code'=>0,'msg'=>'请输入学生姓名'];
        //判断必须选择一个性别
        if (!isset($data['ssex'])) return ['code'=>0,'msg'=>'请选择一个性别'];
        //判断必须选择一个头像
        if (!isset($data['mid'])) return ['code'=>0,'msg'=>'请选择一个头像'];
        //判断必须输入学生年龄
        if (!trim($data['sage'])) return ['code'=>0,'msg'=>'请输入学生年龄'];
        //判断必须选择班级
        if (!$data['gid']) return ['code'=>0,'msg'=>'请选择学生班级'];
        //通过以上判断说明数据可以写入
        //通过调用update方法更新与get值相同的数据
        $this->where("sid={$sid}")->update($data);
        //返回成功代码并弹出提示
        return ['code'=>1,'msg'=>'修改成功'];
    }
}