<meta charset="UTF-8">
<?php
include "UpdateDatabase.php";
function load_data($data_file, $new_filename)
{
    $upload_path = "upload_data/";
    if (!is_dir($upload_path))
    {
        mkdir($upload_path,0777,true);
    }
    move_uploaded_file($data_file["tmp_name"], $upload_path.$data_file["name"]);
}

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $upload_year = $_POST["upload_year"];
    $upload_semester = $_POST["upload_semester"];
    $upload_file = $_FILES["file"];
    if ($upload_file["error"] != 0)
    {
        echo "<script>alert('文件上传出错')</script>";
    }
    else if ($upload_file["type"] != "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
        && $upload_file["type"] != "application/vnd.ms-excel")
    {
        echo "<script>alert('文件类型出错，请上传Excel文件')</script>";
    }
    else
    {
        $update_time = substr($upload_file["name"], 16);
        $update_time_form = substr($update_time, 0, 4)."-".substr($update_time, 4, 2)."-".substr($update_time, 6, 2)." ".substr($update_time, 8, 2).":".substr($update_time, 10, 2);
        $ext = strtolower( pathinfo($update_time, PATHINFO_EXTENSION) );
        if ($ext == "xls") $update_time = $update_time."x";
        load_data($upload_file, $update_time);
        $test_path = "upload_data/".$upload_file["name"];
        $upload_status = update_database($test_path, $update_time_form);
        echo "<script>alert(\"Success:".$upload_status['success']." Fail: ".$upload_status['fail']." Update time:".$update_time_form."\");</script>";
    }
    echo "<script>location='Management.html';</script>";
}