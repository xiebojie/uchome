{%extend base.inc.php%}
{%block main%}
<div class="pageheader">
    <h1 class="pagetitle">应用管理</h1>
    <ul class="hornav">
        <li><a href="./list">应用列表</a></li>
        <li class="current"><a href=""><?php echo empty($app)?'添加应用':'编辑应用'?></a></li>
    </ul>
</div>
<div class="contentpanel">
    <form class="form-horizontal mt20 ajax-form" role="form" method="post" >
        <div class="form-group">
            <label class="col-sm-1 control-label">应用名</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" data-rule="required" name="app_name" value="{%$app['app_name']|default:''%}"/>
            </div>
        </div>
        <div class="form-group">
            <label  class="col-sm-1 control-label">应用地址</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" data-rule="required" name="app_href" value="{%$app['app_href']|default:''%}"/>
            </div>
        </div>
        <div class="form-group">
            <label  class="col-sm-1 control-label">应用密钥</label>
            <div class="col-sm-10">
                <textarea name="public_key">{%$app['public_key']%}</textarea>
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