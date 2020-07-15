<?php
    require '../config/constant.php';
    $key = parse_ini_file("../config/config.ini")["key_encrypt"];
    if (is_form_valid(@$_GET['key']) && @$_GET['key'] == $key) {
        $id = $_GET['v'];
        $idUser = $_GET['idU'];
        $row = $database->select("t_redenvelop","*","id='$id'");
        $sendValue = $row['send_value'];
        $order = "R";
        $used = 1;
        $data = [
            "received_value" => $sendValue,
            "order_type" => $order,
            "used" => $used,
            "user_id" => $idUser,
            "date" => date("D, d M Y H:i:s")
        ];
        $database->update("t_redenvelop",["used" => 1],"id='$id'");
        $v = $database->select("t_user_params","*","id_user='$idUser'")['balance'];
        $database->update("t_user_params",["balance" => floatval($v)+floatval($sendValue)],"id_user='$idUser'");
        $row = $database->insert("t_redenvelop",$data);
        echo "ok";
    } else if (!is_form_valid(@$_GET['key']) || @$_GET['key'] != $key) {
        echo "Unauthorized";
    }
?>