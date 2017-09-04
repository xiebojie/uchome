<?php
/*!
 * uchome project
 *
 * Copyright 2017 xiebojie@qq.com
 * Licensed under the Apache License v2.0
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 */
class app_ctrl extends ctrl
{
    private $model;
    public function __construct()
    {
        parent::__construct();
        $this->model = new app_model();
    }

    public function index()
    {
        $filter_rules = array(
            'id'=>'column:id|compare:equal',
            'name'=>'column:username|compare:like',
            'status'=>'column:status|compare:equal'
        );
        $filter_where = form_filter_parse($filter_rules, $_GET);
        list($page, $psize) = $this->fetch_paging_param();
        list($app_list, $total) = $this->model->search_list($filter_where, ($page-1)*$psize, $psize);
        $this->assign('app_list', $app_list,'total', $total);
        $this->display('app.list.php');
    }

    public function form($app_id=-1)
    {
        $app = $this->model->fetch($app_id);
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
             $valid_fields = array(
                'app_name'=>'required',
                'title'=>'optional',
                'app_href'=>'required',
                'public_key' =>'optional'
            );
            $validator = new validator();
            list($valid_data, $valid_error) = $validator->validate($_POST, $valid_fields);
            if (empty($valid_error))
            {   
                $valid_data['auditor']=  $this->username;
                $valid_data['utime']= 'timestamp';
                if (empty($app))
                {
                    $valid_data['ctime']= 'timestamp';
                    $app_id = $this->model->insert($valid_data);
                }else
                {
                    $this->model->update($app_id, $valid_data);
                }
                return redirect('/app/list');
            }else
            {
                echo implode(',', $valid_error);
            }
        } else
        {
            $this->assign('app',$app);
            $this->display('app.form.php');
        }
    }

    public function delete($app_id=-1)
    {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $this->model->delete($app_id);
        }
    }

    public function iframe($app_id=-1)
    {
        $app = $this->model->fetch($app_id);
        $route_list = array();
        $this->assign('app',$app,'route_list',$route_list);
        $this->display('app.iframe.php');
    }


}
