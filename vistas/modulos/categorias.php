<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Administracion Categorias
      </h1>
      <ol class="breadcrumb">
        <li><a hrefinicioi class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="categorias">Administracion Categorias</a></li>
      </ol>
    </section>
    <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">Añadir usuarios</button>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tablas">
          <thead>
            <tr>
              <th>Nº</th>
              <th>Id</th>
              <th>Categoria</th>
              <th>fecha</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $campo = null;
          $valor = null;

          $mostrar_categoria = new ControladorCategorias();
          $categoria = $mostrar_categoria->ctrMostrarCategorias($campo, $valor);
          //var_dump($usuarios);
          foreach ($categoria as $clave => $valor) {
            ?>
            <tr>
              <td><?php echo $clave + 1 ?></td>
              <td><?php echo $valor["id"] ?></td>
              <td><?php echo $valor["categoria"] ?></td>
              <td><?php echo $valor["fecha"] ?></td>
              <td>
                <div class="btn-group">
                  <button class="btn btn-warning btnEditarCategoria" idCategoria="<?php echo $valor["id"]; ?>" data-toggle="modal" data-target="#modalEditarCategoria" >
                    <i class="fa fa-pencil"></i>
                  </button>
                  <button class="btn btn-danger btnEliminarCategoria" idCategoria="<?php echo $valor["id"]; ?>" categoria="<?php echo $valor["categoria"]; ?>">
                    <i class="fa fa-times"></i>
                  </button>
                </div>
              </td>
            </tr>
          <?php 
        } ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>

<!-- VENTANA MODAL AGREGAR CATEGORIA -->

<!-- MODAL -->
<div id="modalAgregarCategoria" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="POST" action="" enctype="multipart/form-data">
        <div class="modal-header" style="background: #3c8dbc; color: white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Añadir categoria</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <!-- Nombre -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-user"></i>
                </span>
                <input type="text" class="form-control input-lg" name="nuevaCategoria" placeholder="Introduzca el nombre" required="">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
        <?php 
        $crearCategoria = new ControladorCategorias();
        $crearCategoria->ctrCrearCategoria();
        ?>
      </form>
    </div>
  </div>
</div>


<!-- VENTANA MODAL EDITAR CATEGORIA -->

<!-- MODAL -->
<div id="modalEditarCategoria" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="POST" action="" enctype="multipart/form-data">
        <div class="modal-header" style="background: #3c8dbc; color: white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar categoria</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <!-- Nombre -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-user"></i>
                </span>
                <input type="text" class="form-control input-lg" id="editarCategoria" name="editarCategoria" value="">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary miboton">Editar categoria</button>
        </div>
        <?php 
        //$editarCategoria = new ControladorCategorias();
        //$editarCategoria->ctrEditarCategoria();
        ?>
      </form>
    </div>
  </div>
</div>
        <?php 
        //$BorrarCategoria = new ControladorCategorias();
        //$BorrarCategoria->ctrBorrarCategoria();
        ?>