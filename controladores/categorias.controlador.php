<?php

class ControladorCategorias
{
// MOSTRA CATEGORIAS

    public function ctrMostrarCategorias($campo, $valor)
    {
        $tabla = "categorias";
        $respuesta = ModeloCategorias::mdlMostrarCategorias($tabla, $campo, $valor);
        return $respuesta;
    }
// ALTA CATEGORIAS
    public function ctrCrearCategoria()
    {
        if (isset($_POST["nuevaCategoria"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaCategoria"])) {

                $tabla = "categorias";
                $datos = $_POST["nuevaCategoria"];

                $respuesta = ModeloCategorias::mdlIngresarCategorias($tabla, $datos);


                if ($respuesta == "OK") {
                    echo
                        '<script>
                swal({
                    type: "success",
                    title: "¡La categoria ha sido guardada correctamente!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false,
                    position: "bottom-right"
                }).then((result)=>{
                    if(result.value){
                        window.location = "categorias";
                    }
                });
            </script>';
                }

            } else {
                echo
                    '<script>
                swal({
                    type: "error",
                    title: "¡El nombre no puede ir vacio!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false,
                    position: "bottom-right"
                })
            </script>';
            }
        }
    }

    //EDITAR CATEGORIAS

    public function ctrEditarCategoria()
    {

        if (isset($_POST["editarCategoria"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCategoria"]) && !empty($_POST["editarCategoria"])) {

                $tabla = "categorias";

                $datos = array(
                    "id" => $_POST["idCategoria"],
                    "categoria" => $_POST["editarCategoria"]
                );


                $respuesta = ModeloCategorias::mdlEditarCategorias($tabla, $datos);

                if ($respuesta == "SI") {
                    echo
                        '<script>
                    swal({
                        type: "success",
                        title: "¡La categoria ha sido editado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false,
                        position: "bottom-right"
                    }).then((result)=>{
                        if(result.value){
                            window.location = "categorias";
                        }
                    });
                </script>';

                } else {
                    echo
                        '<script>
                    swal({
                        type: "error",
                        title: "¡La categoria no ha sido editada correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false,
                        position: "bottom-right"
                    })
                </script>';
                }
            } else {
                echo
                    '<script>
                swal({
                    type: "error",
                    title: "¡El nombre no puede ir vacio!",
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
    public function ctrBorrarCategoria()
    {
        if (isset($_GET["idCategoria"])) {
            $tabla = "categorias";
            $datos = $_GET["idCategoria"];

            $respuesta = ModeloCategorias::mdlBorrarCategorias($tabla, $datos);

            if ($respuesta == "SI") {
                echo
                    '<script>
                swal({
                    type: "success",
                    title: "¡La categoria ha sido borrado correctamente!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false,
                    position: "bottom-right"
                }).then((result)=>{
                    if(result.value){
                        window.location = "categorias";
                    }
                });
            </script>';
            }
        }
    }
}