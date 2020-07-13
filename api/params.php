<?php
    require '../config/constant.php';
    $result = $database->select('t_params','*');
    $key = parse_ini_file("../config/config.ini")["key_encrypt"];
    if (is_form_valid(@$_GET['key']) && @$_GET['key'] == $key) {
        $row = [
            "paypalAccount" => decrypt($result['paypalAccount']),
            "paypalPassword" => decrypt($result['paypalPassword']),
            "gpayAccount" => decrypt($result['gpayAccount']),
            "gpayPassword" => decrypt($result['gpayPassword']),
            "wallet" => $result['wallet'],
            "wallet_profit" => $result['wallet_profit'],
            "nbr_winner" => $result['nbr_winner'],
            "w_agate" => $result['AGATE'],
            "w_beryl" => $result['BERYL'],
            "w_celestine" => $result['CELESTINE'],
            "w_diamond" => $result['DIAMOND'],
            "w_emerald" => $result['EMERALD'],
            "w_flint" => $result['FLINT'],
        ];
        echo json_encode($row);
    } else if (!is_form_valid(@$_GET['key']) || @$_GET['key'] != $key) {
        echo "Unauthorized";
    }
?>