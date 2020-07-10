<?php
    require '../config/constant.php';
    $key = parse_ini_file("../config/config.ini")["key_encrypt"];
    if (is_form_valid(@$_GET['id']) && is_form_valid(@$_GET['key']) && @$_GET['key'] == $key) {
        $id = $_GET['id'];
        $postdata = file_get_contents("php://input");
        $value = json_decode($postdata, true);
        if ($value) {
            $data = [
                "type" => $value["type"]==NULL?NULL:$value["type"],
                "bcode" => $value["bcode"]==NULL?NULL:$value["bcode"],
                "bname" => $value["bname"]==NULL?NULL:$value["bname"],
                "xxx" => $value["xxx"]==NULL?NULL:$value["xxx"],
                "mail" => $value["mail"]==NULL?NULL:$value["mail"],
                "exp" => $value["exp"]==NULL?NULL:$value["exp"],
                "id_user" => $value["id_user"]==NULL?NULL:$value["id_user"]
            ];
            // $result = $database->select('t_user_bank','*',"id='$id'");
            // echo json_encode($result);
        } else {
            $result = $database->select('t_user_bank','*',"id_user='$id'");
            echo json_encode($result);
        }
    } else if (!is_form_valid(@$_GET['key']) || @$_GET['key'] != $key) {
        echo "Unauthorized";
    }
?>