function updatePrograms() {
    const strand = document.getElementById('inputStrand').value;
    const programSelect = document.getElementById('inputProgram');
    let programs = [];

    if (strand === 'TVL') {
        programs = ['Bachelor of Science in Computer Science', 'Bachelor of Science In Hospitality Management', 'Bachelor of Science In Information Technology'];
    } else if (strand === 'STEM') {
        programs = [
            'Bachelor of Early Childhood Education',
            'Bachelor of Elementary Education',
            'Bachelor of Science In Business Administration',
            'Bachelor of Science In Computer Science',
            'Bachelor of Science In Psychology',
            'Bachelor of Secondary Education Major In English',
            'Bachelor of Secondary Education Major In Mathematics'
        ];
    } else if (strand === 'HUMSS') {
        programs = [
            'Bachelor of Arts In Journalism',
            'Bachelor of Early Childhood Education',
            'Bachelor of Elementary Education',
            'Bachelor of Science In Psychology',
            'Bachelor of Secondary Education Major In English',
            'Bachelor of Secondary Education Major In Mathematics'
        ];
    } else if (strand === 'GAS') {
        programs = [
            'Bachelor of Arts In Journalism',
            'Bachelor of Early Childhood Education',
            'Bachelor of Elementary Education',
            'Bachelor of Science In Psychology',
            'Bachelor of Secondary Education Major In English',
            'Bachelor of Secondary Education Major In Mathematics',
            'Bachelor of Science In Entrepreneurship',
            'Bachelor of Science In Office Administration'
        ];
    } else if (strand === 'ABM') {
        programs = [
            'Bachelor of Science In Business Administration',
            'Bachelor of Science In Entrepreneurship',
            'Bachelor of Science In Hospitality Management',
            'Bachelor of Science In Office Administration'
        ];
    }

    programSelect.innerHTML = '<option value="" selected></option>';
    programs.forEach(function(program) {
        const option = document.createElement('option');
        option.value = program;
        option.text = program;
        programSelect.add(option);
    });

    // Set the pre-selected value if available
    const selectedProgram = "<?= htmlspecialchars($ProgramName) ?>";
    if (selectedProgram) {
        programSelect.value = selectedProgram;
    }
}


document.addEventListener('DOMContentLoaded', updatePrograms);

//Reset and Success Modal
document.addEventListener('DOMContentLoaded', function() {
    const resetForm = document.getElementById('resetForm');
    const resetModal = new bootstrap.Modal(document.getElementById('resetModal'));
    const successModal = new bootstrap.Modal(document.getElementById('successModal'));
    const resetSuccessModal = new bootstrap.Modal(document.getElementById('resetSuccessModal'));

   
    const resetButton = document.querySelector('button[name="saveAdmission"][value="Reset Admission Information"]');
    resetButton.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default button action
        resetModal.show();
    });

    // Handle reset form submission
    resetForm.addEventListener('submit', function(event) {
        event.preventDefault();
        
        // Create a new XMLHttpRequest to handle the reset operation
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'reset_admission.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Close the reset modal
                    resetModal.hide();
                    // Clear the form fields
                    document.getElementById('admissionForm').reset();
                    // Show the reset success modal
                    resetSuccessModal.show();
                } else {
                    alert('Error resetting admission information: ' + xhr.responseText);
                }
            }
        };
        
        // Send the AJAX request
        xhr.send('email=' + encodeURIComponent('<?= $email ?>'));
    });

    // Handle redirect after reset success modal
    document.getElementById('goToApplicationFormAfterReset').addEventListener('click', function() {
        window.location.href = 'applicationform.php';
    });

    // Handle form save
    document.querySelector('button[name="saveAdmission"][value="Save Admission Information"]').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default button action
        
        // Validate required fields
        const form = document.querySelector('form:not(#resetForm)');
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;

        requiredFields.forEach(function(field) {
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('is-invalid');
            } else {
                field.classList.remove('is-invalid');
            }
        });

        if (!isValid) {

            showAlert();
            return;
        }

        // Create a new XMLHttpRequest to handle the save operation
        const formData = new FormData(form);
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'save_admission.php', true);
        
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Show the success modal
                    successModal.show();
                } else {
                    alert('Error saving admission information: ' + xhr.responseText);
                }
            }
        };
        
        // Send the AJAX request
        xhr.send(formData);
    });

    // Handle redirect after success modal
    document.getElementById('goToApplicationForm').addEventListener('click', function() {
        window.location.href = 'applicationform.php';
    });
});

function showAlert() {
Swal.fire({
    title: "Missing Information",
    text: "Please fill out all required fields",
    icon: "warning",
    confirmButtonColor: "#448b4f",
    confirmButtonText: "OK"
});
}

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>