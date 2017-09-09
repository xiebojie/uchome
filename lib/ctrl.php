<?php
/*!
 * uchome project
 *
 * Copyright 2017 xiebojie@qq.com
 * Licensed under the Apache License v2.0
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 */
abstract class ctrl 
{
    protected $tpl_vars= array();
    protected $layout;
    protected $auth_pass=false;
    protected $user_model ;
    
    protected $user_id;
    protected $role;
    protected $username;
    protected $is_admin;

    public function __construct()
    {  
        $this->user_model = new user_model();
        if (empty($this->auth_pass))
        {
            if(!empty($_SESSION['signin']))
            {
                $this->user_id= $_SESSION['signin']['user_id'];
                $this->username=$_SESSION['signin']['username'];
                $this->is_admin = $_SESSION['signin']['is_admin'];
            }else
            {
                redirect('/siginin');
                exit;
            }
        }
        $this->assign('is_admin',  $this->is_admin,'username', $this->username);
        $this->layout = new layout();
    }

    protected function display($tpl_file, $arr=null)
    {
        $compiled_tpl_file = str_replace('/', '_', $tpl_file);
        $tpl_code = $this->layout->compile($tpl_file);
        file_put_contents(TPL_CACHE_PATH.$compiled_tpl_file, $tpl_code);
        extract($this->tpl_vars);
        if(is_array($arr))
        {
            extract($arr);
        }
        ob_start();
        include TPL_CACHE_PATH.$compiled_tpl_file;
        echo ob_get_clean();
    }
    
    protected function fetch_content($tpl_file, $arr=null)
    {
        $compiled_tpl_file = str_replace('/', '_', $tpl_file);
        $tpl_code = $this->layout->compile($tpl_file);
        file_put_contents(TPL_CACHE_PATH.$compiled_tpl_file, $tpl_code);
        extract($this->tpl_vars);
        if(is_array($arr))
        {
            extract($arr);
        }
        ob_start();
        include TPL_CACHE_PATH.$compiled_tpl_file;
        return  ob_get_clean();
    }

    protected function assign() 
    {
        $args = func_get_args();
        for ($i = 0, $j = count($args); $i < $j; $i++) 
        {
            $this->tpl_vars[$args[$i]] = $args[$i + 1];
            $i++;
        }
    }
    
    protected function fetch_paging_param()
    {
        $page = isset($_GET['page'])&& $_GET['page']>=1?intval($_GET['page']):1;
        $psize = isset($_GET['psize'])&& $_GET['psize']>=1&& $_GET['psize']<100?intval($_GET['psize']):50;
        $this->assign('page', $page,'psize', $psize);
        return array($page, $psize);
    }
}