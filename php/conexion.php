<?php
    session_start();

    class conexion{
        private $server = 'localhost:3306';
        private $username = 'root';
        private $password = '';
        private $database = 'motoverse';
        private $link;
        private $conn;
    
        function conectar(){
            try {
                $conn = new PDO('mysql:host='.$this->server.';dbname='.$this->database.';', $this->username, $this->password);                
                return $conn;
            } catch (PDOException $e) {
                die('Connected failed: ' . $e->getMessage());
            }
        }

        function login($email,$password){
            $link = $this->conectar();
            
            $sql="SELECT * FROM usuarios WHERE (nombre='".$email."') AND (pass='".$password."')";                    
            $result = $link->query($sql) or die (print("Error"));            
    
            $data=[];
            while($item = $result->fetch(PDO::FETCH_OBJ)){
                $_SESSION['idUsuario']=$item->idUsuario;
                $_SESSION['tipoUsuario']="1";
                $data[]=[
                    'idUsuario' => $item->idUsuario,
                    'nombre' => $item->nombre,
                    'pass' => $item->pass
                ];
            }
            $datajson=json_encode($data);
            return $datajson; 
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
            $name=$idSolicitud.$motor.$type;
            $rutarelativa="images/".$name;
            $rutaguardarphp="../".$rutarelativa;
            if(move_uploaded_file($tmpimg, $rutaguardarphp)){

                $name=$idSolicitud.$motor.$type2;
                $rutarelativa2="images/".$name;
                $rutaguardarphp="../".$rutarelativa2;
                if(move_uploaded_file($tmpimg2, $rutaguardarphp)){

                    $name=$idSolicitud.$motor.$type3;
                    $rutarelativa3="images/".$name;
                    $rutaguardarphp="../".$rutarelativa3;
                    if(move_uploaded_file($tmpimg3, $rutaguardarphp)){

                        $link->query("INSERT INTO motos (Marca, Modelo, Precio, Imagen, Cilindrada, motor, Peso, VelMax) VALUES ('$marca', '$modelo', '$precio', '$d1', '$cilidrada', '$motor', '$peso', '$velMax')")or die (print("Error"));

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

        function editarMoto($marca, $modelo, $motor, $peso, $precio, $cilidrada, $velMax, $idMoto){
            $link = $this->conectar();
            $id = $_SESSION['idUsuario'];
                        
            $link->query("UPDATE motos SET Marca='$marca', Modelo='$modelo', Precio = '$precio', Cilindrada = '$cilidrada', Motor='$motor', Peso = '$peso', VelMax = '$velMax' WHERE idMoto = '$idMoto'")or die (print("Error"));

            $data[]=[
              "estatus" => "update",                  
            ];
          /* Si regresa algo*/
          $datajson=json_encode($data);
          return $datajson; 
        }

        function encontrarMoto(){
            $link = $this->conectar();

            $sql="SELECT * FROM motos";                    
            $result = $link->query($sql) or die (print("Error"));

            $data=[];
            while($item = $result->fetch(PDO::FETCH_OBJ)){
                $data[]=[
                    'idMoto' => $item->idMoto,
                    'marca' => $item->Marca,
                    'modelo' => $item->Modelo,
                    'precio' => $item->Precio,
                    'imagen' => $item->Imagen,
                    'cilindrada' => $item->Cilindrada,
                    'motor' => $item->motor,
                    'peso' => $item->Peso,
                    'velMax' => $item->VelMax
                ];
            }
            $datajson=json_encode($data);
            return $datajson; 
        }

        function eliminarMoto($idMoto){
            $link = $this->conectar();

            $sql="DELETE FROM motos WHERE idMoto = '$idMoto'";                    
            $result = $link->query($sql) or die (print("Error"));

            $data[]=[
              "estatus" => "eliminado",                  
            ];
            /* Si regresa algo*/
            $datajson=json_encode($data);
            return $datajson; 
        }

        function encontrarDescripcion(){
            $link = $this->conectar();
            
            $sql="SELECT * FROM descripcion";                    
            $result = $link->query($sql) or die (print("Error"));

            $data=[];
            while($item = $result->fetch(PDO::FETCH_OBJ)){
                $data[]=[
                    'idMoto' => $item->idMoto,
                    'Comentario' => $item->Comentario,
                    'Imagen' => $item->Imagen,
                ];
            }
            $datajson=json_encode($data);
            return $datajson; 
        }

        function validarUsuario(){
            $tipo = $_SESSION['tipoUsuario'];  
            echo($tipo);
            if($tipo == null)
                 $tipo ="0";
            /* Si regresa algo*/
            $data[]=[
                "tipo" => $tipo        
            ];
            $datajson=json_encode($data);
            return $datajson; 
        }
    }

?>