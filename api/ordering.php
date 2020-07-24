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
            $GLOBALS['database'] = $database;
            function is_win_number($selected, $result) {
                $rep = [];
                if ($selected == $result) {
                    $rep = [
                        "rep" => "win",
                        "less" => 5,
                        "more" => 5
                    ];
                } else {
                    $rep = [
                        "rep" => "lose",
                        "less" => 0,
                        "more" => 0
                    ];
                }

                return $rep;
            }

            function is_win_color($selected, $result) {
                $rep = [];
                $result = explode(",",$result);
                if ($result[0] == $selected && count($result) == 1) {
                    $rep = [
                        "rep" => "win",
                        "less" => 1.5,
                        "more" => 2
                    ];
                } else if ($result[0] == $selected && count($result) == 2) {
                    $rep = [
                        "rep" => "win",
                        "less" => 2.8, 
                        "more" => 4.5
                    ];
                } else if ($result[1] == $selected && count($result) == 2) {
                    $rep = [
                        "rep" => "win",
                        "less" => 1.25,
                        "more" => 1.4
                    ];
                } else {
                    $rep = [
                        "rep" => "lose",
                        "less" => 0,
                        "more" => 0
                    ];
                }

                return $rep;
            }

            function winner($data, $profits) {
                $amount = $data['amount'];
                $idOrder = $data['numOrder'];
                $period = $data['period'];
                $id = $data['id'];
                if ($amount < 100) {
                    $profit = floatval($profits['less']);
                } else {
                    $profit = floatval($profits['more']);
                }
                $amount_winning = $amount * $profit;
                $data = [
                    "id_winner_period" => $period,
                    "amount_winning" => $amount_winning,
                    "is_win" => 1,
                    "status" => "done"
                ];
                $GLOBALS['database']->update('t_order',$data,"numOrder='$idOrder'");

                $data = [
                    "price" => $amount_winning,
                    "type" => "Reward",
                    "id_user" => $id,
                    "date" => date("Y-m-d")
                ];
                $GLOBALS['database']->insert("t_recharge",$data);
                $getCurrentBalance = $GLOBALS['database']->select("t_user_params","*","id_user='$id'")['balance'];
                $newBalance = $amount_winning + $getCurrentBalance;
                $GLOBALS['database']->update("t_user_params",["balance" => $newBalance],"id_user='$id'");

                $getSystemBalance = $GLOBALS['database']->select("t_params","*","id=1")['wallet_profit'];
                $newSystemBalance = $getSystemBalance - $amount_winning;
                $GLOBALS['database']->update("t_params",["wallet_profit" => $newSystemBalance],"id=1");
            }

            $period = $value['period'];
            $colorWinner = $value['color'];
            $numberWinner = $value['number'];
            $groups = $value["groups"];
            $winner = 0;
            $res = $database->selectMore("t_order","*","id_user='$id' and status='current' and groups='$groups '");
            foreach ($res as $n) {
                $getSystemBalance = $database->select("t_params","*","id=1")['wallet_profit'];
                $newSystemBalance = $getSystemBalance + $n['amount'];
                $database->update("t_params",["wallet_profit" => $newSystemBalance],"id=1");
                $data = [
                    "id" => $id,
                    "amount" => $n['amount'],
                    "period" => $period,
                    "numOrder" => $n['numOrder']
                ];
                $check_num = is_win_number($n['selected'], $numberWinner);
                $check_color = is_win_color($n['selected'], $colorWinner);
                if ($check_num['rep'] == "win") {
                    winner($data,$check_num);
                    $winner++;
                    $data = [
                        "nbr_winner" => $winner,
                        "$groups" => $colorWinner." (".$numberWinner.")"
                    ];
                    $database->update("t_params", $data,"id=1");
                    echo "win";
                } else if ($check_color['rep'] == "win") {
                    $winner++;
                    winner($data,$check_color);
                    $data = [
                        "nbr_winner" => $winner,
                        "$groups" => $colorWinner." (".$numberWinner.")"
                    ];
                    $database->update("t_params", $data,"id=1");
                    echo "win";
                } else {
                    $database->update('t_order',["status" => "done"],"numOrder='".$n['numOrder']."'");
                }
            }
        }
    } else if (!is_form_valid(@$_GET['key']) || @$_GET['key'] != $key) {
        echo "Unauthorized";
    } else if (!is_form_valid(@$_GET['id'])) {
        echo 'Invalid User ID';
    }
?>