<?php 
/*!
 * uchome project
 *
 * Copyright 2017 xiebojie@qq.com
 * Licensed under the Apache License v2.0
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 */
class signin_ctrl extends ctrl
{
    protected $model;
    public function __construct()
    {
        parent::__construct();
        $this->model = new user_model();
    }
    
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
            $passwd = isset($_POST['passwd']) ? $_POST['passwd'] : '';
            $invitation = isset($_POST['invitation'])?$_POST['invitation']:'';
            $user = $this->model->fetch_by_mobile($mobile);
            if (empty($user) || user_model::passwd_hash($passwd) != $user['passwd'])
            {
                return array('error' => 1, 'message' => '帐号密码错误');
            }  else if(empty ($user['passwd']) && $user['invitation']!=$invitation)
            {
                return array('error'=>2, 'message'=>'请输入验证码');
            } else
            {
                //@todo 注册一个 sid 以后可以根据sid获得用户的信息，
                $_SESSION['signin'] = array(
                    'id' => $user['id'],
                    'name' => $user['name']
                );
                return array('error' => 0, 'message' => '登录成功');
            }
        } else
        {
            if(!empty($_SESSION['signin']))
            {
                redirect('/');
            }
            $this->display('signin.php');
        }
    }
    
    //根据appid和sid获得登录账号的信息
    public function ladp($sid=-1,$app_id=-2)
    {
        return array(
            'user_name'=>'',
            'mobile',
            'route_acl'
        );
    }
}