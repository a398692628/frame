<?php

namespace houdunwang\view;

class Base
{
    //设置一个属性存入要分配的变量
    protected $data = [];
    //设置一个属性存入要加载的模版路径
    protected $file;

    /**
     * 分配变量方法
     * @param $var      要分配的变量
     * @return $this
     */
    public function with($var)
    {
        //将传入的变量存入data属性
        //以方便在类中使用
        $this->data = $var;
        return $this;
    }

    /**
     * 加载模版方法
     * @return $this
     */
    public function make()
    {
        //将之前设置的常量与模版位置拼接起来
        //调用c函数判断模版的后缀
        //存入file属性
        $this->file = "../app/" . MODULE . "/view/" . strtolower(CONTROLLER) . "/" . ACTION . "." . c('view.suffix');
        return $this;
    }

    /**
     * 当输出对象的时候触发的函数
     * @return string
     */
    public function __toString()
    {
        //加载与变量必须在一起
        //否则变量不能使用
        //extract函数将变量名变成键名
        //值变成键值
        extract($this->data);
        //加载模版
        include $this->file;
        return '';
    }
}