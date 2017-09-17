<?php
/*!
 * uchome project
 *
 * Copyright 2017 xiebojie@qq.com
 * Licensed under the Apache License v2.0
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 */
class user_model extends model
{
    protected $primary_table = 'uc_user';
    protected $primary_key = 'id';
    
    const STATUS_DISABLE=0;
    const STATUS_ENABLE =1;
    
    public static $status_list = array(
        self::STATUS_DISABLE => '已禁用',
        self::STATUS_ENABLE  => '已启用'
    );
    
    public function set_status($uid, $status)
    {
        $uid = intval($uid);
        $status = intval($status);
        $sql = "UPDATE uc_user SET status=$status WHERE id=$uid";
        return self::$db->replace($sql);
    }
    
    public function fetch_by_email($email)
    {
        $email = addslashes($email);
        $sql = "SELECT * FROM uc_user WHERE email='$email'";
        return self::$db->fetch($sql);
    }
    
    public static function passwd_hash($passwd)
    {
        return substr(md5(sha1($passwd)), 0,32);
    }
}