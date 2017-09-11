<?php
namespace app\admin\controller;

use houdunwang\core\Controller;
use houdunwang\view\View;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use system\model\Admin;

class Login extends Controller
{
    /**
     * 登录
     * @return mixed
     */
    public function index()
    {
        //u('asd.asd');
        //dd($_SESSION);die;
        //当数据传入的方式为post的时候
        //进入if判断
        if (IS_POST){
            //dd($_POST);
            //实例化Admin并调用login方法
            //实现登录
            $res = (new Admin())->login($_POST);
            //dd($res);die;
            //当返回的code代码是真的时候
            //进入if判断
            if ($res['code']){
                //跳转至管理页面并弹出提示
                $this->setRedirect(u('entry.index'))->message($res['msg']);
            //code代码是假的时候
            }else{
                //返回登录页面并弹出提示
                $this->setRedirect()->message($res['msg']);
            }
        }
        //调用make方法
        //加载登录页面
        return View::make();
    }

    /**
     * 获取验证码方法
     */
    public function captcha()
    {
        //compact搜索captcha
        //根据步骤添加代码
        header('Content-type: image/jpeg');
        $phraseBuilder = new PhraseBuilder(4);
        $builder = new CaptchaBuilder(null,$phraseBuilder);
        $builder->build ();
        $_SESSION['phrase'] = $builder->getPhrase();
        $builder->output ();
    }
}