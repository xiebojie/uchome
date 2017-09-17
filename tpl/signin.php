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
                    <input type="text" name="email" class="form-control" placeholder="email"
                           data-rule="email:required;email" data-target=".form-alert"/>
                </div>
                <div class="form-group" id="js-invite-field">
                    <input type="text" name="invitation" class="form-control" style="width: 280px"
                           placeholder="首次或修改密码需输入邀请码" 
                           data-rule="首次或修改密码需输入邀请码:required" data-target=".form-alert"/>
                </div>
                <div class="form-group">
                    <input type="password" name="passwd" class="form-control" style="width: 280px"
                           placeholder="密码" 
                           data-rule="密码:required" data-target=".form-alert"/>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">登 &nbsp;&nbsp;&nbsp;录</button>
                </div>
                <input name="token" type="hidden" value="{%$_GET['token']|default:''%}" />
                <input name="refer" type="hidden" value="{%$_GET['refer']|default:''%}" />
            </form>
        </div>
        <script>
            $(function(){
                $('input[name=email]').isValid(function(valid){
                    if(valid){
                        $.get('/signin/status?email='+'',function(status){
                            if(status==0){
                                $('.form-alert').text('账号不存在').show();
                            }else if(status==1){
                                $('form').validator("setField", "invitation", null);
                                $('#js-invite-field').hide();
                            }else {
                                $('#js-invite-field').show();
                                $('form').validator("setField", "invitation", 'required');
                            }
                        });
                    }
                });
            });
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