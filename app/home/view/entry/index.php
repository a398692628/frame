<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>c86学生管理系统</title>
    <link rel="stylesheet" href="./static/bs3/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title" style="display: inline-block">学生列表</h3>
                <a class="btn btn-primary btn-xs" style="float: right; display: inline-block" href="?s=admin/entry/index">管理</a>
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>学生编号</th>
                        <th>学生姓名</th>
                        <th>学生头像</th>
                        <th>学生年龄</th>
                        <th>学生性别</th>
                        <th>学生班级</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($data as $v):?>
                        <tr>
                            <td><?php echo $v['sid']?></td>
                            <td><?php echo $v['sname']?></td>
                            <td><img style="width: 50px;height: 50px" src="<?php echo $v['mpath']?>" alt=""></td>
                            <td><?php echo $v['sage']?></td>
                            <td><?php echo $v['ssex']?></td>
                            <td><?php echo $v['gname']?></td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>

