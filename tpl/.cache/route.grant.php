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
    <h1 class="pagetitle">权限管理</h1>
    <ul class="hornav">
        <li><a href="/role/list">角色列表</a></li>
        <li><a href="/role/form">添加角色</a></li>
        <li><a href="/route/list">路由列表</a></li>
        <li><a href="/route/form">添加路由</a></li>
        <li class="current"><a href="">路由授权</a></li>
    </ul>
</div>
<div class="contentpanel">
    <form class="search-form">
        <div class="alert alert-warning">角色名：</div>
        <table class="search-table" style="width:228px">
            <tr>
                <th>应用</th>
                <td><select name="app_id" class="form-control">
                        <option value="">全部</option>
                        <?php foreach ($app_list as $_app):?>
                        <option value="<?php echo htmlspecialchars($_app['id']);?>"><?php echo $_app['app_name']?></option>
                        <?php endforeach;?>
                    </select>
                </td>
                <th></th>
                <td><button type="submit" class="btn btn-primary">查 询</button></td>
            </tr>
        </table>
    </form>
    <table class="table table-bordered table-striped">
        <tr>
            <th width="160">应用</th>
            <th>路由</th>
            <th width="130">操作</th>
        </tr>
        <tr>
            <th><div class="checkbox"><label><input type="checkbox" name="app_id"/>软件发布</label></div></th>
            <td>
                <div class="checkbox">
                 <label><input type="checkbox" name="route_ids[]" />舒服的沙发</label>
                <label><input type="checkbox" name="route_ids[]" /> 需件</label>
                </div>
            </td>
            <td align="center"><a href="" class="btn btn-primary ajax-post">提交</a></td>
        </tr>
        <?php foreach ($route_list as $_appid=>$_routes):?>
        <tr>
            <td class="checkbox"><label><input type="checkbox" name="app_id"/>软台</label></td>
            <td class="checkbox">
                <label><input type="checkbox" name="route_ids[]" />需件</label>
                <label><input type="checkbox" name="route_ids[]" />需件</label>
                <label><input type="checkbox" name="route_ids[]" />需件</label>
            </td>
            <td align="center"><a href="" class="btn btn-primary ajax-post">提交</a></td>
        </tr>
        <?php endforeach;?>
    </table>
</div>
<script>
    
</script>
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