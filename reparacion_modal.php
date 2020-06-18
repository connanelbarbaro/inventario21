
<?php
require_once('categoria_modelo.php');
$all_categoria = CategoriaListar( 1 );
$all_ubicacion1 = CategoriaListar( 5 );
$all_ubicacion2 = CategoriaListar( 6 );
$all_ubicacion3 = CategoriaListar( 7 );

?>


<div id="ReparacionModal" class="modal fade" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<form method="post" id="Reparacion_form" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add User</h4>
				</div>
				<div class="modal-body">
				
                         <div class="form-group">
                              <div class="input-group">
                                   <label for="product-title" class="control-label">Herramienta</label>
                                   <input type="text" class="form-control" name="rname" id="rname" disabled >
                              </div>
                         </div>
                         <div class="form-group">
                              <div class="input-group">
                                   <label for="product-categorie" class="control-label">Categoria</label>
                                   <select class="form-control" name="ridcategoria" id="ridcategoria" disabled >
                                        <?php  foreach ($all_categoria as $cat): ?>
                                        <option value="<?php echo (int)$cat['id']; ?>" >
                                             <?php echo remove_junk($cat['name']); ?></option>
                                        <?php endforeach; ?>
                                   </select>
                              </div>
                         </div>
                         <div class="form-group">
                              <div class="row">
                                   <div class="col-md-4">
                                        <label for="product-ubicacion1" class="control-label">Ubicacion 1</label>
                                        <select class="form-control" name="ridubicacion1" id="ridubicacion1" disabled >
									<?php  foreach ($all_ubicacion1 as $cat): ?>
									<option value="<?php echo (int)$cat['id']; ?>" >
										<?php echo remove_junk($cat['name']); ?></option>
									<?php endforeach; ?>
                                        </select>
                                   </div>
                                   <div class="col-md-4">
                                        <label for="product-ubicacion2" class="control-label">Ubicacion 2</label>
                                        <select class="form-control" name="ridubicacion2" id="ridubicacion2" disabled >
									<?php  foreach ($all_ubicacion2 as $cat): ?>
									<option value="<?php echo (int)$cat['id']; ?>" >
										<?php echo remove_junk($cat['name']); ?></option>
									<?php endforeach; ?>
                                        </select>
                                   </div>
                                   <div class="col-md-4">
                                        <label for="product-ubicacion3" class="control-label">Ubicacion 3</label>
                                        <select class="form-control" name="ridubicacion3" id="ridubicacion3" disabled >
									<?php  foreach ($all_ubicacion3 as $cat): ?>
									<option value="<?php echo (int)$cat['id']; ?>" >
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
                                             <label for="qty">Problema</label>
                                             <div class="input-group">
                                                  <input type="text" class="form-control" name="rproblema" id="rproblema" >
                                             </div>
                                        </div>


                                        <div class="form-group">
                                             <label for="qty">Cantidad</label>
                                             <div class="input-group">
                                                  <input type="number" class="form-control" name="rcantidad" id="rcantidad" >
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>				
				
				<div class="modal-footer">
					<input type="hidden" name="rid" id="rid" />
					<input type="hidden" name="roperation" id="roperation" />
					<input type="submit" name="raction" id="raction" class="btn btn-success" value="Add" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>