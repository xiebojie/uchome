{%extend base.inc.php%}
{%block main%}
<div class="pageheader">
    <h1 class="pagetitle">权限管理</h1>
    <ul class="hornav">
        <li><a href="/lvs/ucenter/role/list">角色列表</a></li>
        <li><a href="/lvs/ucenter/role/form">添加角色</a></li>
        <li class="current"><a href="/lvs/ucenter/route/list">路由列表</a></li>
        <li><a href="/lvs/ucenter/route/form">添加路由</a></li>
    </ul>
</div>
<div class="contentpanel">
    <form class="search-form">
        <table class="search-table" style="width:788px">
            <tr>
                <th>id</th>
                <td><input type="text" class="form-control" name="id"/></td>
                <th>应用</th>
                <td>
                    <select name="app_id" class="form-control">
                        <option value="">全部</option>
                        <?php foreach ($app_list as $_app):?>
                        <option value="{%$_app['id']%}"><?php echo $_app['app_name']?></option>
                        <?php endforeach;?>
                    </select>
                </td>
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
            <th width="26">id</th>
            <th>应用</th>
            <th>名称</th>
            <th>模式</th>
            <th>负责人</th>
            <th width="160">时间戳</th>
            <th width="190">操作</th>
        </tr>
        <?php foreach ($route_list as $_route):?>
        <tr>
            <td align="center">{%$_route['id']%}</td>
            <td>{%$_route['app_id']%}</td>
            <td>{%$_route['route_name']%}</td>
            <td>{%$_route['match_schema']%}</td>
            <td>{%$_route['auditor']%}</td>
            <td>{%$_route['utime']%}</td>
            <td align="center">
                <a class="btn btn-danger ajax-post" href="./delete?id={%$_route['id']%}" data-confirm="确定要删除账号吗">
                    <span class="glyphicon glyphicon-ban-circle"></span> 删除
                </a>
                <a href="./form/{%$_route['id']%}" class="btn btn-info"><span class="glyphicon glyphicon-edit"></span> 编辑</a>
            </td>
        </tr>
        <?php endforeach;?>
    </table>
</div>
{%endblock%}