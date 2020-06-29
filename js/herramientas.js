$(document).ready(function(){
	
// LISTAR OPCION = 1
	var opcion = 1 ;	
	var dataTable = $('#myTable').DataTable({
		"scrollX": true, 
		"autoWidth": true,
		"language": { "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json" },
		"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
		"dom": "<'row'<'col-sm-6'l><'col-sm-6'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'B><'col-sm-7'p>>",
		"pagingType": "simple",
		"buttons": [ 'copy', 'csv', 'excel', 'pdf', 'print' ],
	    "ajax":{            
		   "url": 'herramientas_controler.php', 
		   "method": 'POST', //usamos el metodo POST
		   "data":{ opcion:opcion }, //enviamos opcion 4 para que haga un SELECT
		   "dataSrc":""
	    },
		"order": [[ 0, 'asc' ], [ 1, 'asc' ]],
		columnDefs: [
		    { className: 'text-left', targets: [ 1 ] },
		    { className: 'text-right', targets: [ 3 ] },
		    { className: 'text-center', targets: [ 0, 2] },
		  ], 	    
	    "columns":[
		   {"data": "id"},
		   {"data": "name"},
		   {"data": "cantidad"},
		   {"defaultContent": '<div class="btn-group"><button type="button" class="btn btn-info btn-xs btn_view" style="margin-right:16px;"><span class="glyphicon glyphicon glyphicon-eye-close glyphicon-info-sign" aria-hidden="true"></span></button><button type="button" class="btn btn-primary btn-xs btn_edit" style="margin-right:16px;"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button><button type="button" class="btn btn-danger btn-xs btn_del"><span class="glyphicon glyphicon-remove glyphicon-trash" aria-hidden="true"></span></button></div>'}
	    ]
	
	});


// AGREGAR OPCION = 3
	$('#btn_add').click(function(){
		$("#user_form").trigger("reset");
		$('#div_problema').html('<input type="hidden" name="problema" id="problema" />');	    
		$(".modal-header").css( "background-color", "#17a2b8");
		$(".modal-header").css( "color", "white" );
		$(".modal-title").text("Alta de Herramienta");
		$('#id').val( 0 );
		$('#opcion').val( 3 );	
		$('#cantidad').val( 1 );
		$('#problema').val( "" );		
		$('#userModal').modal('show');	    
	});


// EDITAR OPCION = 5
	$(document).on('click', '.btn_edit', function(){
		var fila = $(this).closest("tr");	        
		var id = parseInt(fila.find('td:eq(0)').text()); //capturo el ID
		var opcion = 2 ; // BUSCAR X ID		
 	     $('#div_problema').html('<input type="hidden" name="problema" id="problema" />');
		$.ajax({
		     url: 'herramientas_controler.php', 
			method:"POST",
			data:{ id:id , opcion:opcion },
			dataType:"json",
			success:function(data)
			{
				$("#user_form").trigger("reset");
				$(".modal-header").css( "background-color", "#17a2b8");
				$(".modal-header").css( "color", "white" );
				$(".modal-title").text("Actualizar Herramienta");
				$('#opcion').val( 5 );
				$('#id').val(id);
				$('#name').val(data.name);				
				$('#idcategoria').val(data.idcategoria);
				$('#idubicacion1').val(data.idubicacion1);
				$('#idubicacion2').val(data.idubicacion2);
				$('#idubicacion3').val(data.idubicacion3);
				$('#cantidad').val(data.cantidad);
				$('#problema').val( "" );		
				$('#userModal').modal('show');	
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
		     url: "herramientas_controler.php", 
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
				$('#opcion').val( 4 );
			}
		})
	});


// GRABAR - TOMA LA OPCION DE LA VARIABLE OPERATION
	$('#user_form').submit(function(e){            		
		event.preventDefault();
		var opcion = $('#opcion').val();
		var id = $('#id').val();
		var name = $('#name').val();
		var idcategoria = $('#idcategoria').val();
		var idubicacion1 = $('#idubicacion1').val();
		var idubicacion2 = $('#idubicacion2').val();
		var idubicacion3 = $('#idubicacion3').val();
		var cantidad = $('#cantidad').val();
		var problema = $('#problema').val();
		$.ajax({
			url: 'herramientas_controler.php',
			type: 'post',
			data: { opcion:opcion, id:id, name:name, idcategoria:idcategoria, idubicacion1:idubicacion1,
				idubicacion2:idubicacion2, idubicacion3:idubicacion3, cantidad:cantidad, problema:problema },
			dataType: 'json',
			success: function(data) {
				if ( data.success ) {				
					alertify.success(data.msj );
				} else {
					alertify.error(data.msj );					
				}
				$('#userModal').modal('hide');	
				dataTable.ajax.reload();
			},
			error : function(jqXHR, exception, status ) {
				  var msg = '';
				   if (jqXHR.status === 0) {
					  msg = 'Not connect.\n Verify Network.';
				   } else if (jqXHR.status == 404) {
					  msg = 'Requested page not found. [404]';
				   } else if (jqXHR.status == 500) {
					  msg = 'Internal Server Error [500].';
				   } else if (exception === 'parsererror') {
					  msg = 'Requested JSON parse failed.';
				   } else if (exception === 'timeout') {
					  msg = 'Time out error.';
				   } else if (exception === 'abort') {
					  msg = 'Ajax request aborted.';
				   } else {
					  msg = 'Uncaught Error.\n' + jqXHR.responseText;
				   }
                    console.log( "ERROR" );
				console.log( jqXHR );			
				console.log( msg );
				console.log( status ) ;
				},
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
		var fila = $(this).closest("tr");	        
		var id = parseInt(fila.find('td:eq(0)').text()); //capturo el ID
		var opcion = 2 ; // BUSCAR X ID		
		$.ajax({
		     url: "herramientas_controler.php", 
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
				$('#opcion').val("6");
			}
		})
	});
} );