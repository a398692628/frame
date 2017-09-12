<?php

namespace houdunwang\model;

//根里面找系统函数
use PDOException;
use Exception;
use PDO;

class Base
{
    //创建静态属性
    //存储返回的对象
    private static $pdo = null;
    //用来存储表名的属性
    private $table;
    //设置一个where属性来存储where条件
    //默认为空字符串
    private $where = '';

    private $data;

    private $field = '';

    private $order = '';

    /**
     * 构造函数
     * Base constructor.
     * @param $class        加载表路径
     */
    public function __construct($class)
    {
        //dd($class);
        //检测数据库是否登录成功
        //判断为静态属性是否有值
        if (is_null(self::$pdo)) {
            //如果为空
            //调用此类里面的connet方法来登录数据库
            self::connet();
        }
        //获取表路径
        //并截取成需要的表的名称
        $info = strtolower(ltrim(strrchr($class, '\\'), '\\'));
        //将获取到的表的名称存储到属性内
        //以便接下来取用
        $this->table = $info;
    }

    /**
     * 连接数据库方法
     * @throws Exception
     */
    public static function connet()
    {
        try {
            //通过助手函数里面的c函数来获取需要的登录数据
            $dsn = c('database.driver') . ":host=" . c('database.host') . ";dbname=" . c('database.dbname');
            $user = c('database.user');
            $password = c('database.password');
            //实例化系统自带的类
            //实现登录数据库
            self::$pdo = new PDO($dsn, $user, $password);
            //将编码设置成为utf-8
            self::$pdo->query('set names utf8');
            //设置错误提示方式为抛出异常
            //ATTR_ERRMODE错误提示模式        ERRMODE_EXCEPTION错误提示方式为抛出异常
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo 1;
            //以上代码运行有错误的时候报出错误
        } catch (PDOException $e) {
            //获取错误信息
            throw new Exception($e->getMessage());
        }
    }

    /**
     * 无结果集的查询
     * @param $sql          要查询的sql语句
     * @return mixed        返回自增主键值
     * @throws Exception
     */
    public function exec($sql)
    {
        try{
            //调用系统自带的无结果集查询
            //将其存入$res
            $res = self::$pdo->exec($sql);
            //当写入成功时说明就有主键增加
            //这时进入if判断
            if ($lastInsertId = self::$pdo->lastInsertId()){
                //返回增加的主键值
                return $lastInsertId;
            }
            //如果没有返回一个报错
            return $res;
        //当try里面的代码错误进入catch
        //设置一个错误提示消息
        }catch (PDOException $e){
            //实例化Exception并调用获取错误信息
            throw new Exception($e->getMessage());
        }
    }

    /**
     * 查询表数据方法
     * @param $id       要查询的第几条数据
     * @return mixed
     */
    public function find($id)
    {
        //获取主键获取主键字段名
        //为此创建、调用获取主键方法
        $pk = $this->getPk();
        //在这里加入where条件
        $this->where("$pk={$id}");
        //将sql语句中的*变成可变的
        $field = $this->field ?: "*";
        //通过获取的表名称、主键、以及传入的参数来拼接sql语句
        $sql = "select {$field} from {$this->table} {$this->where}";
        //没有查询方法，在这里创建有结果集的查询方法
        //调用此类中的query方法来查询
        //返回一个对象存入变量
        $data = $this->query($sql);
        //当变量有值的时候
        //进入if判断代码运行
        if (!empty($data)) {
            //将其变成一个一维数组
            $this->data = current($data);
            return $this;
        }
        //将其变为一维数组
        //并作为一个返回值返回
        return current($data);

    }

    /**
     * where条件查询
     * @param $where    要查询的条件
     * @return $this
     */
    public function where($where)
    {
        //将输入的查询条件拼接
        //存储到where属性保存
        $this->where = "where {$where}";
        return $this;
    }

    /**
     * 指定字段查询
     * @param $field    要查询的字段
     * @return $this
     */
    public function field($field)
    {
        //将传入的字段名存入field属性
        //以便调用查询
        $this->field = $field;
        return $this;
    }

    /**
     * 获取所有数据
     * @return $this|array
     */
    public function getAll()
    {
        //调用field属性
        //如果field有值就用他 没有值的话默认为*
        //存储起来作为字段查询的条件
        $field = $this->field ?: "*";
        //组成sql语句
        //用到field元素、table属性、与where属性组成
        $sql = "select {$field} from {$this->table} {$this->where} {$this->order}";
        //调用query方法
        //输入sql语句完成查询
        $data = $this->query($sql);
        //当有值的时候进入if判断
        if (!empty($data)) {
            //将值存入data属性
            $this->data = $data;
            return $this;
        }
        //如果没有值就返回一个空数组
        //为了防止报错
        return [];
    }

    /**
     * 将对象转换成需要的数组
     * @return array
     */
    public function toArray()
    {
        //当data属性不是空的时候
        if ($this->data) {
            //返回该数组
            return $this->data;
        }
        //空的时候返回一个空数组
        return [];
    }

    /**
     * 获取主键字段名
     */
    public function getPk()
    {
        //查看表结构
        //因为要获取表名所以添加一个属性存储表名
        //拼接一个sql语句用来获取表结构
        $sql = "desc " . $this->table;
        //查询需要运行查询有结果的方法所以创建一个查询有结果集的方法
        $data = $this->query($sql);
        //设置一个空变量为空的字符串
        //用来接收获取的主键字段名称
        $pk = '';
        //通过foreach循环获得的结果集
        //通过键值来判断主键名称
        foreach ($data as $v) {
            //当键值为key的键值有PRI时判断这数据为主键
            if ($v['key'] = 'PRI') {
                //Field为这条数据的名称
                //将其存入变量pk；
                $pk = $v['Field'];
                //dd($v);die;
                //并且跳出foreach循环
                break;
            }
        }
        //将pk作为返回值返回
        return $pk;
    }

    /**
     * 有结果集的的查询方法
     * @param $sql          要查询的sql语句
     * @return mixed        返回的结果集
     * @throws Exception
     */
    public function query($sql)
    {
        try {
            //调用query方法来查询传入的sql语句
            //将其存入一个变量
            $res = self::$pdo->query($sql);
            //取出结果集
            //将其变成返回值返回
            return $row = $res->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * 写入数据
     * @param $data     要写入的数据
     * @return mixed
     */
    public function insert($data)
    {
        //dd($data);
        //设置一个空的字符串变量存储字段
        $fields = '';
        //设置一个空的字符串变量存储值
        $values = '';
        //forea循环传入的数据
        //获得其键值与键名
        foreach ($data as $k=>$v)
        {
            //dd($v);
            //向fields变量添加循环获得键名
            //组成字段添加,
            $fields .= $k . ',';
            //如果键名是数字的时候
            //说明不用添加引号
            //所以添加if判断
            if (is_int($v)){
                //是数字的情况下
                //向values里添加键名与,
                $values .= $v . ',';
            }else{
                //不是数字的情况下
                //向values里添加键值与,
                $values .= "'$v'" . ",";
            }
            //dd($fields);
            //dd($values);
        }
        //处理两个变量截取处理过的变量后多余的,
        $fields = rtrim($fields,',');
        $values = rtrim($values,',');
        //dd($fields);
        //dd($values);
        //组成sql语句
        $sql = "insert into {$this->table} ($fields) values ($values)";
        //dd($sql);die;

        //执行无结果集的查询
        //并将起返回值返回
        return $this->exec($sql);
    }

    /**
     * 更新数据
     * @param array $data   要更新的数据
     * @return bool|mixed
     */
    public function update(array $data)
    {
        //为了防止全部数据更新
        //如果没有where条件返回false
        if (empty($this->where)) return false;
        //设置一个空的变量
        //存储要更新的字段与内容
        $fields = '';
        //foreach循环传入的数据
        foreach ($data as $k=>$v){
            //键名是数字的时候
            //判断不用加引号
            if (is_int($v)){
                //向变量添加要更新的字段内容
                //，号隔开
                $fields = "$k=$v" . ",";
            }else{
                //如果不是数组
                //将$v引号引起来作为值
                $fields = "$k='$v'" . ",";
            }
        }
        //整理修改后的变量
        //去除最后一个逗号
        $fields = rtrim($fields,',');
        //dd($fields);
        //拼接sql语句
        $sql = "update {$this->table} set {$fields} {$this->where}";
        //执行无结果集的查询方法
        return $this->exec($sql);
    }

    /**
     * 删除数据
     * @param string $pk    删除第几条数据
     * @return bool|mixed
     */
    public function destory($pk = '')
    {
        //如果有where条件或者有值传入
        //才能进入if判断
        //为了防止将数据全部删除
        if($this->where||$pk){
            //如果where条件是空的时候
            //这时就要判断删除第几条数据
            if (empty($this->where)){
                //获取主键名称
                $prikey = $this->getPk();
                //组成where语句
                $this->where("{$prikey}={$pk}");
                //dd($this->where);die;
            }
            //拼接sql执行删除语句语句
            $sql = "delete from {$this->table} {$this->where}";
            //dd($sql);
            //执行无结果集的查询方法
            return $this->exec($sql);
        }else{
            //如果没有where条件或者数据传入
            //返回false阻止删除
            return false;
        }
    }

    /**
     * 统计数据
     * @return mixed
     */
    public function count()
    {
        //组成sql语句起一个别名num
        $sql = "select count(*) as num from {$this->table} {$this->where}";
        //进行有结果集的查询
        $data = $this->query($sql);
        //返回数据中的0号元素中num的那条数据
        return $data[0]['num'];
    }

    /**
     * @param $order    传入orderby条件
     * @return $this
     */
    public function orderBy($order)
    {
        $this->order = "order by " . $order;
        return $this;
    }
}