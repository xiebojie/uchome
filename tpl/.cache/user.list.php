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
                    <li class="parent">
                        <a>应用管理</a>
                        <ul class="children">
                            <li><a href="/app/list">应用列表</a></li>
                            <li><a href="/app/form">添加应用</a></li>
                        </ul>
                    </li>
                    <li class="parent">
                    <a>权限管理</a>
                    <ul class="children"> 
                        <li><a href="/role/list">角色列表</a></li>
                        <li><a href="/role/form">添加角色</a></li>
                        <li><a href="/route/list">路由列表</a></li>
                        <li><a href="/route/form">添加路由</a></li>
                        <li><a href="/route/grant">路由授权</a></li>
                    </ul>
                </li>
                <li class="parent">
                    <a>用户管理</a>
                    <ul class="children">
                        <li><a href="/user/list">用户列表</a></li>
                        <li><a href="/user/form">添加用户</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="mainpanel">
            <div class="pageheader">
    <h1 class="pagetitle">用户管理</h1>
    <ul class="hornav">
        <li class="current"><a href="/user/list">用户列表</a></li>
        <li><a href="/user/form">添加账号</a></li>
    </ul>
</div>
<div class="contentpanel">
    <form class="search-form">
        <table class="search-table" style="width:788px">
            <tr>
                <th>用户名</th>
                <td><input type="text" class="form-control" name="name"/></td>
                <th>角色</th>
                <td>
                    <select name="role_id" class="form-control">
                        <option value="">全部</option>
                    </select>
                </td>
                <th>状态</th>
                <td>
                    <select name="status" class="form-control">
                        <option value="">全部</option>
                        <?php foreach (user_model::$status_list as $k=>$v):?>
                        <option value="<?php echo $k?>"><?php echo $v?></option>
                        <?php endforeach;?>
                    </select>
                </td>
            </tr>
            <tr>
                <th></th>
                <td><button type="submit" class="btn btn-primary">查 询</button></td>
            </tr>
        </table>
        <input type="hidden" name="psize" value="<?php echo htmlspecialchars($psize);?>"/>
        <input type="hidden" name="page" value="<?php echo htmlspecialchars($page);?>"/>
        <input type="hidden" id="total_page" value="<?php echo htmlspecialchars(ceil($total/$psize));?>"/>
    </form>
    <div class="js-pager pull-right"><span class="total">总数：<?php echo htmlspecialchars(number_format($total));?></span></div>
    <table class="table table-bordered table-striped">
    <tr>
            <th width="26">id</th>
            <th>用户名</th>
            <th>手机</th>
            <th>email</th>
            <th>状态</th>
            <th>角色</th>
            <th>邀请码</th>
            <th>管理员</th>
            <th>备注</th>
            <th>时间戳</th>
            <th width="190">操作</th>
        </tr>
        <?php foreach ($user_list as $_user):?>
        <tr>
            <td align="center"><?php echo htmlspecialchars($_user['id']);?></td>
            <td><?php echo htmlspecialchars($_user['username']);?></td>
            <td><?php echo htmlspecialchars($_user['mobile']);?></td>
            <td><?php echo htmlspecialchars($_user['email']);?></td>
            <td><?php echo user_model::$status_list[$_user['status']]?></td>
            <td><?php echo htmlspecialchars($_user['role_name']);?></td>
            <td><?php echo htmlspecialchars($_user['invitation']);?></td>
            <td><?php echo htmlspecialchars($_user['is_admin']?'是':'否');?></td>
            <td><?php echo htmlspecialchars($_user['remark']);?></td>
            <td><?php echo htmlspecialchars($_user['ctime']);?></td>
            <td align="center">
                <?php if($_user['status']==user_model::STATUS_ENABLE):?>
                <a class="btn btn-danger ajax-post" href="./disable?status=0&id=<?php echo htmlspecialchars($_user['id']);?>" data-confirm="确定要禁用账号吗">
                    <span class="glyphicon glyphicon-ban-circle"></span> 禁用
                </a>
                <?php else :?>
                <a class="btn btn-success ajax-post" href="./disable?status=1&id=<?php echo htmlspecialchars($_user['id']);?>" data-confirm="确定要启用账号吗">
                    <span class="glyphicon glyphicon-ok-circle"></span> 启用
                </a>
                <?php endif;?>
                <a href="./form/<?php echo htmlspecialchars($_user['id']);?>" class="btn btn-info"><span class="glyphicon glyphicon-edit"></span> 编辑</a>
            </td>
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