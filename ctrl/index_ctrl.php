<?php
/*!
 * uchome project
 *
 * Copyright 2017 xiebojie@qq.com
 * Licensed under the Apache License v2.0
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 */
class index_ctrl extends ctrl
{
    public function index()
    {   
        //@todo 根据当前账号的role_id 获得可访问的应用列表
        $app_model = new app_model();
        $app_list = $app_model->fetch_all();
        $this->assign('app_list', $app_list);
        $this->display('index.index.php');
    }   
}
