<?php
    require 'config/constant.php'; 
    $dir = dirname($_SERVER['PHP_SELF']);
    $v = 0;
    $concat = ""; 
    for ($i=0;$i<strlen($dir);$i++) {
        if ($dir[$i] == "/") {
            $v++;
        }
    }
    if ($dir != "/") {
        for ($i=0;$i<$v;$i++) {
            $concat .= "../";
        }
    }
    if (isset($_COOKIE['game_random_app'])) {
        $value = decrypt($_COOKIE['game_random_app']);
        $result = $database->select("t_user","id,type","id='$value'");
        if ($result) {
            $data = $database->select("t_user_info","*","id_login='$value'");
            $_SESSION['user_loggeg'] = $data;
            if ($result['type'] == "ADMIN") {
                if (dirname($_SERVER['PHP_SELF']) != "/views/admin") {
                    header("Location:$concat"."views/admin/admin.php");
                } 
            }
            if ($data['active']) {
                if (dirname($_SERVER['PHP_SELF']) == "/") {
                    header("Location:$concat"."views/app/app.php");
                } else if (dirname($_SERVER['PHP_SELF']) == "/views/admin" && $result['type'] != "ADMIN") {
                    header("Location:$concat"."views/app/app.php");
                }
            } else {
                if (dirname($_SERVER['PHP_SELF']) != "/views/validator") {
                    header("Location:$concat"."views/validator/account_valid.php");
                } 
            }
        } else {
            setcookie('game_random_app',null,0,"/");
            header("Location:$concat"."views/authentification/login.php");
        }
    } else {
        header("Location:$concat"."views/authentification/login.php");
    }
?>