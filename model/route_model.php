<?php
/*!
 * uchome project
 *
 * Copyright 2017 xiebojie@qq.com
 * Licensed under the Apache License v2.0
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 */
class route_model extends model
{
    protected $primary_table = 'uc_route';
    protected $primary_key = 'id';
    
    const STATUS_DISABLE=0;
    const STATUS_ENABLE =1; 
    
    public static $status_list = array(
        self::STATUS_DISABLE => '已禁用',
        self::STATUS_ENABLE  => '已启用'
    );  
    
    public function search_list($filter_where, $offset = 0, $limit_size = 20)
    {
        $offset = abs($offset);
        $limit_size = abs($limit_size);
        $sql = "SELECT SQL_CALC_FOUND_ROWS uc_route.*,app_name FROM uc_route LEFT JOIN uc_app "
                . " ON uc_route.app_id=uc_app.id ";
        if (!empty($filter_where))
        {
            $sql .=' WHERE ' . implode(' AND ', $filter_where);
        }
        $sql .=" ORDER BY uc_route.id DESC ";
        if ($limit_size > 0)
        {
            $sql.=" LIMIT $offset,$limit_size";
        }
        $row_list = self::$db->fetch_all($sql);
        $count = self::$db->fetch_col('SELECT FOUND_ROWS()');
        return array($row_list, $count);
    }
    
    public function fetch_app_route($app_id=-1)
    {
        $app_id = intval($app_id);
        $sql = "SELECT * FROM uc_route ";
        if($app_id>0)
        {
            $sql .= " AND app_id=$app_id";
        }
        $route_list = array();
        foreach (self::$db->fetch_all($sql) as $row)
        {
            $route_list[$row['app_id']][]=$row;
        }
        return $route_list;
    }
    
    public function fetch_route_granted($role_ids, $appid=-1)
    {
        $role_ids = is_array($role_ids)?:array($role_ids);
        $appid = intval($appid);
        $sql = "SELECT * FROM uc_route_grant LEFT JOIN uc_route ON uc_route_grant.route_id=uc_route.id "
                . " WHERE role_id IN ('". implode("','", $role_ids)."')";
        if($appid>0)
        {
            $sql .=" AND app_id=$appid";
        }
        $route_list = array();
        foreach (self::$db->fetch_all($sql) as $row)
        {
            $route_list[$row['route_id']] = $row;
        }
        return $route_list;
    }
}