{%extend base.inc.php%}
{%block main%}
<div class="pageheader">
    <h1 class="pagetitle">权限管理</h1>
    <ul class="hornav">
        <li class="current"><a href="/lvs/ucenter/role/list">角色列表</a></li>
        <li><a href="/lvs/ucenter/role/form">添加角色</a></li>
        <li><a href="/lvs/ucenter/route/list">路由列表</a></li>
        <li><a href="/lvs/ucenter/route/form">添加路由</a></li>
    </ul>
</div>
<div class="contentpanel">
    <form class="search-form">
        <table class="search-table" style="width: 680px">
            <tr>
                <th>id</th>
                <td><input type="text" class="form-control" name="id" /></td>
                <th>名称</th>
                <td><input type="role_name" class="form-control" name="id" /></td>
            </tr>
            <tr>
                <th></th>
                <td><button type="submit" class="btn btn-primary">查 询</button></td>
            </tr>
        </table>
        <input type="hidden" name="psize" value="{%$psize%}"/>
        <input type="hidden" name="page" value="{%$page%}"/>
        <input type="hidden" id="total_page" value="{%$total/$psize|ceil%}"/>
    </form>
    <div class="js-pager pull-right"><span class="total">总数：{%$total|number_format%}</span></div>
    <table class="table table-bordered table-striped">
        <tr>
            <th>id</th>
            <th>角色名</th>
            <th>备注</th>
            <th>操作人</th>
            <th width="160">时间戳</th>
            <th width="190">操作</th>
        </tr>
        <?php foreach ($role_list as $_role):?>
        <tr>
        <td>{%$_role['id']%}</td>
            <td>{%$_role['role_name']%}</td>
            <td>{%$_role['remark']%}</td>
            <td>{%$_role['auditor']%}</td>
            <td>{%$_role['utime']%}</td>
            <td>
                <a href="/lvs/ucenter/route/grant?role_id={%$_role['id']%}" class="btn btn-warning"> 授权</a>
                <a href="./delete/{%$_role['id']%}" class="btn btn-danger ajax-post" data-confirm="确定要删除吗">删除</a>
            </td>
        </tr>
        <?php endforeach;?>
    </table>
</div>
{%endblock%}