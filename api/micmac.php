<?php
    require '../config/constant.php';
    $key = parse_ini_file("../config/config.ini")["key_encrypt"];
    if (is_form_valid(@$_GET['key']) && @$_GET['key'] == $key) {
        $idPeriod = $_GET['period'];
        $groups = $_GET['groups'];
        $winnerFirstColor = $_GET['winC'];
        $winnerFirstNumber = $_GET['winN'];
        $color = [
            0 => "GREEN",
            1 => "ORANGE",
            2 => "VIOLET"
        ];
        $randomColor = $color[rand(0,2)];
        $randomNumber = null;
        if ($randomColor == "GREEN") {
            $colorByNumber = [
                0 => 3,
                1 => 5,
                2 => 7,
                3 => 9
            ];
            $randomNumber = $colorByNumber[rand(0, 3)];
        } else if ($randomColor == "ORANGE") {
            $colorByNumber = [
                0 => 2,
                1 => 4,
                2 => 6,
                3 => 8
            ];
            $randomNumber = $colorByNumber[rand(0, 3)];
        } else if ($randomColor == "VIOLET") {
            $colorByNumber = [
                0 => 0,
                1 => 1
            ];
            $randomNumber = $colorByNumber[rand(0, 1)];
            $temp = "VIOLET";
            $randomColor = $temp.",".$color[rand(0,1)];
        }
        $value = [
            "color" => $randomColor,
            "number" => $randomNumber,
            "groups" => $_GET['groups']
        ];
        $lastId = $database->getLastValue("t_winner","id")+1;
        if ($lastId == '') {
            $lastId = 1;
        }
        $now = date("d").date("m").date("Y").date("H").date("i");
        $price = 0;
        $allPlayer = $database->selectMore("t_order","*","status='current' and groups='$groups'");
        foreach ($allPlayer as $p) {
            $price += $p['amount'];
        }
        $data = [ 
            "price" => $price
        ];
        $database->update("t_winner",$data,"period='$idPeriod'");
        $allPlayer = $database->selectMore("t_order","selected","status='current' and groups='$groups'");
        $current = $database->select("t_winner","*","period='$idPeriod'");
        $nbr = count($allPlayer);
        $result = [];
        $percent = 0;
        $i = 0;
        foreach ($allPlayer as $p) {
            if ($p['selected'] == $winnerFirstColor || $p['selected'] == $winnerFirstNumber) {
                $i++;
            }
        }
        if ($nbr > 0) {
            $percent = ($i * 100) / $nbr;
        }
        if ($percent >= 60) {
            $data = [
                "number" => $randomNumber,
                "result" => $randomColor,
                "groups" => $_GET['groups']
            ];
            $database->update("t_winner",$data,"period='$idPeriod'");
        }
        $newRow = $database->select("t_winner","*","period='$idPeriod'");
        echo json_encode($newRow);
    } else if (!is_form_valid(@$_GET['key']) || @$_GET['key'] != $key) {
        echo "Unauthorized";
    }
?>