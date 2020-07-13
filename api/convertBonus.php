<?php
    require '../config/constant.php';
    $key = parse_ini_file("../config/config.ini")["key_encrypt"];
    if (is_form_valid(@$_GET['id']) && is_form_valid(@$_GET['key']) && @$_GET['key'] == $key) {
        $id = $_GET['id'];
        $postdata = file_get_contents("php://input");
        $value = floatval(json_decode($postdata));
        $row = $database->select("t_user_params","*","id_user='$id'");
        $bonus = $row['bonus'];
        $currentBalance = $row['balance'];
        $total = $currentBalance + $bonus;
        $data = [
            "balance" => $total,
            "bonus" => 0
        ];
        $database->update("t_user_params",$data,"id_user='$id'");
        echo "ok";
    } else if (!is_form_valid(@$_GET['key']) || @$_GET['key'] != $key) {
        echo "Unauthorized";
    } else if (!is_form_valid(@$_GET['id'])) {
        echo "Invalid ID";
    }
?>