//  <script type="text/javascript" src="libs/datatables/datatables.js"></script>
		$(document).ready(function () {
	        $('#tabla1').DataTable( {
			        "pageLength": 5,
					"lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "Todos"] ],
			        pagingType : "first_last_numbers",
			        language: {
			        "emptyTable":       "Tabla Vacia",
			        "info":             "",
			        "infoEmpty":        "",
			        "infoFiltered":     "",
			        "infoPostFix":      "",
			        "lengthMenu":       "Show _MENU_ entries",
			        "loadingRecords":   "Loading...",
			        "processing":       "Processing...",
			        "search":           "Buscar:",
			        "zeroRecords":      "No se encontraron registros coincidentes",
			        "paginate": {
			          "first":        "Primero",
			          "previous":     "Previo",
			          "next":         "Siguiente",
			          "last":         "Ultimo"
			    },
			    "aria": {
			        "sortAscending":    ": activate to sort column ascending",
			        "sortDescending":   ": activate to sort column descending"
			    },
			    "decimal":          "",
			    "thousands":        ","
			}




     });





	    });
	</script>