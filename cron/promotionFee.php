<?php
    require '../config/constant.php';
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
?>