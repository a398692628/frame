<?php

namespace houdunwang\view;
//v类跳转板
class View
{
    /**
     * 调用普通的方法的时候
     * @param $name         不存在的方法明
     * @param $arguments    方法的参数
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        //调用parseAction传参
        return self::parseAction($name, $arguments);
    }

    /**
     * 调用静态方法的时候
     * @param $name         不存在的静态方法
     * @param $arguments    方法的参数
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        //调用parseAction传参
        return self::parseAction($name, $arguments);
    }

    /**
     * @param $name         方法名
     * @param $arguments    方法的参数
     * @return mixed
     */
    public static function parseAction($name, $arguments)
    {
        //根据函数call_user_func_array实例化同命名空间内的Base类
        //并调用传入的方法名以及方法参数
        return call_user_func_array([new Base, $name], $arguments);
    }
}