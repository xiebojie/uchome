%extend base.inc.php%}
{%block main%}
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
        <input type="hidden" name="psize" value="{%$psize%}"/>
        <input type="hidden" name="page" value="{%$page%}"/>
        <input type="hidden" id="total_page" value="{%$total/$psize|ceil%}"/>
    </form>
    <div class="js-pager pull-right"><span class="total">总数：{%$total|number_format%}</span></div>
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
            <td>{%$app['id']%}</td>
            <td>{%$app['app_name']%}</td>
            <td>{%$app['app_href']%}</td>
            <td>{%$app['public_key']%}</td>
            <td>{%$app['auditor']%}</td>
            <td>{%$app['utime']%}</td>
            <td>
                <a href="./delete/{%$app['id']%}" class="btn btn-danger ajax-post" data-confirm="确定要删除吗">删除</a>
                <a href="./form/{%$app['id']%}" class="btn btn-warning">编辑</a>
                <a href="./link_list/{%$app['id']%}" class="btn btn-primary">链接列表</a>
                <a href="./link_form/{%$app['id']%}" class="btn btn-success">链接列表</a>
            </td>
        </tr>
        <?php endforeach;?>
    </table>
</div>
{%endblock%}