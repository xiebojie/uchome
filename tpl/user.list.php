{%extend base.inc.php%}
{%block main%}
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
        <input type="hidden" name="psize" value="{%$psize%}"/>
        <input type="hidden" name="page" value="{%$page%}"/>
        <input type="hidden" id="total_page" value="{%$total/$psize|ceil%}"/>
    </form>
    <div class="js-pager pull-right"><span class="total">总数：{%$total|number_format%}</span></div>
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
            <td align="center">{%$_user['id']%}</td>
            <td>{%$_user['username']%}</td>
            <td>{%$_user['mobile']%}</td>
            <td>{%$_user['email']%}</td>
            <td><?php echo user_model::$status_list[$_user['status']]?></td>
            <td>{%$_user['role_name']%}</td>
            <td>{%$_user['invitation']%}</td>
            <td>{%$_user['is_admin']?'是':'否'%}</td>
            <td>{%$_user['remark']%}</td>
            <td>{%$_user['ctime']%}</td>
            <td align="center">
                <?php if($_user['status']==user_model::STATUS_ENABLE):?>
                <a class="btn btn-danger ajax-post" href="./disable?status=0&id={%$_user['id']%}" data-confirm="确定要禁用账号吗">
                    <span class="glyphicon glyphicon-ban-circle"></span> 禁用
                </a>
                <?php else :?>
                <a class="btn btn-success ajax-post" href="./disable?status=1&id={%$_user['id']%}" data-confirm="确定要启用账号吗">
                    <span class="glyphicon glyphicon-ok-circle"></span> 启用
                </a>
                <?php endif;?>
                <a href="./form/{%$_user['id']%}" class="btn btn-info"><span class="glyphicon glyphicon-edit"></span> 编辑</a>
            </td>
        </tr>
        <?php endforeach;?>
    </table>
</div>
<script>

</script>
{%endblock%}