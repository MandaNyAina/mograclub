<?php
    require '../config/constant.php';
    $tomorrow  = mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"));
    $today = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
    $data = [
        "start_date" => $today.'8:15',
        "stop_date" => $tomorrow.'8:15',
        "get_date" => $today.'7:15'
    ];
    $database->update("t_task",$data,"1");
?>