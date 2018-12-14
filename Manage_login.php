<?php
include "PasswordCheck.php";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $pass = $_POST['input_password'];
    if (password_check($pass) != 1) echo "<script>alert('password incorrect'); location='Manage_login.html'; </script>";
    else
    {
        //session_start();
        //$_SESSION["LOGIN"] = 1;
        echo "<script>sessionStorage.setItem('LOGIN', 1);location='Management.html';</script>";
    }
}
?>
