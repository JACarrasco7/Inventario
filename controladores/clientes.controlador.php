<?php

?><?php

    class ControladorClientes
    {
    
    //? ALTA DE CLIENTE
        public function ctrCrearClientes()
        {

            if (isset($_POST["nuevoDocumento"])) {
            
            // preg_match — Realiza una comparación con una expresión regular.
                if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"])) {
                    if (preg_match('/^([0-9]{2})(.)([0-9]{3})(.)([0-9]{3})(.)[A-Z]+$/', $_POST["nuevoDocumento"])) {
                        if (preg_match('/^([0-9]{3})(-)([0-9]{2})(-)([0-9]{2})(-)([0-9]{2})+$/', $_POST["nuevoTelefono"])) {


                            $fecha = date("Y-m-d", strtotime($_POST["nuevoFecha_nac"]));

                            $tabla = "clientes";

                            $datos = array(
                                "nombre" => $_POST["nuevoNombre"],
                                "documento" => $_POST["nuevoDocumento"],
                                "email" => $_POST["nuevoEmail"],
                                "telefono" => $_POST["nuevoTelefono"],
                                "direccion" => $_POST["nuevoDireccion"],
                                "fecha_nac" => $fecha
                            );

                            $respuesta = ModeloClientes::mdlCrearClientes($tabla, $datos);
                    
                    //? SI TODO SALE BIEN MOSTRAMOS UN ALERT SUCCESS, SINO UNO DE ERROR
                            if ($respuesta == "OK") {
                                echo '<script>
                                swal({
                                    type: "success",
                                    title: "¡El cliente ha sido guardado correctamente!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: false,
                                    position: "bottom-right"
                                }).then((result)=>{
                                    if(result.value){
                                        window.location = "clientes";
                                    }     
                                });
                            </script>';
                            }
                        } else {
                            echo '<script>
                        swal({
                            type: "error",
                            title: "¡Telefono mal introducido!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false,
                            position: "bottom-right"
                        }).then((result)=>{
                            if(result.value){
                                window.location = "clientes";
                            }     
                        });
                    </script>';
                        }
                    } else {
                        echo '<script>
                            swal({
                                type: "error",
                                title: "¡DNI mal escrito!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false,
                                position: "bottom-right"
                            }).then((result)=>{
                                if(result.value){
                                    window.location = "clientes";
                                }     
                            });
                        </script>';
                    }
                } else {
                    echo '<script>
                        swal({
                            type: "error",
                            title: "¡El nombre no puede ir vacío o llevar caracteres especialeswefewfw!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false,
                            position: "bottom-right"
                        }).then((result)=>{
                            if(result.value){
                                window.location = "clientes";
                            }     
                        });
                    </script>';
                }
            }
        }

    //? SE UTILIZA PARA MOSTRAR LOS CLIENTES EN LA TABLA (DATATABLE)
        public function ctrMostrarClientes($campo, $valor)
        {
            $tabla = "clientes";

            $respuesta = ModeloClientes::mdlMostrarClientes($tabla, $campo, $valor);

            return $respuesta;

        }
        //EDITAR CATEGORIAS

        public function ctrEditarClientes()
        {

            if (isset($_POST["editarId"])) {
                if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])) {
                    if (preg_match('/^([0-9]{2})(.)([0-9]{3})(.)([0-9]{3})(.)[A-ZÑ]+$/', $_POST["editarDocumento"])) {
                        if (preg_match('/^([0-9]{3})(-)([0-9]{2})(-)([0-9]{2})(-)([0-9]{2})+$/', $_POST["editarTelefono"])) {

                            $fecha = date("Y-m-d", strtotime($_POST["editarFecha_nac"]));
                            $tabla = "clientes";
                            $datos = array(
                                "id" => $_POST["editarId"],
                                "nombre" => $_POST["editarNombre"],
                                "documento" => $_POST["editarDocumento"],
                                "email" => $_POST["editarEmail"],
                                "telefono" => $_POST["editarTelefono"],
                                "direccion" => $_POST["editarDireccion"],
                                "fecha_nac" => $fecha
                            );
                            $respuesta = ModeloClientes::mdlEditarClientes($tabla, $datos);
                            
                    // SI TODO SALE BIEN MOSTRAMOS UN ALERT SUCCESS, SINO UNO DE ERROR
                            if ($respuesta == "SI") {
                                echo '<script>
                                swal({
                                    type: "success",
                                    title: "¡El cliente ha sido editado correctamente!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: false,
                                    position: "bottom-right"
                                }).then((result)=>{
                                    if(result.value){
                                        window.location = "clientes";
                                    }     
                                });
                            </script>';
                            }
                        } else {
                            echo '<script>
                        swal({
                            type: "error",
                            title: "¡Telefono mal introducido!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false,
                            position: "bottom-right"
                        }).then((result)=>{
                            if(result.value){
                                window.location = "clientes";
                            }     
                        });
                    </script>';
                        }
                    } else {
                        echo '<script>
                            swal({
                                type: "error",
                                title: "¡DNI mal introducido!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false,
                                position: "bottom-right"
                            }).then((result)=>{
                                if(result.value){
                                    window.location = "clientes";
                                }     
                            });
                        </script>';
                    }
                } else {
                    echo '<script>
                        swal({
                            type: "error",
                            title: "¡El nombre no puede ir vacío o llevar caracteres especialeswefewfw!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false,
                            position: "bottom-right"
                        }).then((result)=>{
                            if(result.value){
                                window.location = "clientes";
                            }     
                        });
                    </script>';
                }
            }
        }

        //BORRAR CLIENTE
        public function ctrBorrarClientes()
        {
            if (isset($_GET["idCliente"])) {
                $tabla = "clientes";
                $datos = $_GET["idCliente"];

                $respuesta = ModeloClientes::mdlBorrarClientes($tabla, $datos);

                if ($respuesta == "SI") {
                    echo
                        '<script>
                swal({
                    type: "success",
                    title: "¡EL cliente ha sido borrado correctamente!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false,
                    position: "bottom-right"
                }).then((result)=>{
                    if(result.value){
                        window.location = "clientes";
                    }
                });
            </script>';
                }
            }
        }
    }
    