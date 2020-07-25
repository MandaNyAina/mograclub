<?php
    require 'constant.php';

    $all = $database->selectMore("t_rel_promotion");

    foreach($all as $rel) {
        $id = $rel['t_user_property'];
        $rows = $database->selectMore("t_rel_promotion","*","t_user_property='$id'");
        $user = $database->select("t_user_info","*","id='$id'");
        $user_login = $database->select("t_user","*","id='".$user['id_login']."'");
        $type_user = $user_login['type'];
        $active_number = 0;
        $contribution = 0;
        foreach ($rows as $value) {
            $id_refer = $value['t_user_rel'];
            $amountCurrentOrderReferalUser = $database->select("t_order","*","id_user='$id_refer' and status='current'")['amount'];
            $id_login_refer = $database->select("t_user_info","id_login","id='$id_refer'")['id_login'];
            $is_active = $database->select("t_user","active","id='$id_login_refer'")['active'];
            if ($is_active) {
                $contribution += $amountCurrentOrderReferalUser;
                $active_number++;
            }
        }
        if ($active_number > 0) {
            $database->update("t_reward",[
                                    "active" => $active_number,
                                    "contribution" => $contribution
                                ],"id_user='$id'");
            if ($type_user == "ADMIN") {
                $getSystWallet = $database->select("t_params","*","id=1")['wallet'];
                $newSystWallet = $getSystWallet + 2;
                $database->update("t_params",["wallet" => $newSystWallet],"id=1");
            } else {
                $getBalance = $database->select("t_user_params","*","id='$id'")['balance'];
                $newBalance = $getBalance + 2;
                $database->update("t_user_params",["balance" => $newBalance],"id='$id'");
            }
        }
    }
?>