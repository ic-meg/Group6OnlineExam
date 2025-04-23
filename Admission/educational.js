document.addEventListener('DOMContentLoaded', function() {
    const resetButton = document.querySelector('button[name="saveEducational"][value="Reset Educational Information"]');
    const resetModal = new bootstrap.Modal(document.getElementById('resetModal'));
    const successModal = new bootstrap.Modal(document.getElementById('successModal'));
    const resetSuccessModal = new bootstrap.Modal(document.getElementById('resetSuccessModal'));
    const resetForm = document.getElementById('resetForm');

    if (resetButton) {
        resetButton.addEventListener('click', function(event) {
            event.preventDefault(); 
            resetModal.show();
        });
    }

    if (resetForm) {
        resetForm.addEventListener('submit', function(event) {
            event.preventDefault();
            
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'reset_educational.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    resetModal.hide();
                    resetSuccessModal.show();
                } else {
                    alert('Error resetting family background information.');
                }
            };
            xhr.send('action=reset');
        });
    }

    const goToApplicationFormButton = document.getElementById('goToApplicationForm');
    if (goToApplicationFormButton) {
        goToApplicationFormButton.addEventListener('click', function() {
            window.location.href = 'applicationform.php';
        });
    }

    const goToApplicationFormAfterResetButton = document.getElementById('goToApplicationFormAfterReset');
    if (goToApplicationFormAfterResetButton) {
        goToApplicationFormAfterResetButton.addEventListener('click', function() {
            window.location.href = 'applicationform.php';
        });
    }
});