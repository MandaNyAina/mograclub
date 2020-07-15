<?php
    require '../config/constant.php';
    $key = parse_ini_file("../config/config.ini")["key_encrypt"];
    if (is_form_valid(@$_GET['key']) && @$_GET['key'] == $key) {
        $postdata = file_get_contents("php://input");
        $value = json_decode($postdata,true);
        $type = $value['type'];
        $total = $value['total'];
        $number = $value['number'];
        $user = $value['user_id'];
        $password = $value['password'];
        $idL = $database->select("t_user_info","*","id='$user'")['id_login'];
        $users = $database->select("t_user","*","id='$idL'");
        if (password_match($users['password'], $password)) {
            $order = "S";
            $used = 0;
            $result = [];
            $link = randomValue(15);
            if ($number > 0) {
                $amount = $database->select("t_user_params","*","id_user='$user'")['balance'];
                for ($i=0;$i<$number;$i++) {
                    $amount -= $total;
                }
                if ($amount > 0) {
                    for ($i=0;$i<$number;$i++) {
                        $database->update("t_user_params",["balance" => $amount], "id_user='$user'");
                        $data = [
                            "type" => $type,
                            "link" => $link,
                            "user_id" => $user,
                            "used" => $used,
                            "send_value" => $total,
                            "order_type" => $order,
                            "date" => date("D, d M Y H:i:s")
                        ];
                        $database->insert("t_redenvelop",$data);
                        array_push($result,$data);
                    }
                    echo $link;
                } else {
                    echo "amountKO";
                }
            }
        } else {
            echo "passError";
        }
    } else if (!is_form_valid(@$_GET['key']) || @$_GET['key'] != $key) {
        echo "Unauthorized";
    }
?>