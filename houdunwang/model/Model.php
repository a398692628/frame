<?php
namespace houdunwang\model;

//模型类M跳板
class Model
{
    public function __call($name, $arguments)
    {
        return self::paresAction($name, $arguments);
    }

    public static function __callStatic($name, $arguments)
    {
        return self::paresAction($name, $arguments);
    }

    public static function paresAction($name, $arguments)
    {
        //get_call_class函数返回调用的类名
        //当前调用的类名
        $class = get_called_class();
        return call_user_func_array([new Base($class),$name],$arguments);
    }


}


