function toggleSidebar() {
    var sidebar = document.getElementById('sidebar');
    var content = document.getElementById('content');
    var schoolName = document.querySelector('.SchoolName');

    schoolName.style.display = 'none';

    sidebar.classList.toggle('show');
    content.classList.toggle('sidebar-show');

    if (sidebar.classList.contains('show')) {
        schoolName.style.display = 'block';
    } else {
        schoolName.style.display = 'none';
    }
}

$(document).ready(function() {
$('#adminForm').on('submit', function(e) {
e.preventDefault();

var username = $('#username').val();
var password = $('#password').val();
var adminId = $('#adminId').val();

var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
if (!passwordPattern.test(password)) {
    Swal.fire({
        title: 'Warning!',
        text: 'Password does not meet the required policy. Please ensure it is at least 8 characters long and includes an uppercase letter, a lowercase letter, a digit, and a special character.',
        icon: 'warning'
    });
    return;
}

$.ajax({
    url: 'save_admin.php',
    type: 'POST',
    data: {
        username: username,
        password: password,
        adminId: adminId
    },
    success: function(response) {
        if (response.trim() === 'success') {
            Swal.fire({
                title: 'Success!',
                text: 'Admin saved successfully.',
                icon: 'success'
            }).then(function() {
                location.reload();
            });
        } else {
            Swal.fire({
                title: 'Error!',
                text: 'Failed to save admin. Please try again.',
                icon: 'error'
            });
        }
    },
    error: function() {
        Swal.fire({
            title: 'Error!',
            text: 'An unexpected error occurred. Please try again later.',
            icon: 'error'
        });
    }});
});
});



$(document).ready(function() {

$(document).on('click', '.editAdmin', function(e) {
e.preventDefault();

var adminId = $(this).data('admin-id');
var username = $(this).data('username');
var password = $(this).data('password');

$('#editAdminId').val(adminId);
$('#editUsername').val(username);
$('#editPassword').val(password);



var editModal = new bootstrap.Modal(document.getElementById('editAdminModal'));
editModal.show();
});


$(document).on('click', '.deleteAdmin', function(e) {
e.preventDefault();

var adminId = $(this).data('admin-id');

$('#deleteAdminId').val(adminId);

var deleteModal = new bootstrap.Modal(document.getElementById('deleteAdminModal'));
deleteModal.show();
});


$(document).on('submit', '#editAdminForm', function(e) {
e.preventDefault();

var adminId = $('#editAdminId').val();
var username = $('#editUsername').val();
var password = $('#editPassword').val();

var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
if (!passwordPattern.test(password)) {
    Swal.fire({
        title: 'Warning!',
        text: 'Password does not meet the required policy. Please ensure it is at least 8 characters long and includes an uppercase letter, a lowercase letter, a digit, and a special character.',
        icon: 'warning'
    });
    return;
}

$.ajax({
    url: 'editAdmin.php',
    method: 'POST',
    data: {
        adminId: adminId,
        username: username,
        password: password
    },
    success: function(response) {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Admin details have been updated.',
            timer: 2000,
            showConfirmButton: false
        }).then(() => {
            $('#editAdminModal').modal('hide');
            location.reload(); 
        });
    },
    error: function(xhr, status, error) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Failed to update admin details. Please try again.',
            timer: 2000,
            showConfirmButton: false
        });
    }
});
});


$(document).on('click', '#confirmDeleteButton', function(e) {
e.preventDefault();

var adminId = $('#deleteAdminId').val();

$.ajax({
    url: 'deleteAdmin.php',
    method: 'POST',
    data: { adminId: adminId },
    success: function(response) {
        Swal.fire({
            icon: 'success',
            title: 'Deleted',
            text: 'Admin has been deleted.',
            timer: 2000,
            showConfirmButton: false
        }).then(() => {
            $('#deleteAdminModal').modal('hide');
            location.reload(); 
        });
    },
    error: function(xhr, status, error) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Failed to delete admin. Please try again.',
            timer: 2000,
            showConfirmButton: false
        });
    }
});
});
});


document.addEventListener('DOMContentLoaded', function() {
const searchInput = document.getElementById('search_inpt');
const tableBody = document.getElementById('search_tbl');

searchInput.addEventListener('input', function() {
    const searchValue = this.value.toLowerCase().trim();

    Array.from(tableBody.getElementsByTagName('tr')).forEach(function(row) {
        const text = row.innerText.toLowerCase();

        if (text.includes(searchValue)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
});
