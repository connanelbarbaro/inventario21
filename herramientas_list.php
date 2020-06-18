<?php 
require_once('herramientas_modelo.php');

page_require_level(1);
$all_herramientas = HerramientasListar();
?>

<table class="table table-bordered table-striped table-hover" id="myTable">
	<thead>
		<tr>
<!--			
			<th class="text-center" style="width: 1%;">#</th>
-->			
			<th class="text-left" style="width: 15%;"> Descripcion </th>
			<th class="text-center" style="width: 1%;"> Categoria </th>
			<th class="text-center" style="width: 1%;"> Ubicacion__1 </th>
			<th class="text-center" style="width: 1%;"> Ubicacion__2 </th>
			<th class="text-center" style="width: 1%;"> Ubicacion__3 </th>
			<th class="text-center" style="width: 1%;"> Stock </th>
			<th class="text-center" style="width: 5%;"> Acciones </th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($all_herramientas as $herramienta):?>
			<tr>
<!--			
				<td class="text-center"><?php echo $herramienta['id'];?></td>
-->				
				<td> <?php echo $herramienta['name']; ?></td>
				<td class="text-center"> <?php echo $herramienta['categoria']; ?></td>
				<td class="text-center"> <?php echo $herramienta['ubicacion_1']; ?> </td>
				<td class="text-center"> <?php echo $herramienta['ubicacion_2']; ?> </td>
				<td class="text-center"> <?php echo $herramienta['ubicacion_3']; ?> </td>
				<td class="text-center"> <?php echo $herramienta['cantidad']; ?></td>
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

			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php include_once('layouts/js.php'); ?>
<script type="text/javascript" src="herramientas.js"></script>
