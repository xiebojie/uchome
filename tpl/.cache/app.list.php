<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="icon" href="/style/images//favicon.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <title><?php echo htmlspecialchars(empty($title)?'uchome':$title);?></title>
        <link href="/style/bootstrap.min.css" rel="stylesheet"/>
        <link href="/style/bootstrap.datepicker.css" rel="stylesheet"/>
        <link href="/style/ucbase.css" rel="stylesheet"/>
        <script src="/script/jquery.min.js"></script>
    </head>
    <body>
        <div class="navbar" style="background:#428bca;border-radius: 0px;margin: 0px">
            <div class="navbar-brand" style="font-size:28px;color:#fff">uchome</div>
              <div class="pull-right whoami">
                   <a class="dropdown-toggle" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-user"></span><?php echo htmlspecialchars(empty($username)?'':$username);?>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="/user/logout">退出</a></li>
                </ul>
              </div>
        </div>
        <div>
            <div class="leftpanel">
                <ul class="nav" >
                    <li style="border-top: 0.5px solid #e7e7e7">
                        <a href="/"><i class="glyphicon glyphicon-home"></i>首页</a>
                    </li>
           
                   <li class="parent"><a href="/app/list">应用列表</a></li>
                            <li class="parent"><a href="/app/form">添加应用</a></li>
                        <li class="parent"><a href="/role/list">角色列表</a></li>
                        <li class="parent"><a href="/role/form">添加角色</a></li>
                        <li class="parent"><a href="/route/list">路由列表</a></li>
                        <li class="parent"><a href="/route/form">添加路由</a></li>
                        <li class="parent"><a href="/route/grant">路由授权</a></li>
                   
                <li class="parent"><a href="/user/list">用户列表</a></li>
                        <li class="parent"><a href="/user/form">添加用户</a></li>
            </ul>
        </div>
        <div class="mainpanel">
            <div class="pageheader">
    <h1 class="pagetitle">应用管理</h1>
    <ul class="hornav">
        <li class="current"><a href="./list">应用列表</a></li>
        <li><a href="./form">添加应用</a></li>
    </ul>
</div>
<div class="contentpanel">
    <form class="search-form">
        <table class="search-table" style="width:1228px">
            <tr>
                <th>id</th>
                <td><input type="text" class="form-control" name="id"/></td>
                <th>状态</th>
                <td><select name="status" class="form-control">
                        <option value="">选择</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <button type="submit" class="btn btn-primary">查 询</button>
                </td>
            </tr>
        </table>
        <input type="hidden" name="psize" value="<?php echo htmlspecialchars($psize);?>"/>
        <input type="hidden" name="page" value="<?php echo htmlspecialchars($page);?>"/>
        <input type="hidden" id="total_page" value="<?php echo htmlspecialchars(ceil($total/$psize));?>"/>
    </form>
    <div class="js-pager pull-right"><span class="total">总数：<?php echo htmlspecialchars(number_format($total));?></span></div>
    <table class="table table-bordered table-striped">
        <tr>
            <th>id</th>
            <th>应用名</th>
            <th>网址</th>
            <th>密钥</th>
            <th>负责人</th>
            <th>时间戳</th>
            <th width="320">操作</th>
        </tr>
        <?php foreach ($app_list as $app):?>
        <tr>
            <td><?php echo htmlspecialchars($app['id']);?></td>
            <td><?php echo htmlspecialchars($app['app_name']);?></td>
            <td><?php echo htmlspecialchars($app['app_href']);?></td>
            <td><?php echo htmlspecialchars($app['public_key']);?></td>
            <td><?php echo htmlspecialchars($app['auditor']);?></td>
            <td><?php echo htmlspecialchars($app['utime']);?></td>
            <td>
                <a href="./delete/<?php echo htmlspecialchars($app['id']);?>" class="btn btn-danger ajax-post" data-confirm="确定要删除吗">删除</a>
                <a href="./form/<?php echo htmlspecialchars($app['id']);?>" class="btn btn-warning">编辑</a>
                <a href="./link_list/<?php echo htmlspecialchars($app['id']);?>" class="btn btn-primary">链接列表</a>
                <a href="./link_form/<?php echo htmlspecialchars($app['id']);?>" class="btn btn-success">链接列表</a>
            </td>
        </tr>
        <?php endforeach;?>
    </table>
</div>
        </div>
    </div>
    <script src="/script/bootstrap.js"></script>
    <script src="/script/jquery.pagination.js"></script>
    <script src="/script/jquery.validator.js"></script>
    <script src="/script/jquery.validator.zh.js"></script>
    <script src="/script/bootstrap-datetimepicker.js"></script>
    <script src="/script/bootstrap-datetimepicker.zh.js"></script>
    <script src="/script/jquery.form.js"></script>
    <script src="/script/bootbox.js"></script>
    <script src="/script/admin.base.js"></script>
    <script>
            var path = window.location.pathname.replace(/\/(\d+|index)/,'');
            $('.leftpanel .nav li a').each(function() {
                if (this.href.indexOf(path) !==-1) 
                {
                    $(this).parent('li').addClass('active');
                    $(this).parent('li').parent().parent().addClass('active');
                    return false;
                }
            });
            $('.parent >a').click(function(){
                $('.active').removeClass('active');
                $(this).parent('li').addClass('active');
            });
        </script>
    </body>
</html>