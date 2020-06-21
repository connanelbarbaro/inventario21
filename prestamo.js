$(document).ready(function(){
	
// DATATABLE
	var dataTable = $('#myTable').DataTable({
		"language": { "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json" },
		"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
		"dom": "<'row'<'col-sm-6'l><'col-sm-6'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'B><'col-sm-7'p>>",
		"pagingType": "full_numbers",
		"buttons": [ 'copy', 'csv', 'excel', 'pdf', 'print' ],

	});


// MODAL AGREGAR PEDIDO
	$('#add_button').click(function(){
		var idpedido = 0 ;
		var cantidad = 1 ;			
		var opcion = 6 ;
		$('#user_form')[0].reset();
		$('.modal-title').text("Agregar Pedido");
		$('#action').val("Guardar Pedido");
		$('#operation').val("add");
		$('#idpedido').val(idpedido);
		$('#txt_cantidad').val(cantidad);
		$.post("prestamo_controler.php",
			{ idpedido :idpedido, opcion:opcion }, function(data){
				$("#detalle-producto2").html(data);
		});						
	});

// MODAL BORRAR PEDIDO
	$(document).on('click', '.delete', function(){
		var idpedido = $(this).attr("id");
		$.ajax({
			url:"prestamo_del.php",
			method:"POST",
			data:{ idpedido:idpedido },
			dataType:"json",
			success:function(data)
			{
				var msg = alertify.success(data.msj, 0);				
				$(".detalle-producto1").load('prestamo_list.php');
				msg.dismiss();		
			}
		})
	});

// MODAL ACTUALIZAR	
	$(document).on('click', '.update', function(){
		var idpedido = $(this).attr("id");
		var opcion = 4 ;
		var msg = alertify.success( "Cargando", 0 );				
		$.ajax({
			url:"prestamo_edit.php",
			method:"POST",
			data:{idpedido:idpedido , opcion:opcion },
			dataType:"json",
			success:function(data)
			{
				var opcion = 6 ;
				$('#cbx_profesor').val(data.idprofesor);
				$.post("prestamo_controler.php",
					{ idpedido :idpedido, opcion:opcion }, function(data){
						$("#detalle-producto2").html(data);
				});						
				$('#userModal').modal('show');
				$('.modal-title').text("Editar");
				$('#action').val("Actualizar");
				$('#operation').val("edit");
			}
		})
		msg.dismiss();		
	});


// AGREGAR HERRAMIENTA
	$(document).on('click', '#btn-agregar-producto', function(event){
// 1 herramienta
		event.preventDefault();
		var idherramienta = $('#cbx_herramienta').val();
		var prestadas = $('#txt_cantidad').val();
		var opcion = 1 ;
		$.ajax({
			url: 'prestamo_edit.php',
			type: 'post',
			data: { idherramienta:idherramienta, prestadas:prestadas, opcion:opcion },
			dataType: 'json',
			success: function(data) {
				var idpedido = $('#idpedido').val();
				var opcion = 6 ;					
				alertify.success(data.msj );				
				$.post("prestamo_controler.php",
					{ idpedido:idpedido, opcion:opcion }, function(data){
					$("#detalle-producto2").html(data);
				});						
				var cantidad = 1 ;			
				$('#txt_cantidad').val(cantidad);
			},
			error: function(jqXHR, textStatus, error) {
				alertify.error(" ERROR AGREGAR HERRAMIENTA");
			}
		});			

	});

// BORRAR HERRAMNIENTA
	$(document).on('click', '.btn-borrar-producto', function(event){
		var id = $(this).attr("id");
		var opcion = 3 ;	
		$.ajax({
			url: 'prestamo_edit.php',
			type: 'post',
			data: { id:id , opcion:opcion  },
			dataType: 'json',
			success: function(data) {
				var idpedido = $('#idpedido').val();
				var opcion = 6 ;					
				alertify.success(data.msj);				
				$.post("prestamo_controler.php",
					{ idpedido:idpedido, opcion:opcion }, function(data){
					$("#detalle-producto2").html(data);
				});						
			},
			error: function(req, status, err ) {
                    console.log( 'something went wrong', status, err );
                    alert('something went wrong'+ status + err); 
			}
		});
	});


// GUARDAR PEDIDO	
	$(document).on('submit', '#user_form', function(event){
// 2 pedido
		event.preventDefault();
		var idprofesor = $('#cbx_profesor').val();
		var operation = "add" ;		
		if (idprofesor =="0"){
			alertify.error("Debes seleccionar un cliente");
			$("#cbx_profesor").focus();
			return false;
		}
		var opcion = 2 ;	
		$.ajax({
			url: 'prestamo_edit.php',
			type: 'post',
			data: { idprofesor:idprofesor , opcion:opcion  },
			dataType: 'json',
			success: function(data) {
				// CARGAR PEDIDOS
				var msg = alertify.success('Cargando Pedidos', 0);
				$(".detalle-producto1").load('prestamo_list.php');
				msg.dismiss();		
				$('#user_form')[0].reset();
				$('#userModal').modal('hide');
			},
			error: function(req, status, err ) {
                    console.log( 'something went wrong', status, err );
                    alert('something went wrong'+ status + err); 
			}
		});			

	});	



} );

