<?php
/*!
 * uchome project
 *
 * Copyright 2017 xiebojie@qq.com
 * Licensed under the Apache License v2.0
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 */
class role_ctrl extends ctrl
{
    private $model;
    public function __construct()
    {   
        parent::__construct();
        $this->model = new role_model();
    }   

    public function index()
    {   
        $filter_rules = array(
            'id'=>'column:id|compare:equal',
            'name'=>'column:username|compare:like',
        );  
        $filter_where = form_filter_parse($filter_rules, $_GET);
        list($page, $psize) = $this->fetch_paging_param();
        list($role_list, $total) = $this->model->search_list($filter_where, ($page-1)*$psize, $psize);
        $this->assign('role_list', $role_list,'total', $total);
        $this->display('role.list.php');
    }   
    
    public function form($role_id=-1)
    {   
        $role = $this->model->fetch($role_id);
        if($_SERVER['REQUEST_METHOD']=='POST')
        {   
            $valid_fields = array(
                'role_name'=>'required',
                'remark'=>'optional',
            );  
            $validator = new validator();
            list($valid_data, $valid_error) = $validator->validate($_POST, $valid_fields);
            if (empty($valid_error))
            {   
                $valid_data['auditor']=  $this->username;
                $valid_data['utime']= 'timestamp';
                if (empty($role))
                {   
                    $valid_data['ctime']= 'timestamp';
                    $role_id = $this->model->insert($valid_data);
                }else
                {
                    $this->model->update($role_id, $valid_data);
                }
                return redirect('./list');
            }
        } else
        {
            $this->assign('role',$role);
            $this->display('role.form.php');
        }
    }

    public function delete($role_id=-1)
    {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $this->model->delete($role_id);
        }
    }
}
