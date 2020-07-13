<?php
    require '../config/constant.php';
    $key = parse_ini_file("../config/config.ini")["key_encrypt"];
    if (is_form_valid(@$_GET['id']) && is_form_valid(@$_GET['key']) && @$_GET['key'] == $key) {
        $id = $_GET['id'];
        $group = $_GET['groups'];
        $row = $database->selectMore("t_order","*","status='current' and id_user='$id' and groups='$group'");
        if (count($row) < 3) {
            echo "ok";
        } else {
            echo "ko";
        }
    } else if (!is_form_valid(@$_GET['key']) || @$_GET['key'] != $key) {
        echo "Unauthorized";
    }
?>