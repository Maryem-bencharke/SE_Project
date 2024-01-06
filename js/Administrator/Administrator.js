$(document).ready(function () {
    $('#administrators').DataTable();
    $('.dataTables_length').addClass('bs-select');
});

if (document.getElementById('successAlert')) {
    setTimeout(function() {
        $('#successAlert').alert('close');
    }, 5000);
}
// function addAdministrator() {
//     document.getElementById('newAdministratorForm').style.display = 'block';
// }

// function addAdministrator() {
//     window.location.href = 'path'; // Update with the actual path
// }

