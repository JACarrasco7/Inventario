<?php

class ControladorUsuarios
{
// INGRESO DE USUARIO

    public function ctrIngresoUsuario()
    {

        if (isset($_POST["usuario"])) {

            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["usuario"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["password"])) {

                $tabla = "usuarios";
                $campo = "usuario";

                $encriptada = crypt($_POST["password"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $valor = $_POST["usuario"];

                $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $campo, $valor);
                if ($respuesta["usuario"] == $_POST["usuario"] && $respuesta["password"] == $encriptada) {
                    if ($respuesta["estado"] == 1) {

                        $_SESSION["sesion_iniciada"] = "SI";

                        $_SESSION["id"] = $respuesta["id"];
                        $_SESSION["nombre"] = $respuesta["nombre"];
                        $_SESSION["usuario"] = $respuesta["usuario"];
                        $_SESSION["foto"] = $respuesta["foto"];
                        $_SESSION["perfil"] = $respuesta["perfil"];

                        //Ultimologin
                        date_default_timezone_set('Europe/Madrid');
                        $fecha = date('Y-m-d');
                        $hora = date('H:i:s');
                        $fechaActual = $fecha . ' ' . $hora;
                        $campo1 = "ultimo_login";
                        $valor1 = $fechaActual;
                        $campo2 = "id";
                        $valor2 = $respuesta["id"];

                        $ultimoLogin = ModeloUsuarios::mdlActualizarCampoUsuario($tabla, $campo1, $valor1, $campo2, $valor2);

                        if ($ultimoLogin == "SI") {
                            header('Location: inicio');
                        }
                    } else {
                        echo '<br><div class="alert alert-danger">Este usuario se no tiene acceso actualmente</div>';
                    }
                } else {
                    echo '<br><div class="alert alert-danger">Los datos introducidos no coinciden</div>';
                }
            }
        }
    }
// ALTA USUARIO
    public function ctrCrearUsuario()
    {
        if (isset($_POST["nuevoUsuario"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])) {

                $ruta = "";

                if (isset($_FILES["nuevaFoto"]["tmp_name"])) {
                    list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

                    $nuevoAncho = 350;
                    $nuevoAlto = 350;
                     // CREAMOS EL DIRECTORIO
                    $directorio = "vistas/img/usuarios/" . $_POST["nuevoUsuario"];
                    mkdir($directorio, 0755);

                     // APLICAMOS FUNCIONES SEGUN EL FORMATO
                    if ($_FILES["nuevaFoto"]["type"] == "image/jpeg") {
                        $ruta = "vistas/img/usuarios/" . $_POST["nuevoUsuario"] . "/" . $_POST["nuevoUsuario"] . ".jpg";
                        $origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);
                    }

                    if ($_FILES["nuevaFoto"]["type"] == "image/png") {
                        $ruta = "vistas/img/usuarios/" . $_POST["nuevoUsuario"] . "/" . $_POST["nuevoUsuario"] . ".png";
                        $origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);
                    }
                }

                $tabla = "usuarios";

                $encriptada = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $datos = array(
                    "nombre" => $_POST["nuevoNombre"],
                    "usuario" => $_POST["nuevoUsuario"],
                    "password" => $encriptada,
                    "perfil" => $_POST["nuevoPerfil"],
                    "foto" => $ruta
                );

                $respuesta = ModeloUsuarios::mdlIngresarUsuarios($tabla, $datos);


                if ($respuesta == "OK") {
                    echo
                        '<script>
                swal({
                    type: "success",
                    title: "¡El usuario ha sido guardado correctamente!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false,
                    position: "bottom-right"
                }).then((result)=>{
                    if(result.value){
                        window.location = "usuarios";
                    }
                });
            </script>';
                }

            } else {
                echo
                    '<script>
                swal({
                    type: "error",
                    title: "¡El usuario no puede ir vacio o llevar caracteres especiales!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false,
                    position: "bottom-right"
                })
            </script>';
            }
        }
    }
    // MOSTRA USUARIOS

    public function ctrMostrarUsuarios($campo, $valor)
    {

        $tabla = "usuarios";
        $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $campo, $valor);
        return $respuesta;
    }

    //EDITAR USUARIO

    public function ctrEditarUsuario()
    {

        if (isset($_POST["editarUsuario"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"]) && !empty($_POST["editarNombre"])) {

                $ruta = $_POST["fotoActual"];

                if (isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])) {

                    list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);
                    $nuevoAncho = 350;
                    $nuevoAlto = 350;

                    $directorio = "vistas/img/usuarios/" . $_POST["editarUsuario"];

                    if (!empty($_POST["fotoActual"])) {
                        unlink($_POST["fotoActual"]);
                    } else {
                        mkdir($directorio, 0755);
                    }
                    if ($_FILES["editarFoto"]["type"] == "image/jpeg") {
                        $ruta = "vistas/img/usuarios/" . $_POST["editarUsuario"] . "/" . $_POST["editarUsuario"] . ".jpg";
                        $origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);
                    }

                    if ($_FILES["editarFoto"]["type"] == "image/png") {
                        $ruta = "vistas/img/usuarios/" . $_POST["editarUsuario"] . "/" . $_POST["editarUsuario"] . ".png";
                        $origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);
                    }
                }

                $tabla = "usuarios";

                if ($_POST["editarPassword"] != "") {
                    if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])) {
                        $encriptada = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                        $datos = array(
                            "nombre" => $_POST["editarNombre"],
                            "usuario" => $_POST["editarUsuario"],
                            "password" => $encriptada,
                            "perfil" => $_POST["editarPerfil"],
                            "foto" => $ruta
                        );
                        $respuesta = ModeloUsuarios::mdlEditarUsuarios($tabla, $datos);

                        if ($respuesta == "SI") {
                            echo
                                '<script>
                        swal({
                            type: "success",
                            title: "¡El usuario ha sido editado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false,
                            position: "bottom-right"
                        }).then((result)=>{
                            if(result.value){
                                window.location = "usuarios";
                            }
                        });
                    </script>';

                        }
                    } else {
                        echo
                            '<script>
                                swal({
                                    type: "error",
                                    title: "¡La contraseña no puede ir vacio o llevar caracteres especiales!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: false,
                                    position: "bottom-right"
                                })
                            </script>';
                    }
                } else {
                    $encriptada = $_POST["passwordActual"];

                    $datos = array(
                        "nombre" => $_POST["editarNombre"],
                        "usuario" => $_POST["editarUsuario"],
                        "password" => $encriptada,
                        "perfil" => $_POST["editarPerfil"],
                        "foto" => $ruta
                    );
                    $respuesta = ModeloUsuarios::mdlEditarUsuarios($tabla, $datos);

                    if ($respuesta == "SI") {
                        echo
                            '<script>
                    swal({
                        type: "success",
                        title: "¡El usuario ha sido editado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false,
                        position: "bottom-right"
                    }).then((result)=>{
                        if(result.value){
                            window.location = "usuarios";
                        }
                    });
                </script>';

                    }
                }

            } else {
                echo
                    '<script>
                swal({
                    type: "error",
                    title: "¡El usuairio no puede ir vacio o llevar caracteres especiales!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false,
                    position: "bottom-right"
                })
            </script>';
            }
        }

    }
    
    // BORRAR USUARIO
    public function ctrBorrarUsuario()
    {
        if (isset($_GET["idUsuario"])) {
            if ($_GET["fotoUsuario"] != "") {
                unlink($_GET["fotoUsuario"]);
                rmdir('vistas/img/usuarios/' . $_GET["usuario"]);
            }
            $tabla = "usuarios";
            $datos = $_GET["idUsuario"];

            $respuesta = ModeloUsuarios::mdlBorrarUsuarios($tabla, $datos);

            if ($respuesta == "SI") {
                echo
                    '<script>
                swal({
                    type: "success",
                    title: "¡El usuario ha sido borrado correctamente!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false,
                    position: "bottom-right"
                }).then((result)=>{
                    if(result.value){
                        window.location = "usuarios";
                    }
                });
            </script>';
            }
        }
    }
}
