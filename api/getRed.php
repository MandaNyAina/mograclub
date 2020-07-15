<?php
    require '../config/constant.php';
    $key = parse_ini_file("../config/config.ini")["key_encrypt"];
    if (is_form_valid(@$_GET['key']) && @$_GET['key'] == $key) {
        $id = $_GET['id'];
        if ($_GET['type'] == "send") {
            $rows = $database->selectMore("t_redenvelop","*","user_id='$id' and order_type='S'");
        } else if ($_GET['type'] == "receive") {
            $rows = $database->selectMore("t_redenvelop","*","user_id='$id' and order_type='R'");
        }
        echo json_encode($rows);
    } else if (!is_form_valid(@$_GET['key']) || @$_GET['key'] != $key) {
        echo "Unauthorized";
    }
?>