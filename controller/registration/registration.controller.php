<?php 
    require '../../config/constant.php';
    require '../../api/taskServiceApi.php';
    require '../../api/promotionService.php';
    
    if (is_form_valid($_POST['fname']) && is_form_valid($_POST['lname']) && is_form_valid($_POST['mail']) && is_form_valid($_POST['phone']) && is_form_valid($_POST['username']) && is_form_valid($_POST['password'])  && is_form_valid($_POST['invite'])) {
        $inv = $_POST['invite'];
        $promotion = new Promotion($database);
        $task = new Task();
        $user_promo = $promotion->exist($inv);
        $task_value = $task->exist($inv);
        $verify = 0;
        if ($user_promo) {
            $verify = 1;
        } else if ($task_value)  {
            $verify = 1;
        }
        $check = $database->select("t_user","username","username='".$_POST['username']."'");
        if (!$check && $verify) {
            $id = randomValue(50);
            $password = password_encrypt($_POST['password']);
            $data = [
                "id" => $id,
                "username" => clearString($_POST['username']) ,
                "password" => $password,
                "active" => 0
            ];
            $save = $database->insert("t_user",$data);
            if ($save) {
                $id_info = randomValue(50);
                $code = randomValue(5);
                $msg = "
                <h2>Hello</h2>
                Your account activation key is <b>$code</b><br/> <br>
                Thanks,
                ";
                sendMail("MograClub | Mail verification",$_POST['mail'],$msg);
                $data = [
                    "id" => $id_info,
                    "first_name" => clearString($_POST['fname']) ,
                    "last_name" => clearString($_POST['lname']),
                    "mail" => clearString($_POST['mail']) ,
                    "phone" => clearString($_POST['phone']) ,
                    "active" => 0,
                    "code" => $code,
                    "id_login" => $id,
                    "address" => clearString($_POST['aname'])
                ];
                $save = $database->insert("t_user_info",$data);
                $promotion->addReferTo($user_promo, $id_info);
                $promotion->createPromotion($id_info);
                $data = [
                    "first_pay" => 0,
                    "id_user" => $id_info,
                    "balance" => 0,
                    "bonus" => 0
                ];
                $set_balance = $database->insert("t_user_params",$data);
                if ($save && $set_balance) {
                    if ($task_value) {
                        $task->valide_1($inv, $id_info);
                    } else if ($user_promo) {
                        $promotion->profit_now($user_promo);

                    }
                    $_SESSION['account_for_validate'] = $id_info;
                    $_SESSION['register_ok'] = true;
                    header("Location:../../views/authentification/login.php");
                }
            } else {
                $_SESSION['not_save_error'] = true;
                header("Location:../../views/registration/registre.php");
            }
        } else if (!$verify) {
            $_SESSION['invite_code_error'] = true;
            header("Location:../../views/registration/registre.php");
        } else {
            $_SESSION['not_save_exist'] = true;
            header("Location:../../views/registration/registre.php");
        }
    } else {
        $_SESSION['form_vide'] = true;
        header("Location:../../views/registration/registre.php");
    }
?>