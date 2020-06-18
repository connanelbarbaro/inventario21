<?php 
require_once('reparacion_modelo.php');

page_require_level(1);
$all_herramientas = ReparacionListar();
$opcion = (isset($_GET["opcion"])) ? $_GET["opcion"] : '0';

?>

<table class="table table-bordered table-striped table-hover" id="myTable">
	<thead>
		<tr>
			<th class="text-left" style="width: 15%;"> Descripcion </th>
			<th class="text-center" style="width: 1%;"> Ubicacion__1 </th>
			<th class="text-center" style="width: 1%;"> Problema </th>
			<?php if( $opcion == "0") { ?>
				<th class="text-center" style="width: 5%;"> Acciones </th>
			<?php } ?>				
		</tr>
	</thead>
	<tbody>
		<?php foreach ($all_herramientas as $herramienta):?>
			<tr>
				<td> <?php echo $herramienta['herramienta']; ?></td>
				<td> <?php echo $herramienta['ubicacion']; ?></td>
				<td> <?php echo $herramienta['problema']; ?></td>				
				<?php if( $opcion == "0") { ?>
					<td class="text-center">
						<div class="btn-group">
							<button type="button" name="update" id="<?php echo (int)$herramienta['id'];?>" class="btn btn-info btn-sm update" title="Editar">
								E
							</button>
						</div>
						<div class="btn-group">					
							<button type="button" name="reparacion" id="<?php echo (int)$herramienta['id'];?>" class="btn btn-warning btn-sm reparacion" title="Reparacion">
								R
							</button>
						</div>					
						<div class="btn-group">					
							<button type="button" name="delete" id="<?php echo (int)$herramienta['id'];?>" class="btn btn-danger btn-sm delete" title="Borrar">
								B
							</button>
						</div>

					</td>
				<?php } ?>								


			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php if( $opcion == "0") { ?>
	<?php include_once('layouts/js.php'); ?>
	<script type="text/javascript" src="reparacion.js"></script>
<?php } ?>
