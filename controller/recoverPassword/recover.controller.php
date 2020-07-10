<?php
    require '../../config/constant.php';
    if (is_form_valid($_GET['user'])) {
        $id = $_GET['user'];
        $random = randomValue(8);
        $row = $database->select("t_user_info","*","id='$id'");
        $message = "
        Hello ".$row['last_name']." ".$row['first_name'].", <br>
        Your new password is $random. You can change this in Accounts settings/Account security
        ";
        $id_user = $row['id_login'];
        sendMail("Your new password",$row['mail'], $message);
        $database->update("t_user",["password" => password_encrypt($random)],"id='$id_user'");
        $_SESSION['password_change'] = true;
        header("Location:../../index.php");
    } else {
        $_SESSION['error_num'] = true;
        header('../../views/recoverPassword/recover.php');
    }
?>