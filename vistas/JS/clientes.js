//EDITAR CLIENTE

$(document).on("click", ".btnEditarCliente", function () {
  var idCliente = $(this).attr("idCliente");
  console.log("idCliente", idCliente);
  var datos = new FormData();
  datos.append("idCliente", idCliente);
  $.ajax({
    url: "ajax/clientes.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      console.log("respuesta", respuesta);
      $("#editarNombre").val(respuesta["nombre"]);
      $("#editarDocumento").val(respuesta["documento"]);
      $("#editarEmail").val(respuesta["email"]);
      $("#editarTelefono").val(respuesta["telefono"]);
      $("#editarDireccion").val(respuesta["direccion"]);
      $("#editarFecha_nac").val(respuesta["fecha_nacimiento"]);
      $("#editarId").val(respuesta["id"]);
    }
  });
});

//BORRAR CLIENTE
$(document).on("click", ".btnEliminarCliente", function () {
  var idCliente = $(this).attr("idCliente");
  swal({
    title: "¿Está seguro de borrar el cliente?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
    confirmButtonText: "Borrar cliente",
    position: "bottom-right"
  }).then(result => {
    if (result.value) {
      window.location = "index.php?ruta=clientes&idCliente=" + idCliente;
    }
  });
});

//VALIDAR CLIENTE
$("#nuevoEmail").change(function () {
  $(".alert").remove();

  var cliente = $(this).val();

  var datos = new FormData();
  datos.append("validarCliente", cliente);

  $.ajax({
    url: "ajax/clientes.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      console.log(respuesta);
      if (respuesta) {
        $("#nuevoEmail")
          .parent()
          .after(
            '<div class="alert alert-warning">Este email ya esta en uso</div>'
          );
        $("#nuevoEmail").val("");
      }
    }
  });
});

$("#nuevoDocumento").change(function () {
  $(".alert").remove();

  var cliente = $(this).val();

  var datos = new FormData();
  datos.append("validarClienteDNI", cliente);

  $.ajax({
    url: "ajax/clientes.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      //console.log(respuesta);
      if (respuesta) {
        $("#nuevoDocumento")
          .parent()
          .after(
            '<div class="alert alert-warning">Este DNI ya esta en uso</div>'
          );
        $("#nuevoDocumento").val("");
      }
    }
  });
});