<?php 
require_once('prestamo_modelo.php');
page_require_level(1);
$all_prestamos = PrestamoListar();
?>

<table class="table table-bordered table-striped table-hover" id="myTable">
	<thead>
	    <tr>
		   <th style="width: 50%;"> Profesor </th>
		   <th style="width: 5%;"> Prestadas </th>
		   <th style="width: 5%;"> Pendientes </th>                            
		   <th class="text-center" style="width: 10%;"> Acciones </th>
	    </tr>
	</thead>
	<tbody>
		<?php foreach ($all_prestamos as $prestamo):?>
			<tr>
				<td class="text-left"> <?php echo remove_junk($prestamo['profesor']); ?></td>
				<td class="text-right"> <?php echo remove_junk($prestamo['totalprestadas']); ?></td>
				<td class="text-right"> <?php echo remove_junk($prestamo['totalpendientes']); ?></td>
				<td class="text-center">
					<div class="btn-group">
						<button type="button" name="update" id="<?php echo (int)$prestamo['id'];?>" class="btn btn-info btn-sm update" title="Editar">
							E
						</button>
					</div>
					<div class="btn-group">					
						<button type="button" name="reparacion" id="<?php echo (int)$prestamo['id'];?>" class="btn btn-warning btn-sm reparacion" title="Reparacion">
							R
						</button>
					</div>					
					<div class="btn-group">					
						<button type="button" name="delete" id="<?php echo (int)$prestamo['id'];?>" class="btn btn-danger btn-sm delete" title="Borrar">
							B
						</button>
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php include_once('layouts/js.php'); ?>
<script type="text/javascript" src="prestamo.js"></script>
