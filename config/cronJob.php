<?php
    require 'constant.php';
    $rows = $database->selectMore("t_rel_promotion");
    $i = 0;
    $all = [];
    foreach ($rows as $value) {
        $idProperty = $value['t_user_property'];
        $_id = $value['t_user_rel'];
        $_idLogin = $database->select("t_user_info","*","id='$_id'")["id_login"];
        $active = $database->select("t_user","*","id='$_idLogin'")["active"];
        if ($active) {
            if (!in_array($idProperty, $all)) {
                array_push($all, $idProperty);
            }
        }
    }
    foreach ($all as $id) {
        $getCurrentBalance = $database->select("t_user_params","*","id_user='$id'")["balance"];
        $data = [
            "balance" => ($getCurrentBalance+2)
        ];
        $database->update("t_user_params",$data,"id_user='$id'");
    }
    $tomorrow  = date("Y")."-".date("m")."-".(date("d")+1);
    $today = date("Y")."-".date("m")."-".date("d");
    $nextMonth = 31;
    $currentMonth = intval(date("m"));
    if ($currentMonth == 2) {
        $nextMonth = 28;
    } else if ($currentMonth %2 == 0) {
        $nextMonth = 30;
    }
    $nextMonth = date('Y')."-".date('m')."-".($nextMonth);
    $data = [
        "start_date" => $today,
        "stop_date" => $tomorrow,
        "get_date" => $today
    ];
    $GLOBALS['database']->update("t_task",$data,"number_ref != 500");
    $data = [
        "start_date" => $today,
        "stop_date" => $nextMonth ,
        "get_date" => $today
    ];
    $database->update("t_task",$data,"number_ref = 500");
?>