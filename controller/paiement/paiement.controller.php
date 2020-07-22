<?php
    require '../../config/constant.php';
    require_once('../../api/paiement/api.php');
    if (is_form_valid($_POST['nameAccount']) && is_form_valid($_POST['ifcs']) && is_form_valid($_POST['numberAcc']) && is_form_valid($_POST['state']) && is_form_valid($_POST['city']) && is_form_valid($_POST['address']) && is_form_valid($_POST['mobile']) && is_form_valid($_POST['emailAcc'])) {
        $beneId = randomValue(50);
        $id = $_SESSION["user_loggeg"]['id'];
        if ($_GET['type']=='save') {
            $data = [
                "id" => randomValue(50),
                "beneId" => $beneId,
                "name" => clearString($_POST['nameAccount']),
                "email" => clearString($_POST['emailAcc']),
                "phone" => clearString($_POST['mobile']),
                "bankAccount" => clearString($_POST['numberAcc']),
                "ifsc" => clearString($_POST['ifcs']),
                "address1" => clearString($_POST['address']),
                "city" => clearString($_POST['city']),
                "state" => clearString($_POST['state']),
                "id_user" => $id
            ];
            $payement = new Payment();
            $check = $payement->api('validation/bankDetails?name='.$data['name'].'&phone='.$data['phone'].'&bankAccount='.$data['bankAccount'].'&ifsc='.$data['ifsc'].'',$data);
            if ($check['subCode'] == 200) {
                $addBenificiary = $payement->api("addBeneficiary",$data);
                if ($addBenificiary) {
                    $database->insert("t_user_bank",$data);
                    header("Location: ../../views/app/app.php#!/bank");
                } else {
                    echo "<script>alert('Your bank information is wrong');</script>";
                    echo '<meta http-equiv="refresh" content="0; ../../views/app/app.php#!/bank">';
                }
            } else {
                echo "<script>alert('Your bank information is wrong');</script>";
                echo '<meta http-equiv="refresh" content="0; ../../views/app/app.php#!/bank">';
            }
        } else if ($_GET['type'] == 'update') {
            $data = [
                "name" => clearString($_POST['nameAccount']),
                "email" => clearString($_POST['emailAcc']),
                "phone" => clearString($_POST['mobile']),
                "bankAccount" => clearString($_POST['numberAcc']),
                "ifsc" => clearString($_POST['ifcs']),
                "vpa" => clearString($_POST['vpa']),
                "address1" => clearString($_POST['address']),
                "city" => clearString($_POST['city']),
                "state" => clearString($_POST['state'])
            ];
            
            $payement = new Payment();
            $addBenificiary = $payement->api('addBeneficiary',$data);
            
            if ($addBenificiary['status'] == "SUCCESS") {
                $database->insert("t_user_bank",$data);
                header("Location: ../../views/app/app.php#!/bank");
            } else {
                echo "<script>alert('Your bank information is wrong');</script>";
                echo '<meta http-equiv="refresh" content="0; ../../views/app/app.php#!/bank">';
            }
        }
    } else if ($_GET['type'] == 'delete') {
        $id = $_SESSION["user_loggeg"]['id'];
        $database->delete("t_user_bank","id_user='$id'");
        header("Location: ../../views/app/app.php#!/bank");
    } else {
        header("Location:../../views/app/app.php");
    } 
?>