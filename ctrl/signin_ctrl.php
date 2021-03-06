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
    protected $signin_model;
            
    public function __construct()
    {
        $this->auth_pass=true;
        parent::__construct();
        $this->model = new user_model();
        $this->signin_model = new signin_model();
    }
    
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $passwd = isset($_POST['passwd']) ? $_POST['passwd'] : '';
            $invitation = isset($_POST['invitation'])?$_POST['invitation']:'';
            $user = $this->model->fetch_by_email($email);
            if(!empty($invitation) && $invitation==$user['invitation']
                    ||user_model::passwd_hash($passwd) == $user['passwd'])
             {
                if(!empty($user['invitation']))
                {
                    $this->model->update($user['id'], array(
                        'utime'=>'timestamp',
                        'passwd'=>  user_model::passwd_hash($passwd),
                        'invitation'=>''
                    ));
                }
                $_SESSION['signin'] = array(
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'is_admin'=>$user['is_admin']
                );
                if(!empty($_REQUEST['token']) && !empty($_REQUEST['refer']))
                {
                    $app = app_model::fetch_by_token($_REQUEST['token']);
                    signin_model::start_new_session($user['id'], $app['id'], $_SERVER['REMOTE_ADDR']);
                    return redirect($_REQUEST['refer']);
                }
                return array('error' => 0, 'message' => '登录成功');
            }else if (empty($user['invitation']) || user_model::passwd_hash($passwd) != $user['passwd'])
            {
                return array('error' => 1, 'message' => '帐号密码错误');
            }  else if(empty ($user['passwd']) && $user['invitation']!=$invitation)
            {
                return array('error'=> 2, 'message'=>'邀请码错误');
            } 
        } else
        {
            if(!empty($_SESSION['signin']) && empty($_GET['token']))
            {
                return redirect('/');
            }else if(!empty ($_SESSION['signin'])&& !empty ($_GET['token']) && !empty ($GET['refer']))
            {
                $app = app_mode::fetch_by_token($_GET['token']);
                if(!empty($app))
                {
                    $sid= signin_model::start_new_session($_SESSION['signin']['user_id'], $app['id'],
                        $_SERVER['REMOTE_ADDR']);
                    return redirect($_GET['refer'].'?sid='.$sid);
                }
            }
            $this->display('signin.php');
        }
    }
    
    //根据appid和sid获得登录账号的信息
    public function ladp($sid=-1)
    {
        $sid = isset($_REQUEST['sid'])?$_REQUEST['sid']:'';
        $signin = $this->signin_model->fetch_by_sid($sid);
        if(!empty($signin) && time()-strtotime($signin['ctime'])<90)
        {
            $user = $this->user_model->fetch($signin['user_id']);
            $route_list = $route_model->fetch_by_appid($user['user_id'],$signin['app_id']);
            return array(
                'error'=>'',
                'user_id'=>$user['id'],
                'username'=>$user['username'],
                'route'=>$route_list
            );
        }  else
        {
            return array('error'=>'invalid sid');
        }
    }
    
    
    public function status()
    {
        $email = isset($_REQUEST['email'])?$_REQUEST['email']:'';
        $user = $this->model->fetch_by_email($email);
        if(empty($user))
        {
            echo '0';
        }else if(!empty ($user['invitation'])){
            echo  '1';
        }else {
            echo  '2';
        }
    }

    public function logout()
    {
        unset($_SESSION['signin']);
        session_destroy();
    }
}