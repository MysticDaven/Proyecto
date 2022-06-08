<?php
    require 'conexion.php';
    $email = isset($POST['email']) ? $_POST['email'] : '';
    $password = isset($POST['password']) ? $_POST['password'] : '';

    echo($email);
    echo($password);
    $nCon = new conexion();
    $respuestajson=$nCon->login($email,$password);
    echo($respuestajson);
?>