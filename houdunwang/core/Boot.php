<?php
//命名空间与路径一样
//使用类前要添加上路径
namespace houdunwang\core;

class Boot
{
    /**
     * 上一步在public\index.php里
     * 执行应用
     */
    public static function run()
    {
        self::handler();
        //dd(1);
        //打印测试失败调整composer.json打印成功
        //初始化框架
        //调用静态方法init
        //就在这个类里 不用加路径
        self::init();
        //执行应用
        //控制app文件夹里面的控制类
        //在app\home\controller里面创建控制类Entry.php
        //目的通过地址栏参数控制?s=home/entry/add
        self::appRun();
    }

    private static function handler()
    {
        $whoops = new \Whoops\Run;
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
        $whoops->register();
    }

    /**
     * 上一步为这个类里面的run方法里
     * 执行应用
     */
    public static function appRun()
    {
        //检测地址栏有没有参数s
        //有参数进入if判断运行
        if (isset($_GET['s'])) {
            //dd($_GET['s']);
            //通过手动输入地址栏参数s 打印可以获得地址栏s参数
            //将地址栏参数根据/转化成为一个数组
            //目的是分开控制?s=home/entry/add各个参数
            $info = explode('/', $_GET['s']);
            //dd($info);
            //打印测试成功可以获得数组
            //将数组中元素替换进s参数里面用来控制应用的执行
            //测试手动输入地址栏?s=home/entry/index可以执行Entry里面的方法
            $class = "\app\\{$info[0]}\controller\\" . ucfirst($info[1]);
            //测试手动输入地址栏?s=home/entry/index可以执行Entry里面的方法
            $action = $info[2];
            //将三个参数转换成常量以便以后使用
            define('MODULE', $info[0]);
            define('CONTROLLER', $info[1]);
            define('ACTION', $info[2]);
            //无参数进入else判断
            //当地址栏没有s参数时候给一个默认值
        } else {
            //实例化\app\home\controller\里面的Entry类
            $class = "\app\home\controller\Entry";
            //调用方法index
            $action = "index";
            //测试可以执行赋予的默认值
            //将三个参数转换成常量设置成默认值
            define('MODULE', 'home');
            define('CONTROLLER', 'entry');
            define('ACTION', 'index');
        }
        //函数call_user_func_array第一个参数是要实例化的类名与要调用的方法，第二个参数必须要有留空也要有
        echo call_user_func_array([new $class, $action], []);
    }


    /**
     * 上一步为这个类里面的run方法里
     * 初始化框架
     */
    public static function init()
    {
        //dd(2);
        //打印测试可以执行
        //声明头部
        //如果不生命头部可能导致显示乱码
        header('Content-type:text/html;charset=utf8');
        //设置时区
        //不设置时区可能导致时间出错  这里地区暂时设置为国内时间 以后提参数
        date_default_timezone_set('PRC');
        //开启session
        //这里加入判断 如果有session_id就不必再次开启session
        session_id() || session_start();
        //dd(1);
    }
}