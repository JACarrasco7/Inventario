<?php

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class AjaxClientes
{
    //EDITAR CLIENTES

    public $idCliente;
    public $validarCliente;
    public $validarClienteDNI;

    public function ajaxEditarCliente()
    {
        $campo = "id";
        $valor = $this->idCliente;

        $editarClientes = new ControladorClientes();
        $respuesta = $editarClientes->ctrMostrarClientes($campo, $valor);

        echo json_encode($respuesta);

    }
    //VALIDAR CLIENTE

    public function ajaxValidarClienteEmail()
    {
        $campo = "email";
        $valor = $this->validarCliente;

        $clienteValido = new ControladorClientes();
        $respuesta = $clienteValido->ctrMostrarClientes($campo, $valor);

        echo json_encode($respuesta);
    }

    public function ajaxValidarClienteDNi()
    {
        $campo = "documento";
        $valor = $this->validarClienteDNI;

        $clienteValido = new ControladorClientes();
        $respuesta = $clienteValido->ctrMostrarClientes($campo, $valor);

        echo json_encode($respuesta);
    }
}

//OBJETO PARA EDITAR CLIENTE

if (isset($_POST["idCliente"])) {

    $editar = new AjaxClientes();
    $editar->idCliente = $_POST["idCliente"];
    $editar->ajaxEditarCliente();
}

//VALIDAR EMAIL CLIENTE

if (isset($_POST["validarCliente"])) {
    $validacionCliente = new AjaxClientes();
    $validacionCliente->validarCliente = $_POST["validarCliente"];
    $validacionCliente->ajaxValidarClienteEmail();
}
//VALIDAR EMAIL CLIENTE

if (isset($_POST["validarClienteDNI"])) {
    $validacionCliente = new AjaxClientes();
    $validacionCliente->validarClienteDNI = $_POST["validarClienteDNI"];
    $validacionCliente->ajaxValidarClienteDNI();
}