$(document).ready(function(){
			$.post("prestamo_controler.php?opcion=4", {}, function(data){
				$("#cbx_profesor").html(data);
			});

			$.post("prestamo_controler.php?opcion=5", {}, function(data){
				$("#cbx_herramienta").html(data);
			});
	
		$('#add_button').click(function(){
			var idpedido = 0 ;
			var cantidad = 1 ;			
			alertify.set('notifier','position', 'top-center');
			alertify.set('notifier','delay', 10);			
			alertify.success("Cargando");		
//			$.post("prestamo_controler.php?opcion=6", {}, function(data){
//				$("#detalle-producto2").html(data);
//			});			
			


		   	$('#user_form')[0].reset();
			$('.modal-title').text("Agregar Categoria");
			$('#action').val("Agregar");
			$('#operation').val("add");
			$('#idpedido').val(idpedido);
			$('#txt_cantidad').val(cantidad);
			$("#detalle-producto2").html("");

		});


	var dataTable = $('#myTable').DataTable({
		"language": { "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json" },
		"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
		"dom": "<'row'<'col-sm-6'l><'col-sm-6'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'B><'col-sm-7'p>>",
		"pagingType": "full_numbers",
		"buttons": [ 'copy', 'csv', 'excel', 'pdf', 'print' ],

	});

	$(document).on('click', '#btn-agregar-producto', function(event){
		event.preventDefault();
		var idherramienta = $('#cbx_herramienta').val();
		var prestadas = $('#txt_cantidad').val();
		alertify.set('notifier','position', 'top-center');
		alertify.set('notifier','delay', 5);			
		alertify.success("Guardando");				
		$.ajax({
			url: 'prestamo_controler.php?opcion=7',
			type: 'post',
			data: { 'idherramienta' :idherramienta, 'prestadas' :prestadas },
			dataType: 'json',
			success: function(data) {
				if(data.success==true){
					alertify.set('notifier','delay', 5);			
					alertify.success(data.msj);
					$.post("prestamo_controler.php?opcion=6",
						{}, function(data){
							$("#detalle-producto2").html(data);
					});						
					var cantidad = 1 ;			
					$('#txt_cantidad').val(cantidad);
				}else{
					alertify.error(data.msj);
				}
			},
			error: function(jqXHR, textStatus, error) {
				alertify.error(error);
			}
		});			

	});

	
	$(document).on('submit', '#user_form', function(event){
		event.preventDefault();
		var idprofesor = $('#cbx_profesor').val();

		if (idprofesor =="0"){
			alertify.error("Debes seleccionar un cliente");
			$("#cbx_profesor").focus();
			return false;
		}
	
		alertify.set('notifier','position', 'top-center');
		alertify.set('notifier','delay', 10);			
		alertify.success("Guardando");				
		$.ajax({
			url: 'prestamo_controler.php?opcion=3',
			type: 'post',
			data: { 'idprofesor' :idprofesor},
			dataType: 'json',
			success: function(data) {
				if(data.success==true){
					alertify.success(data.msj);
				}else{
					alertify.error(data.msj);
				}
			},
			error: function(jqXHR, textStatus, error) {
				alertify.error(error);
			}
		});			

	});	
	
	$(document).on('click', '.update', function(){
		var user_id = $(this).attr("id");
		$.ajax({
			url:"categoria_controler.php?opcion=2",
			method:"POST",
			data:{user_id:user_id},
			dataType:"json",
			success:function(data)
			{
				$('#userModal').modal('show');
				$('#name').val(data.name);
				$('.modal-title').text("Editar");
				$('#user_id').val(user_id);
				$('#action').val("Actualizar");
				$('#operation').val("edit");
			}
		})
	});

	$(document).on('click', '.delete', function(){
		var user_id = $(this).attr("id");
		$.ajax({
			url:"categoria_controler.php?opcion=2",
			method:"POST",
			data:{user_id:user_id},
			dataType:"json",
			success:function(data)
			{
				$('#userModal').modal('show');
				$('#name').val(data.name);
				$('.modal-title').text("Borrar");
				$('#user_id').val(user_id);
				$('#action').val("Confirmar");
				$('#operation').val("del");
			}
		})
	});

} );