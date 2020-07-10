<?php 
    require '../../config/constant.php';
    if (is_form_valid($_POST['response'])) {
        if (isset($_SESSION['account_for_validate'])) {
            $id = $_SESSION['account_for_validate'];
        } else if (isset($_SESSION['user_loggeg'])) {
            $id = $_SESSION['user_loggeg']['id'];
        }
        $rep = $_POST['response'];
        $result = $database->select("t_user_info","*","id='$id' and code='$rep'");
        if ($result) {
            $data = [
                "active" => 1
            ];
            $update = $database->update("t_user_info",$data,"id='$id'");
            if ($update) {
                header("Location:../../views/app/app.php");
            }
        } else {
            echo $result;
            $_SESSION['invalid_code'] = true;
            header("Location:../../views/validator/account_valid.php");
        }
    }
?>