<?php
    require '../config/constant.php';
    $key = parse_ini_file("../config/config.ini")["key_encrypt"];
    if (is_form_valid(@$_GET['id']) && is_form_valid(@$_GET['key']) && @$_GET['key'] == $key) {
        $postdata = file_get_contents("php://input");
        $value = json_decode($postdata, true);
        $id = $_GET['id'];
        $data = [
            "address" => $value["address"]
        ];
        $result = $database->update('t_user_info',$data,"id='$id'");
        if ($result) {
            echo "Ok";
        } else {
            echo "Ko";
        }
    } else if (!is_form_valid(@$_GET['key']) || @$_GET['key'] != $key) {
        echo "Unauthorized";
    } else if (!is_form_valid(@$_GET['id'])) {
        echo "Invalid ID";
    }
?>