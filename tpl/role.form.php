{%extend base.inc.php%}
{%block main%}
<div class="pageheader">
    <h1 class="pagetitle">角色管理</h1>
    <ul class="hornav">
        <li><a href="/lvs/ucenter/role/list">角色列表</a></li>
        <li class="current"><a href="/lvs/ucenter/role/form">添加角色</a></li>
        <li><a href="/lvs/ucenter/route/list">路由列表</a></li>
        <li><a href="/lvs/ucenter/route/form">添加路由</a></li>
    </ul>
</div>
<div class="contentpanel">
    <form class="form-horizontal mt20" role="form" method="post">
        <div class="form-group">
            <label class="col-sm-1 control-label">角色名</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" data-rule="required" name="role_name" value="{%$role['role_name']|default:''%}"/>
            </div>
        </div>
        <div class="form-group">
            <label  class="col-sm-1 control-label">备注</label>
            <div class="col-sm-10">
                <textarea class="form-control"  data-rule="required" name="remark" value="{%$role['remark']|default:''%}"></textarea>
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