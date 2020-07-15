<?php
    require '../config/constant.php';
    $key = parse_ini_file("../config/config.ini")["key_encrypt"];
    if (is_form_valid(@$_GET['key']) && @$_GET['key'] == $key) {
        $idPeriod = $_GET['period'];
        $groups = $_GET['groups'];
        $winnerFirstColor = $_GET['winC'];
        $winnerFirstNumber = $_GET['winN'];
        $winnerFirstColor = explode(",",$winnerFirstColor);
        $color = [
            0 => "GREEN",
            1 => "ORANGE",
            2 => "TIN"
        ];
        $randomColor = null;
        $randomNumber = null;
        $i = 0;
        while ($i < 5) {
            $randomColor = $color[rand(0,2)];
            if (count($winnerFirstColor) == 1) {
                $randomColor = "TIN";
            } else {
                while (in_array($randomColor, $winnerFirstColor) || $randomColor == "TIN") {
                    $randomColor = $color[rand(0,2)];
                }
            }
            
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
            } else if ($randomColor == "TIN") {
                $colorByNumber = [
                    0 => 0,
                    1 => 1
                ];
                $randomNumber = $colorByNumber[rand(0, 1)];
                $temp = "TIN";
                $randomColor = $temp.",".$color[rand(0,1)];
            }
            $i++;
        }
        sleep(0.2);
        $price = 0;
        $allPlayer = $database->selectMore("t_order","*","status='current' and groups='$groups'");
        foreach ($allPlayer as $p) {
            $price += $p['amount'];
        }
        $data = [ 
            "price" => $price
        ];
        $database->update("t_winner",$data,"period='$idPeriod'");
        $allPlayer = $database->selectMore("t_order","*","status='current' and groups='$groups'");
        $current = $database->select("t_winner","*","period='$idPeriod'");
        $nbr = count($allPlayer);
        $result = [];
        $percent = 0;
        $i = 0;
        foreach ($allPlayer as $p) {
            if (in_array($p["selected"],$winnerFirstColor) || ($p["selected"] == $winnerFirstNumber)) {
                $i++;
            }
        }
        if ($nbr > 0) {
            $percent = ($i * 100) / $nbr;
        }
        $change = "no";
        if ($percent >= 50) {
            $data = [
                "number" => $randomNumber,
                "result" => $randomColor
            ];
            $database->update("t_winner",$data,"period='$idPeriod'");
            $change = "yes";
        }
        $newRow = $database->select("t_winner","*","period='$idPeriod'");
        $result = [
            "avant" => $winnerFirstColor,
            "apres" => $randomColor,
            "change" => $change,
            "group" => $_GET['groups'],
            "allPlayer" => $allPlayer,
            "nbr_personne" => $nbr,
            "choice" => $i,
            "percent" => $percent,
            "row" => $newRow
        ];
        echo json_encode($result);
    } else if (!is_form_valid(@$_GET['key']) || @$_GET['key'] != $key) {
        echo "Unauthorized";
    }
?>