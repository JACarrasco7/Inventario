<?php
class Conexion
{
    static public function conectar()
    {
        $conexion = new PDO("mysql:host=localhost;dbname=inventario", "root", "");
        $conexion->exec("set names utf8");
        return $conexion;
    }
}