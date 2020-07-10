<?php 
    require '../../config/constant.php';
    
    if (is_form_valid($_POST['fname']) && is_form_valid($_POST['lname']) && is_form_valid($_POST['mail']) && is_form_valid($_POST['phone']) && is_form_valid($_POST['username']) && is_form_valid($_POST['password'])  && is_form_valid($_POST['invite'])) {
        $inv = $_POST['invite'];
        $verify = $database->select("t_reward","*","id_para='$inv'");
        $check = $database->select("t_user","username","username='".$_POST['username']."'");
        if (!$check && $verify) {
            $database->update("t_reward",["nbr_pres" => "(nbr_pres+1)"],"id_para='$inv'");
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
                Your account activate key is <b>$code</b><br/>
                Thanks,
                ";
                // mail($_POST['mail'], "Your activated key", $msg);
                $data = [
                    "id" => $id_info,
                    "first_name" => clearString($_POST['fname']) ,
                    "last_name" => clearString($_POST['lname']),
                    "mail" => clearString($_POST['mail']) ,
                    "phone" => clearString($_POST['phone']) ,
                    "active" => 1,
                    "code" => $code,
                    "id_login" => $id,
                    "address" => clearString($_POST['aname'])
                ];
                $save = $database->insert("t_user_info",$data);
                $v = date("m").date("Y");
                $data = [
                    "id_para" => randomValue(6).$v,
                    "nbr_pers" => 0,
                    "id_user" => $id_info
                ];
                $set_reward = $database->insert('t_reward', $data);
                $data = [
                    "first_pay" => 0,
                    "id_user" => $id_info,
                    "balance" => 0
                ];
                $set_balance = $database->insert("t_user_params",$data);
                if ($save && $set_balance && $set_reward) {
                    $_SESSION['account_for_validate'] = $id_info;
                    header("Location:../../views/registration/registre.php");
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