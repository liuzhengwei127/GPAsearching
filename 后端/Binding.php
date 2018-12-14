<?php

header("Content-Type: text/html;charset=utf-8");

$studentID = $_GET['studentID'];
$studentName = $_GET['studentName'];
$openid = $_GET['openid'];
$result = array();
$search_string = 'select * from bks'
        . ' where studentID='.$studentID;

$lin = mysql_connect('localhost','root','root');
if ($lin)
    mysql_select_db('gpa',$lin);
else
    $result['status_code'] = 5; 


$query1 = mysql_query($search_string);
if ($query1)
{
    $data = mysql_fetch_array($query1);
    if ($data)
    {
        if ($data['studentName'] != $studentName)
        {
            $result['status_code'] = 1; 
        }
        else
        {
            if ($data['openid'])
            {
                $result['status_code'] = 2;
            }
            else
            {
                $bind_string = "update bks set openid='".$openid."' where studentID='".$studentID."'";
                $query2 = mysql_query($bind_string);
                if ($query2)
                {
                    $result = $data;
                    $result['status_code'] = 0;
                } 
                else
                {
                    $result['status_code'] = 4;
                }
            }
        }
    }
    else
    {
        $result['status_code'] = 3;
    }
}
else
{
    $result['status_code'] = 4;    
}

echo json_encode($result);