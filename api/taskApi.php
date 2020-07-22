<?php
    require '../config/constant.php';
    require 'taskServiceApi.php';
    $key = parse_ini_file("../config/config.ini")["key_encrypt"];
    if (is_form_valid(@$_GET['id']) && is_form_valid(@$_GET['key']) && @$_GET['key'] == $key) {
        $task = new Task();
        if ($_GET['type'] == "all") {
            echo json_encode($task->getTaskById($_GET['id']));
        } else if ($_GET['type'] == "get") {
            $task->createTask($_GET['id'], $_GET['idTask']);
        } else if ($_GET['type'] == "active") {
            echo json_encode($task->getTaskActiveById($_GET['id'], date("Y-m-d"))) ;
        }
    } else if (!is_form_valid(@$_GET['key']) || @$_GET['key'] != $key) {
        echo "Unauthorized";
    }
?>