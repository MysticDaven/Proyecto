<?php    
        $idMoto = $_POST["idMoto"];
       
        session_start();
        $_SESSION['idMoto'] = $idMoto;
        
        Header("location: http://localhost/motoverse/Proyecto/editar.html");

    ?>