<?php
    require '../config/constant.php';
    $result = $database->select('t_params','*');
    $key = parse_ini_file("../config/config.ini")["key_encrypt"];
    if (is_form_valid(@$_GET['key']) && @$_GET['key'] == $key) {
        $postdata = file_get_contents("php://input");
        $value = floatval(json_decode($postdata));
        $getOld = $database->select("t_params","*","id=1")['wallet'];
        $x = $getOld + $value;
        $database->update('t_params',["wallet" => $x],"id=1");
        echo $x;
    } else if (!is_form_valid(@$_GET['key']) || @$_GET['key'] != $key) {
        echo "Unauthorized";
    }
?>