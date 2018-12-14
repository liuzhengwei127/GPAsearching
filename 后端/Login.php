<?php

$code = $_GET['code'];

$url = 'https://api.weixin.qq.com/sns/jscode2session?appid=wx4d613ff18f9c0195&secret=8c47545f92e17c92b08a05f10b03d49f&js_code=' . $code . '&grant_type=authorization_code';

$wx_return = file_get_contents($url);
$wx_arr = json_decode($wx_return,1);

$lin = mysql_connect('localhost','root','root');
mysql_select_db('gpa',$lin);

$search_string = "select * from bks where openid='".$wx_arr['openid']."'";
$query = mysql_query($search_string);

if ($query)
{
    $arr = mysql_fetch_array($query);
    if ($arr)
    {
        $arr['flag'] = true;
        $arr['openid'] = $wx_arr['openid'];       
    }
    else
    {
        $arr['flag']=false;
        $arr['openid'] = $wx_arr['openid'];
    }
}
else
{
    $arr = array();
    $arr['error'] = "query_error";
}

echo json_encode($arr);
