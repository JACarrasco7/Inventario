<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";


class AjaxProductos
{
    public $idCategoria;
    public $idProducto;

    public function ajaxCrearCodigoProducto()
    {
        $campo = "id_categoria";
        $valor = $this->idCategoria;

        $mostrarProducto = new ControladorProductos();
        $respuesta = $mostrarProducto->ctrMostrarProductos($campo, $valor);

        echo json_encode($respuesta);
    }

    public function ajaxEditarProducto()
    {
        $campo = "id";
        $valor = $this->idProducto;

        $mostrarProducto = new ControladorProductos();
        $respuesta = $mostrarProducto->ctrMostrarProductos($campo, $valor);

        echo json_encode($respuesta);
    }
}

// SACAR CODIGO A PARTIR DE CATEGORIA

if (isset($_POST["idCategoria"])) {
    $codigoProducto = new AjaxProductos();
    $codigoProducto->idCategoria = $_POST["idCategoria"];
    $codigoProducto->ajaxCrearCodigoProducto();
}

// EDITAR PRODUCTO

if (isset($_POST["idProducto"])) {
    $codigoProducto = new AjaxProductos();
    $codigoProducto->idProducto = $_POST["idProducto"];
    $codigoProducto->ajaxEditarProducto();
}