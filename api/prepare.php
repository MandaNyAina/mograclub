<?php
    require '../config/constant.php';
    $key = parse_ini_file("../config/config.ini")["key_encrypt"];
    if (is_form_valid(@$_GET['key']) && @$_GET['key'] == $key) {
        $now = date("d").date("m").date("Y").date("H").date("i").date("s").$_GET['groups'][0];
        $data = [
            "period" => $now,
            "number" => 0,
            "result" => 0,
            "groups" => $_GET['groups'],
            "price" => 0,
            "showing" => 0
        ];
        $database->insert("t_winner",$data);
        echo $now;
    } else if (!is_form_valid(@$_GET['key']) || @$_GET['key'] != $key) {
        echo "Unauthorized";
    }
?>