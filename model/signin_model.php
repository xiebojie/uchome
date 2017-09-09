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
   
}