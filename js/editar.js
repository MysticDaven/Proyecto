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
    encontrarArticulo();
    const formulario = document.querySelector('#DataBox');
    function encontrarArticulo() {        
        $.ajax({
            type: "POST",
            url: "./php/id_moto.php",
            data: "",
            dataType: "text",
            success: function (response) {
                idMoto = response;                
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
                            Imagen = response2[i]['imagen'];
  
                            document.getElementById("marca").value = marca;
                            document.getElementById("modelo").value = modelo;
                            document.getElementById("motor").value = motor;
                            document.getElementById("peso").value = peso;
                            document.getElementById("precio").value = precio;
                            document.getElementById("cilidrada").value = cilindrada;
                            document.getElementById("velMax").value = velMax;
                            document.getElementById("img1").src = Imagen;
                        }
                    },error: function (response2) {
                        console.log(response2);
                    }
                });
            }
        });
    }

    $('#DataBox').submit(function (e){
        e.preventDefault();
        const datos= new FormData(formulario);
        $.ajax({
            type: "POST",
            url: "./php/editarMoto.php",
            data: datos,
            contentType:false,
            cache: false,
            processData: false,
            success: function (response) {
                window.alert("Editada con exito");
            },
            error: function(response) {
                
            }
        });
    });

    $('#Cancelar').click(function(){
        location.href = "./eleccionEditar.html";
    });

    $('#eliminar').click(function(){
        // e.preventDefault();
        // const datos= new FormData(formulario);
        $.ajax({
            type: "POST",
            url: "./php/eliminarMoto.php",
            data: "",
            success: function (response) {
                window.alert("Eliminada con exito");
                location.href = "./eleccionEditar.html";
            },
            error: function(response) {
                console.log(response)
            }
        });
    });
});