$(window).ready(function () {
    catalogo();

    function catalogo() {
        $.ajax({
            type: "POST",
            url: "./php/catalogo.php",
            data: "",
            dataType: "JSON",
            success: function (response) {

                var html = "";
                /* Imprimimos en pantalla cada moto encontrada*/
                response.map(item => {
                    console.log(item);
                    html += `
                <div class="galeria-item">
                  <img src="${item.imagen}" alt="..." onclick="abrirMoto('${item.idMoto}')" width="200px">
                  <form action="php/encontrarMoto.php" method="post" autocomplete="off">
                  <input type="text" name="idMoto" value="${item.idMoto}" style="display: none;">
                  <input class="btn btn-outline-primary" type="submit" value="Aceptar" id="btnSubmit${item.idMoto}" style="display: none;">
                  </form>
                  <h3>${item.marca}</h3>
                  <h5>${item.modelo}</h5>
                </div>
              `;
                })
                $('#catalogo').html(html);
            }
        });
    }

    
});

function abrirMoto(idMoto){
    $(`#btnSubmit${idMoto} `).click();
}