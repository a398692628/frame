<?php

namespace system\model;

use houdunwang\model\Model;

class Material extends Model
{
    /**
     * 数据添加方法
     * @return array
     */
    public function add()
    {
        //dd(current($_FILES));die;
        //将上传的文件数据数组指向第一个值
        $file =current($_FILES);
        //如果里面的error==4说面没有文件上传
        //返回0并报错
        if ($file['error']==4) return ['code'=>0,'msg'=>'没有上传文件'];
        //如果通过上面验证
        //通过调用upload方法上传数据
        //接收返回值
        $res = $this->upload();
        //返回值的code代码是假的时
        //返回错误信息
        if (!$res['code']) return ['code'=>'0','msg'=>$res['msg'][0]];
        //根据存储的路径创建一个数组
        //该数组就是要写入数据库的数组
        $data = [
            //存储路径
            'mpath'=>$res['path'],
            //存储当前时间戳
            'mtime'=>time(),
        ];
        //通过调用写入方法写入数据
        $this->insert($data);
        //返回成功代码并弹出提示
        return ['code'=>1,'msg'=>'添加成功'];

    }

    /**
     * 上传方法
     * @return array
     */
    public function upload()
    {
        //组成文件夹路径
        $dir = "upload/" . date("Y/m/d");
        //检测文件夹是否存在
        //如果不存在就根据上面组成的路径创建一个文件夹
        is_dir($dir) || mkdir($dir,0777,true);
        //以下为下载的插件
        //根据插件介绍增加
        $storage = new \Upload\Storage\FileSystem($dir);
        $file = new \Upload\File('mpath', $storage);
        $new_filename = uniqid();
        $file->setName($new_filename);
        $file->addValidations(array(
            // Ensure file is of type "image/png"
            //new \Upload\Validation\Mimetype(['image/png','image/jpg','image/jpeg']),

            //You can also add multi mimetype validation
            //new \Upload\Validation\Mimetype(array('image/png', 'image/gif'))

            // Ensure file is no larger than 5M (use "B", "K", M", or "G")
            new \Upload\Validation\Size('5M')
        ));
        $data = array(
            'name'       => $file->getNameWithExtension(),
            'extension'  => $file->getExtension(),
            //'mime'       => $file->getMimetype(),
            'size'       => $file->getSize(),
            //'md5'        => $file->getMd5(),
            //'dimensions' => $file->getDimensions()
        );
        try {
            // Success!
            $file->upload();
            //将路径返回去
            return ['code'=>1,'msg'=>'','path'=>$dir . '/' . $data['name']];
        } catch (\Exception $e) {
            // Fail!
            $errors = $file->getErrors();
            return ['code'=>0,'msg'=>$errors];
        }

    }
}