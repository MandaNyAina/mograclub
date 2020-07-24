<?php 
    require '../../config/constant.php';
    if ($_GET['form'] == "reset") {
        if (is_form_valid($_POST['password'])) {
            $data = [
                "password" => password_encrypt($_POST['password'])
            ];
            $database->update("t_user",$data,"type='ADMIN'");
            echo '<script>alert("Success")</script>';
        } else {
            echo '<script>alert("Password is require")</script>';
        }
    } else if ($_GET['form'] == "paypal") {
        if (is_form_valid($_POST['paypalMail']) && is_form_valid($_POST['paypalPassword'])) {
            $data = [
                "paypalAccount" => encrypt($_POST['paypalMail']),
                "paypalPassword" => encrypt($_POST['paypalPassword'])
            ];
            $database->update("t_params",$data,"id=1");
            echo '<script>alert("Success")</script>';
        } else {
            echo '<script>alert("Please entrer inside email and password")</script>';
        }
    } else if ($_GET['form'] == "gpay") {
        if (is_form_valid($_POST['gpayMail']) && is_form_valid($_POST['gpayPassword'])) {
            $data = [
                "gpayAccount" => encrypt($_POST['gpayMail']),
                "gpayPassword" => encrypt($_POST['gpayPassword'])
            ];
            $database->update("t_params",$data,"id=1");
            echo '<script>alert("Success")</script>';
        } else {
            echo '<script>alert("Please entrer inside email and password")</script>';
        }
    }
    
?>
<meta http-equiv="refresh" content="0; ../../views/admin/adminSetting.php">