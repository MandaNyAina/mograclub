<?php 
    require '../../config/constant.php';
    if (isset($_SESSION['account_for_validate'])) {
        $id = $_SESSION['account_for_validate'];
    } else if (isset($_SESSION['user_loggeg'])) {
        $id = $_SESSION['user_loggeg']['id'];
    }
    if (!isset($id)) {
        header("Location:../../views/authentification/login.php");  
    }
    $code = randomValue(5);
    $data = [
        "code" => $code
    ];
    $updateCode = $database->update('t_user_info',$data,"id='$id'");
    $row = $database->select("t_user_info","*","id='$id'");
    if ($row) {
        $message = "
        Hello ".$row['last_name']." ".$row['first_name'].", <br>
        Your activation code is $code.
        ";
        $id_user = $row['id_login'];
        sendMail("Your activation code",$row['mail'], $message);
        $_SESSION['resend_ok'] = true;
        header("Location:../../views/validator/account_valid.php");
    } else {
        header("Location:../../views/authentification/login.php");
    }
    
?>