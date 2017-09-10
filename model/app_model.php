<?php
/*!
 * uchome project
 *
 * Copyright 2017 xiebojie@qq.com
 * Licensed under the Apache License v2.0
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 */
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
    
    public static function fetch_by_token($token)
    {
        $token = addslashes($token);
        $sql = "SELECT * FROM uc_app WHERE token='$token'";
        return self::$db->fetch($sql);
    }
}