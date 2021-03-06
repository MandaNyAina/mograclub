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
        $file = fopen("paylog.txt","a");
        $payment = new Payment();
        
        $getBalance = $database->select("t_user_params","balance","id_user='$id'")["balance"];
        if ($getBalance >= $value) {
            $amount = 0;
            $y = 0;
            if ($value > 1500) {
                $amount = $value - 35;
                $y = 35;
            } else {
                $amount = $value - (($value * 2) / 100);
                $y = (($value * 2) / 100);
            }
            $cashfreeFee = $amount * ((1.75) / 100);
            $response = [];
            $date = date("Y-m-d H:i:s");
            $x = $getBalance - $value - $y - $cashfreeFee;
            if ($bankInfo) {
                $data['amount'] = $amount;
                $withdrawal = $payment->api("requestTransfer",$data);
                $rep = "withdrawing ".date("d-m-Y H:i:s")." :: ".json_encode($withdrawal)."\n";
                fwrite($file, $rep);
                if ($withdrawal['api response']['status'] == "SUCCESS") {
                    $database->update("t_user_params",["balance" => $x],"id_user='$id'");
                    $data = [
                        "id_user" => $id,
                        "price" => $value,
                        "type" => "withdrawal",
                        "date" => $date
                    ];
                    $database->insert("t_recharge",$data);
                    $message = "
                    Withdrawal information,
                    the bank service charge is $cashfreeFee rupees
                    Thanks for you
                    ";
                    $rep = [
                        "status" => $withdrawal['api response']['status'],
                        "message" => $message
                    ];
                    echo json_encode($rep);
                } else {
                    $rep = [
                        "status" => $withdrawal['api response']['status'],
                        "message" => $withdrawal['api response']['message']
                    ];
                    echo json_encode($rep);
                }
            } else {
                $rep = [
                    "status" => "error",
                    "message" => "Your bank is not set"
                ];
                echo json_encode($rep);
            }
        } else {
            $rep = [
                "status" => "error",
                "message" => "The withdrawal amount error, balance low"
            ];
            echo json_encode($rep);
        }
    } else if (!is_form_valid(@$_GET['key']) || @$_GET['key'] != $key) {
        echo "Unauthorized";
    } else if (!is_form_valid(@$_GET['id'])) {
        echo "Invalid ID";
    }
?>