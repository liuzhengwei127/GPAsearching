<?php
include "PasswordCheck.php";
$back_loc = "location = ResetPasswordPage.html;";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $pass = $_POST['previous_password'];
    if (password_check($pass) != 1) 
    {
        echo "<script>alert('previous password incorrect');".$back_loc."</script>";
    }
    else
    {
        $new_pass = $_POST['new_password'];
        $check_pass = $_POST['check_password'];
        if ($new_pass != $check_pass) 
        {
            echo "<script>alert('Please input the same password');".$back_loc."</script>";
        }
        else 
        {
            password_change($new_pass);
            echo "<script>alert('Password change success');location='Manage_login.html';</script>";
        }
    }
}