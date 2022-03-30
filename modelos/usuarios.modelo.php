<?php

require_once('conexion.php');

class ModeloUsuarios
{
        // MOSTRAR USUARIOS

    static public function mdlMostrarUsuarios($tabla, $campo, $valor)
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

    //INGRESAR USUARIOS
    static public function mdlIngresarUsuarios($tabla, $datos)
    {
        $conexion = Conexion::conectar();
        $sentencia = $conexion->prepare("INSERT INTO $tabla(nombre, usuario, password, perfil, foto, intentos) 
                                         VALUES(:nombre, :usuario, :password, :perfil, :foto, 5)");
        $sentencia->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $sentencia->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
        $sentencia->bindParam(":password", $datos["password"], PDO::PARAM_STR);
        $sentencia->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
        $sentencia->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);

        if ($sentencia->execute()) {
            return "OK";
        } else {
            return "error";
        }

        $sentencia->close();

        $sentencia = null;
    }

    //EDITAR USUARIO
    static public function mdlEditarUsuarios($tabla, $datos)
    {
        $conexion = Conexion::conectar();
        $sentencia = $conexion->prepare("UPDATE $tabla SET nombre = :nombre, password = :password, perfil = :perfil, foto = :foto WHERE usuario = :usuario");

        $sentencia->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $sentencia->bindParam(":password", $datos["password"], PDO::PARAM_STR);
        $sentencia->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
        $sentencia->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
        $sentencia->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);

        if ($sentencia->execute()) {
            if ($_SESSION["usuario"] == $datos["usuario"]) {
                $_SESSION["foto"] = $datos["foto"];
                $_SESSION["nombre"] = $datos["nombre"];
            }
            return "SI";
        } else {
            return "error";
        }

        $sentencia->close();

        $sentencia = null;
    }

    //ACTIVAR USUARIO
    static public function mdlActualizarCampoUsuario($tabla, $campo1, $valor1, $campo2, $valor2)
    {
        $conexion = Conexion::conectar();
        $sentencia = $conexion->prepare("UPDATE $tabla SET $campo1 = :$campo1, intentos = 5 WHERE $campo2 = :$campo2");

        $sentencia->bindParam(":" . $campo1, $valor1, PDO::PARAM_STR);
        $sentencia->bindParam(":" . $campo2, $valor2, PDO::PARAM_STR);

        if ($sentencia->execute()) {
            return "SI";
        } else {
            return "error";
        }

        $sentencia->close();

        $sentencia = null;

    }

    //RESTAR INTENTOS
    static public function mdlRestarIntentos($tabla, $usuario, $intentos)
    {
        $conexion = Conexion::conectar();
        $sentencia = $conexion->prepare("UPDATE $tabla SET intentos = $intentos WHERE usuario = '$usuario'");

        $sentencia->bindParam(":intentos", $intentos, PDO::PARAM_INT);
        $sentencia->bindParam(":usuario", $usuario, PDO::PARAM_STR);

        if ($sentencia->execute()) {
            return "SI";
        } else {
            return "error";
        }

        $sentencia->close();

        $sentencia = null;
    }

    //DESACTIVAR USUARIO INTENTOS
    static public function mdldesactivarintentos($tabla, $usuario)
    {
        $conexion = Conexion::conectar();
        $sentencia = $conexion->prepare("UPDATE $tabla SET estado = 0 WHERE usuario = '$usuario'");

        $sentencia->bindParam(":usuario", $usuario, PDO::PARAM_STR);

        if ($sentencia->execute()) {
            return "SI";
        } else {
            return "error";
        }

        $sentencia->close();

        $sentencia = null;
    }


    //BORRAR USUARIO
    static public function mdlBorrarUsuarios($tabla, $datos)
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