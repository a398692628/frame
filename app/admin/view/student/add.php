<?php include "../app/admin/view/common/header.php"?>

<!--右侧主体区域部分 start-->
		<div class="col-xs-12 col-sm-9 col-lg-10">
			<!-- TAB NAVIGATION -->
            <!-- TAB NAVIGATION -->
            <ul class="nav nav-tabs" role="tablist">
                <li ><a href="<?php echo u('index')?>" >学生列表</a></li>
                <li class="active"><a href="<?php echo u('add')?>" >学生添加</a></li>
            </ul>
            <form action="" method="POST" class="form-horizontal" role="form">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">学生添加</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">学生姓名</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="sname" id="" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">学生性别</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                	<label>
                                		<input type="radio" name="ssex" value="男" checked="checked">男
                                	</label>
                                    <label>
                                        <input type="radio" name="ssex" value="女" >女
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">选择头像</label>
                            <div class="col-sm-10">
                                    <?php foreach($getMaterialData as $k=>$v):?>
                                    <li style="list-style: none;float: left;margin-right: 5px;overflow: hidden;border: 1px solid red">
                                        <input type="radio" name="mid" value="<?php echo $v['mid']?>">
                                        <img style="width: 80px;height: 80px" src="<?php echo $v['mpath']?>" alt="">
                                    </li>
                                    <?php endforeach ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">学生年龄</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="sage" id="" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">所在班级</label>
                            <div class="col-sm-10">
                                <select name="gid" id="inputID" class="form-control">

                                	<option value="0"> -- Select One -- </option>
                                    <?php foreach($getGradeData as $v):?>
                                	<option value="<?php echo $v['gid']?>"> -- <?php echo $v['gname']?> -- </option>
                                	<?php endforeach?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary">提交</button>
            </form>


        </div>
<?php include "../app/admin/view/common/footer.php"?>

