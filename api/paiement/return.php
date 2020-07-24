<?php  
    require '../../config/constant.php';
    require '../taskServiceApi.php';
    $orderId = $_POST["orderId"];
    $orderAmount = $_POST["orderAmount"];
    $referenceId = $_POST["referenceId"];
    $txStatus = $_POST["txStatus"];
    $paymentMode = $_POST["paymentMode"];
    $txMsg = $_POST["txMsg"];
    $txTime = $_POST["txTime"];
    $signature = $_POST["signature"];
    $data = $orderId.$orderAmount.$referenceId.$txStatus.$paymentMode.$txMsg.$txTime;
    $hash_hmac = hash_hmac('sha256', $data, "4f71e0edc347872efac215ea99ba417570c9b76f", true) ;
    $computedSignature = base64_encode($hash_hmac);
    if ($signature == $computedSignature) {
        $task = new Task();
        $value = $_POST["orderAmount"];
        $id = $_SESSION['user_loggeg']['id'];
        $data = [
            "price" => $value,
            "type" => "Recharge",
            "id_user" => $id,
            "date" => date("Y-m-d H:i:s")
        ];
        $database->insert("t_recharge",$data);
        $deduct = 2;
        $oldBalance = floatval($database->select('t_user_params',"*","id_user='$id'")['balance']);
        $pay = $database->select('t_user_params',"*","id_user='$id'")['first_pay'];
        if ($pay == 0) {
            $deduct = 3;
            $task->valide_2($id);
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
        header("Location: ../../views/app/app.php#!/recharge");
    } else {
        echo "Somethings wrong";
    }
?>