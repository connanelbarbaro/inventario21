<?php

	require_once('admin_modelo.php');  
	require_once('reparacion_modelo.php');
	require_once('prestamo_modelo.php');	
	$page_title = 'Pagina De Inicio';

	// Checkin What level user has permission to view this page
	page_require_level(1);
	$adatos = array( array( "Usuarios", Contar( 'users') ),
	array( "Categorias", Contar( 'categorias') ),
	array( "Herramientas", Contar( 'herramientas') ),
	array( "Pendientes", TotalPendientes() ),
	array( "Prestadas x Mes", TotalPrestadasMes() ),	
	array( "Prestadas Hoy", TotalPrestadasHoy() ),
	array( "En Reparacion", TotalReparacion() ),	
	);
	$all_herramientas = ReparacionListar();
	$all_prestamo = PrestamoPendientes();
?>
<?php include_once('layouts/header.php'); ?>

<div class="row">
    <div class="col-md-6">
        <?php echo display_msg($msg); ?>
    </div>
</div>
<div class="row">
	  <?php foreach ($adatos as  $datos): ?>
		    <div class="col-md-3">
			   <div class="panel panel-box clearfix">
				  <div class="panel-icon pull-left bg-green">
					 <i class="glyphicon glyphicon-info-sign"></i>
				  </div>
				  <div class="panel-value pull-right">
					 <h2 class="margin-top"> <?php  echo $datos[ 1 ]; ?> </h2>
					 <p class="text-muted"><?php  echo $datos[ 0 ]; ?></p>
				  </div>
			   </div>
		    </div>
	  <?php endforeach; ?>

</div>

<!-- reportes -->
<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<strong>
					<span class="glyphicon glyphicon-th"></span>
					<span>Herramientas Para Devolver</span>
				</strong>
			</div>
			<div class="panel-body">
			<table class="table table-bordered table-striped table-hover" id="myTable">
				<thead>
					<tr>
						<th class="text-left" style="width: 15%;"> Descripcion </th>
						<th class="text-center" style="width: 1%;"> Prestadas </th>
						<th class="text-center" style="width: 1%;"> Pendientes </th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($all_prestamo as $herramienta):?>
						<tr>
							<td> <?php echo $herramienta['herramienta']; ?></td>
							<td> <?php echo $herramienta['totalprestadas']; ?></td>
							<td> <?php echo $herramienta['totalpendientes']; ?></td>				
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>	
	</div>
</div>	
<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<strong>
					<span class="glyphicon glyphicon-th"></span>
					<span>Herramientas Para Reparar</span>
				</strong>
			</div>
			<div class="panel-body">
			<?php 
				require_once('reparacion_modelo.php');
				$all_herramientas = ReparacionListar();
				$opcion = (isset($_GET["opcion"])) ? $_GET["opcion"] : '0';
			?>
			<table class="table table-bordered table-striped table-hover" id="myTable">
				<thead>
					<tr>
						<th class="text-left" style="width: 15%;"> Descripcion </th>
						<th class="text-center" style="width: 1%;"> Ubicacion__1 </th>
						<th class="text-center" style="width: 1%;"> Problema </th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($all_herramientas as $herramienta):?>
						<tr>
							<td> <?php echo $herramienta['herramienta']; ?></td>
							<td> <?php echo $herramienta['ubicacion']; ?></td>
							<td> <?php echo $herramienta['problema']; ?></td>				
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>	
	</div>
</div>	



<?php include_once('layouts/footer.php'); ?>