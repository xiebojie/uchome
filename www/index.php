<?php
define('BASEPATH', dirname(dirname(__FILE__)).'/');
define('TPLPATH', BASEPATH.'tpl/');
date_default_timezone_set('PRC');
define('TPL_CACHE_PATH', BASEPATH.'tpl/.cache/');
ini_set('session.save_path', '/tmp/');
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

include BASEPATH.'/daemon/uboot.inc.php';

function uri_route()
{
    $uri = parse_url(preg_replace("/\/lvs\/usertrustnew/", '', $_SERVER['REQUEST_URI']),PHP_URL_PATH);
    $segements = explode('/', trim($uri,'/'));
    $dir = '';
    while(true)
    {
        if(count($segements)>0&& is_dir(BASEPATH.'ctrl/'.$dir.$segements[0]))
        {
            $dir .=$segements[0].'/';
            array_shift($segements);
        } else 
        {
            break;
        }
    }
    $class = isset($segements[0])?$segements[0]:'index';
    $methods = isset($segements[1])&& !is_numeric($segements[1])?$segements[1]:'index';
    
    return array($dir, $class, $methods,  array_slice($segements, 2));
}

function form_filter_parse($field_list, $data)
{
    $where = array();
    foreach ($field_list as $_field => $fielter_list)
    {
        if (isset($data[$_field]) && is_string($data[$_field]) && $data[$_field] != '')
        {
            $input = addslashes($data[$_field]);
            $field_where = array();
            $tpl = "%s ='%s'";
            $column_list = array();
            $glue = 'AND';
            foreach (explode('|', $fielter_list) as $_filter)
            {
                list($key, $val) = explode(':', $_filter);
                if ($key == 'column')
                {
                    $column_list = explode(',', $val);
                } else if ($key == 'compare')
                {
                    if ($val == 'equal')
                    {
                        $tpl = "%s=%s";
                    } elseif ($val == 'like')
                    {
                        $tpl = "%s LIKE '%%%s%%'";
                    } else if ($val == 'date_start')
                    {
                        $tpl = "%s >= '%s'";
                    } else if ($val == 'date_end')
                    {
                        $tpl = "%s <='%s'";
                    }
                } else if ($key == 'glue')
                {
                    $glue = $val;
                }
            }
            foreach ($column_list as $_column)
            {
                $field_where[] = sprintf($tpl, $_column, $input);
            }
            $where[] = !empty($field_where) && count($field_where) > 1 ? sprintf("(%s)", implode(" $glue ", $field_where)) : $field_where[0];
        }
    }
    return $where;
}

function show404()
{
    header('Status: 404 Not Found',true,404);
    include BASEPATH.'tpl/404.php';
    exit;
}

function show_err($msg='')
{
    header('Status:500',true,500);
    extract(array('msg'=>$msg));
    include TPLPATH. '500.php';
    exit;
}

function redirect($url)
{
    $req=  parse_url($_SERVER['REQUEST_URI']);
    if($req['path'] !=$url)
    {
        header('Location:'.$url, true, 301);
        exit;
    }
}

//@todo 仅支持term和range匹配
function es_filter_parse($field_list, $data)
{
    $term = array();
    $range = array();
    foreach ($field_list as $_field => $_str)
    {
        if (isset($data[$_field]) && is_string($data[$_field]) && $data[$_field] != '')
        {
            $token = array('column'=>'','compare'=>array());
            parse_str($_str, $token);
            if($token['compare']=='term')
            {
                $term[] = array('term'=>array($token['column']=>$data[$_field]));
            }elseif ($token['compare']=='date_start') 
            {
                $range[$token['column']]['range'][$token['column']]['from']=date('Y-m-d H:i:s',  strtotime($data[$_field]));
            }else if($token['compare']=='date_end')
            {
                $range[$token['column']]['range'][$token['column']]['to']= date('Y-m-d H:i:s',  strtotime($data[$_field].' 23:59:59'));
            }
        }
    }
    return array_merge($term,  array_values($range));
}

function str_replace_star($str,$star_len=3)
{
    $len = mb_strlen($str);
    if($len>$star_len+2)
    {
        return mb_ereg_replace(mb_substr($str, ceil(($len-$star_len)/2), $star_len), str_pad('', $star_len,'*'),$str);
    }
    return $str;
}

function ldap_login( $Flag = 'http')
{
    static $D_URL = 'https://login.ops.qihoo.net:4436/sec/login';
    static $B_URL = 'https://tool4.ops.dxt.qihoo.net:4436/sec/login';
    //判断D_URL是否有效,无效换备份跳转地址B_URL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $D_URL);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // allow redirects 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // return into a variable 
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($http_code != 200)
    {
        $D_URL = $B_URL;
    }
    //跳转
    $sid = isset($_GET['sid']) ? $_GET['sid'] : '';
    $ref = isset($_GET['ref']) ? $_GET['ref'] : '';
    //获取sid
    if (!(preg_match("/[0-9a-z]{32}/",$sid)))
    {
        $S_URL = $Flag . '://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
        $ref = $S_URL;
        $d_url = $D_URL . '?ref=' . $S_URL;
        redirect($d_url);
    }else
    {
        if (empty($ref))
        {
            $S_URL = $Flag . '://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
            $ref = $S_URL;
        }
        $url = $D_URL . '?sid=' . $sid . '&ref=' . $ref;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // allow redirects 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // return into a variable 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_TIMEOUT, 25);
        $result = curl_exec($ch);
        curl_close($ch);

        $userinfo = array();
        if ($result != 'None')
        {
            $userinfo = json_decode($result, true);
        }
        return $userinfo;
    }
}

/***********************************初始化控制器并执行该方法*******************************************************/

!isset($_SESSION) && session_start();
list($DIR, $CLASS, $ACT, $PARAMS) = uri_route();

include BASEPATH.'lib/ctrl.php';
$PATH = BASEPATH.'ctrl/'.strtolower($DIR.$CLASS).'_ctrl.php';

if (!file_exists($PATH))
{
    show404();
} else 
{
    include $PATH;
    $CLASS=$CLASS.'_ctrl';
    $OBJECT = new $CLASS;
    if($ACT =='list')
    {
        $ACT = 'index';
    }
    if (!method_exists($OBJECT, $ACT))
    {
        show404();
    }
    $resp = call_user_func_array(array($OBJECT, $ACT), $PARAMS);
    if(is_array($resp))
    {
        echo json_encode($resp);
    }
}