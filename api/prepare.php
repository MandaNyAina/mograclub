<?php
    require '../config/constant.php';
    $key = parse_ini_file("../config/config.ini")["key_encrypt"];
    if (is_form_valid(@$_GET['key']) && @$_GET['key'] == $key) {
        $now = date("d").date("m").date("Y").date("H").date("i").date("s").$_GET['groups'][0];
        $groups = $_GET['groups'];
        $checkAll = $database->selectMore("t_winner","*","groups='$groups' and period='$now'");
        $checkNothing = $database->selectMore("t_winner","*","groups='$groups' and showing=0 and number=0 and result=0");
        if (count($checkAll) == 0 && count($checkNothing) == 0) {
            $data = [
                "period" => $now,
                "number" => 0,
                "result" => 0,
                "groups" => $_GET['groups'],
                "price" => 0,
                "showing" => 0
            ];
            $database->insert("t_winner",$data);
        }
        echo $now;
    } else if (!is_form_valid(@$_GET['key']) || @$_GET['key'] != $key) {
        echo "Unauthorized";
    }
?>