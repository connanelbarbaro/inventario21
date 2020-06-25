$(document).ready(function(){
	
// LISTAR OPCION = 1
	var opcion = 1 ;	
	var dataTable = $('#myTable').DataTable({
		"scrollX": true, 
		"responsive": true,
		"language": { "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json" },
		"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
		"dom": "<'row'<'col-sm-6'l><'col-sm-6'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'B><'col-sm-7'p>>",
		"pagingType": "full_numbers",
		"buttons": [ 'copy', 'csv', 'excel', 'pdf', 'print' ],
	    "ajax":{            
		   "url": "herramientas_controler.php", 
		   "method": 'POST', //usamos el metodo POST
		   "data":{ opcion:opcion }, //enviamos opcion 4 para que haga un SELECT
		   "dataSrc":""
	    },
	    "columns":[
		   {"data": "id"},
		   {"data": "name"},
		   {"data": "categoria"},
		   {"data": "ubicacion_1"},
		   {"data": "ubicacion_2"},
		   {"data": "ubicacion_3"},
		   {"data": "cantidad"},
		   {"defaultContent": '<div class="btn-group"><button type="button" class="btn btn-info btn-xs btn_view" style="margin-right:16px;"><span class="glyphicon glyphicon glyphicon-eye-close glyphicon-info-sign" aria-hidden="true"></span></button><button type="button" class="btn btn-primary btn-xs btn_edit" style="margin-right:16px;"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button><button type="button" class="btn btn-danger btn-xs btn_del"><span class="glyphicon glyphicon-remove glyphicon-trash" aria-hidden="true"></span></button></div>'}
	    ]
	
	});
	new $.fn.dataTable.FixedHeader( DataTable );

// AGREGAR OPCION = 3
	$('#add_button').click(function(){
		$('#div_problema').html('<input type="hidden" name="problema" id="problema" />');
		$('#user_form')[0].reset();
		$('.modal-title').text("Agregar Herramienta");
		$('#action').val("Agregar");
		$('#operation').val(3);
	});


// EDITAR OPCION = 5
	$(document).on('click', '.btn_edit', function(){
		var fila = $(this).closest("tr");	        
		var id = parseInt(fila.find('td:eq(0)').text()); //capturo el ID
		var opcion = 2 ; // BUSCAR X ID		
	    $('#div_problema').html('<input type="hidden" name="problema" id="problema" />');
		$.ajax({
			url:"herramientas_controler.php",
			method:"POST",
			data:{ id:id , opcion:opcion },
			dataType:"json",
			success:function(data)
			{
				$('#id').val(id);
				$('#name').val(data.name);
				$('#idcategoria').val(data.idcategoria);
				$('#idubicacion1').val(data.idubicacion1);
				$('#idubicacion2').val(data.idubicacion2);
				$('#idubicacion3').val(data.idubicacion3);
				$('#cantidad').val(data.cantidad);
				$('#userModal').modal('show');
				$('.modal-title').text("Editar");
				$('#action').val("Actualizar");
				$('#operation').val( 5 );
			}
		})
	});

// BORRAR - OPCION 4
	$(document).on('click', '.btn_del', function(){
		var fila = $(this).closest("tr");	        
		var id = parseInt(fila.find('td:eq(0)').text()); //capturo el ID
		var opcion = 2 ; // BUSCAR X ID		
	     $('#div_problema').html('<input type="hidden" name="problema" id="problema" />');
		$.ajax({
			url:"herramientas_controler.php",
			method:"POST",
			data:{ id:id , opcion:opcion },
			dataType:"json",
			success:function(data)
			{
				$('#id').val(id);
				$('#name').val(data.name);
				$('#idcategoria').val(data.idcategoria);
				$('#idubicacion1').val(data.idubicacion1);
				$('#idubicacion2').val(data.idubicacion2);
				$('#idubicacion3').val(data.idubicacion3);
				$('#cantidad').val(data.cantidad);
				$('#userModal').modal('show');
				$('.modal-title').text("Borrar");
				$('#action').val("Confirmar");
				$('#operation').val( 4 );
			}
		})
	});








// GRABAR - TOMA LA OPCION DE LA VARIABLE OPERATION
	$(document).on('submit', '#user_form', function(event){
		event.preventDefault();
		var id = $('#id').val();
		var name = $('#name').val();
		var idcategoria = $('#idcategoria').val();
		var idubicacion1 = $('#idubicacion1').val();
		var idubicacion2 = $('#idubicacion2').val();
		var idubicacion3 = $('#idubicacion3').val();
		var cantidad = $('#cantidad').val();
		var opcion = $('#operation').val();
			$.ajax({
				url:"herramientas_controler.php",
				method:'POST',
				data:new FormData(this),
				contentType:false,
				processData:false,
				success:function(data)
				{
					alertify.success(opcion);
					$('#user_form')[0].reset();
					$('#userModal').modal('hide');
					alertify.success(data.msj);

				}
			});

	});
	

// REPARACION - OPCION 6	
	$(document).on('click', '.btn_view', function(){
		var div = '<div class="form-group">' ;
		var div = div + '<label for="problema">Problema</label>';
		var div = div + '<div class="input-group">';
		var div = div + '<input type="text" class="form-control" name="rproblema" id="rproblema" >';
		var div = div + '</div>';
		var div = div + '</div>';
		$('#div_problema').html(div) ;
	    $('#div_problema').html('<input type="hidden" name="problema" id="problema" />');
		var fila = $(this).closest("tr");	        
		var id = parseInt(fila.find('td:eq(0)').text()); //capturo el ID
		var opcion = 2 ; // BUSCAR X ID		
		$.ajax({
			url:"herramientas_controler.php",
			method:"POST",
			data:{ id:id , opcion:opcion },
			dataType:"json",
			success:function(data)
			{
				$('#id').val(id);
				$('#name').val(data.name);
				$('#idcategoria').val(data.idcategoria);
				$('#idubicacion1').val(data.idubicacion1);
				$('#idubicacion2').val(data.idubicacion2);
				$('#idubicacion3').val(data.idubicacion3);
		
				$('#userModal').modal('show');
				$('.modal-title').text("Reparacion");
				$('#action').val("Actualizar");
				$('#operation').val("6");
           
			}
		})
	});
	
	
	

} );