$(document).ready(function () {
    $('#patients').DataTable();
    $('.dataTables_length').addClass('bs-select');
  });

  if (document.getElementById('successAlert')) {
    // Set a timeout to automatically hide the alert after 5 seconds (5000 milliseconds)
    setTimeout(function() {
        $('#successAlert').alert('close');
    }, 5000);
}