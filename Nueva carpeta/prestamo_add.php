<?php
$page_title = 'Prestamo';
require_once('includes/load.php');
require_once('categorie_sql.php');
  require_once('product_sql.php');
  
$resultado_producto = filter_product();
$resultado_profesor = filter_categories ('categorias', _PROFESOR);

if (isset($_POST["prestamo-profesor"]) ) {
	$profesor =$_POST["prestamo-profesor"] ;
} else {
	$profesor ="" ;
}
if (isset($_POST["prestamo-fecha"]) ) {
	$fecha =$_POST["prestamo-fecha"] ;
} else {
	$fecha =make_date() ;
}

/* ACCIONES  ------------------------------------------------------------------------------------------------------------
*/
/* GUARDAR HERRAMIENTA  -------------------------------------------------------------------------------------------------
*/
if (isset($_POST["btn-agregar-producto"]) ) {
	$producto_id =$_POST["cbo_producto"] ;
	$cantidad =$_POST["txt_cantidad"] ;
	$query = "INSERT INTO detalle (";
	$query .= " idherramienta, idestado, cantidad ";
	$query .= ") VALUES (";
	$query .= " '{$producto_id}', 'B', '{$cantidad}'";
	$query .= ")";
	$db->query($query);

}
/* BORRAR HERRAMIENTA -------------------------------------------------------------------------------------------------
*/
if (isset($_GET['id'])) {
	delete_by_id("detalle",$_GET['id'] ) ;
}

/* GUARDAR PEDIDO */
if (isset($_POST["btn-guardar-producto"]) ) {

	if ( $profesor == "" ) {
		$session->msg("w", ' Error, Debe Seleccionar un Profesor');
	} else {
		if ( $fecha == "" ) {
			$session->msg("w", ' Error, Debe Seleccionar una fecha');
		} else {
			$idpedido = 0 ;
			$rs = $db->query("SELECT MAX(idpedido) AS id FROM detalle");
			if ($row = mysqli_fetch_row($rs)) {
				$idpedido = (int)trim($row[0]);
			}
			$idpedido = $idpedido + 1 ;

			$query   = "UPDATE detalle SET";
			$query  .=" idpedido ='{$idpedido}',";
			$query  .=" idprofesor ='{$profesor}',";
			$query  .=" fecha ='{$fecha}',";
			$query  .=" idestado ='P' ";
			$query  .=" WHERE idestado ='B' ";

			if ($db->query($query)) {
				$session->msg("d", 'Aviso, Pedido Guardado');
				redirect('prestamo.php');
			} else {
				$session->msg("d", 'Error, Al guardar Pedido');
			}

		}
	}
}

/* CANCELAR PEDIDO */
if (isset($_POST["btn-cancelar-producto"]) ) {
	$query = "DELETE FROM detalle WHERE idestado = 'B'" ;
	if ($db->query($query)) {
		$session->msg("s", "Cancelacion exitosamente. ");

	} else {
		$session->msg("d", ' Lo siento, registro falló.');
	}

}
/* VOLVER */

if (isset($_POST["btn-volver-producto"]) ) {
	redirect('prestamo.php');
}



/* consulta de herramientas prestados estado borrador */
    $herramientas = filter_detalle_estado("B", "");


?>


<?php include_once('layouts/header.php'); ?>


<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Prestamo de Herramientas</span>
        </strong>
      </div>
      <div class="panel-body">
        <div class="col-md-12">
		<form method="post" action="prestamo_add.php" class="clearfix">

            <div class="form-group">
              <div class="row">
                <div class="col-md-4">
                  <div class="input-group">
                    <select class="form-control" name="prestamo-profesor">
                      <option value="">Seleccione un Profesor</option>
                      <?php  foreach ($resultado_profesor as $cat): ?>
                        <option value="<?php echo (int)$cat['id']; ?>" <?php if( (int)$profesor === (int) $cat['id']): echo "selected"; endif; ?> >
                        <?php echo $cat['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="input-group">
                  <input type="date" class="form-control datepicker" name="prestamo-fecha" data-date-format="dd/mm/aa" value="<?php echo $fecha;?>">
                  </div>
                </div>


				<div class="row">
			<div class="col-md-4">
				<div>Producto:
				<select class="combobox input-large form-control" name="cbo_producto" id="cbo_producto" placeholder="Seleccione Herramienta" >
					<option value="0">Seleccione un producto</option>
					<?php foreach($resultado_producto as $producto):?>
						<option value="<?php echo $producto['id']?>"><?php echo $producto['name']?></option>
					<?php endforeach;?>
				</select>
				</div>
			</div>
			<div class="col-md-2">
				<div>Cantidad:
				  <input id="txt_cantidad" name="txt_cantidad" type="text" class="col-md-2 form-control" placeholder="Ingrese cantidad" autocomplete="off" />
				</div>
			</div>
			<div class="col-md-2">
				<div style="margin-top: 19px;">
					<button type="submit" class="btn btn-success" name ="btn-agregar-producto">Agregar</button>
				</div>

			</div>
		</div>
		<br>
		<div class="panel panel-info">
			 <div class="panel-heading">
		        <h3 class="panel-title">

		        Productos</h3>
		      </div>
			<div class="panel-body" >
				<div id="detalle-producto">
<?php /* herramientas prestadas */; ?>
          <table class="table table-bordered table-striped table-hover" id="tabla1">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th>Descripcion</th>
                    <th class="text-center" style="width: 50px;">Cantidad</th>
                    <th class="text-center" style="width: 100px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($herramientas as $cat):?>
                <tr>
                    <td class="text-center"><?php echo count_id();?></td>
                    <td><?php echo remove_junk(ucfirst($cat['herramienta'])); ?></td>
                    <td><?php echo $cat['cantidad']; ?></td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="prestamo_add.php?id=<?php echo (int)$cat['id'];?>"  class="btn btn-xs btn-danger" name ="btn-borrar-producto" data-toggle="tooltip" title="Eliminar">
                          <span class="glyphicon glyphicon-trash"></span>
                        </a>
                      </div>
                    </td>

                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
<?php /* herramientas prestadas */; ?>












				</div>
			</div>
		</div>
 	</div>
                </div>
              </div>
              <div class="form-group clearfix">
        				<button type="submit" class="btn btn-success" name ="btn-guardar-producto">Guardar</button>
        				<button type="submit" class="btn btn-success" name ="btn-cancelar-producto">Limpiar</button>
        				<button type="submit" class="btn btn-success" name ="btn-volver-producto">Volver</button>
              </div>
          </form>

      </div>
    </div>
  </div>
</div>
</div>
    </div>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
  <script type="text/javascript" src="js/functions.js"></script>

  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/sidebar.js"></script>
  <script type="text/javascript" src="js/chosen.jquery.min.js"></script>
  <script type="text/javascript" src="js/bootstrap-combobox.js"></script>
	<script>
		$(document).ready(function(){
		  $('.cbo_producto').combobox({bsVersion: '2'})
          });

</script>

  </body>
</html>

<?php if(isset($db)) { $db->db_disconnect(); } ?>

