<?php
    require 'conexion.php';

    $nuevacon= new conexion();
    $respuestajson=$nuevacon->validarUsuario();
    echo($respuestajson);
?>