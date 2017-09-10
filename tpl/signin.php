<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>uchome signin</title>
        <link href="/style/bootstrap.min.css" rel="stylesheet"/>
        <link href="/style/ucbase.css" rel="stylesheet" />
        <script src="/script/jquery.min.js"></script>
    </head>
    <body style="background: #f7fafc;vertical-align: middle;margin-top: 55px">
        <div class="wraper center-block" style="width:280px">
            <h1 class="text-primary text-center">UCHOME</h1>
            <form method="post">
                <div class="form-alert"></div>
                <div class="form-group">
                    <input type="text" name="mobile" class="form-control" placeholder="手机号"
                           data-rule="手机号:required;mobile" data-target=".form-alert"/>
                </div>
                <div class="form-group">
                    <input type="password" name="passwd" class="form-control" style="width: 280px"
                           placeholder="密码" 
                           data-rule="密码:required" data-target=".form-alert"/>
                </div>
                <div class="form-group" id="js-invitation">
                    <input type="text" name="invitation" class="form-control" 
                        placeholder="邀请码" data-rule="邀请码:required"  data-target=".form-alert"/>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">登 &nbsp;&nbsp;&nbsp;录</button>
                </div>
                <input name="token" type="hidden" value="{%$_GET['token']|default:''%}" />
                <input name="refer" type="hidden" value="{%$_GET['refer']|default:''%}" />
            </form>
        </div>
        <script>
            $('input[name=mobile]').change(function(){
                if(this.value==='')
                {
                     $('#js-invitation').hide();
                }
                $.get('/sigin/exist?mobile='+this.value,function(r){
                    var resp = $.parseJSON(r);
                    if(resp.exist)
                    {
                        $('#js-invitation').show();
                        $('input[name=invitatio]').attr('data-rule','');
                    }else{
                        $('#js-invitation').hide();
                    }
                });
            }).trigger('change');
            $('form').bind('valid.form', function(){
                $('form').ajaxSubmit({'success':function(r){
                    var resp = $.parseJSON(r);
                    if(resp.error===0)
                    { 
                        window.location.href=$('input[name=refer]').val();
                    }else
                    {
                        alert(resp.message);
                    }
                }});
                return false;
            });
        </script>
        <script src="/script/jquery.form.js"></script>
        <script src="/script/jquery.validator.js"></script>
        <script src="/script/jquery.validator.zh.js"></script>
    </body>
</html>