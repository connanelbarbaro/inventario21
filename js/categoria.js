$(document).ready(function(){
// 1 LISTADO
// 2 REGISTRO
// 3 AGREGAR
// 4 BORRAR
// 5 ACTUALIZAR

	var dataTable = $('#myTable').DataTable({
		"language": { "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json" },
		"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
		"dom": "<'row'<'col-sm-6'l><'col-sm-6'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'B><'col-sm-7'p>>",
		"pagingType": "full_numbers",
		"buttons": [ 'copy', 'csv', 'excel', 'pdf', 'print' ],
	});
	
	$('#add_button').click(function(){
		$('#user_form')[0].reset();
		$('.modal-title').text("Agregar Categoria");
		$('#action').val("Agregar");
		$('#operation').val( 1 );
	});



	$(document).on('submit', '#user_form', function(event){
		event.preventDefault();
		var user_id = $('#user_id').val();
		var name = $('#name').val();
		var opcion = $('#operation').val() ;
		$.ajax({
			url: 'categoria_controler',
			type: 'post',
			data: { opcion:opcion, user_id:user_id, name:name },
			dataType: 'json',
			success: function(data) {
				var opcion = 1 ;
				$.post("categoria_controler.php", {opcion:opcion }, function(data){
					$("#detalle-producto1").html(data);
				});
				$('#user_form')[0].reset();
				$('#userModal').modal('hide');

			}
		});

	});
	
	$(document).on('click', '.update', function(){
		var user_id = $(this).attr("id");
		var opcion = 2 ;		
		$.ajax({
			url:"categoria_controler.php",
			method:"POST",
			data:{ user_id:user_id, opcion:opcion },
			dataType:"json",
			success:function(data)
			{
				$('#userModal').modal('show');
				$('#name').val(data.name);
				$('.modal-title').text("Editar");
				$('#user_id').val( user_id );
				$('#action').val("Actualizar");
				$('#operation').val( 5 );
			}
		})
	});

	$(document).on('click', '.delete', function(){
		var user_id = $(this).attr("id");
		var opcion = 2 ;		
		$.ajax({
			url:"categoria_controler.php",
			method:"POST",
			data:{user_id:user_id, opcion:opcion },
			dataType:"json",
			success:function(data)
			{
				$('#userModal').modal('show');
				$('#name').val(data.name);
				$('.modal-title').text("Borrar");
				$('#user_id').val(user_id);
				$('#action').val("Confirmar");
				$('#operation').val( 4 );
			}
		})
	});
	

} );