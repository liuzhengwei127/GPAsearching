<?php
$password_file_add = "woaingmenzh.txt";

function password_check($get_password)
{
    $password_file = fopen($GLOBALS['password_file_add'],"r");
    $true_password = fgets($password_file);
    $get_pass = md5($get_password);
    fclose($password_file);
    if ($get_pass == $true_password) return 1;
    else  return 0;
}

function password_change($new_password)
{
    $password_file = fopen($GLOBALS['password_file_add'],"w");
    fwrite($password_file,md5($new_password));
    fclose($password_file);
}