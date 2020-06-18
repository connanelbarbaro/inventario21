$(document).ready(function(){
	$('#add_button').click(function(){
		$('#div_problema').html('<input type="hidden" name="problema" id="problema" />');
		
		$('#user_form')[0].reset();
		$('.modal-title').text("Agregar Herramienta");
		$('#action').val("Agregar");
		$('#operation').val("add");
	});

	var dataTable = $('#myTable').DataTable({
		"autoWidth": true,		
		"language": { "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json" },
		"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
		"dom": "<'row'<'col-sm-6'l><'col-sm-6'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'B><'col-sm-7'p>>",
		"pagingType": "full_numbers",
		"buttons": [ 'copy', 'csv', 'excel', 'pdf', 'print' ],

	});

	$(document).on('submit', '#user_form', function(event){
		event.preventDefault();
		var id = $('#id').val();
		var name = $('#name').val();
		var idcategoria = $('#idcategoria').val();
		var idubicacion1 = $('#idubicacion1').val();
		var idubicacion2 = $('#idubicacion2').val();
		var idubicacion3 = $('#idubicacion3').val();
		var cantidad = $('#cantidad').val();
			$.ajax({
				url:"herramientas_controler.php?opcion=3",
				method:'POST',
				data:new FormData(this),
				contentType:false,
				processData:false,
				success:function(data)
				{
					$('#user_form')[0].reset();
					$('#userModal').modal('hide');
					alertify.success(data.msj);
					$(".detalle-producto").load('herramientas_list.php');
				}
			});

	});
	
	$(document).on('click', '.update', function(){
		var id = $(this).attr("id");
		$('#div_problema').html('<input type="hidden" name="problema" id="problema" />');
		$.ajax({
			url:"herramientas_controler.php?opcion=2",
			method:"POST",
			data:{id:id},
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
				$('#operation').val("edit");
			}
		})
	});
	$(document).on('click', '.delete', function(){
		var id = $(this).attr("id");
		$('#div_problema').html('<input type="hidden" name="problema" id="problema" />');
		$.ajax({
			url:"herramientas_controler.php?opcion=2",
			method:"POST",
			data:{id:id},
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
				$('#operation').val("del");
			}
		})
	});
	
	$(document).on('click', '.reparacion', function(){
			var id = $(this).attr("id");
			var div = '<div class="form-group">' ;
			var div = div + '<label for="problema">Problema</label>';
			var div = div + '<div class="input-group">';
			var div = div + '<input type="text" class="form-control" name="rproblema" id="rproblema" >';
			var div = div + '</div>';
			var div = div + '</div>';
			$('#div_problema').html(div) ;
			$.ajax({
			url:"herramientas_controler.php?opcion=2",
			method:"POST",
			data:{id:id},
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
				$('#operation').val("rep");

            
			}
		})
	});
	
	
	

} );