// // CARGAR TABLA
// $.ajax({
//   url: "ajax/datatable-productos.ajax.php",
//   success: function (respuesta) {
//     console.log(respuesta);
//   }
// });

//APLICAR ORIGEN DATOS JSON
$(".tablaProductos").DataTable({
  ajax: "ajax/datatable-productos.ajax.php",
  deferRender: true,
  retrieve: true,
  Processing: true,
  language: {
    sProcessing: "Procesando...",
    sLengthMenu: "Mostrar _MENU_ registros",
    sZeroRecords: "No se encontraron resultados",
    sEmptyTable: "Ningún dato disponible en esta tabla",
    sInfo:
      "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
    sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
    sInfoPostFix: "",
    sSearch: "Buscar:",
    sUrl: "",
    sInfoThousands: ",",
    sLoadingRecords: "Cargando...",
    oPaginate: {
      sFirst: "Primero",
      sLast: "Último",
      sNext: "Siguiente",
      sPrevious: "Anterior"
    },
    oAria: {
      sSortAscending: ": Activar para ordenar la columna de manera ascendente",
      sSortDescending: ": Activar para ordenar la columna de manera descendente"
    }
  }
});

//CAPTURAR CATEGORIA

$("#nuevaCategoria").change(function() {
  var idCategoria = $(this).val();

  var datos = new FormData();
  datos.append("idCategoria", idCategoria);

  $.ajax({
    url: "ajax/productos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta) {
      if (!respuesta) {
        var nuevoCodigo = idCategoria + "01";
        $("#nuevoCodigo").val(nuevoCodigo);
      } else {
        var nuevoCodigo = Number(respuesta["codigo"]) + 1;
        $("#nuevoCodigo").val(nuevoCodigo);
      }
      //console.log("nuevoCodigo", nuevoCodigo);
    }
  });
});

//AGREGAR PRECIO DE VENTA
$("#nuevoPrecioCompra, #editarPrecioCompra").change(function() {
  if ($(".porcentaje").prop("checked")) {
    var valorPorcentaje = $(".nuevoPorcentaje").val();
    var precio =
      Number(($("#nuevoPrecioCompra").val() * valorPorcentaje) / 100) +
      Number($("#nuevoPrecioCompra").val());
    var precio_editado =
      Number(($("#editarPrecioCompra").val() * valorPorcentaje) / 100) +
      Number($("#editarPrecioCompra").val());
    console.log(precio_editado);

    $("#nuevoPrecioVenta").val(precio);
    $("#nuevoPrecioVenta").prop("readonly", true);

    $("#editarPrecioVenta").val(precio_editado);
    $("#editarPrecioVenta").prop("readonly", true);
  }
});

//CAMBIO DE PORCENTAJE
$(".nuevoPorcentaje").change(function() {
  if ($(".porcentaje").prop("checked")) {
    var valorPorcentaje = $(this).val();

    var precio =
      Number(($("#nuevoPrecioCompra").val() * valorPorcentaje) / 100) +
      Number($("#nuevoPrecioCompra").val());
    var precio_editado =
      Number(($("#editarPrecioCompra").val() * valorPorcentaje) / 100) +
      Number($("#editarPrecioCompra").val());

    $("#nuevoPrecioVenta").val(precio);
    $("#nuevoPrecioVenta").prop("readonly", true);

    $("#editarPrecioVenta").val(precio_editado);
    $("#editarPrecioVenta").prop("readonly", true);
  }
});

$(".porcentaje").on("ifUnchecked", function() {
  $("#nuevoPrecioVenta").prop("readonly", false);
  $("#editarPrecioVenta").prop("readonly", false);
});

$(".porcentaje").on("ifChecked", function() {
  $("#nuevoPrecioVenta").prop("readonly", true);
  $("#editarPrecioVenta").prop("readonly", true);
});

// SUBIENDO LA FOTO DEL USUARIO

$(".nuevaImagen").change(function() {
  var imagen = this.files[0];

  if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
    $(".nuevaImagen").val("");

    $.swal({
      title: "Error al subir la foto",
      message: "¡La imagen debe estar en formato JPG o PNG!",
      type: "error",
      position: "bottom-right",
      confirmButtonText: "¡Cerrar!"
    });
  } else if (imagen["size"] > 2000000) {
    $(".nuevaImagen").val("");

    $.swal({
      title: "Error al subir la foto",
      message: "¡La imagen no debe de pesar mas de 2 mb!",
      type: "error",
      position: "bottom-right",
      confirmButtonText: "¡Cerrar!"
    });
  } else {
    var datosImagen = new FileReader();
    datosImagen.readAsDataURL(imagen);

    $(datosImagen).on("load", function(event) {
      var rutaImagen = event.target.result;
      $(".previsualizar2").attr("src", rutaImagen);
    });
  }
});

// EDITAR LA FOTO DEL USUARIO

$(".nuevaImagen").change(function() {
  var imagen = this.files[0];

  if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
    $(".nuevaImagen").val("");

    $.swal({
      title: "Error al subir la foto",
      message: "¡La imagen debe estar en formato JPG o PNG!",
      type: "error",
      position: "bottom-right",
      confirmButtonText: "¡Cerrar!"
    });
  } else if (imagen["size"] > 2000000) {
    $(".nuevaImagen").val("");

    $.swal({
      title: "Error al subir la foto",
      message: "¡La imagen no debe de pesar mas de 2 mb!",
      type: "error",
      position: "bottom-right",
      confirmButtonText: "¡Cerrar!"
    });
  } else {
    var datosImagen = new FileReader();
    datosImagen.readAsDataURL(imagen);

    $(datosImagen).on("load", function(event) {
      var rutaImagen = event.target.result;
      $(".previsualizar").attr("src", rutaImagen);
    });
  }
});

//EDITAR PRODUCTO
$(".tablaProductos tbody").on("click", "button.btnEditarProducto", function() {
  var idProducto = $(this).attr("idProducto");
  //console.log(idProducto);
  var datos = new FormData();
  datos.append("idProducto", idProducto);

  $.ajax({
    url: "ajax/productos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta) {
      //console.log(respuesta);

      var datosCategoria = new FormData();
      datosCategoria.append("idCategoria", respuesta["id_categoria"]);
      $.ajax({
        url: "ajax/categorias.ajax.php",
        method: "POST",
        data: datosCategoria,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
          //console.log(respuesta);
          $("#editarCategoria").val(respuesta["id"]);
          $("#editarCategoria").html(respuesta["categoria"]);
        }
      });
      $("#editarCodigo").val(respuesta["codigo"]);
      $("#editarDescripcion").val(respuesta["descripcion"]);
      $("#editarStock").val(respuesta["stock"]);
      $("#editarPrecioCompra").val(respuesta["precio_compra"]);
      $("#editarPrecioVenta").val(respuesta["precio_venta"]);
      if (respuesta["imagen"] != "") {
        $("#imagenActual").val(respuesta["imagen"]);
        $(".previsualizar").attr("src", respuesta["imagen"]);
      }
    }
  });
});

//BORRAR PRODUCTO

$(".tablaProductos tbody").on(
  "click",
  "button.btnEliminarProducto",
  function() {
    var idProducto = $(this).attr("idProducto");
    var codigo = $(this).attr("codigo");
    var imagen = $(this).attr("imagen");
    // console.log(idProducto);
    // console.log(codigo);
    // console.log(imagen);

    swal({
      title: "¿Está seguro de borrar el producto?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Cancelar",
      confirmButtonText: "Borrar producto",
      position: "bottom-right"
    }).then(result => {
      if (result.value) {
        window.location =
          "index.php?ruta=productos&idProducto=" +
          idProducto +
          "&codigo=" +
          codigo +
          "&imagen=" +
          imagen;
      }
    });
  }
);
