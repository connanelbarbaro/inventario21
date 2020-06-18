<?php
  $page_title = 'Editar producto';
  require_once('includes/load.php');
  require_once('categorie_sql.php');
  require_once('product_sql.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
?>
<?php
$idherramienta = (int)$_GET['idherramienta'];


if( $idherramienta == 0)
{
    $boton = '<button type="submit" name="btn-agregar-producto" class="btn btn-danger">Agregar</button>' ;
    $_title ="Agregar Herramienta ";

} else {
  $boton = '<button type="submit" name="btn-actualizar-producto" class="btn btn-danger">Actualizar</button>' ;
  $_title ="Editar Herramienta ";

}

if( ( isset($_POST['btn-agregar-producto']) and $idherramienta == 0 ) or  ( isset($_POST['btn-actualizar-producto']) and $idherramienta > 0 )) {
     $herramienta = remove_junk($db->escape($_POST['product-title']));
     $categoria = (int)$_POST['product-categoria'];
     $ubicacion1 = (int)$_POST['product-ubicacion1'];
     $ubicacion2 = (int)$_POST['product-ubicacion2'];
     $ubicacion3 = (int)$_POST['product-ubicacion3'];
     
     $cantidad = remove_junk($db->escape($_POST['product-cantidad']));
     $fecha =date("d/m/y") ;
     if( isset($_POST['btn-agregar-producto']) ) {
          if ( product_actualizar($idherramienta, $herramienta, $cantidad, $categoria, $fecha, $ubicacion1, $ubicacion2, $ubicacion3) ){
               $idherramienta = ultimo_id( "heramientas");
               $boton = '<button type="submit" name="btn-actualizar-producto" class="btn btn-danger">Actualizar</button>' ;     
               $session->msg("s","Herramienta Agregada");
               $product = find_by_id('herramientas',$idherramienta );
               redirect('product.php');
          } else {
               $idherramienta = 0 ;  
               $session->msg("s","Error, al grabar");             
          }
     } else {
          if ( product_actualizar($idherramienta, $herramienta, $cantidad, $categoria, $fecha, $ubicacion1, $ubicacion2, $ubicacion3) ){
               $product = find_by_id('herramientas',$idherramienta );
               $session->msg("s","Herramienta Actualizada");
               redirect('product.php');
          } else {
               $session->msg("s","Error, al grabar");             
          }
     }
}
$all_categoria = filter_categories ( _CATEGORIA);
$all_ubicacion1 = filter_categories ( _UBICACION1);
$all_ubicacion2 = filter_categories ( _UBICACION2);
$all_ubicacion3 = filter_categories ( _UBICACION3);
$boton1 = '<button type="submit" name="btn-volver-producto" class="btn btn-danger">Volver</button>' ;
$product = find_by_id('herramientas',$idherramienta );   

?>

<?php include_once('layouts/header.php'); ?>
<div class="row">
     <div class="col-md-12">
          <?php echo display_msg($msg); ?>
     </div>
</div>
<div class="row">
     <div class="panel panel-default">
          <div class="panel-heading">
               <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span><?php echo $_title ; ?></span>
               </strong>
          </div>
          <div class="panel-body">
               <div class="col-md-10">
                    <form method="post" action="product_edit.php?idherramienta=<?php echo $idherramienta ?>">
                         <input type="hidden" id="idherramienta" name="idherramienta" value="<?php echo $idherramienta ; ?>">
                         <div class="form-group">
                              <div class="input-group">
                                   <label for="product-title" class="control-label">Herramienta</label>
                                   <input type="text" class="form-control" name="product-title"
                                        value="<?php echo $product['name'];?>">
                              </div>
                         </div>
                         <div class="form-group">
                              <div class="input-group">
                                   <label for="product-categorie" class="control-label">Categoria</label>
                                   <select class="form-control" name="product-categoria">
                                        <option value="">Selecciona una categoría</option>
                                        <?php  foreach ($all_categoria as $cat): ?>
                                        <option value="<?php echo (int)$cat['id']; ?>"
                                             <?php if($product['idcategoria'] === $cat['id']): echo "selected"; endif; ?>>
                                             <?php echo remove_junk($cat['name']); ?></option>
                                        <?php endforeach; ?>
                                   </select>
                              </div>
                         </div>
                         <div class="form-group">
                              <div class="row">
                                   <div class="col-md-4">
                                        <label for="product-ubicacion1" class="control-label">Ubicacion 1</label>
                                        <select class="form-control" name="product-ubicacion1">
                                             <option value="">Selecciona una Ubicacion</option>
                                             <?php  foreach ($all_ubicacion1 as $cat): ?>
                                             <option value="<?php echo (int)$cat['id']; ?>"
                                                  <?php if($product['idubicacion1'] === $cat['id']): echo "selected"; endif; ?>>
                                                  <?php echo remove_junk($cat['name']); ?></option>
                                             <?php endforeach; ?>
                                        </select>
                                   </div>
                                   <div class="col-md-4">
                                        <label for="product-ubicacion2" class="control-label">Ubicacion 2</label>
                                        <select class="form-control" name="product-ubicacion2">
                                             <option value="">Selecciona una Ubicacion</option>
                                             <?php  foreach ($all_ubicacion2 as $cat): ?>
                                             <option value="<?php echo (int)$cat['id']; ?>"
                                                  <?php if($product['idubicacion2'] === $cat['id']): echo "selected"; endif; ?>>
                                                  <?php echo remove_junk($cat['name']); ?></option>
                                             <?php endforeach; ?>
                                        </select>
                                   </div>
                                   <div class="col-md-4">
                                        <label for="product-ubicacion3" class="control-label">Ubicacion 3</label>
                                        <select class="form-control" name="product-ubicacion3">
                                             <option value="">Selecciona una Ubicacion</option>
                                             <?php  foreach ($all_ubicacion3 as $cat): ?>
                                             <option value="<?php echo (int)$cat['id']; ?>"
                                                  <?php if($product['idubicacion3'] === $cat['id']): echo "selected"; endif; ?>>
                                                  <?php echo remove_junk($cat['name']); ?></option>
                                             <?php endforeach; ?>
                                        </select>
                                   </div>
                              </div>
                         </div>

                         <div class="form-group">
                              <div class="row">
                                   <div class="col-md-4">
                                        <div class="form-group">
                                             <label for="qty">Cantidad</label>
                                             <div class="input-group">
                                                  <span class="input-group-addon">
                                                       <i class="glyphicon glyphicon-shopping-cart"></i>
                                                  </span>
                                                  <input type="number" class="form-control" name="product-cantidad"
                                                       value="<?php echo remove_junk($product['cantidad']); ?>">
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
					<div class="btn-group">                                        
                         	<?php echo $boton ; ?>
               		</div>
					<div class="btn-group">                                        
						<a href="product.php" class="btn btn-success btn-xl"  title="Volver" data-toggle="tooltip"> Volver </a>
					</div>                                                                   
                    </form>
               </div>
          </div>
     </div>
</div>

<?php include_once('layouts/footer.php'); ?>