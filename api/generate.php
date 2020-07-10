<?php
    require '../config/constant.php';
    $key = parse_ini_file("../config/config.ini")["key_encrypt"];
    if (is_form_valid(@$_GET['key']) && @$_GET['key'] == $key) {
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
        $now = date("Y").date("m").date("d").
        $now = date("d").date("m").date("Y").date("H").date("i");
        $period = $now.$lastId.$_GET['groups'][0];
        $data = [
            "period" => $period,
            "number" => $randomNumber,
            "result" => $randomColor,
            "groups" => $_GET['groups'],
            "price" => 0
        ];
        $database->insert('t_winner',$data);
        echo json_encode($data);
    } else if (!is_form_valid(@$_GET['key']) || @$_GET['key'] != $key) {
        echo "Unauthorized";
    }
?>