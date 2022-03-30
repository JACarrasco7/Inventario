<?php

require_once('conexion.php');

class ModeloProductos
{
    // MOSTRAR PRODUCTOS

    static public function mdlMostrarProductos($tabla, $campo, $valor)
    {
        if ($campo != null) {
            $conexion = Conexion::conectar();
            $sentencia = $conexion->prepare("SELECT * FROM $tabla WHERE $campo = :$campo");
            $sentencia->bindparam(":" . $campo, $valor, PDO::PARAM_STR);
            $sentencia->execute();
            return $sentencia->fetch();
        } else {
            $conexion = Conexion::conectar();
            $sentencia = $conexion->prepare(" SELECT * FROM $tabla");
            $sentencia->execute();
            return $sentencia->fetchAll();
        }
        $sentencia->close();
        $sentencia = null;
    }

    static public function mdlIngresarProducto($tabla, $datos)
    {
        $conexion = Conexion::conectar();
        $sentencia = $conexion->prepare("INSERT INTO $tabla(id_categoria, codigo, descripcion, imagen, stock, precio_compra, precio_venta) 
                                         VALUES(:id_categoria, :codigo, :descripcion, :imagen, :stock, :precio_compra, :precio_venta)");
        $sentencia->bindparam(":id_categoria", $datos["id_categoria"], PDO::PARAM_STR);
        $sentencia->bindparam(":codigo", $datos["codigo"], PDO::PARAM_STR);
        $sentencia->bindparam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $sentencia->bindparam(":imagen", $datos["imagen"], PDO::PARAM_STR);
        $sentencia->bindparam(":stock", $datos["stock"], PDO::PARAM_STR);
        $sentencia->bindparam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
        $sentencia->bindparam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);

        if ($sentencia->execute()) {
            return "SI";
        } else {
            return "error";

        }
    }

    static public function mdlEditarProducto($tabla, $datos)
    {
        $conexion = Conexion::conectar();
        $sentencia = $conexion->prepare("UPDATE  $tabla SET id_categoria = :id_categoria, codigo = :codigo, descripcion = :descripcion, imagen = :imagen, stock = :stock, precio_compra = :precio_compra, precio_venta = :precio_venta  WHERE codigo = :codigo");
        $sentencia->bindparam(":id_categoria", $datos["id_categoria"], PDO::PARAM_STR);
        $sentencia->bindparam(":codigo", $datos["codigo"], PDO::PARAM_STR);
        $sentencia->bindparam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $sentencia->bindparam(":imagen", $datos["imagen"], PDO::PARAM_STR);
        $sentencia->bindparam(":stock", $datos["stock"], PDO::PARAM_STR);
        $sentencia->bindparam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
        $sentencia->bindparam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);

        if ($sentencia->execute()) {
            return "SI";
        } else {
            return "error";

        }
    }

    static public function mdlBorrarProducto($tabla, $datos)
    {
        $conexion = Conexion::conectar();
        $sentencia = $conexion->prepare("DELETE FROM $tabla WHERE id = :id");
        $sentencia->bindparam(":id", $datos, PDO::PARAM_STR);

        if ($sentencia->execute()) {
            return "SI";
        } else {
            return "error";
            echo "<script>alert('hola')</script>";
        }

    }
}