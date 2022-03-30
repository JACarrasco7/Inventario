<?php
require_once('conexion.php');

class ModeloClientes
{
    // MOSTRARA USUARIOS
    static public function mdlMostrarClientes($tabla, $campo, $valor)
    {
        if ($valor != null) {
            $conexion = Conexion::conectar();
            $sentencia = $conexion->prepare("SELECT * FROM $tabla WHERE $campo = :$campo");
            $sentencia->bindparam(":" . $campo, $valor, PDO::PARAM_STR);
            $sentencia->execute();
            return $sentencia->fetch();
        } else {
            $conexion = Conexion::conectar();
            $sentencia = $conexion->prepare("SELECT * FROM $tabla");
            $sentencia->execute();
            return $sentencia->fetchAll();
        }
        $sentencia->close();
        $sentencia = null;
    }

    //CREAR CLIENTES
    static public function mdlCrearClientes($tabla, $datos)
    {
        $conexion = Conexion::conectar();
        $sentencia = $conexion->prepare("INSERT INTO $tabla(nombre, documento, email, telefono, direccion, fecha_nacimiento) 
                                         VALUES(:nombre, :documento, :email, :telefono, :direccion, :fecha_nac)");
        $sentencia->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $sentencia->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
        $sentencia->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $sentencia->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $sentencia->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
        $sentencia->bindParam(":fecha_nac", $datos["fecha_nac"]);

        if ($sentencia->execute()) {
            return "OK";
        } else {
            return "error";
        }


        $sentencia->close();

        $sentencia = null;
    }

    //EDITAR CLIENTES
    static public function mdlEditarClientes($tabla, $datos)
    {

        $conexion = Conexion::conectar();
        $sentencia = $conexion->prepare("UPDATE $tabla SET nombre = :nombre, documento = :documento, email = :email, telefono = :telefono, direccion = :direccion, fecha_nacimiento = :fecha_nac WHERE id = :id");
        $sentencia->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $sentencia->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
        $sentencia->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $sentencia->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $sentencia->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
        $sentencia->bindParam(":fecha_nac", $datos["fecha_nac"]);
        $sentencia->bindParam(":id", $datos["id"], PDO::PARAM_INT);


        if ($sentencia->execute()) {
            return "SI";
        } else {
            return "error";
        }

        $sentencia->close();

        $sentencia = null;
    }

    //BORRAR CLIENTE
    static public function mdlBorrarClientes($tabla, $datos)
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