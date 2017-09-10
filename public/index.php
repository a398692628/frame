<?php
/**
 * 入口文件
 */

//加载一次自动加载文件
//将自动加载类
require_once '../vendor/autoload.php';
//静态调用方法
//houdunwang\core\Boot空间里类的方法
//直接调用会出错需要修改composer.json文件
//这时在houdunwang\core\里面创建类Boot
\houdunwang\core\Boot::run();