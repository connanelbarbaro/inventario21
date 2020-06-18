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
					<?php include_once('herramientas_list.php'); ?>					

					</div>
				</div>
			</div>
		</div>
	
	</div>
</div>
<?php include_once('herramientas_modal.php'); ?>
</body>
</html>