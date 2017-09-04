<?php
/*!
 * uchome project
 *
 * Copyright 2017 xiebojie@qq.com
 * Licensed under the Apache License v2.0
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 */
class grant_model extends model
{
    protected $primary_table = 'ucenter_route_grant';
    protected $primary_key = 'id';
    
    public function fetch_route_list($role_ids,$app_id=0)
    {   
        $app_id = intval($app_id);
        $role_ids = array_walk($role_ids, 'intval');
        $sql = sprintf("SELECT * FROM ucenter_route_grant LEFT JOIN route ON route_grant.route_id=route.id WHERE role_id IN('%s')",  implode("','", $role_ids));
        if($app_id >0) 
        {   
            $sql .=" AND app_id=$app_id";
        }   
        $route_list=array();
        foreach (self::$db->fetch_all($sql) as $_row)
        {   
            $route_list[$_row['app_id']][] = array('route_name'=>$_row['route_name'],'path'=>$_row['route_path']);
        }   
        return $route_list;
    }   
    
    public function truncate($app_id)
    {   
        $app_id = intval($app_id);
        $sql = "DELETE FROM ucenter_route_grant WHERE app_id=$app_id";
        self::$db->delete($sql);
    }   
}