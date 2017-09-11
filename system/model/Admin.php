<?php
namespace system\model;

use houdunwang\model\Model;

class Admin extends Model
{
    /**
     * 登录方法
     * @param $data     输入的表单数据
     * @return array
     */
    public function login($data)
    {
        //dd(password_hash('admin888',PASSWORD_DEFAULT));die;
        //dd($data);die;
        //获取post传入的用户名
        //将值存入变量
        $admin_username = $data['admin_username'];
        //获取post传入的密码
        //将值存入变量
        $admin_password = $data['admin_password'];
        //获取post传入的验证码
        //将值存入变量
        $captcha = $data['captcha'];
        //验证用户名
        //当用户名为空的时候返回错误代码并弹出提示
        if (!trim($admin_username)) return ['code'=>0,'msg'=>'请输入用户名'];
        //验证密码
        //当用密码为空的时候返回错误代码并弹出提示
        if (!$admin_password) return ['code'=>0,'msg'=>'请输入密码'];
        //验证验证码
        //当验证码为空的时候返回错误代码并弹出提示
        if (!trim($captcha)) return ['code'=>0,'msg'=>'请输入验证码'];
        //当上面的验证通过时
        //尝试从数据库中调取与用户输入的用户名一样的那条数据
        $userInfo = $this->where("admin_username='{$admin_username}'")->getAll();
        //dd($userInfo);die;
        //判断数据是否存在
        //如果数据不存在的时候返回错误代码并弹出提示
        if (!$userInfo) return ['code'=>0,'msg'=>'您输入的用户名不存在'];
        //上面验证都通过时说明数据存在
        //将调出的数据转换成需要的数组
        $userInfo = $userInfo->toArray();
        //dd($userInfo);die;
        //比对输入的密码与数据库中的密码
        //使用password_verify函数比对两条数据的哈希值
        //当两条数据哈希值不相同的时候返回错误代码并弹出提示
        if (!password_verify($admin_password,$userInfo[0]['admin_password'])) return ['code'=>0,'msg'=>'您输入的密码不正确'];
        //比对session中的验证码与输入的验证码
        //当两条数据不相同的时候返回错误代码并弹出提示
        if (strtolower($captcha) != strtolower($_SESSION['phrase'])) return ['code'=>0,'msg'=>'您输入的验证码不正确'];
        //dd($userInfo);die;
        //以上验证通过时说明验证通过了
        //将其id值存入session
        //用来验证是否登录
        $_SESSION['admin_id'] = $userInfo[0]['id'];
        //将其用户名存入session
        //页面显示使用
        $_SESSION['admin_username'] = $userInfo[0]['admin_username'];
        //dd($_SESSION);die;
        //以上验证都通过说明登录成功
        return ['code'=>1,'msg'=>'登录成功'];
    }

    /**
     * 修改密码方法
     * @param $data     输入的表单数据
     * @return array
     */
    public function edit($data){
        //dd($data);die;
        //获取post传入的密码
        //将值存入变量
        $admin_password_new2=$data['admin_password'];
        //获取post传入的旧密码
        //将值存入变量
        $admin_password_new1=$data['admin_password_new1'];
        //获取post传入的新密码1
        //将值存入变量
        $admin_password=$data['admin_password_new2'];
        //获取post传入的新密码2
        //将值存入变量
        $userinfo = $_SESSION['admin_username'];
        //dd($info);die;
        //设置验证验证旧密码
        //值不能为空
        if (!$admin_password_new2) return ['code'=>0,'msg'=>'请输入原始密码'];
        //设置验证验证新密码1
        //值不能为空
        if (!$admin_password_new1) return ['code'=>0,'msg'=>'请输入修改密码'];
        //设置验证验证新密码2
        //值不能为空
        if (!$admin_password) return ['code'=>0,'msg'=>'请输入第二次修改密码'];
        //以上验证通过根据session里面存储的用户名从数据库中调取数据
        $info = $this->where("admin_username='{$userinfo}'")->getAll()->toArray();
        //dd($info);die;
        //比对旧密码与输入的旧密码
        //当两个值的哈希值不同的时候返回错误代码并弹出提示
        if (!password_verify($admin_password_new2,$info[0]['admin_password'])) return ['code'=>0,'msg'=>'您输入的初始密码不正确'];
        //比对输入的新密码1与数据库中的旧密码
        //结果不能相同，相同的时候返回错误代码并弹出提示
        if (password_verify($admin_password_new1,$info[0]['admin_password'])) return ['code'=>0,'msg'=>'请修改与初始密码不同的密码'];
        //比对输入的新密码1与新密码2
        //两个结果不相同的时候返回错误代码并弹出提示
        if ($admin_password_new1!=$admin_password) return ['code'=>0,'msg'=>'您两次输入的密码不一致'];
        //dd($admin_password);die;
        //以上验证通过时说明密码可以修改
        //将修改的密码转换成哈希值
        $admin_password = password_hash($admin_password,PASSWORD_DEFAULT);
        //dd($admin_password);die;
        //通过compact函数将变量的名字变成键值，将变量值变成键值
        $password = compact('admin_password');
        //dd($password);
        //$password = password_hash($password['admin_password_new2'],PASSWORD_DEFAULT);
        //dd($password);die;
        //通过继承的方法更新数据库数据
        //条件是与session值相同的那条数据
        //变更其密码为新输入的密码
        $this->where("admin_username='{$userinfo}'")->update($password);
        //返回一个布尔值为true的代码并弹出成功提示
        return ['code'=>1,'msg'=>'密码修改成功,将返回登录页面'];
    }



}