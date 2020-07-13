<?php
    require '../config/constant.php';
    $idLoginAdmin = $database->select("t_user","*","type='ADMIN'")["id"];
    $idAdminUser = $database->select("t_user_info","*","id_login='$idLoginAdmin'")['id'];
    $balanceAdmin = $database->select("t_user_params","*","id_user='$idAdminUser'")["balance"];
    $wallet = $database->select("t_params","*","id=1")["wallet"];
    if ($wallet != $balanceAdmin) {
        $data = [
            "balance" => $wallet
        ];
        $database->update("t_user_params",$data,"id_user='$idAdminUser'");
    }
?>