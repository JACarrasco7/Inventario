//EDITANDO CATEGORIAS

$(document).on("click", ".btnEditarCategoria", function () {
    var idCategoria = $(this).attr("idCategoria");
    console.log("idCategoria", idCategoria);

    var datos = new FormData();
    datos.append("idCategoria", idCategoria);
    $.ajax({
        url: "ajax/categorias.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log("respuesta", respuesta);
            $("#editarCategoria").val(respuesta["categoria"]);
            $("#idCategoria").val(respuesta["id"]);
        }
    });
});

//BORRAR CATEGORIA
$(document).on("click", ".btnEliminarCategoria", function () {
    var idCategoria = $(this).attr("idCategoria");
    swal({
        title: "¿Está seguro de borrar esta categoria?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Borrar categoria",
        position: "bottom-right"
    }).then(result => {
        if (result.value) {
            window.location =
                "index.php?ruta=categorias&idCategoria=" + idCategoria;
        }
    });
});

//VALIDAR CATEGORIA
$("#nuevaCategoria").change(function () {
    $(".alert").remove();

    var categoria = $(this).val();

    var datos = new FormData();
    datos.append("validarCategoria", categoria);

    $.ajax({
        url: "ajax/categorias.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            //console.log(respuesta);
            if (respuesta) {
                $("#nuevaCategoria")
                    .parent()
                    .after(
                        '<div class="alert alert-warning">Este nombre ya esta en uso</div>'
                    );
                $("#nuevaCategoria").val("");
            }
        }
    });
});