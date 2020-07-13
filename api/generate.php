<?php
    require '../config/constant.php';
    $key = parse_ini_file("../config/config.ini")["key_encrypt"];
    if (is_form_valid(@$_GET['period']) && is_form_valid(@$_GET['key']) && @$_GET['key'] == $key) {
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
        $value = [
            "color" => $randomColor,
            "number" => $randomNumber,
            "groups" => $_GET['groups']
        ];
        $period = $_GET['period'];
        $data = [
            "number" => $randomNumber,
            "result" => $randomColor,
            "groups" => $_GET['groups'],
            "price" => 0
        ];
        $database->update('t_winner',$data,"period='$period'");
        echo json_encode($data);
    } else if (!is_form_valid(@$_GET['key']) || @$_GET['key'] != $key) {
        echo "Unauthorized";
    } 
?>