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
							<span><?php echo 'Herramientas'; ?></span>
							<div align="right">
								<button type="button" id="btn_add" class="btn btn-info btn-sm">Agregar</button>
							</div>
						</strong>
					</div>

					<div class="panel-body" >
						<table class="table table-bordered table-striped table-hover" id="myTable">
							<thead>
								<th class="text-center" style="width: 1%;">#</th>
								<th class="text-left" style="width: 15%;"> Descripcion </th>
								<th class="text-center" style="width: 1%;"> Stock </th>
								<th class="text-center" style="width: 1%;"> Acciones </th>
							</thead>
							<tbody></tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include_once('herramientas_modal.php'); ?>
<script src="js/herramientas.js"></script>
</body>
</html>


