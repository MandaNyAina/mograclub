<?php
    require '../config/constant.php';
    $key = parse_ini_file("../config/config.ini")["key_encrypt"];
    if (is_form_valid(@$_GET['id']) && is_form_valid(@$_GET['key']) && @$_GET['key'] == $key) {
        $postdata = file_get_contents("php://input");
        $value = floatval(json_decode($postdata));
        if ($value) {
            $data = [
                "price" => $value,
                "type" => "Recharge",
                "id_user" => $_GET['id'],
                "date" => date("Y-m-d H:i:s")
            ];
            $database->insert("t_recharge",$data);
            $id = $_GET['id'];
            $deduct = 2;
            $oldBalance = floatval($database->select('t_user_params',"*","id_user='$id'")['balance']);
            $pay = $database->select('t_user_params',"*","id_user='$id'")['first_pay'];
            if ($pay == 0) {
                $deduct = 5;
            }
            $params = $database->select("t_params","*","id=1")["wallet"];
            $params += $deduct;
            $database->update("t_params",["wallet" => $params],"id=1");
            $value = ($oldBalance + $value) - $deduct;
            $data = [
                "first_pay" => 1,
                "balance" => $value
            ];
            $update = $database->update('t_user_params',$data,"id_user='$id'");  
            if ($update) {
                echo 'Ok';
            } else {
                echo 'Ko';
            }
        } else {
            echo 'Value empty';
        }
    } else if (!is_form_valid(@$_GET['key']) || @$_GET['key'] != $key) {
        echo "Unauthorized";
    } else if (!is_form_valid(@$_GET['id'])) {
        echo "Invalid ID";
    }
?>