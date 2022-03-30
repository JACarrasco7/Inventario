<?php

require_once('conexion.php');

class ModeloCategorias
{
    // MOSTRAR CATEGORIAS

    static public function mdlMostrarCategorias($tabla, $campo, $valor)
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

    //INGRESAR CATEGORIAS
    static public function mdlIngresarCategorias($tabla, $datos)
    {
        $conexion = Conexion::conectar();
        $sentencia = $conexion->prepare("INSERT INTO $tabla(categoria) 
                                         VALUES(:nombre)");
        $sentencia->bindParam(":nombre", $datos, PDO::PARAM_STR);

        if ($sentencia->execute()) {
            return "OK";
        } else {
            return "error";
        }

        $sentencia->close();

        $sentencia = null;
    }

    //EDITAR USUARIO
    static public function mdlEditarCategorias($tabla, $datos)
    {

        $conexion = Conexion::conectar();
        $sentencia = $conexion->prepare("UPDATE $tabla SET categoria = :nombre WHERE id = :id");
        $sentencia->bindParam(":nombre", $datos["categoria"], PDO::PARAM_STR);
        $sentencia->bindParam(":id", $datos["id"], PDO::PARAM_INT);

        if ($sentencia->execute()) {
            return "SI";
        } else {
            return "error";
        }

        $sentencia->close();

        $sentencia = null;
    }

        //BORRAR CATEGORIA
    static public function mdlBorrarCategorias($tabla, $datos)
    {
        $conexion = Conexion::conectar();
        $sentencia = $conexion->prepare("DELETE FROM $tabla WHERE id = :id");

        $sentencia->bindParam(":id", $datos, PDO::PARAM_INT);

        if ($sentencia->execute()) {
            return "SI";
        } else {
            return "error";
        }

        $sentencia->close();

        $sentencia = null;

    }

}