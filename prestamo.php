<?php
// Checkin What level user has permission to view this page
  require_once('includes/load.php');
@session_start();
$_SESSION['detalle'] = array();  
  
?>
<?php include_once('layouts/header.php'); ?>

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<strong>
							<span class="glyphicon glyphicon-th"></span>
							<span><?php echo 'Listado de Prestamos'; ?></span>
							<div align="right">
								<button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-sm">Agregar</button>
							</div>
						</strong>
					</div>
					<div class="panel-body detalle-producto1">
					<?php include_once('prestamo_list.php'); ?>					
					
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
<?php include_once('prestamo_modal.php'); ?>
</body>
</html>
<script type="text/javascript">



$(document).ready(function(){

// CARGA PROFESORES EN MODAL	
	var opcion = 4 ;
	$.post("prestamo_controler.php", {opcion:opcion }, function(data){
		$("#cbx_profesor").html(data);
	});

// CARGA HERRAMIENTAS EN MODAL	
	var opcion = 5 ;
	$.post("prestamo_controler.php", {opcion:opcion }, function(data){
		$("#cbx_herramienta").html(data);
	});
	


} );

</script>



