<?php
    require '../config/constant.php';
    $postdata = file_get_contents("php://input");
    $value = json_decode($postdata, true);
    $key = parse_ini_file("../config/config.ini")["key_encrypt"];
    if (is_form_valid($_GET['id']) && is_form_valid(@$_GET['key']) && @$_GET['key'] == $key) {
        if ($value) {
            $id = $_GET['id'];
            $id = $database->select('t_user_info','id_login',"id='$id'")['id_login'];
            $data = [
                "password" => password_encrypt($value["new"]) 
            ];
            $older = $database->select('t_user',"password","id='$id'")['password'];
            
            if (password_match($older, $value["older"])) {
                $database->update('t_user',$data,"id='$id'");
                echo "ok";
            } else {
                echo "ko";
            }
        } else {
            echo "Empty value";
        } 
    } else if (!is_form_valid(@$_GET['key']) || @$_GET['key'] != $key) {
        echo "Unauthorized";
    } else if (!is_form_valid($_GET['id'])) {
        echo "Invalid ID";
    }
?>