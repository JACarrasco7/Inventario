<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Administracion Productos
        </h1>
        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="productos">Administracion Productos</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProductos">Añadir Producto</button>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped dt-responsive tablaProductos">
                    <thead>
                        <tr>
                            <th>Nº</th>
                            <th>Id</th>
                            <th>Imagen</th>
                            <th>Codigo</th>
                            <th>Descripcion</th>
                            <th>Categoria</th>
                            <th>Stock</th>
                            <th>Precio de compra</th>
                            <th>Precio de venta</th>
                            <th>Agregado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<!-- VENTANA MODAL AGREGAR PRODUCTOS -->

<!-- MODAL -->
<div id="modalAgregarProductos" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="POST" action="" enctype="multipart/form-data">
                <div class="modal-header" style="background: #3c8dbc; color: white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Añadir productos</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                    <!-- Categoria -->
                    <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-th"></i>
                                </span>
                                <select class="form-control input-lg" name="nuevaCategoria" id="nuevaCategoria" required>
                                    <option value="">Selecciona una categoria</option>
                                    <?php 
                                    $campo = null;
                                    $valor = null;

                                    $mostrarCategorias = new ControladorCategorias();
                                    $categorias = $mostrarCategorias->ctrMostrarCategorias($campo, $valor);

                                    foreach ($categorias as $clave => $valor) {
                                        echo '<option value="' . $valor["id"] . '">' . $valor["categoria"] . '</option>';
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>
                        <!-- Codigo -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-code"></i>
                                </span>
                                <input type="text" class="form-control input-lg" name="nuevoCodigo" id="nuevoCodigo" placeholder="Introduzca el codigo" required>
                            </div>
                        </div>
                        <!-- Descripcion -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-product-hunt"></i>
                                </span>
                                <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Introduzca la descripcion" required>
                            </div>
                        </div>
                        <!-- Stock -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-check"></i>
                                </span>
                                <input type="text" class="form-control input-lg" name="nuevoStock" placeholder="Stock" required>
                            </div>
                        </div>
                        <!-- Precio Compra -->
                        <div class="form-group row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-arrow-up"></i>
                                    </span>
                                    <input type="number" class="form-control input-lg" name="nuevoPrecioCompra" id="nuevoPrecioCompra" min="0" step="any" placeholder="Precio de compra" required>
                                </div>
                            </div>
                            <!--  Venta -->
                            <div class="col-xs-12 col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-arrow-down"></i>
                                    </span>
                                    <input type="number" class="form-control input-lg" name="nuevoPrecioVenta" step="any" id="nuevoPrecioVenta" min="0" placeholder="Precio de venta" required>
                                </div>
                                <br>
                                <!-- Checkbox porcentaje -->
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label><input type="checkbox"  class="minimal porcentaje" checked>Utilizar porcentaje</label>
                                    </div>
                                </div>
                                <!-- Entrada porcentaje -->
                                <div class="col-xs-6" style="padding:0">
                                    <div class="input-group">
                                        <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" requires>
                                        <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- subir foto -->
                        <div class="form-group">
                            <div class="panel">Subir imagen</div>
                            <div class="input-group">
                                <input type="file" class="nuevaImagen" name="nuevaImagen">
                                <p class="help-block">Peso máximo de la foto: 2Mb</p>
                                <img src="vistas/img/productos/default/anonymous.png" class="img-thumbail previsualizar2" width="100px">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar producto</button>
                </div>
                <?php 
                $crearProducto = new ControladorProductos();
                $crearProducto->ctrCrearProductos();
                ?>
            </form>
        </div>
    </div>
</div>


<!-- VENTANA MODAL EDITAR PRODUCTOS -->

<!-- MODAL -->
<div id="modalEditarProducto" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="POST" action="" enctype="multipart/form-data">
                <div class="modal-header" style="background: #3c8dbc; color: white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editar productos</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                    <!-- Categoria -->
                    <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-th"></i>
                                </span>
                                <select class="form-control input-lg" name="editarCategoria" readonly required>
                                    <option id="editarCategoria"></option>
                                </select>
                            </div>
                        </div>
                        <!-- Codigo -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-code"></i>
                                </span>
                                <input type="text" class="form-control input-lg" name="editarCodigo" id="editarCodigo" readonly required>
                            </div>
                        </div>
                        <!-- Descripcion -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-product-hunt"></i>
                                </span>
                                <input type="text" class="form-control input-lg" name="editarDescripcion" id="editarDescripcion" required>
                            </div>
                        </div>
                        <!-- Stock -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-check"></i>
                                </span>
                                <input type="text" class="form-control input-lg" name="editarStock" id="editarStock" placeholder="Stock" required>
                            </div>
                        </div>
                        <!-- Precio Compra -->
                        <div class="form-group row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-arrow-up"></i>
                                    </span>
                                    <input type="number" class="form-control input-lg" name="editarPrecioCompra" id="editarPrecioCompra" min="0" step="any" required>
                                </div>
                            </div>
                            <!--  Venta -->
                            <div class="col-xs-12 col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-arrow-down"></i>
                                    </span>
                                    <input type="number" class="form-control input-lg" name="editarPrecioVenta" step="any" id="editarPrecioVenta" min="0" readonly required>
                                </div>
                                <br>
                                <!-- Checkbox porcentaje -->
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label><input type="checkbox"  class="minimal porcentaje" checked>Utilizar porcentaje</label>
                                    </div>
                                </div>
                                <!-- Entrada porcentaje -->
                                <div class="col-xs-6" style="padding:0">
                                    <div class="input-group">
                                        <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" requires>
                                        <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- subir foto -->
                        <div class="form-group">
                            <div class="panel">Editar imagen</div>
                            <div class="input-group">
                                <input type="file" class="nuevaImagen" id="nuevaImagen" name="editarImagen">
                                <input type="hidden" name="imagenActual" id="imagenActual">
                                <p class="help-block">Peso máximo de la foto: 2Mb</p>
                                <img src="vistas/img/productos/default/anonymous.png" class="thumbail previsualizar" width="100px">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar producto</button>
                </div>
                <?php 
                $editarProducto = new ControladorProductos();
                $editarProducto->ctrEditarProductos();
                ?>
            </form>
        </div>
    </div>
</div>

                <?php 
                $eliminarProducto = new ControladorProductos();
                $eliminarProducto->ctrBorrarProducto();
                ?>
