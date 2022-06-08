<?php
    session_start();

    class conexion{
        private $server = 'localhost';
        private $username = 'root';
        private $password = '';
        private $database = 'motoverse';
        private $link;
        private $conn;
    
        function conectar(){
            try {
                $conn = new PDO('mysql:host='.$this->server.';dbname='.$this->database.';', $this->username, $this->password);
                echo($conn);
                return $conn;
            } catch (PDOException $e) {
                die('Connected failed: ' . $e->getMessage());
            }
        }

        function agregarMoto($marca, $modelo, $motor, $peso, $precio, $cilidrada, $velMax, $d1, $d2, $d3, $tmpimg, $type, $tmpimg2, $type2, $tmpimg3, $type3){
            $link = $this->conectar();
            $id = $_SESSION['idUsuario'];
            $sql="SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'motoverse' AND   TABLE_NAME   = 'motos'";
            $autoincrement = $link->query($sql) or die (print("Error"));
            $idSolicitud = "";
            while($item = $autoincrement->fetch(PDO::FETCH_OBJ)){
              $idSolicitud=$item->AUTO_INCREMENT;
            }
            $name=$idSolicitud.$nombre.$type;
            $rutarelativa="images/".$name;
            $rutaguardarphp="/".$rutarelativa;
            if(move_uploaded_file($tmpimg, $rutaguardarphp)){

                $name=$idSolicitud.$nombre.$type2;
                $rutarelativa2="images/".$name;
                $rutaguardarphp="/".$rutarelativa2;
                if(move_uploaded_file($tmpimg2, $rutaguardarphp)){

                    $name=$idSolicitud.$nombre.$type3;
                    $rutarelativa3="images/".$name;
                    $rutaguardarphp="/".$rutarelativa3;
                    if(move_uploaded_file($tmpimg3, $rutaguardarphp)){

                        $link->query("INSERT INTO motos (Marca, Modelo, Precio, Cilindrada, motor, Peso, VelMax) VALUES ('$marca', '$modelo', '$precio', '$cilidrada', '$moto', '$peso', '$velMax')")or die (print("Error"));

                        $link->query("INSERT INTO descripcion (idMoto, Comentario, Imagen) VALUES ('$idSolicitud', '$d1', '$rutarelativa')")or die (print("Error"));
                        $link->query("INSERT INTO descripcion (idMoto, Comentario, Imagen) VALUES ('$idSolicitud', '$d2', '$rutarelativa2')")or die (print("Error"));
                        $link->query("INSERT INTO descripcion (idMoto, Comentario, Imagen) VALUES ('$idSolicitud', '$d3', '$rutarelativa3')")or die (print("Error"));


                    }                                                
                }
            }
            
            $data[]=[
              "estatus" => "registrado",                  
            ];
          /* Si regresa algo*/
          $datajson=json_encode($data);
          return $datajson; 
        }

        function login($email,$password){
            $link = $this->conectar();
            
            $sql="SELECT * FROM usuarios WHERE (nombre='".$email."') AND (pass='".$password."')";            
            $result = $link->query($sql) or die (print("Error"));            
    
            $data=[];
            while($item = $result->fetch(PDO::FETCH_OBJ)){
                $_SESSION['idUsuario']=$item->idUsuario;
                $data[]=[
                    'idUsuario' => $item->idUsuario,
                    'nombre' => $item->nombre,
                    'pass' => $item->pass
                ];
            }
            $datajson=json_encode($data);
            return $datajson; 
        }
    }

?>