<?php 
    require '../../config/constant.php';
    require '../../api/taskServiceApi.php';
    
    if (is_form_valid($_POST['fname']) && is_form_valid($_POST['lname']) && is_form_valid($_POST['mail']) && is_form_valid($_POST['phone']) && is_form_valid($_POST['username']) && is_form_valid($_POST['password'])  && is_form_valid($_POST['invite'])) {
        $inv = $_POST['invite'];
        $promo_value = $database->select("t_reward","*","id_para='$inv'");
        $task = new Task();
        $task_value = $task->exist($inv);
        $verify = 0;
        if ($promo_value) {
            $verify = 1;
        } else if ($task_value)  {
            $verify = 1;
        }
        $check = $database->select("t_user","username","username='".$_POST['username']."'");
        if (!$check && $verify) {
            $nbr_pers = intval($verify['nbr_pers']) + 1;
            $database->update("t_reward",["nbr_pers" => $nbr_pers],"id_para='$inv'");
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
                if ($task_value) {
                    $task->valide_1($inv, $id_info);
                }
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
                $v = date("d").date("m").date("Y");
                $data = [
                    "id_para" => randomValue(6).$v,
                    "nbr_pers" => 0,
                    "id_user" => $id_info
                ];
                $set_reward = $database->insert('t_reward', $data);
                $data = [
                    "first_pay" => 0,
                    "id_user" => $id_info,
                    "balance" => 0,
                    "bonus" => 0
                ];
                $set_balance = $database->insert("t_user_params",$data);
                if ($save && $set_balance && $set_reward) {
                    $_id = $verify['id_user'];
                    $currentBalance = $database->select("t_user_params","*","id_user='$_id'")['balance'];
                    $data = [
                        "balance" => $currentBalance + 15   
                    ];
                    $database->update("t_user_params",$data,"id_user='$_id'");
                    $walletSyst = $database->select("t_params","*","id=1")["wallet_profit"];
                    $newwalletSyst = $walletSyst - 15;
                    $database->update("t_params",["wallet_profit" => $newwalletSyst],"id=1");
                    $data = [
                        "t_user_property" => $verify['id_user'],
                        "t_user_rel" => $id_info
                    ];
                    $a = $database->insert("t_rel_promotion",$data);
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