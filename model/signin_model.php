<?php
/*!
 * uchome project
 *
 * Copyright 2017 xiebojie@qq.com
 * Licensed under the Apache License v2.0
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 */
class signin_model extends model
{
    protected $primary_table = 'uc_signin';
    protected $primary_key = 'id';
    
    public function generate_sid()
    {
        return substr(sha1(microtime().getmygid()),0,32);
    }
    
    public function fetch_by_sid($sid)
    {
        $sid = addslashes($sid);
        $sql = "SELECT * FROM uc_sigin WHERE sid='$sid' ORDER BY id DESC LIMIT 1";
        return self::$db->fetch($sql);
    }
   
    public static function start_new_session($user_id,$app_id,$client_ip)
    {
        $user_id = intval($user_id);
        $app_id = intval($app_id);
        $client_ip = addslashes($client_ip);
        $sid = substr(sha1(getmygid().time().$client_ip),0,32);
        
        $sql = "INSERT INTO uc_signin SET user_id=$user_id,app_id=$app_id,client_ip='$client_ip',"
                . "sid='$sid',ctime=NOW()";
        self::$db->replace($sql);
        return $sid;
    }
}