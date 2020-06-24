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
							<span><?php echo 'Prestamo de Herramientas'; ?></span>
							<div align="right">
								<button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-sm">Agregar</button>
							</div>
						</strong>
					</div>
					<div class="panel-body" >
						<table class="table table-bordered table-striped table-hover" id="myTable1">
							<thead>
								   <th style="width: 5%;"> # </th>
								   <th style="width: 50%;"> Profesor </th>
								   <th style="width: 5%;"> Prestadas </th>
								   <th style="width: 5%;"> Pendientes </th>                            
								   <th class="text-center" style="width: 10%;"> Acciones </th>
							</thead>
							<tbody id="detalle-producto1">
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	
	</div>
</div>
<?php include_once('prestamo_modal.php'); ?>
<?php include_once('layouts/js.php'); ?>
<script src="js/prestamo.js"></script>
</body>
</html>


