<div id="userModal" class="modal fade" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg">
		<form method="post" id="user_form" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add User</h4>
				</div>
				<div class="modal-body">

					<div class="form-group">
						<div class="row">
							<div class="col-md-4">
								<div>Seleccione Profesor :
									<select class="form-control" name="cbx_profesor" id="cbx_profesor"></select>

								</div>
							</div>
						</div>
						<br>

						<div class="row">
							<div class="col-md-4">
								<div>Seleccione Herramienta :
									<select class="form-control cbx_herramienta" name="cbx_herramienta" id="cbx_herramienta"></select>

								</div>
							</div>
							<div class="col-md-2">
								<div>Cantidad :
									<input id="txt_cantidad" name="txt_cantidad" type="text" class="col-md-2 form-control txt_cantidad " placeholder="Cantidad" autocomplete="off" />
								</div>
							</div>
							<div class="col-md-2">
								<div style="margin-top: 19px;">
									<button type="button" class="btn btn-info btn-agregar-producto" id= "btn-agregar-producto" name ="btn-agregar-producto">Agregar</button>
								</div>
							</div>
						</div>
						<br>
						<div class="panel panel-info">
							<div class="panel-body" >
								<table class="table table-bordered table-striped table-hover" id="myTable">
									<thead>
									    <tr>
										   <th style="width: 50%;"> Herramienta </th>
										   <th style="width: 5%;"> Prestadas </th>
										   <th style="width: 5%;"> Pendientes </th>
										   <th class="text-center" style="width: 10%;"> Acciones </th>
									    </tr>
									</thead>
									<tbody id="detalle-producto2" name="detalle-producto2" >

									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="user_id" id="user_id" />
					<input type="hidden" name="idpedido" id="idpedido" />					
					<input type="hidden" name="operation" id="operation" />
					<input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>
