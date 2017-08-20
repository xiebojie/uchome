!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="icon" href="/style/images//favicon.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <title>{%$title|default:'uchome'%}</title>
        <link href="/www/style/bootstrap.min.css" rel="stylesheet"/>
        <link href="/www/style/bootstrap.datepicker.css" rel="stylesheet"/>
        <link href="/www/style/ucbase.css" rel="stylesheet"/>
        <script src="/www/script/jquery.min.js"></script>
    </head>
    <body>
        <div class="navbar" style="background:#428bca;border-radius: 0px;margin: 0px">
            <div class="navbar-brand" style="font-size:28px;color:#fff">uchome</div>
              <div class="pull-right whoami">
                   <a class="dropdown-toggle" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-user"></span>{%$username|default:''%}
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
                    <li class="parent"><a href="/widget">widget</a></li>
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
                        <li><a href="／route/list">路由列表</a></li>
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
            {%block main%}{%endblock%}
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