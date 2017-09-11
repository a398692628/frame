<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>密码修改系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="./static/bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="./static/css/site.css" rel="stylesheet">
    <link href="./static/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="./static/js/jquery.min.js"></script>
    <script src="./static/bs3/js/bootstrap.min.js"></script>
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/r29/html5.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        if (navigator.appName == 'Microsoft Internet Explorer') {
            if (navigator.userAgent.indexOf("MSIE 5.0") > 0 || navigator.userAgent.indexOf("MSIE 6.0") > 0 || navigator.userAgent.indexOf("MSIE 7.0") > 0) {
                alert('您使用的 IE 浏览器版本过低, 推荐使用 Chrome 浏览器或 IE8 及以上版本浏览器.');
            }
        }
    </script>
    <style>
        i {
            color: #337ab7;
        }
    </style>
</head>
<body>
<div class="container-fluid admin-top">
    <!--导航-->
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <h4 style="display: inline;line-height: 50px;float: left;margin: 0px"><a href="index.html" style="color: white;margin-left: -14px">密码修改页</a>
                </h4>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="fa fa-w fa-user"></i>
                            admin
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="changePass.html">修改密码</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="">退出</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!--导航end-->
</div>
<!--主体-->
<div class="container-fluid admin_menu" >
    <div class="row">
        <!--右侧主体区域部分 start-->
        <div style="width: 45%;margin: 0px auto;">
            <!-- TAB NAVIGATION -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#tab1" >密码修改</a></li>
            </ul>
            <form action="" method="POST" class="form-horizontal" role="form">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">密码修改</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">原始密码</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="admin_password" placeholder="" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">修改密码</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="admin_password_new1" placeholder="" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">再次输入</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control"  name="admin_password_new2"placeholder="" value="">
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary">修改密码</button>
            </form>
        </div>
    </div>
    <!--右侧主体区域部分结束 end-->
</div>
</div>
<div class="master-footer" style="margin-top: 150px">
<!--    <a href="http://www.wubin.pro">武斌博客</a>-->
    <br>
    Powered by wubin.pro v2.0 © 2017 http://www.wubin.pro
</div>
</body>
</html>
