<?php
class notice_ctrl extends ctrl
{
    private $model;
    
    public function __construct()
    {   
        parent::__construct();
        $this->model = new notice_model();
    }   

    public function index()
    {   
        $filter_rules = array(
            'id'=>'column:id|compare:equal',
            'title'=>'column:title|compare:like',
            'sdate'=>'column:ctime|compare:date_start',
            'edate'=>'column:ctime|compare:date_end',
        );  
        $filter_where = form_filter_parse($filter_rules, $_GET);
        list($page, $psize) = $this->fetch_paging_param();
        list($notice_list, $total) = $this->model->search_list($filter_where, ($page-1)*$psize, $psize);
        $this->assign('notice_list', $notice_list,'total', $total);
        $this->display('notice.list.php');
    }   
    
    
    public function delete($notice_id=-1)
    {   
        if($_SERVER['REQUEST_METHOD']=='POST')
        {   
    
        }   
    }   
}