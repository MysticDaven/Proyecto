$(window).ready(function () {
    var usuarioexiste = 0;
    $('.login-form').submit(function (e) {
        e.preventDefault();
        var datos = $(this).serializeArray();
        console.log(datos)
        $.ajax({
            type: "POST",
            url: "./php/login.php",
            data: datos,
            dataType: "JSON",
            success: function (response) {
                //obtener tamaño del json
                usuarioexiste = (Object.keys(response).length);
                console.log(response);
                if (usuarioexiste == 1) {
                    console.log("hola" + response[0]['nombre']);
                    location.href = "./admin.html";
                }
                else {
                    alert("Correo o password incorrectos");
                }
            },
            error: function (response) {
                console.log(response);
            }
        });
    });
});