{%extend base.inc.php%}
{%block main%}
<div class="pageheader">
    <h1 class="pagetitle">用户管理</h1>
    <ul class="hornav">
        <li><a href="/user/list">用户列表</a></li>
        <li class="current"><a href=""><?php echo empty($user)?'添加账号':'编辑账号'?></a></li>
    </ul>
</div>
<div class="contentpanel">
    <form class="form-horizontal mt20" role="form" method="post">
        <div class="form-group">
            <label class="col-sm-1 control-label">用户名</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" data-rule="required" name="username" value="{%$user['username']|default:''%}"/>
            </div>
        </div>
        <div class="form-group">
            <label  class="col-sm-1 control-label">手机号</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" data-rule="required" name="mobile" value="{%$user['mobile']|default:''%}"/>
            </div>
        </div>
        <div class="form-group">
            <label  class="col-sm-1 control-label">Email</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  data-rule="required" name="email" value="{%$user['email']|default:''%}"/>
            </div>
        </div>
        <div class="form-group">
            <label  class="col-sm-1 control-label">部门</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  data-rule="required" name="department" value="{%$user['department']|default:''%}"/>
            </div>
        </div>
        <div class="form-group">
            <label  class="col-sm-1 control-label">角色</label>
            <div class="col-sm-10 checkbox">
                <label class="text-danger"><input type="checkbox"/>管理员</label>
            </div>
        </div>
        <div class="form-group">
        <label  class="col-sm-1 control-label">备注</label>
            <div class="col-sm-10">
                <textarea class="form-control"  name="remark">{%$user['remark']|default:''%}</textarea>
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