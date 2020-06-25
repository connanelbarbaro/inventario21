<?php 
require_once('categoria_modelo.php');

page_require_level(1);
$all_categories = CategoriaListar( $_SESSION["categoria"] );

?>

<table class="table table-bordered table-striped table-hover" id="myTable">
	<thead>
		<tr>
			<th class="text-center" style="width: 50px;">#</th>
			<th>Descripcion</th>
			<th class="text-center" style="width: 100px;">Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($all_categories as $cat):?>
			<tr>
				<td class="text-center"><?php echo $cat['id'];?></td>
				<td><?php echo remove_junk(ucfirst($cat['name'])); ?></td>
				<td class="text-center">
					<div class="btn-group">
						<button type="button" name="update" id="<?php echo (int)$cat['id'];?>" class="btn btn-warning btn-sm update">
							<span class="glyphicon glyphicon-edit"></span>
						</button>
						<button type="button" name="delete" id="<?php echo (int)$cat['id'];?>" class="btn btn-danger btn-sm delete">
							<span class="glyphicon glyphicon-trash"></span>
						</button>
					</div>
				</td>

			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php include_once('layouts/js.php'); ?>
<script type="text/javascript" src="categoria.js"></script>



