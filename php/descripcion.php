<?php
    require 'conexion.php';
    
    $nuevacon= new conexion();
    $respuestajson=$nuevacon->encontrarDescripcion();
    echo($respuestajson);
?>