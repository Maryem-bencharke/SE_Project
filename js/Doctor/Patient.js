$(document).ready(function () {
    $('#patients').DataTable();
    $('.dataTables_length').addClass('bs-select');
  });


  /*$(document).ready(function() {
    var table = $('#patients').DataTable();

    // Event listener to the two range filtering inputs to redraw on input
    $('#rowCount').on('change', function() {
        table.page.len($(this).val()).draw();
    });
});*/
/*
$(document).ready(function() {
    var table = $('#patients').DataTable({
        "paging": true, // Enable pagination
        "pageLength": 5 // Set the default number of rows per page
    });

    // Event listener for the row count selection
    $('#rowCount').on('change', function() {
        table.page.len($(this).val()).draw();
    });
});*/
/*
$(document).ready(function() {
    // Check if DataTables initializes correctly
    var table = $('#patients').DataTable();

    if (table) {
        console.log("DataTables initialized successfully.");

        $('#rowCount').on('change', function() {
            var newLength = $(this).val();
            console.log("Changing page length to: " + newLength);
            table.page.len(newLength).draw();
        });
    } else {
        console.error("DataTables did not initialize.");
    }
});
*/