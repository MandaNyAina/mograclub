<?php 
    require '../../config/constant.php';
    $value = $_SESSION['user_loggeg']['id_login'];
    $load = [
        "active" => 0
    ];
    $database->update('t_user',$load,"id='$value'");
    setcookie('game_random_app',null,0,"/");
    session_unset();
    session_destroy();
?>
<meta http-equiv="refresh" content="0; url=../../views/authentification/login.php">