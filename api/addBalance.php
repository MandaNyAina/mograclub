<?php
    require '../config/constant.php';
    require_once('paiement/api.php');
    $key = parse_ini_file("../config/config.ini")["key_encrypt"];
    if (is_form_valid(@$_GET['key']) && @$_GET['key'] == $key) {
        $id = $_SESSION['user_loggeg']['id'];
        $amount = $_POST['recharge'];
        $userRow = $database->select("t_user_info","*","id='$id'");
        $user = array();
        $user['customerName'] = $userRow['first_name']." ".$userRow['last_name'];
        $user['customerEmail'] = $userRow['mail'];
        $user['customerPhone'] = $userRow['phone'];
        $order = array();
        $order['orderAmount'] = $amount;
        $order['orderNote'] = "Recharge";
        $order['orderCurrency'] = "INR";
        try {
            $payement = new Payment();
            $send = $payement->pay($user,$order);
        } catch (Exception $e) {
            echo "Payement error => ".$e;
        }
    } else if (!is_form_valid(@$_GET['key']) || @$_GET['key'] != $key) {
        echo $_GET['key'];
    }
?>