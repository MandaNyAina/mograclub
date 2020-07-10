<?php
    require '../../config/constant.php';
    if (is_form_valid($_POST['username']) && is_form_valid($_POST['password'])) {
        $result = $database->select("t_user","id,password","username='".clearString($_POST['username'])."'");
        if ($result && password_match($result['password'], $_POST['password'])) {
            setcookie('game_random_app',encrypt($result['id']),time()+(86400 * 30),"/");
            $value = $result['id'];
            $data = $database->select("t_user_info","*","id_login='$value'");
            if ($data['type'] != "ADMIN") {
                $load = [
                    "active" => 1
                ];
                $database->update('t_user',$load,"id='$value'");
            }
            $_SESSION['user_loggeg'] = $data;
            if ($data['active']) {
                header("Location:../../views/app/app.php");
            } else {
                header("Location:../../views/validator/account_valid.php");
            }
        } else {
            $_SESSION['error_login'] = true;
            header('Location:../../views/authentification/login.php');
        }
    } else {
        header('Location:../../views/authentification/login.php');
    }
?>