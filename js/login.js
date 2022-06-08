$(window).ready(function () {
    var usuarioexiste = 0;
    $('.login-form').submit(function (e) {
        e.preventDefault();
        var datos = $(this).serializeArray();
        $.ajax({
            type: "POST",
            url: "./php/login.php",
            data: datos,
            dataType: "JSON",
            success: function (response) {
                //obtener tamaño del json
                console.log("hola" + response);
                usuarioexiste = (Object.keys(response).length);
                if (usuarioexiste == 1) {
                    // location.href = "./agregar.html";
                }
                else {
                    alert("Correo o password incorrectos");
                }
            },
            error: function (response) {
                console.log("error " + response);
            }
        });
    });
});