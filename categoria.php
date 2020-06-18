<?php
@session_start() ;
$_SESSION['categoria'] = $_GET['p'];
  require_once('includes/load.php');
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
?>
<?php include_once('layouts/header.php'); ?>

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<strong>
							<span class="glyphicon glyphicon-th"></span>
							<span><?php echo 'Lista de '.$_title; ?></span>
							<div align="right">
					<button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-sm">Agregar</button>
							</div>
						</strong>
					</div>
					<div class="panel-body detalle-producto">
					<?php include_once('categoria_list.php'); ?>					

					</div>
				</div>
			</div>
		</div>
	
	</div>
</div>

<?php include_once('categoria_modal.php'); ?>


  </body>

</html>