<?php
    require '../config/constant.php';
    $key = parse_ini_file("../config/config.ini")["key_encrypt"];
    if (is_form_valid(@$_GET['key']) && @$_GET['key'] == $key) {
        $data = [
            "nbr_winner" => 0,
            "AGATE" => "",
            "BERYL" => "",
            "CELESTINE" => "",
            "DIAMOND" => "",
            "EMERALD" => "",
            "FLINT" => ""
        ];
        $database->update("t_params",$data,"id=1");
    } else if (!is_form_valid(@$_GET['key']) || @$_GET['key'] != $key) {
        echo "Unauthorized";
    }
?>