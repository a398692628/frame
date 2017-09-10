<?php
//命名空间为文件所在路径
//方便管理控制
namespace app\home\controller;

//加载类通过修改composer.json
//上一步为houdunwang\core\里面Boot类的addrun方法
use houdunwang\core\Controller;
use houdunwang\model\Model;
use houdunwang\view\View;
use system\model\Stu;


//继承Controller类里面的方法属性
//用来跳转提示信息
class Entry extends Controller
{
    //这里两个方法做测试用
    //通过改变地址栏参数来调用不同的方法
    public function index()
    {
        //------------getAll获取所有数据
        //$data = Stu::getAll()->toArray();
        //dd($data);
        //------------where条件
        //$data = Stu::where('age>2 and sex="女"')->getAll()->toArray();
        //dd($data);
        //------------field指定字段查询
        //$data = Stu::field('name')->find(1)->toArray();
        //dd($data);
        //------------insert写入数据
//        $ary =
//            [
//                'name'=>'赵四',
//                'age'=>18,
//            ];
        //$data = Stu::insert($ary);
        //dd($data);
        //------------updata上传数据
//        $ary =
//        [
//          'hobby' => '玩',
//        ];
        //$data = Stu::where('id=1')->update($ary);
        //dd($data);
        //------------delete删除数据

        //Stu::where('id=1')->destory();
        //Stu::destory(1);
        //------------count统计数据
        //Stu::where("age>22")->count();

        //------------order by排序
        //$data = Stu::where('id>3')->orderBy('age');
        //$data = Stu::where('id>3')->orderBy();
        //dd($data);
    }

    public function add()
    {
        //链式
        //继承父级方法
        //调用setRedirect方法必须要返回一个对象 否则message无法调用
        //所以在setRedirect方法中加入返回值$this，并将参数url变成属性
        //$this->setRedirect()->message('添加成功');
    }
}