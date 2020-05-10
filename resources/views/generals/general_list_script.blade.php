 <script>
  $(document).ready(function() {
    $('#listado').DataTable( {
        pageLength: 30,
        scrollY:'55vh',
        scrollX: true,
        scrollCollapse: true,
        fixedHeader: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'print'
        ]
    } );
  } );
</script>