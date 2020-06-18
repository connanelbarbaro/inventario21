$(document).ready(function(){
		$('#add_button').click(function(){
			var idpedido = 0 ;
			$.post("prestamo_controler.php?opcion=6", {}, function(data){
				$("#detalle-producto2").html(data);
			});			
			
			$.post("prestamo_controler.php?opcion=4", {}, function(data){
				$("#cbx_profesor").html(data);
			});

			$.post("prestamo_controler.php?opcion=5", {}, function(data){
				$("#cbx_herramienta").html(data);
			});

		   	$('#user_form')[0].reset();
			$('.modal-title').text("Agregar Categoria");
			$('#action').val("Agregar");
			$('#operation').val("add");
			$('#idpedido').val(idpedido);
			$('#txt_cantidad').val(idpedido);
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
		console.log("prueba");
		$.ajax({
			$.post("prestamo_controler.php?opcion=3", 
				{ idherramienta:idherramienta, prestadas:prestadas }, function(data){
					$.post("prestamo_controler.php?opcion=6",
						{}, function(data){
							$("#detalle-producto2").html(data);
					});						
			});						
		});

	});
	$(document).on('submit', '#user_form', function(event){
		event.preventDefault();
		alert( "yo1" );
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