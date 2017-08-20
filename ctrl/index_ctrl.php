<?php
class index_ctrl extends ctrl
{
    public function index()
    {   
        //@todo 根据当前账号的role_id 获得可访问的应用列表
        $app_list = array();
        $this->assign('app_list', $app_list);
        $this->display('index.index.php');
    }   
}
