<?php

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class AjaxUsuarios
{

    //EDITAR USUARIOS

    public $idUsuario;
    public $activarUsuario;
    public $activarId;
    public $validadUsuario;

    public function ajaxEditarUsuario()
    {
        $campo = "id";
        $valor = $this->idUsuario;

        $editarUsuario = new ControladorUsuarios();
        $respuesta = $editarUsuario->ctrMostrarUsuarios($campo, $valor);

        echo json_encode($respuesta);
    }

    public function ajaxActivarUsuario()
    {
        $tabla = "usuarios";
        $campo1 = "estado";
        $valor1 = $this->activarUsuario;
        $campo2 = "id";
        $valor2 = $this->activarId;

        $respuesta = ModeloUsuarios::mdlActualizarCampoUsuario($tabla, $campo1, $valor1, $campo2, $valor2);
    }

    public function ajaxValidarUsuario()
    {
        $campo = "usuario";
        $valor = $this->validadUsuario;

        $usuarioValido = new ControladorUsuarios();
        $respuesta = $usuarioValido->ctrMostrarUsuarios($campo, $valor);

        echo json_encode($respuesta);
    }
}

//OBJETO PARA EDITARA USUARIO

if (isset($_POST["idUsuario"])) {

    $editar = new AjaxUsuarios();
    $editar->idUsuario = $_POST["idUsuario"];
    $editar->ajaxEditarUsuario();
}

//ACTIVAR USUARIO

if (isset($_POST["activarUsuario"])) {

    $editarUsuario = new AjaxUsuarios();
    $editarUsuario->activarUsuario = $_POST["activarUsuario"];
    $editarUsuario->activarId = $_POST["activarId"];
    $editarUsuario->ajaxActivarUsuario();
}

//VALIDAR USUARIO REPE

if (isset($_POST["validarUsuario"])) {
    $validacionUsuario = new AjaxUsuarios();
    $validacionUsuario->validadUsuario = $_POST["validarUsuario"];
    $validacionUsuario->ajaxValidarUsuario();
}