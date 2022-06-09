<?php
    require 'conexion.php';
    
    $nuevacon= new conexion();
    $respuestajson=$nuevacon->encontrarMoto();
    echo($respuestajson);
?>