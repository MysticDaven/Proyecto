<?php
    require 'conexion.php';

    $marca = isset($_POST['marca']) ? $_POST['marca'] : '';
    $modelo = isset($_POST['modelo']) ? $_POST['modelo'] : '';
    $motor = isset($_POST['motor']) ? $_POST['motor'] : '';
    $peso = isset($_POST['peso']) ? $_POST['peso'] : '';
    
    $precio = isset($_POST['precio']) ? $_POST['precio'] : '';
    $cilidrada = isset($_POST['cilidrada']) ? $_POST['cilidrada'] : '';
    $velMax = isset($_POST['velMax']) ? $_POST['velMax'] : '';

    $d1 = isset($_POST['d1']) ? $_POST['d1'] : '';
    $d2 = isset($_POST['d2']) ? $_POST['d2'] : '';
    $d3 = isset($_POST['d3']) ? $_POST['d3'] : '';

    $tmpimg=$_FILES['i1']['tmp_name'];
    $type=$_FILES['i1']['type'];
    $tmpimg2=$_FILES['i2']['tmp_name'];
    $type2=$_FILES['i2']['type'];
    $tmpimg3=$_FILES['i3']['tmp_name'];
    $type3=$_FILES['i3']['type'];

    if(isset($_FILES['i1'])){

        $tmpimg=$_FILES['i1']['tmp_name'];
        $type=$_FILES['i1']['type'];
      
        if($type=='image/png'){
          $type='.png';
        }
        else if($type=='image/jpg'){
          $type='.jpg';   
        }
        else if($type=='image/jpeg'){
          $type='.jpeg';
        }
        else{
          $type='png';
        }
      
        if(isset($_FILES['i2'])){
      
              $tmpimg2=$_FILES['i2']['tmp_name'];
              $type2=$_FILES['i2']['type'];
          
              if($type2=='image/png'){
              $type2='2.png';
              }
              else if($type2=='image/jpg'){
              $type2='2.jpg';   
              }
              else if($type2=='image/jpeg'){
              $type2='2.jpeg';
              }
              else{
              $type2='2.png';
              }
            if(isset($_FILES['i3'])){
        
                $tmpimg3=$_FILES['i3']['tmp_name'];
                $type3=$_FILES['i3']['type'];
            
                if($type3=='image/png'){
                $type3='3.png';
                }
                else if($type3=='image/jpg'){
                $type3='3.jpg';   
                }
                else if($type3=='image/jpeg'){
                $type3='3.jpeg';
                }
                else{
                $type3='3.png';
                }
                $nuevacon= new conexion();
                $respuestajson=$nuevacon->agregarMoto($marca, $modelo, $motor, $peso, $precio, $cilidrada, $velMax, $d1, $d2, $d3, $tmpimg, $type, $tmpimg2, $type2, $tmpimg3, $type3);
                echo($respuestajson);
                // Hola
            }
          }
    }
?>