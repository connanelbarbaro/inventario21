<?php
// Checkin What level user has permission to view this page
  require_once('includes/load.php');
?>
<?php include_once('layouts/header.php'); ?>

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<strong>
							<span class="glyphicon glyphicon-th"></span>
							<span><?php echo 'Lista de Herramientas'; ?></span>
							<div align="right">
								<button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-sm">Agregar</button>
							</div>
						</strong>
					</div>
					<div class="panel-body detalle-producto">
					<?php include_once('prestamo_list.php'); ?>					

					</div>
				</div>
			</div>
		</div>
	
	</div>
</div>
<?php /* include_once('prestamo_modal.php'); */ ?>
</body>
</html>

















<?php
  require_once('includes/load.php');
  require_once('prestamo_sql.php');

  // Checkin What level user has permission to view this page
  page_require_level(2);

  $products = LISTAR_PEDIDOS();
  $_title = 'Prestamo de Herramientas';
  $page_title = "Prestamo";

  if (isset($_SESSION['idpedido'])) {
    unset($_SESSION['idpedido']);
  }


?>

<?php include_once('layouts/header.php'); ?>


<div class="row">
    <div class="col-md-12">

        <?php echo display_msg($msg); ?>
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span><?php echo $_title; ?></span>
                </strong>
                <div class="pull-right">
                  <a href='prestamo_edit.php?idpedido=0' class='btn btn-primary'>Agregar</a>
                </div>
            </div>
            <div class="panel-body">
            <table id="Mytabla1" class="table compact AllDataTables table-bordered display" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">#</th>
                            <th style="width: 50%;"> Profesor </th>
                            <th style="width: 5%;"> Prestadas </th>
                            <th style="width: 5%;"> Pendientes </th>                            
                            <th class="text-center" style="width: 10%;"> Acciones </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product):?>
                        <tr>
                            <td class="text-center"><?php echo count_id();?></td>
                            <td class="text-left"> <?php echo remove_junk($product['profesor']); ?></td>
                            <td class="text-right"> <?php echo remove_junk($product['totalprestadas']); ?></td>
                            <td class="text-right"> <?php echo remove_junk($product['totalpendientes']); ?></td>                            
                            <td class="text-center">
                                <div class="btn-group">

                                    <a href="prestamo_edit.php?idpedido=<?php echo (int)$product['idpedido'];?>"
                                        class="btn btn-info btn-xs" title="Editar" data-toggle="tooltip">
                                        <span class="glyphicon glyphicon-edit"></span>
                                    </a>
                                    <a href="prestamo_delete.php?idpedido=<?php echo (int)$product['idpedido'];?>"
                                        class="btn btn-danger btn-xs" title="Eliminar" data-toggle="tooltip">
                                        <span class="glyphicon glyphicon-trash">
                                    </a>

                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>



            </div>
        </div>
    </div>
</div>







<?php include_once('layouts/footer.php'); ?>