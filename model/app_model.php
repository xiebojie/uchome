<?php
class app_model extends model
{
    protected $primary_table = 'uc_app';
    protected $primary_key = 'id';
    
    const STATUS_DISABLE=0;
    const STATUS_ENABLE =1; 
    
    public static $status_list = array(
        self::STATUS_DISABLE => '已禁用',
        self::STATUS_ENABLE  => '已启用'
    );  
    
    public function set_status($app_id, $status)
    {   
        $app_id = intval($app_id);
        $status = intval($status);
        $sql = "UPDATE ucenter_app SET status=$status WHERE id=$app_id";
        return self::$db->replace($sql);
    }   
}