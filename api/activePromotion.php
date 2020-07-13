<?php
    require '../config/constant.php';
    $key = parse_ini_file("../config/config.ini")["key_encrypt"];
    if (is_form_valid(@$_GET['id']) && is_form_valid(@$_GET['key']) && @$_GET['key'] == $key) {
        $id = $_GET['id'];
        $row = $database->selectMore("t_rel_promotion","*","t_user_property='$id'");
        $active = 0;
        $people = 0;
        $contribution = 0;
        foreach ($row as $value) {
            $_id = $value['t_user_rel'];
            $_id_log = $database->select("t_user_info","*","id='$_id'")["id_login"];
            $actUser = $database->select("t_user","*","id='$_id_log'");
            if ($actUser['active']) {
                $active++;
            }
            $allPlay = $database->selectMore("t_order","**","id_user='$_id' and status='current'");
            $people = count($allPlay);
            foreach ($allPlay as $p) {
                $contribution += $p["amount"];
            }
        }
        $result = [
            "active" => $active,
            "people" => $people,
            "contribution" => $contribution
        ];
        echo json_encode($result);
    } else if (!is_form_valid(@$_GET['key']) || @$_GET['key'] != $key) {
        echo "Unauthorized";
    } else if (!is_form_valid(@$_GET['id'])) {
        echo "Invalid ID";
    }
?>