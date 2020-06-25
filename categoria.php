<?php
@session_start() ;
$_SESSION['categoria'] = $_GET['p'];
require_once('includes/load.php');
require_once('categoria_modelo.php');

$_title	= "";
switch ($_SESSION['categoria']) {
    case 1:
		$_title = 'Categorias';
	   break;
    case 2:
		$_title = 'Medida';
	   break;
    case 3:
		$_title = 'Estados';
	   break;
    case 4:
		$_title = 'Profesores';
	break;
 case 5:
   $_title = 'Ubicacion';
   break;
 case 6:
	$_title = 'Ubicacion';
	break;
 case 7:
	$_title = 'Ubicacion';
	break;
}

  $page_title = 'Lista de '.$_title;

  // Checkin What level user has permission to view this page
  page_require_level(1);
$all_registros = CategoriaListar( $_SESSION["categoria"] );;
?>
<?php include_once('layouts/header.php'); ?>

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<strong>
							<span class="glyphicon glyphicon-th"></span>
							<span><?php echo $_title; ?></span>
							<div align="right">
								<button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-sm">Agregar</button>
							</div>
						</strong>
					</div>
					<table class="table table-bordered table-striped table-hover" id="myTable">
						<thead>
							<tr>
								<th class="text-center" style="width: 1%;">#</th>
								<th class="text-left"   style="width: 50%;">Descripcion</th>
								<th class="text-center" style="width: 1%;">Acciones</th>
							</tr>
						</thead>
						<tbody id="detalle-producto1">
							<?php foreach ($all_registros as $registro):?>
								<tr>
									<td class="text-center"><?php echo $registro['id'];?></td>
									<td><?php echo remove_junk(ucfirst($registro['name'])); ?></td>
									<td class="text-center">
										<div class="btn-group">
											<button type="button" name="update" id="<?php echo (int)$registro['id'];?>" class="btn btn-warning btn-sm update">
												<span class="glyphicon glyphicon-edit"></span>
											</button>
											<button type="button" name="delete" id="<?php echo (int)$registro['id'];?>" class="btn btn-danger btn-sm delete">
												<span class="glyphicon glyphicon-trash"></span>
											</button>
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
</div>

<?php include_once('categoria_modal.php'); ?>
<?php include_once('layouts/js.php'); ?>
<script src="js/categoria.js"></script>
</body>
</html>