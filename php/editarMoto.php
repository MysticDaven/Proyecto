<?php
    require 'conexion.php';

    session_start();

    $idMoto = $_SESSION['idMoto'];
    $marca = isset($_POST['marca']) ? $_POST['marca'] : '';
    $modelo = isset($_POST['modelo']) ? $_POST['modelo'] : '';
    $motor = isset($_POST['motor']) ? $_POST['motor'] : '';
    $peso = isset($_POST['peso']) ? $_POST['peso'] : '';
    
    $precio = isset($_POST['precio']) ? $_POST['precio'] : '';
    $cilidrada = isset($_POST['cilidrada']) ? $_POST['cilidrada'] : '';
    $velMax = isset($_POST['velMax']) ? $_POST['velMax'] : '';

    $nuevacon= new conexion();
    $respuestajson=$nuevacon->editarMoto($marca, $modelo, $motor, $peso, $precio, $cilidrada, $velMax, $idMoto);
    echo($respuestajson);
?>