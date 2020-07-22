<?php
    require '../config/constant.php';
    require_once('../api/paiement/api.php');
    $key = parse_ini_file("../config/config.ini")["key_encrypt"];
    if (is_form_valid(@$_GET['id']) && is_form_valid(@$_GET['key']) && @$_GET['key'] == $key) {
        $id = $_GET['id'];
        $bankInfo = $database->select("t_user_bank","*","id_user='$id'");
        $postdata = file_get_contents("php://input");
        $value = floatval(json_decode($postdata));
        $data = array();
        $data['beneId'] = $bankInfo['beneId'];
        $data['transferId'] = date("m").time();
        $payment = new Payment();
        
        $getBalance = $database->select("t_user_params","balance","id_user='$id'")["balance"];
        $amount = 0;
        $y = 0;
        if ($value > 1500) {
            $amount = $value - 1500;
            $y = 1500;
        } else {
            $amount = $value - (($value * 4) / 100);
            $y = (($value * 4) / 100);
        }
        $date = date("Y-m-d H:i:s");
        $x = $getBalance - $value - $y;
        if ($x > 0) {
            $data['amount'] = $amount;
            $withdrawal = $payment->api("requestTransfer",$data);
            if ($withdrawal['status'] == "SUCCESS") {
                $database->update("t_user_params",["balance" => $x],"id_user='$id'");
                $data = [
                    "id_user" => $id,
                    "price" => $value,
                    "type" => "withdrawal",
                    "date" => $date
                ];
                $database->insert("t_recharge",$data);
            }
            print_r($withdrawal);
        } else {
            echo "Ko";
        }
    } else if (!is_form_valid(@$_GET['key']) || @$_GET['key'] != $key) {
        echo "Unauthorized";
    } else if (!is_form_valid(@$_GET['id'])) {
        echo "Invalid ID";
    }
?>