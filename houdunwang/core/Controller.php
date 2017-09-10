<?php

namespace houdunwang\core;
//构建控制起层C
//作用于加载消息提示页面以及定时跳转功能
//Boot.php完成后构建
class Controller
{
    //设置属性url在message页面中使用
    //并给一个默认值返回上级页面
    private $url = "window.history.back";

    /**
     * @param $message      要在页面上显示的消息
     */
    public function message($message)
    {
        //加载提示信息页面
        //参数$message在页面中显示
        include './view/message.php';
        //die结束掉代码运行
        die;
    }

    /**
     * @param string $url  输入想要跳转的地址
     * @return $this       返回$this使方法变成对象
     */
    public function setRedirect($url = '')
    {
        //当参数为空的时候
        //给方法一个默认的返回上一级页面
        if (empty($url)) {
            //设置成history.back返回历史上一级页面
            //将接收的变成一个属性
            $this->url = "window.history.back()";
        //当有参数传入时
        //跳转地址为参数中的地址
        } else {
            //通过location.herf跳转
            //传的参数变为跳转连接
            $this->url = "location.href='$url'";
        }
        //将方法设置成一个对象
        //加入return $this
        return $this;
    }

}