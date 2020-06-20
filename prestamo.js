$(document).ready(function(){

	var msg = alertify.success('Cargando Pedidos', 0);
// { name: "John", time: "2pm" }							
// CARGDA DATOS PRESTAMOS
	var opcion = 8 ;
	$.post("prestamo_controler.php", {opcion:opcion }, function(data){
		$("#detalle-producto1").html(data);
    		msg.dismiss();		
	});			

// CARGA PROFESORES EN MODAL	
	var opcion = 4 ;
	$.post("prestamo_controler.php", {opcion:opcion }, function(data){
		$("#cbx_profesor").html(data);
	});

// CARGA HERRAMIENTAS EN MODAL	
	var opcion = 5 ;
	$.post("prestamo_controler.php", {opcion:opcion }, function(data){
		$("#cbx_herramienta").html(data);
	});
	
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
		var opcion = 6
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
		var operation = "del" ;
		var opcion = 9 ;
		alert( idpedido );
		$.ajax({
			url:"prestamo_controler.php",
			method:"POST",
			data:{ idpedido:idpedido, opcion:opcion },
			dataType:"json",
			success:function(data)
			{
				var opcion = 8 ;
				$.post("prestamo_controler.php", { opcion:opcion }, function(data){
					$("#detalle-producto1").html(data);
				});			
			}
		})
	});

// MODAL ACTUALIZAR	
	$(document).on('click', '.update', function(){
	});




// AGREGAR HERRAMIENTA
	$(document).on('click', '#btn-agregar-producto', function(event){
		event.preventDefault();
		var idherramienta = $('#cbx_herramienta').val();
		var prestadas = $('#txt_cantidad').val();
		var opcion = 7 ;
		var msg = alertify.success('Guardando Herramienta', 0);
		$.ajax({
			url: 'prestamo_controler.php',
			type: 'post',
			data: { idherramienta:idherramienta, prestadas:prestadas, opcion:opcion },
			dataType: 'json',
			success: function(data) {
					var idpedido = $('#idpedido').val();
					var opcion = 6 ;					
					$.post("prestamo_controler.php",
						{ idpedido:idpedido, opcion:opcion }, function(data){
							$("#detalle-producto2").html(data);
    							msg.dismiss();
					});						
					var cantidad = 1 ;			
					$('#txt_cantidad').val(cantidad);
			},
			error: function(jqXHR, textStatus, error) {
				alertify.error(" ERROR AGREGAR HERRAMIENTA");
			}
		});			

	});

// GUARDAR PEDIDO	
	$(document).on('submit', '#user_form', function(event){
		event.preventDefault();
		var idprofesor = $('#cbx_profesor').val();
		var operation = $('#operation').val();		
		if (idprofesor =="0"){
			alertify.error("Debes seleccionar un cliente");
			$("#cbx_profesor").focus();
			return false;
		}
		var opcion = 3 ;	
		$.ajax({
			
			url: 'prestamo_controler.php',
			type: 'post',
			data: { idprofesor:idprofesor , opcion:opcion , operation:operation },
			dataType: 'json',
			success: function(data) {
				alertify.success(data.msj);
				$('#user_form')[0].reset();
				$('#userModal').modal('hide');
				alertify.success(data.msj);
				var opcion = 8 ;
				$.post("prestamo_controler.php", { opcion:opcion }, function(data){
					$("#detalle-producto1").html(data);
				});			
			},
			error: function(jqXHR, textStatus, error) {
				alertify.error(error);
			}
		});			

	});	



} );

