<?php
    require '../config/constant.php';
    $key = parse_ini_file("../config/config.ini")["key_encrypt"];
    if (is_form_valid(@$_GET['id']) && is_form_valid(@$_GET['key']) && @$_GET['key'] == $key) {
        $id = $_GET['id'];
        $rows = $database->select("t_reward","*","id_user='$id'");
        $result = [
            "active" => $rows['active'],
            "people" => $rows['nbr_pers'],
            "contribution" => $rows['contribution']
        ];
        echo json_encode($result);
    } else if (!is_form_valid(@$_GET['key']) || @$_GET['key'] != $key) {
        echo "Unauthorized";
    } else if (!is_form_valid(@$_GET['id'])) {
        echo "Invalid ID";
    }
?>