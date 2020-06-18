<?php

$page_title = 'Prestamo / Devolucion';
require_once('includes/load.php');
require_once('categorie_sql.php');
require_once('prestamo_sql.php');
require_once('product_sql.php');

$sql  =" SELECT p.id, p.name, p.cantidad - (SELECT ifnull(SUM( d.pendientes),0)  from detalle d where ( d.idestado = 'P' or d.idestado = 'B' ) and  d.idherramienta = p.id ) as disponible ";
$sql  .=" FROM herramientas p";
$resultado_producto = find_by_sql($sql);
$idprofesor = 0 ;

$resultado_producto = filter_product ();
$resultado_profesor = filter_categories (_PROFESOR );


if (!isset($_SESSION['idpedido'])) {
    $_SESSION['idpedido'] = (int)$_GET['idpedido'] ;
}

if( $_SESSION['idpedido'] != 0 ) {
   $resultado = find_profesor_detalle( $_SESSION['idpedido'] );
   $idprofesor =$resultado[0] ;
   $profesor =$resultado[1] ;
   $fecha = $resultado[2];
}

if( $_SESSION['idpedido'] == 0 ) {
    if (isset($_POST["prestamo-profesor"]) )
        $idprofesor =(int)$_POST["prestamo-profesor"] ;
}

/* ------------------------------------------ ACCIONES ----------------------------------------------------- */
/* VOLVER -------------------------------------------------------------------------------------------------- */
if ( isset( $_POST["btn-volver-producto"] ) ) {
     redirect('prestamo.php');
}

/* AGREGAR HERRAMIENTA ------------------------------------------------------------------------------------- */
if ( isset( $_POST["btn-agregar-producto"] ) ) {
    $producto_id =$_POST["cbo_producto"] ;
    $cantidad =$_POST["txt_cantidad"] ;
    if ($cantidad > 0 ){
	    if ( $_SESSION['idpedido'] == 0  ) {
			$query = "INSERT INTO detalle (";
			$query .= " idpedido, idherramienta, idestado, prestadas, pendientes ";
			$query .= ") VALUES (";
			$query .= " '0', '{$producto_id}', 'B', '{$cantidad}', '{$cantidad}'";
			$query .= ")";
		} else {
			$query = "INSERT INTO detalle (";
			$query .= " idpedido, idprofesor, fecha, idherramienta, idestado, prestadas, pendientes ";
			$query .= ") VALUES (";
			$query .= " '{$_SESSION['idpedido']}', '{$idprofesor}', '{$fecha}', '{$producto_id}', 'P', '{$cantidad}', '{$cantidad}'";
			$query .= ")";
		}
		$db->query($query);		
    } else {
        $session->msg("w", ' Error, Debe ingresar una cantidad ');
    }
}

/* BORRAR HERRAMIENTA -------------------------------------------------------------------------------------- */
if ( isset( $_POST['btn-borrar-producto'] ) ) {
	delete_by_id("detalle",$_POST['btn-borrar-producto'] ) ;
}

/* EDITAR HERRAMIENTA -------------------------------------------------------------------------------------- */
if ( isset( $_POST['btn-editar-producto'] ) ) {
	$pos = $_POST['btn-editar-producto'] ;
	$Aid = $_POST['id'] ;
	$Acantidad = $_POST['cantidad'] ;
	$query   = "UPDATE detalle SET";
	$query  .=" prestadas = '".$Acantidad[$pos]."' ";
	$query  .=" WHERE id = '".$Aid[$pos]."' ";
	$db->query($query) ;

}

/* GUARDAR PEDIDO ------------------------------------------------------------------------------------------ */
if (isset($_POST["btn-guardar-producto"]) ) {
	if ( $idprofesor == 0 ) {
		$session->msg("w", ' Error, Debe Seleccionar un Profesor');
	} else {
		$fecha =make_date() ;
		$rs = $db->query("SELECT MAX(idpedido) AS id FROM detalle");
		if ($row = mysqli_fetch_row($rs)) {
			$_SESSION['idpedido'] = (int)trim($row[0]);
		}
		$_SESSION['idpedido'] = $_SESSION['idpedido'] + 1 ;
		$query   = "UPDATE detalle SET";
		$query  .=" idpedido ='{$_SESSION['idpedido']}',";
		$query  .=" idprofesor ='{$idprofesor}',";
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

/* CANCELAR PEDIDO ----------------------------------------------------------------------------------------- */
if (isset($_POST["btn-cancelar-producto"]) ) {
	$query = "DELETE FROM detalle WHERE idestado = 'B'" ;
	if ($db->query($query)) {
		$session->msg("s", "Cancelacion exitosA. ");

	} else {
		$session->msg("d", 'Error, al cancelar.');
	}
}


/* consulta de herramientas prestados estado borrador */
$_title = "Prestamo de Herramientas" ;
if( $_SESSION['idpedido']  == 0 )  {
   $_title .= " - Nuevo Pedido " ;

} else {
   $_title .= " - Editar Pedido :".$profesor ;

}



$herramientas = LISTAR_DETALLE( $_SESSION['idpedido'] );

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
                         <span><?php echo $_title ; ?></span>
                    </strong>
               </div>
               <div class="panel-body">
                    <div class="col-md-12">
                         <form method="post" action="prestamo_edit.php" class="clearfix">
                              
                              <div class="form-group">
                                   <?php if( $_SESSION['idpedido'] === 0 ): ?>
                                   <div class="row">
                                        <div class="col-md-6">
                                             <div class="input-group">
                                                  <span class="input-group-addon">
                                                       <i class="glyphicon glyphicon-user"></i>
                                                  </span>
                                                  <select class="form-control" name="prestamo-profesor"
                                                       <?php if( $idpedido != 0 ): echo "disabled"; endif; ?>>
                                                       <option value="">Seleccione un Profesor</option>
                                                       <?php  foreach ($resultado_profesor as $cat): ?>
                                                       <option value="<?php echo (int)$cat['id']; ?>"
                                                            <?php if( $idprofesor === (int)$cat['id']): echo "selected"; endif; ?>>
                                                            <?php echo $cat['name'] ?>
                                                       </option>
                                                       <?php endforeach; ?>
                                                  </select>
                                             </div>
                                        </div>


                                   </div>
                                   <?php endif; ?>
                                   <div class="row">
                                        <div class="col-md-6">
                                             <div>Producto:
                                                  <select class="combobox input-large form-control" name="cbo_producto" 
                                                       id="cbo_producto" placeholder="Seleccione Herramienta" onchange="cbo_disponible.selectedIndex=this.selectedIndex; return true;">>
                                                       <option value="0">Seleccione un producto</option>
                                                       <?php foreach($resultado_producto as $producto):?>
                                                       <option value="<?php echo $producto['id']?>">
                                                            <?php echo $producto['name']?>
                                                       </option>
                                                       <?php endforeach;?>
                                                  </select>
                                             </div>
                                        </div>                                             
                                        <div class="col-md-2">
                                             <div>Disponibles:
                                                  <select class="combobox input-large form-control" name="cbo_disponible" disabled
                                                       id="cbo_producto" placeholder="Disponible">
                                                       <option value="0"></option>
                                                       <?php foreach($resultado_producto as $producto):?>
                                                       <option value="<?php echo $producto['id']?>">
                                                            <?php echo $producto['disponible']?>
                                                       </option>                                                       
                                                       <?php endforeach;?>
                                                  </select>
                                             </div>                                             
                                        </div>
                                        <div class="col-md-2">
                                             <div>Cantidad:
                                                  <input id="txt_cantidad" name="txt_cantidad" type="text"
                                                       class="col-md-2 form-control" placeholder="Ingrese cantidad"
                                                       autocomplete="off" />
                                             </div>
                                        </div>
                                        <div class="col-md-2">
                                             <div style="margin-top: 19px;">
                                                  <button type='submit' class="btn btn-success"
                                                       name="btn-agregar-producto">Agregar</button>
                                             </div>

                                        </div>

                                   </div>

                                   <div class="panel-body">
                                        <div id="detalle-producto">

                                             <table class="table table-bordered table-striped table-hover" id="tabla1">
                                                  <thead>
                                                       <tr>
                                                            <th class="text-center" style="width: 50px;">#</th>
                                                            <th>Descripcion</th>
                                                            <th class="text-center" style="width: 50px;">Prestadas</th>
                                                            <th class="text-center" style="width: 100px;">Acciones</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       <?php foreach ($herramientas as $cat):?>
                                                       <tr>
                                                       <?php $posicion = count_id(); ?>                                                
												<input name="id[]" type="hidden" value="<?php echo $cat['id']; ?>">                                                       
                                                            <td class="text-center"><?php echo $posicion;?></td>
                                                            <td><?php echo remove_junk(ucfirst($cat['herramienta'])); ?>
                                                            </td>
                                                            <td class="text-right">
													<?php if( $cat['pendientes'] > 0){  ?>                                                            
														<input type = "number" name="cantidad[]" value="<?php echo $cat['prestadas']; ?>">
													<?php } else {
														echo $cat['prestadas'] ;
														}
													?>
                                                            <td class="text-center">
     <!--
													<?php if( $cat['pendientes'] > 0){  ?>                                                            
                                                                 <div class="btn-group">
														<button type='submit' class="btn btn-success btn-xs" name="btn-editar-producto" value ="<?php echo $posicion-1;?>" ><span class="glyphicon glyphicon-edit"></span></button>
													</div>
													<?php } ?>                                                            
                                                        -->

                                                                 <div class="btn-group">
                                                            
														<button type='submit' class="btn btn-danger btn-xs" name="btn-borrar-producto" value ="<?php echo (int)$cat['id'];?>" ><span class="glyphicon glyphicon-trash"></span></button>
         
													</div>
                                                                 
                                                                 </div>
                                                            </td>

                                                       </tr>
                                                       <?php endforeach; ?>
                                                  </tbody>
                                             </table>

                                        </div>
                                   </div>
                              </div>
                              <div class="form-group clearfix">
                                   <?php
							if( $_SESSION['idpedido']  == 0 )  {
								echo "<button type='submit' class='btn btn-success' name ='btn-guardar-producto'>Guardar</button>" ;
								echo "<button type='submit' class='btn btn-success' name ='btn-cancelar-producto'>Limpiar</button>" ;
							}
							echo "<button type='submit' class='btn btn-info' name ='btn-volver-producto'>Volver</button>" ;
						?>



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
$(document).ready(function() {
     $('.cbo_producto').combobox({
          bsVersion: '2'
     })
});
</script>

</body>

</html>

<?php if(isset($db)) { $db->db_disconnect(); } ?>