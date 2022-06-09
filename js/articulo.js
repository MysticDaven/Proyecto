var idMoto;
var cilindrada ="";
var marca="";
var modelo=""
var motor="";
var peso="";
var precio="";
var velMax="";
var Imagen="";
var Comentario="";
$(window).ready(function () {
    encontrarDescripcion();
    encontrarArticulo();

    function encontrarDescripcion() {
        $.ajax({
            type: "POST",
            url: "./php/id_moto.php",
            data: "",
            dataType: "text",
            success: function (response) {
                idMoto = 1;
                $.ajax({
                    type: "POST",
                    url: "./php/descripcion.php",
                    data: "",
                    dataType: "JSON",
                    success: function (response2) {
                        /* Buscamos la moto correcta*/
                        var i = 0;
                        var c=1;

                        while (i<response2.length) {
                            if (idMoto == response2[i]['idMoto']) {

                                Comentario = response2[i]['Comentario'];
                                Imagen = response2[i]['Imagen'];
                                
                                document.getElementById("p"+c).innerHTML = Comentario;
                                document.getElementById("img"+c).src = Imagen;

                                c++;
                            }
                            i++;
                        }
                        
                    },error: function (response2) {
                        console.log(response2);
                    }
                });
            },error: function (response) {
                console.log(response);
            }
        });
    }

    function encontrarArticulo() {
        console.log("hola");
        $.ajax({
            type: "POST",
            url: "./php/id_moto.php",
            data: "",
            dataType: "text",
            success: function (response) {
                idMoto = 1;
                console.log(idMoto);
                $.ajax({
                    type: "POST",
                    url: "./php/catalogo.php",
                    data: "",
                    dataType: "JSON",
                    success: function (response2) {
                        /* Buscamos la moto correcta*/
                        var i = 0;
                        
                        while (response2[i]['idMoto'] != idMoto) {
                            i++;
                        }
                        if (idMoto == response2[i]['idMoto']) {

                            cilindrada = response2[i]['cilindrada'];
                            marca = response2[i]['marca'];
                            modelo = response2[i]['modelo'];
                            motor = response2[i]['motor'];
                            peso = response2[i]['peso'];
                            precio = response2[i]['precio'];
                            velMax = response2[i]['velMax'];
  
                            $("#marca").html("Marca: "+marca);
                            $("#modelo").html("Modelo: "+modelo);
                            $("#cilin").html("Cilindrada: "+cilindrada);
                            $("#motor").html("Tipo de Motor: " +motor);
                            $("#peso").html("Peso: "+peso);
                            $("#velmax").html("Velocidad Maxima: "+velMax);
                            $("#precio").html("Precio: "+precio+" MXN");

                        }
                    },error: function (response2) {
                        console.log(response2);
                    }
                });
            }
        });
    }
});