$(document).ready(function () {
    $('#nurses').DataTable();
    $('.dataTables_length').addClass('bs-select');
});

if (document.getElementById('successAlert')) {
    setTimeout(function() {
        $('#successAlert').alert('close');
    }, 5000);
}
