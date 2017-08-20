{%extend base.inc.php%}
{%block main%}
<div class="pageheader">
    <h1 class="pagetitle">通知管理</h1>
    <ul class="hornav">
        <li class="current"><a href="">通知列表</a></li>
    </ul>
</div>
<div class="contentpanel">
    <form class="search-form">
        <table class="search-table" style="width:1228px">
            <tr>
                <th>应用</th>
                <td><select name="app" class="form-control">
                        <option value="">选择</option>
                    </select>
                </td>
                <th>标题</th>
                <td></td>
            </tr>
            <tr>
                <th>日期</th>
                <td></td>
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
        <input type="hidden" id="total_page" value="{%$count/$psize|ceil%}"/>
    </form>
    <div class="js-pager pull-right"><span class="total">总数：{%$count|number_format%}</span></div>
    <table class="table table-bordered table-striped">
        <tr>
            <th>id</th>
            <th>应用</th>
            <th>标题</th>
            <th>内容</th>
            <th>时间戳</th>
            <th>操作</th>
        </tr>
        <?php foreach ($notice_list as $_notice):?>
        <tr>
            <td>{%$_notice['id']%}</td>
            <td>{%$_notice['app_name']%}</td>
            <td>{%$_notice['title']%}</td>
            <td>{%$_notice['content']%}</td>
            <td>{%$_notice['ctime']%}</td>
            <td><a href="">删除</a></td>
        </tr>
        <?php endforeach;?>
    </table>
</div>
{%endblock%}