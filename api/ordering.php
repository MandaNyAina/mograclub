<?php
    require '../config/constant.php';
    $key = parse_ini_file('../config/config.ini')['key_encrypt'];
    $postdata = file_get_contents("php://input");
    $value = json_decode($postdata, true);
    if (is_form_valid(@$_GET['id']) && is_form_valid(@$_GET['key']) && @$_GET['key'] == $key) {
        $id = $_GET['id'];
        $groups = $value["groups"];
        if ($_GET['service'] == "ordering") {
            $idOrder = randomValue(14);
            $date = date("Y-m-d");
            $amount = $value["amount"];
            $selected = $value["selected"];
            $is_win = 0;
            $status = "current";
            $type = $value['branch'];
            $data = [
                "numOrder" => $idOrder,
                "date" => $date,
                "amount" => $amount,
                "amount_winning" => 0,
                "selected" => $selected,
                "type" => $type,
                "is_win" => $is_win,
                "converted" => 0,
                "status" => $status,
                "groups" => $groups,
                "id_user" => $id
            ];
            $database->insert('t_order',$data);
            $balance = $database->select("t_user_params","balance","id_user='$id'")["balance"];
            $balance = $balance - $amount;
            $database->update('t_user_params',["balance" => $balance],"id_user='$id'");
            echo "Send Done";
        } else if ($_GET['service'] == "validate") {
            $period = $value['period'];
            $colorWinner = $value['color'];
            $numberWinner = $value['number'];
            $groups = $value["groups"];
            $winner = 0;
            $profit = 0;
            $gagne = 0;
            $res = $database->selectMore("t_order","*","id_user='$id' and status='current' and groups='$groups '");
            foreach ($res as $n) {
                $selected = $n["selected"];
                $amount = $n["amount"];
                $idOrder = $n["numOrder"];
                if ($n["type"] == "N") {
                    if (intval($selected) == intval($numberWinner)) {
                        // winning
                        $amount_winning = $amount * 5;
                        $data = [
                            "id_winner_period" => $period,
                            "amount_winning" => $amount_winning,
                            "is_win" => 1,
                            "status" => "done"
                        ];
                        $update = $database->update('t_order',$data,"numOrder='$idOrder'");
                        $getBalance = $database->select("t_user_params","*","id_user='$id'")["balance"];
                        $amount_winning = $amount_winning + $getBalance;
                        $database->update("t_user_params",["balance" => $amount_winning],"id_user='$id'");
                        $params = $database->select("t_params","*","id=1");
                        $winner =  $params["nbr_winner"] + 1;
                        $profit =  $params["wallet_profit"] - $amount_winning;
                        $data = [
                            "wallet_profit" => $profit,
                            "nbr_winner" => $winner,
                            "$groups" => $colorWinner." (".$numberWinner.")"
                        ];
                        $database->update('t_params',$data,"id=1");
                        $data = [
                            "price" => $amount_winning,
                            "type" => "Reward",
                            "id_user" => $id,
                            "date" => date("Y-m-d")
                        ];
                        $database->insert("t_recharge",$data);
                        $gagne++;
                        echo $update;
                    } else {
                        // losing
                        $data = [
                            "status" => "done"
                        ];
                        $database->update('t_order',$data,"numOrder='$idOrder'");
                        $params = $database->select("t_params","*","id=1")["wallet_profit"];
                        $profit = $amount + $params;
                        $data = [
                            "wallet_profit" => $profit,
                            "$groups" => $colorWinner." (".$numberWinner.")"
                        ];
                        $database->update('t_params',$data,"id=1");
                    }
                } else if ($n["type"] == "C") {
                    $amount_winning = 0;
                    if ($selected == $colorWinner) {
                        // winning
                        $amount_winning = 0;
                        if ($amount <= 100) {
                            $amount_winning = $amount * 1.5;
                        } else if ($amount > 100) {
                            $amount_winning = $amount * 2;
                        }
                        $data = [
                            "id_winner_period" => $period,
                            "amount_winning" => $amount_winning,
                            "is_win" => 1,
                            "status" => "done"
                        ];
                        $update = $database->update('t_order',$data,"numOrder='$idOrder'");
                        $getBalance = $database->select("t_user_params","*","id_user='$id'")["balance"];
                        $amount_winning = $amount_winning + $getBalance;
                        $database->update("t_user_params",["balance" => $amount_winning],"id_user='$id'");
                        $params = $database->select("t_params","*","id=1");
                        $winner =  $params["nbr_winner"] + 1;
                        $profit =  $params["wallet_profit"] - $amount_winning;
                        $data = [
                            "wallet_profit" => $profit,
                            "nbr_winner" => $winner,
                            "$groups" => $colorWinner." (".$numberWinner.")"
                        ];
                        $database->update('t_params',$data,"id=1");
                        $data = [
                            "price" => $amount_winning - $getBalance,
                            "type" => "Reward",
                            "id_user" => $id,
                            "date" => date("Y-m-d")
                        ];
                        $database->insert("t_recharge",$data);
                        $gagne++;
                        echo $update;
                    } if (($selected == "GREEN" && $colorWinner == "TIN,GREEN") || ($selected == "ORANGE" && $colorWinner == "TIN,ORANGE")) {
                        // winning
                        $amount_winning = 0;
                        if ($amount <= 100) {
                            $amount_winning = $amount * 1.25;
                        } else if ($amount > 100) {
                            $amount_winning = $amount * 1.4;
                        }
                        $data = [
                            "id_winner_period" => $period,
                            "amount_winning" => $amount_winning,
                            "is_win" => 1,
                            "status" => "done"
                        ];
                        $update = $database->update('t_order',$data,"numOrder='$idOrder'");
                        $getBalance = $database->select("t_user_params","*","id_user='$id'")["balance"];
                        $amount_winning = $amount_winning + $getBalance;
                        $database->update("t_user_params",["balance" => $amount_winning],"id_user='$id'");
                        $params = $database->select("t_params","*","id=1");
                        $winner =  $params["nbr_winner"] + 1;
                        $profit =  $params["wallet_profit"] - $amount_winning;
                        $data = [
                            "wallet_profit" => $profit,
                            "nbr_winner" => $winner,
                            "$groups" => $colorWinner." (".$numberWinner.")"
                        ];
                        $database->update('t_params',$data,"id=1");
                        $data = [
                            "price" => $amount_winning-$getBalance,
                            "type" => "Reward",
                            "id_user" => $id,
                            "date" => date("Y-m-d")
                        ];
                        $database->insert("t_recharge",$data);
                        $gagne++;
                        echo $update ;
                    } else if (($selected == "TIN" && $colorWinner == "TIN,GREEN") || ($selected == "TIN" && $colorWinner == "TIN,ORANGE")) {
                        // winning up
                        $amount_winning = 0;
                        if ($amount <= 100) {
                            $amount_winning = $amount * 2.8;
                        } else if ($amount > 100) {
                            $amount_winning = $amount * 4.5;
                        }
                        $data = [
                            "id_winner_period" => $period,
                            "amount_winning" => $amount_winning,
                            "is_win" => 1,
                            "status" => "done"
                        ];
                        $update = $database->update('t_order',$data,"numOrder='$idOrder'");
                        $getBalance = $database->select("t_user_params","*","id_user='$id'")["balance"];
                        $amount_winning = $amount_winning + $getBalance;
                        $database->update("t_user_params",["balance" => $amount_winning],"id_user='$id'");
                        $params = $database->select("t_params","*","id=1");
                        $winner =  $params["nbr_winner"] + 1;
                        $profit =  $params["wallet_profit"] - $amount_winning;
                        $data = [
                            "wallet_profit" => $profit,
                            "nbr_winner" => $winner,
                            "$groups" => $colorWinner." (".$numberWinner.")"
                        ];
                        $database->update('t_params',$data,"id=1");
                        $data = [
                            "price" => $amount_winning - $getBalance,
                            "type" => "Reward",
                            "id_user" => $id,
                            "date" => date("Y-m-d H:i:s")
                        ];
                        $database->insert("t_recharge",$data);
                        $gagne++;
                        echo $update ;
                    } else {
                        // losing
                        $data = [
                            "status" => "done"
                        ];
                        $database->update('t_order',$data,"numOrder='$idOrder'");
                        $params = $database->select("t_params","*","id=1")["wallet_profit"];
                        $profit = $amount + $params;
                        $data = [
                            "$groups" => $colorWinner." (".$numberWinner.")",
                            "wallet_profit" => $profit
                        ];
                        $database->update('t_params',$data,"id=1");
                    }
                }   
            }
            // if ($gagne>0) {
            //     echo "win";
            // } else {
            //     echo "lose";
            // }
        }
    } else if (!is_form_valid(@$_GET['key']) || @$_GET['key'] != $key) {
        echo "Unauthorized";
    } else if (!is_form_valid(@$_GET['id'])) {
        echo 'Invalid User ID';
    }
?>