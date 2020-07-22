<?php  
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
        echo "Payement done";
    } else {
        // Reject this call
    }
?>