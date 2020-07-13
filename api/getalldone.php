<?php
    require '../config/constant.php';
    $key = parse_ini_file("../config/config.ini")["key_encrypt"];
    if (is_form_valid(@$_GET['key']) && @$_GET['key'] == $key) {
        if ($_GET['choice'] == "prepare") {
            $group = $_GET['groups'];
            $result = $database->selectMore('t_winner',"*", "groups='$group'");
            $data = [];
            foreach ($result as $value) {  
                $data = $value;
            }
            $result = $data;
        } else if ($_GET['choice'] == "prime")  {
            $group = $_GET['groups'];
            $result = $database->selectMore('t_winner',"*", "groups='$group' and showing = '1'");
        } else if ($_GET['choice'] == "final")  {
            $group = $_GET['groups'];
            $database->update("t_winner",["showing" => 1],"1");
            $result = $database->selectMore('t_winner',"*", "groups='$group' and result != '0'");
        }
        echo json_encode($result);
    } else if (!is_form_valid(@$_GET['key']) || @$_GET['key'] != $key) {
        echo "Unauthorized";
    }
?>