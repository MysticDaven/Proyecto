$(window).ready(function(){
    const formulario = document.querySelector('#DataBox');
    $('#DataBox').submit(function (e){
        e.preventDefault();
        const datos= new FormData(formulario);
        $.ajax({
            type: "POST",
            url: "./php/agregar.php",
            data: datos,
            contentType:false,
            cache: false,
            processData: false,
            success: function (response) {
                console.log(response);
                
            },
            error: function(response) {
                console.log(response);
            }
        });
    });
});