<?php
    require '../config/constant.php';
    $key = parse_ini_file("../config/config.ini")["key_encrypt"];
    if (is_form_valid(@$_GET['key']) && @$_GET['key'] == $key) {
        if (@$_GET['id']) {
            $id = $_GET['id'];
            $rows = $database->selectMore("t_complaint","*","type='P' and id_user='$id' ORDER BY date_sender DESC");
            $result = [];
            foreach ($rows as $value) {
                $id_row = $value["ticket_id"];
                $row = $database->selectMore("t_complaint","*","source='$id_row' and type='R' ORDER BY date_sender DESC");
                $data = [
                    "parent" => $value,
                    "response" => $row
                ];
                array_push($result, $data);
            }
            echo json_encode($result);
        } else if (@$_GET['id_complaint']) {
            $id = $_GET['id_complaint'];
            $update = $database->update("t_complaint",["solved" => 1],"id='$id'");
            if ($update) {
                echo "ok";
            } else {
                echo "ko";
            }

        } else {
            $rows = $database->query("SELECT * FROM t_complaint WHERE type='P' ORDER BY  date_sender DESC");
            $result = [];
            foreach ($rows as $value) {
                $id_row = $value["ticket_id"];
                $row = $database->selectMore("t_complaint","*","source='$id_row' and type='R' ORDER BY date_sender DESC");
                $data = [
                    "parent" => $value,
                    "response" => $row
                ];
                array_push($result, $data);
            }
            echo json_encode($result);
        }
    } else if (!is_form_valid(@$_GET['key']) || @$_GET['key'] != $key) {
        echo "Unauthorized";
    }
?>