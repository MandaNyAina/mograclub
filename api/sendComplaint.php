<?php
    require '../config/constant.php';
    $postdata = file_get_contents("php://input");
    $value = json_decode($postdata, true);
    $key = parse_ini_file("../config/config.ini")["key_encrypt"];
    if (is_form_valid(@$_GET['key']) && @$_GET['key'] == $key) {
        if ($_GET['type'] == "new") {
            $id = $_GET['id'];
            $date = date("D, d M Y");
            $time = date("H:i:s");
            $dateSend = date('Y-m-d H:i:s');
            $type = "P";
            $now = date("m").date("Y");
            $tiketId = randomValue(9).$now;
            $is_read = 0;
            $message = $value['detail'];
            $messageType = $value["type"];
            $orderId = @$value["orderId"];
            $data = [
                "ticket_id" => $tiketId,
                "id_user" => $id,
                "message" => $message,
                "message_type" => $messageType,
                "type" => $type,
                "is_read" => $is_read,
                "order_id" => $orderId,
                "date" => $date,
                "time" => $time,
                "date_sender" => $dateSend,
                "solved" => 0
            ];
            $save = $database->insert("t_complaint",$data);
            if ($save) {
                echo "ok";
            } else {
                echo "ko";
            }
        } else if ($_GET['type'] == "response") {
            $id = $_GET['id'];
            $date = date("D, d M Y");
            $time = date("H:i:s");
            $dateSend = date('Y-m-d H:i:s');
            $type = "R";
            $messageType = "Response";
            $idSource = $value['source'];
            $message = $value['message'];
            $is_read = 0;
            $data = [
                "id_user" => $id,
                "source" => $idSource,
                "message" => $message,
                "message_type" => $messageType,
                "type" => $type,
                "is_read" => $is_read,
                "date" => $date,
                "time" => $time,
                "date_sender" => $dateSend,
                "solved" => 0
            ];
            $save = $database->insert("t_complaint",$data);
            if ($save) {
                echo "ok";
            } else {
                echo "ko";
            }
        }
    } else if (!is_form_valid(@$_GET['key']) || @$_GET['key'] != $key) {
        echo "Unauthorized";
    }
?>