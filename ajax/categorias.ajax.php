<?php

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class AjaxCategorias
{

    //EDITAR USUARIOS

    public $idCategoria;
    public $validarCategoria;

    public function ajaxEditarCategoria()
    {
        $campo = "id";
        $valor = $this->idCategoria;

        $editarCategoria = new ControladorCategorias();
        $respuesta = $editarCategoria->ctrMostrarCategorias($campo, $valor);

        echo json_encode($respuesta);

    }

    public function ajaxValidarCategoria()
    {
        $campo = "categoria";
        $valor = $this->validarCategoria;

        $categoriaValido = new ControladorCategorias();
        $respuesta = $categoriaValido->ctrMostrarCategorias($campo, $valor);

        echo json_encode($respuesta);
    }
}

//OBJETO PARA EDITAR CATEGORIA

if (isset($_POST["idCategoria"])) {

    $editar = new AjaxCategorias();
    $editar->idCategoria = $_POST["idCategoria"];
    $editar->ajaxEditarCategoria();
}

//VALIDAR CATEGORIA

if (isset($_POST["validarCategoria"])) {
    $validacionCategoria = new AjaxCategorias();
    $validacionCategoria->validarCategoria = $_POST["validarCategoria"];
    $validacionCategoria->ajaxValidarCategoria();
}