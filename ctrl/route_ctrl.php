<?php
class route_ctrl extends ctrl
{
    private $model;
    private $app_model;
    public function __construct()
    {   
        parent::__construct();
        $this->model = new route_model();
        $this->app_model = new app_model();
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
        list($route_list, $total) = $this->model->search_list($filter_where, ($page-1)*$psize, $psize);
        $this->assign('route_list', $route_list,'total', $total,'app_list',  $this->app_model->fetch_all());
        $this->display('route.list.php');
    }   
    
    public function form($route_id=-1)
    {   
        $route = $this->model->fetch($route_id);
        if($_SERVER['REQUEST_METHOD']=='POST')
        {   
              $valid_fields = array(
                'app_id'=>'required',
                'route_name'=>'required',
                'match_schema'=>'required'
            );  
            $validator = new validator();
            list($valid_data, $valid_error) = $validator->validate($_POST, $valid_fields);
            if (empty($valid_error))
            {   
                $valid_data['auditor']=  $this->username; 
                $valid_data['utime']= 'timestamp';
                if (empty($route))
                {
                    $valid_data['ctime']= 'timestamp';
                    $route_id = $this->model->insert($valid_data);
                }else
                {
                    $this->model->update($route_id, $valid_data);
                }
                return redirect('./list');
            }else
            {
                echo implode(',', $valid_error);
            }
        }else
        {
            $this->assign('route',$route,'app_list',  $this->app_model->fetch_all());
            $this->display('route.form.php');
        }
    }

    public function delete($route_id=-1)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $this->model->delete($route_id);
        }
    }
    public function grant()
    {
        $role_list = array();
        $this->assign('role_list', $role_list,'app_list',  $this->app_model->fetch_all());
        $this->display('route.grant.php');
    }

     public function grant_form()
    {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $app_id = isset($_REQUEST['app_id'])?$_REQUEST['app_id']:-1;
            $route_ids = isset($_REQUEST['route_ids'])?$_REQUEST['route_ids']:array();
            $this->model->truncate($app_id);
            foreach ($route_ids as $_routeid)
            {
                $this->model->insert(array());
            }
        }
    }
}
