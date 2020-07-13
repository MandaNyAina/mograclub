<?php
    require '../config/constant.php';
    $key = parse_ini_file('../config/config.ini')['key_encrypt'];
    $postdata = file_get_contents("php://input");
    $value = floatval(json_decode($postdata));
    if (is_form_valid(@$_GET['id']) && is_form_valid(@$_GET['key']) && @$_GET['key'] == $key) {
        $id = $_GET['id'];
        $groups = $_GET['groups'];
        if ($_GET["options"] == "current") {
            $row = $database->selectMore("t_order","*","id_user='$id' and status='current' and groups='$groups'");
            echo json_encode($row);
        } if ($_GET["options"] == "history") {
            $row = $database->selectMore("t_order","*","id_user='$id' and status='done' and groups='$groups'");
            echo json_encode($row);
        }
    } else if (!is_form_valid(@$_GET['key']) || @$_GET['key'] != $key) {
        echo "Unauthorized";
    } else if (!is_form_valid(@$_GET['id'])) {
        $row = $database->selectMore("t_order","*","status='current'");
        $amountPerGroup = [
            'AGATE' => 0,
            'BERYL' => 0,
            'CELESTINE' => 0,
            'DIAMOND' => 0,
            'EMERALD' => 0,
            'FLINT' => 0
        ];
        $amount = 0;
        $nbrOfPlayer = count($row);
        foreach ($row as $value) {
            if ($value['groups'] == 'AGATE') {
                $amountPerGroup['AGATE'] += $value['amount'];
            } else if ($value['groups'] == 'BERYL') {
                $amountPerGroup['BERYL'] += $value['amount'];
            } else if ($value['groups'] == 'CELESTINE') {
                $amountPerGroup['CELESTINE'] += $value['amount'];
            } else if ($value['groups'] == 'DIAMOND') {
                $amountPerGroup['DIAMOND'] += $value['amount'];
            } else if ($value['groups'] == 'EMERALD') {
                $amountPerGroup['EMERALD'] += $value['amount'];
            } else if ($value['groups'] == 'FLINT') {
                $amountPerGroup['FLINT'] += $value['amount'];
            }
            $amount += $value["amount"];
        }
        $value = [
            "nbrOfPlayer" => $nbrOfPlayer,
            "agate" => $amountPerGroup["AGATE"],
            "beryl" => $amountPerGroup["BERYL"],
            "celestine" => $amountPerGroup["CELESTINE"],
            "diamond" => $amountPerGroup["DIAMOND"],
            "emerald" => $amountPerGroup["EMERALD"],
            "flint" => $amountPerGroup["FLINT"],
            "amount" => $amount
        ];
        echo json_encode($value);
    }
?>