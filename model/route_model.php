<?php
class route_model extends model
{
    protected $primary_table = 'ucenter_route';
    protected $primary_key = 'id';
    
    const STATUS_DISABLE=0;
    const STATUS_ENABLE =1; 
    
    public static $status_list = array(
        self::STATUS_DISABLE => '已禁用',
        self::STATUS_ENABLE  => '已启用'
    );  
}