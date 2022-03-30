// SUBIENDO LA FOTO DEL USUARIO

$(".nuevaFoto").change(function () {
    var imagen = this.files[0];

    if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
        $("nuevaFoto").val("");

        $.wnoty({
            type: "error",
            message: "¡La imagen debe estar en formato JPG o PNG!",
            position: "bottom-right",
            autohide: false
        });
    } else if (imagen["size"] > 2000000) {
        $(".nuevaFoto").val("");

        $.wnoty({
            type: "error",
            message: "¡La imagen no debe pesar mas de 5Mb!",
            position: "bottom-right",
            autohide: false
        });
    } else {
        var datosImagen = new FileReader();
        datosImagen.readAsDataURL(imagen);

        $(datosImagen).on("load", function (event) {
            var rutaImagen = event.target.result;

            $(".previsualizar").attr("src", rutaImagen);
        });
    }
});

//EDITANDO USUARIO

$(document).on("click", ".btnEditarUsuario", function () {
    var idUsuario = $(this).attr("idUsuario");
    console.log("idUsuario", idUsuario);

    var datos = new FormData();
    datos.append("idUsuario", idUsuario);
    $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            //console.log("respuesta", respuesta);
            $("#editarNombre").val(respuesta["nombre"]);
            $("#editarUsuario").val(respuesta["usuario"]);
            $("#editarPerfil").html(respuesta["perfil"]);
            $("#editarPerfil").val(respuesta["perfil"]);

            $("#fotoActual").val(respuesta["foto"]);
            $("#passwordActual").val(respuesta["password"]);

            if (respuesta["foto"] != "") {
                $(".previsualizar").attr("src", respuesta["foto"]);
            }
        }
    });
});

//ACTIVANDO USUARIO

$(document).on("click", ".btnActivar", function () {
    var idUsuario = $(this).attr("idUsuario");
    var estadoUsuario = $(this).attr("estadoUsuario");

    var datos = new FormData();

    datos.append("activarId", idUsuario);
    datos.append("activarUsuario", estadoUsuario);

    $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            if (window.matchMedia("(max-width:767px)").matches) {
                swal({
                    title: "El usuario ha sido actualizado",
                    type: "success",
                    confirmButtonText: "¡Cerrar!",
                    position: "bottom-right"
                }).then(result => {
                    if (result.value) {
                        window.location = "usuarios";
                    }
                });
            }
        }
    });

    if (estadoUsuario == 0) {
        $(this).removeClass("btn-success");
        $(this).addClass("btn-danger");
        $(this).html("Desactivado");
        $(this).attr("estadoUsuario", 1);
    } else {
        $(this).addClass("btn-success");
        $(this).removeClass("btn-danger");
        $(this).html("Activado");
        $(this).attr("estadoUsuario", 0);
    }
});

//VALIDAR USUARIO
$("#nuevoUsuario").change(function () {
    $(".alert").remove();

    var usuario = $(this).val();

    var datos = new FormData();
    datos.append("validarUsuario", usuario);

    $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            if (respuesta) {
                $("#nuevoUsuario")
                    .parent()
                    .after(
                        '<div class="alert alert-warning">Este nombre ya esta en uso</div>'
                    );
                $("#nuevoUsuario").val("");
            }
        }
    });
});

//BORRAR USUARIO
$(document).on("click", ".btnEliminarUsuario", function () {
    var idUsuario = $(this).attr("idUsuario");
    var fotoUsuario = $(this).attr("fotoUsuario");
    var usuario = $(this).attr("usuario");
    swal({
        title: "¿Está seguro de borrar el usuario?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Borrar usuario",
        position: "bottom-right"
    }).then(result => {
        if (result.value) {
            window.location =
                "index.php?ruta=usuarios&idUsuario=" +
                idUsuario +
                "&usuario=" +
                usuario +
                "&fotoUsuario=" +
                fotoUsuario;
        }
    });
});
