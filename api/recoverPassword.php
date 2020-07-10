<?php
    require '../config/constant.php';
    $key = parse_ini_file("../config/config.ini")["key_encrypt"];
    if (is_form_valid(@$_GET['key']) && @$_GET['key'] == $key) {
        if (is_form_valid($_GET['mail'])) {
            $mail = $_GET['mail'];
            $data = $database->selectMore('t_user_info','*',"mail='$mail'");
            if ($data) {
                echo json_encode($data);
            } else {
                echo "unkown";
            }
        } else {
            $_SESSION['error_num'] = true;
            header('../views/recoverPassword/recover.php');
        }
    } else if (!is_form_valid(@$_GET['key']) || @$_GET['key'] != $key) {
        echo "Unauthorized";
    }
?>