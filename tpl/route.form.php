{%extend base.inc.php%}
{%block main%}
<div class="pageheader">
    <h1 class="pagetitle">路由管理</h1>
    <ul class="hornav">
        <li><a href="/role/list">角色列表</a></li>
        <li ><a href="/role/form">添加角色</a></li>
        <li><a href="/route/list">路由列表</a></li>
        <li class="current"><a href="/route/form">添加路由</a></li>
    </ul>
</div>
<div class="contentpanel">
    <form class="form-horizontal mt20" role="form" method="post">
        <div class="form-group">
            <label class="col-sm-1 control-label">所属应用</label>
            <div class="col-sm-10">
                <select name="app_id" class="form-control" data-rule="required">
                    <?php foreach ($app_list as $_app):?>
                    <option value="<?php echo $_app['id']?>">{%$_app['app_name']%}</option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label  class="col-sm-1 control-label">名称</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" data-rule="required" name="route_name" value="{%$route['route_name']|default:''%}"/>
            </div>
        </div>
        <div class="form-group">
            <label  class="col-sm-1 control-label">匹配规则</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  data-rule="required" name="match_schema" value="{%$route['match_schema']|default:''%}"/>
            </div>
        </div>
        <div class="form-group">
            <label  class="col-sm-1 control-label"></label>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-success">提 交</button>
            </div>
        </div>
    </form>
    </div>
{%endblock%}