     </div>
    </div>
  </body>

<!-- Latest compiled and minified JavaScript -->
  <script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ="   crossorigin="anonymous"></script>
  <script type="text/javascript" src="libs/js/functions.js"></script>
<!-- Latest compiled and minified bootstrap -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- Latest compiled and minified datable -->
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>

  <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>



  <script type = "text/javascript">
    $(document).ready( function() {
        $("#Mytabla").dataTable( {
          language: { "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json" },
			    "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
          "dom": "<'row'<'col-sm-6'l><'col-sm-6'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'B><'col-sm-7'p>>",
          "pagingType": "full_numbers",
          buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]

		    });

        $("#Mytabla1").dataTable( {
          language: { "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json" },
			    "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
          "dom": "<'row'<'col-sm-6'l><'col-sm-6'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'B><'col-sm-7'p>>",
          "pagingType": "simple_numbers",
          buttons: [
            'copy', 'pdf', 'print'
        ]

		    });
    })

	</script>
</html>
