$(document).ready(function () {
  $('#doctors').DataTable();
  $('.dataTables_length').addClass('bs-select');
});

if (document.getElementById('successAlert')) {
  setTimeout(function() {
      $('#successAlert').alert('close');
  }, 5000);
}

