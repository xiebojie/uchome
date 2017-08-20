{%extend base.inc.php%}
{%block main%}
<div class="pageheader">
    <h1 class="pagetitle">应用管理</h1>
    <ul class="hornav">
        <li class="current"><a href="">应用链接</a></li>
        <li><a href="">添加链接</a></li>
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
            <th>auditor</th>
            <th>操作</th>
        </tr>
        <?php foreach ($app_list as $app):?>
        <tr>
            <td>{%$app['id']%}</td>
            <td>{%$app['app_name']%}</td>
            <td>{%$app['weburl']%}</td>
            <td>{%$app['public_key']%}</td>
            <td>{%$app['auditor']%}</td>
            <td>{%$app['utime']%}</td>
            <th><a href="">删除</a>
                <a href="">编辑</a>
            </th>
        </tr>
        <?php endforeach;?>
    </table>
</div>
{%endblock%}