<?php
class api_ctrl extends ctrl
{
    public function notice()
    {   
    
    }   
    
    public function send_notice($app_id, $user_id,$title,$content){
    
    }   
    
    //获得访问
    public function route_list($app_id)
    {   
        $app_id = isset($_REQUEST['app_id'])?$_REQUEST['app_id']:-1;
        $session_id = isset($_REQUEST['session_id'])?$_REQUEST['session_id']:-1;
        session_id($session_id);
        $role_ids = isset($_SESSION['role_ids'])?$_SESSION['role_ids']:array();
        if(!empty($role_ids) && !empty($app_id))
        {   
            return array('error'=>0,'route_list'=>array());
        }   
        return array('error'=>1,'message'=>'require login');
    }   
    
}