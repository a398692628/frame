<?php
//命名空间为文件所在路径
//方便管理控制
namespace app\home\controller;

use houdunwang\core\Controller;
use houdunwang\view\View;
use system\model\Student;


//继承Controller类里面的方法属性
class Entry extends Controller
{
    public function index()
    {
        //通过三表关联获取所有需要的数据
        //调用query方法输入原生sql语句查询
        $data = Student::query("select * from student s join grade g on s.gid = g.gid join material m on s.mid = m.mid");
        //调用与方法同名的模版
        //分配变量在网页中使用
        return View::make()->with(compact('data'));

    }
}