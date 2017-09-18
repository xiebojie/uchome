{%extend base.inc.php%}
{%block main%}
<div class="pageheader">
    <h1 class="pagetitle">权限管理</h1>
    <ul class="hornav">
        <li><a href="/role/list">角色列表</a></li>
        <li><a href="/role/form">添加角色</a></li>
        <li><a href="/route/list">路由列表</a></li>
        <li><a href="/route/form">添加路由</a></li>
        <li class="current"><a href="">路由授权</a></li>
    </ul>
</div>
<div class="contentpanel">
    
    <form class="search-form">
        <div class="alert alert-warning">角色名：{%$role['role_name']%}</div>
        <table class="search-table" style="width:228px">
            <tr>
                <th>应用</th>
                <td><select name="app_id" class="form-control">
                        <option value="">全部</option>
                        <?php foreach ($app_list as $_app):?>
                        <option value="{%$_app['id']%}"><?php echo $_app['app_name']?></option>
                        <?php endforeach;?>
                    </select>
                </td>
                <th></th>
                <td><button type="submit" class="btn btn-primary">查 询</button></td>
            </tr>
        </table>
    </form>
    
    <table class="table table-bordered table-striped">
        <tr>
            <th width="160">应用</th>
            <th>路由</th>
            <th width="130">操作</th>
        </tr>
        <?php foreach ($route_list as $_appid=>$_routes):?>
           <tr>
            <th><div class="checkbox">
                <label><input type="checkbox" name="app_id" value="{%$_appid%}"class="check-all" title="全选"/>
                    <?php echo $app_list[$_appid]['app_name']?></label>
                </div>
            </th>
            <td>
                <div class="checkbox">
                <?php foreach ($_routes as $_r):?>
                    <label><input type="checkbox" name="route_ids[]" value="<?php echo $_r['id']?>" />
                        <?php echo $_r['route_name']?></label>
                <?php endforeach;?>
                </div>
            </td>
            <td align="center"><a href="/route/grantedit/<?php echo $_appid?>" 
                                  class="btn btn-warning js-grantedit">提交</a>
            </td>
        </tr>
        <?php endforeach;?>
    </table>
</div>
<script>
    $('.check-all').click(function(){
        $(this).parent().parent().parent().next().find('input[type=checkbox]').attr('checked',this.checked);
    });
    $('.js-grantedit').click(function(){
        var list=[];
        $(this).parent('td').parent().prev().find('input[type=checkbox').each(function(ele){
           
        });
        $.post(this.href,{},function(r){
            
        });
        return false;
    });
</script>
{%endblock%}