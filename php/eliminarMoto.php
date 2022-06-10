<?php

    require 'conexion.php';
    session_start();

    $idMoto = $_SESSION['idMoto'];

    $nuevacon= new conexion();
    $respuestajson=$nuevacon->eliminarMoto($idMoto);

    echo $idMoto;
?>