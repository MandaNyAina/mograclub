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
            echo '<script>alert("Please entrer a password value")</script>';
        }
    } else if ($_GET['form'] == "bank") {
        if (is_form_valid($_POST['mailPay']) && is_form_valid($_POST['passPay'])) {
            $data = [
                "adminAccount" => encrypt($_POST['mailPay']),
                "passwordAccount" => encrypt($_POST['passPay'])
            ];
            $database->update("t_params",$data,"id=1");
            echo '<script>alert("Success")</script>';
        } else {
            echo '<script>alert("Please entrer inside email and password")</script>';
        }
    }
    
?>
<meta http-equiv="refresh" content="0; ../../views/admin/adminSetting.php">