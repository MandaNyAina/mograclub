<?php
    require '../config/constant.php';
    $key = parse_ini_file("../config/config.ini")["key_encrypt"];
    if (is_form_valid(@$_GET['key']) && @$_GET['key'] == $key) {
        $id = $_GET['id_value'];
        $row = $database->selectMore("t_redenvelop","*","link='$id' and used = 0");
        if (count($row) > 0) {
            echo json_encode($row);
        } else {
            echo json_encode([]);
        }
    } else if (!is_form_valid(@$_GET['key']) || @$_GET['key'] != $key) {
        echo "Unauthorized";
    }
?>