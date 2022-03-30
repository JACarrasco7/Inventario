<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class TablaProductos
{

    //MOSTRAR TABLA 
    public function mostrarTablaProductos()
    {
        $campo = null;
        $valor = null;

        $mostrarProductos = new ControladorProductos();
        $productos = $mostrarProductos->ctrMostrarProductos($campo, $valor);
        
        //cabecera JSON
        $datosJson = '{
            "data": [';

        for ($i = 0; $i < count($productos); $i++) {
            //IMAGEN
            $imagen = "<img src='" . $productos[$i]["imagen"] . "' width='35px'>";

            //CATEGORIA
            $campo = "id";
            $valor = $productos[$i]["id_categoria"];

            $mostrarCategoria = new ControladorCategorias();
            $categoria = $mostrarCategoria->ctrMostrarCategorias($campo, $valor);

            //STOCK

            if ($productos[$i]["stock"] <= 10) {
                $stock = "<button class='btn btn-danger'>" . $productos[$i]["stock"] . "</button>";
            } else if ($productos[$i]["stock"] > 11 && $productos[$i]["stock"] <= 15) {
                $stock = "<button class='btn btn-warning'>" . $productos[$i]["stock"] . "</button>";
            } else {
                $stock = "<button class='btn btn-success'>" . $productos[$i]["stock"] . "</button>";
            }

            //BOTONES ACCION

            $botones = "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='" . $productos[$i]["id"] . "' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='" . $productos[$i]["id"] . "' codigo='" . $productos[$i]["codigo"] . "' imagen='" . $productos[$i]["imagen"] . "'><i class='fa fa-times'></i></button></div>";

            $datosJson .= '[
                "' . ($i + 1) . '",
                "' . $productos[$i]["id"] . '",
                "' . $imagen . '",
                "' . $productos[$i]["codigo"] . '",
                "' . $productos[$i]["descripcion"] . '",
                "' . $categoria["categoria"] . '",
                "' . $stock . '",
                "' . $productos[$i]["precio_compra"] . '",
                "' . $productos[$i]["precio_venta"] . '",
                "' . $productos[$i]["fecha"] . '",
                "' . $botones . '"
            ],';
        }
        $datosJson = substr($datosJson, 0, -1);

        $datosJson .= ' ]

    }';
        echo $datosJson;
    }
}

//ACTIVAR TABLA 
$activarProductos = new TablaProductos();
$activarProductos->mostrarTablaProductos();      