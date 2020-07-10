<?php
    require '../config/constant.php';
    $postdata = file_get_contents("php://input");
    $value = json_decode($postdata, true);
    $key = parse_ini_file("../config/config.ini")["key_encrypt"];
    if (is_form_valid(@$_GET['key']) && @$_GET['key'] == $key) {
        if (is_form_valid($_GET['id']) && is_form_valid($value['first_name']) && is_form_valid($value['last_name']) && is_form_valid($value['mail']) && is_form_valid($value['phone']) && is_form_valid($value['password'])) {
            $id = $_GET['id'];
            $id_login = $database->select('t_user_info','id_login',"id='$id'")['id_login'];
            $pass = $database->select('t_user','password',"id='$id_login'")['password'];
            if (password_match($pass, $value['password'])) {
                $data = [
                    "first_name" => clearString($value['first_name']) ,
                    "last_name" => clearString($value['last_name']),
                    "mail" => clearString($value['mail']) ,
                    "phone" => clearString($value['phone'])
                ];
                $save = $database->update('t_user_info',$data,"id='$id'");
                if ($save) {
                    echo "ok";
                } else {
                    echo "ko";
                }
            } else {
                echo "ko";
            }
        } else {
            echo 'ko';
        }
    } else if (!is_form_valid(@$_GET['key']) || @$_GET['key'] != $key) {
        echo "Unauthorized";
    }
?>