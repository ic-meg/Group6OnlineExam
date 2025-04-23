

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Family Background</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,900;1,500&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@400&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montagu+Slab:wght@700&display=swap" />

    
    
</head>
<body>
<?php 
    include "Header.php";
    include 'dbconn.php'; 
    session_start();

    $email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : '';

    if ($email) {
       
        $fatherName = $fatherContact = $fatherOccupation = $motherName = $motherContact = $motherOccupation = '';
        $income = $siblings = $birthOrder = $guardianName = $guardianContact = $guardianOccupation = '';
        $soloParent = $familyAbroad = '';
        $isReadOnly = false;
        $buttonText = "Save Family Background Information";
        $buttonClass = "btn-success";
        $formError = '';

        if (isset($_POST['saveFamily'])) {
           
            if ($_POST['saveFamily'] === "Reset Family Background Information") {
                echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    var resetModal = new bootstrap.Modal(document.getElementById('resetModal'));
                    resetModal.show();
                });
                </script>";
            } else {
                // Validate required fields
                $fatherName = isset($_POST['FathersName']) ? $_POST['FathersName'] : '';
                $fatherContact = isset($_POST['FathersContact']) ? $_POST['FathersContact'] : '';
                $fatherOccupation = isset($_POST['FathersOccu']) ? $_POST['FathersOccu'] : '';
                $motherName = isset($_POST['MothersName']) ? $_POST['MothersName'] : '';
                $motherContact = isset($_POST['MothersContact']) ? $_POST['MothersContact'] : '';
                $motherOccupation = isset($_POST['MothersOccu']) ? $_POST['MothersOccu'] : '';
                $income = isset($_POST['MonthlyIncome']) ? $_POST['MonthlyIncome'] : '';
                $siblings = isset($_POST['NumOfSib']) ? $_POST['NumOfSib'] : '';
                $birthOrder = isset($_POST['BirthOrder']) ? $_POST['BirthOrder'] : '';
                $guardianName = isset($_POST['GuardiansName']) ? $_POST['GuardiansName'] : '';
                $guardianContact = isset($_POST['GuardiansContact']) ? $_POST['GuardiansContact'] : '';
                $guardianOccupation = isset($_POST['GuardiansOccu']) ? $_POST['GuardiansOccu'] : '';
                $soloParent = isset($_POST['SoloParent']) ? $_POST['SoloParent'] : '';
                $familyAbroad = isset($_POST['FamWorkingAbroad']) ? $_POST['FamWorkingAbroad'] : '';
        
                // Check for empty fields
                if (empty($guardianName) || empty($guardianContact) || empty($guardianOccupation)) {
                    $formError = 'Please fill out all required fields.';
                    echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                        errorModal.show();
                    });
                    </script>";
                } else {
                    // Proceed with saving the data
                    $stmt = $conn->prepare("SELECT userID FROM useraccount WHERE email = ?");
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $result = $stmt->get_result();
        
                    if ($result && $result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $userID = $row['userID'];
        
                        $sql = "INSERT INTO familybackground (
                            userID, FathersName, FathersContact, FathersOccu, 
                            MothersName, MothersContact, MothersOccu, MonthlyIncome, 
                            NumOfSib, BirthOrder, GuardiansName, GuardiansContact, 
                            GuardiansOccu, SoloParent, FamWorkingAbroad
                        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        
                        // Prepare the statement
                        $stmt = $conn->prepare($sql);
                        
                        // Check if preparation was successful
                        if ($stmt === false) {
                            die('Prepare() failed: ' . htmlspecialchars($conn->error));
                        }
                        
                        // Bind parameters
                        $stmt->bind_param(
                            "issssssisssssss", 
                            $userID, $fatherName, $fatherContact, $fatherOccupation, 
                            $motherName, $motherContact, $motherOccupation, $income, 
                            $siblings, $birthOrder, $guardianName, $guardianContact, 
                            $guardianOccupation, $soloParent, $familyAbroad
                        );
                        
                        // Execute the query
                        if ($stmt->execute()) {
                            echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                                successModal.show();
                                successModal.addEventListener('hidden.bs.modal', function () {
                                    window.location.href = 'applicationform.php';
                                });
                            });
                            </script>";
                        } else {
                            echo "<script>alert('Error saving family background information.');</script>";
                        }
                    } else {
                        echo "<script>alert('User not found.');</script>";
                    }
                }
            }
        }
         else {
            // Fetch existing data if available
            $stmt = $conn->prepare("SELECT * FROM familybackground WHERE userID = (SELECT userID FROM useraccount WHERE email = ?)");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $fatherName = $row['FathersName'];
                $fatherContact = $row['FathersContact'];
                $fatherOccupation = $row['FathersOccu'];
                $motherName = $row['MothersName'];
                $motherContact = $row['MothersContact'];
                $motherOccupation = $row['MothersOccu'];
                $income = $row['MonthlyIncome'];
                $siblings = $row['NumOfSib'];
                $birthOrder = $row['BirthOrder'];
                $guardianName = $row['GuardiansName'];
                $guardianContact = $row['GuardiansContact'];
                $guardianOccupation = $row['GuardiansOccu'];
                $soloParent = $row['SoloParent'];
                $familyAbroad = $row['FamWorkingAbroad'];
                $isReadOnly = true;
                $buttonText = "Reset Family Background Information"; 
                $buttonClass = "btn-danger"; 
            }
        }
    }
?>


            <div class="content" id="content">
                <div class="container"><br>
                <p style="color: red;"><b>* -required fields</b></p>
                    <p class="mt-4" style="font-size: 20px;"><b>Family Background</b></p> <br>
                    <form id="familyBackgroundForm" method="POST"  onsubmit="return validateForm()">
                       <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="fatherName">Father's Name</label>
                            <input type="text" class="form-control" id="fatherName" name="FathersName" value="<?= htmlspecialchars($fatherName) ?>" <?= $isReadOnly ? 'readonly' : '' ?>>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="fatherContact">Contact Number</label>
                            <input type="text" class="form-control" pattern="\d{11}" maxlength="11" id="fatherContact" name="FathersContact" value="<?= htmlspecialchars($fatherContact) ?>" <?= $isReadOnly ? 'readonly' : '' ?>>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="fatherOccupation">Occupation</label>
                            <input type="text" class="form-control" id="fatherOccupation" name="FathersOccu" value="<?= htmlspecialchars($fatherOccupation) ?>" <?= $isReadOnly ? 'readonly' : '' ?>>
                        </div>
                            </div><hr>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="motherName">Mother's Name</label>
                                    <input type="text" class="form-control" id="motherName" name="MothersName" value="<?= htmlspecialchars($motherName) ?>" <?= $isReadOnly ? 'readonly' : '' ?>>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="motherContact">Contact Number</label>
                                    <input type="text" class="form-control" pattern="\d{11}" maxlength="11" id="motherContact" name="MothersContact" value="<?= htmlspecialchars($motherContact) ?>" <?= $isReadOnly ? 'readonly' : '' ?>>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="motherOccupation">Occupation</label>
                                    <input type="text" class="form-control" id="motherOccupation" name="MothersOccu" value="<?= htmlspecialchars($motherOccupation) ?>" <?= $isReadOnly ? 'readonly' : '' ?>>
                                </div>
                            </div><hr>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="income">*Estimated Monthly Family Income</label>
                                    <select id="income" name="MonthlyIncome" class="form-control" required <?= $isReadOnly ? 'disabled' : '' ?>>
                                        <option value="" disabled <?= empty($income) ? 'selected' : '' ?>></option>
                                        <option value="below 10,000" <?= $income === "below 10,000" ? 'selected' : '' ?>>below 10,000</option>
                                        <option value="10,000 - 20,000" <?= $income === "10,000 - 20,000" ? 'selected' : '' ?>>10,000 - 20,000</option>
                                        <option value="20,000 - 30,000" <?= $income === "20,000 - 30,000" ? 'selected' : '' ?>>20,000 - 30,000</option>
                                        <option value="30,000 - 40,000" <?= $income === "30,000 - 40,000" ? 'selected' : '' ?>>30,000 - 40,000</option>
                                        <option value="40,000 - 50,000" <?= $income === "40,000 - 50,000" ? 'selected' : '' ?>>40,000 - 50,000</option>
                                        <option value="above 50,000" <?= $income === "above 50,000" ? 'selected' : '' ?>>above 50,000</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="siblings">Number of siblings</label>
                                    <input type="number" class="form-control" id="siblings" name="NumOfSib" value="<?= htmlspecialchars($siblings) ?>" min="0" max="20" <?= $isReadOnly ? 'readonly' : '' ?>>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="birthOrder">Birth Order</label>
                                    <select id="birthOrder" class="form-control" name="BirthOrder" <?= $isReadOnly ? 'disabled' : '' ?>>
                                        <option value="" disabled <?= empty($birthOrder) ? 'selected' : '' ?>></option>
                                        <option <?= $birthOrder === "Eldest" ? 'selected' : '' ?>>Eldest</option>
                                        <option <?= $birthOrder === "Middle" ? 'selected' : '' ?>>Middle</option>
                                        <option <?= $birthOrder === "Youngest" ? 'selected' : '' ?>>Youngest</option>
                                        <option <?= $birthOrder === "Only Child" ? 'selected' : '' ?>>Only Child</option>
                                    </select>
                                </div>
                            </div><hr>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="guardianName">*Guardian's Name</label>
                                    <input type="text" class="form-control" id="guardianName" name="GuardiansName" value="<?= htmlspecialchars($guardianName) ?>" required <?= $isReadOnly ? 'readonly' : '' ?>>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="guardianContact">*Contact Number</label>
                                    <input type="tel" class="form-control" id="guardianContact" pattern="\d{11}" maxlength="11" name="GuardiansContact" value="<?= htmlspecialchars($guardianContact) ?>" required <?= $isReadOnly ? 'readonly' : '' ?>>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="guardianOccupation">*Occupation</label>
                                    <input type="text" class="form-control" id="guardianOccupation" name="GuardiansOccu" value="<?= htmlspecialchars($guardianOccupation) ?>" required <?= $isReadOnly ? 'readonly' : '' ?>>
                                </div>
                            </div>
                            <p class="mt-4" style="font-size: 20px;"><b>Additional Family Information</b></p>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="soloParent">Are you a Solo Parent?</label>
                                    <select id="soloParent" name="SoloParent" class="form-control" <?= $isReadOnly ? 'disabled' : '' ?>>
                                        <option value="" disabled <?= empty($soloParent) ? 'selected' : '' ?>></option>
                                        <option value="Yes" <?= $soloParent === "Yes" ? 'selected' : '' ?>>Yes</option>
                                        <option value="No" <?= $soloParent === "No" ? 'selected' : '' ?>>No</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="familyAbroad">Is any member of your family working abroad?</label>
                                    <select id="familyAbroad" name="FamWorkingAbroad" class="form-control" <?= $isReadOnly ? 'disabled' : '' ?>>
                                        <option value="" disabled <?= empty($familyAbroad) ? 'selected' : '' ?>></option>
                                        <option value="Yes" <?= $familyAbroad === "Yes" ? 'selected' : '' ?>>Yes</option>
                                        <option value="No" <?= $familyAbroad === "No" ? 'selected' : '' ?>>No</option>
                                    </select>
                                </div>
                            </div><hr><br>
                        
                        
                                <button type="submit" class="btn <?= htmlspecialchars($buttonClass) ?>" name="saveFamily" value="<?= htmlspecialchars($buttonText) ?>"><?= htmlspecialchars($buttonText) ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
 <!-- Error Modal -->
 <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="errorModalLabel">Error</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <?= $formError ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

<!-- Reset Modal -->
<div class="modal fade" id="resetModal" tabindex="-1" aria-labelledby="resetModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resetModalLabel">Confirm Reset</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to reset the admission information? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <form method="POST" id="resetForm">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="saveAdmission" value="Reset Admission Information" class="btn btn-danger">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Success Modal HTML -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Your family background information has been saved successfully.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="goToApplicationForm">OK</button>
            </div>
        </div>
    </div>
</div>

<!-- Reset Success Modal HTML -->
<div class="modal fade" id="resetSuccessModal" tabindex="-1" aria-labelledby="resetSuccessModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resetSuccessModalLabel">Reset Successful</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Your family background information has been successfully reset.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="goToApplicationFormAfterReset">OK</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const resetButton = document.querySelector('button[name="saveFamily"][value="Reset Family Background Information"]');
    const resetModal = new bootstrap.Modal(document.getElementById('resetModal'));
    const successModal = new bootstrap.Modal(document.getElementById('successModal'));
    const resetSuccessModal = new bootstrap.Modal(document.getElementById('resetSuccessModal'));
    const resetForm = document.getElementById('resetForm');

    if (resetButton) {
        resetButton.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default button action
            resetModal.show();
        });
    }

    if (resetForm) {
        resetForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission
            
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'reset_family.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    resetModal.hide();
                    resetSuccessModal.show();
                } else {
                    alert('Error resetting family background information.');
                }
            };
            xhr.send('action=reset'); // Modify according to your PHP script
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
document.getElementById('guardianContact').addEventListener('input', function (e) {
const value = e.target.value.replace(/\D/g, ''); 
if (value.length > 11) {
    e.target.value = value.slice(0, 11); 
} else {
    e.target.value = value; 
}
});

document.getElementById('motherContact').addEventListener('input', function (e) {
const value = e.target.value.replace(/\D/g, ''); 
if (value.length > 11) {
    e.target.value = value.slice(0, 11); 
} else {
    e.target.value = value; 
}
});
document.getElementById('fatherContact').addEventListener('input', function (e) {
const value = e.target.value.replace(/\D/g, ''); 
if (value.length > 11) {
    e.target.value = value.slice(0, 11); 
} else {
    e.target.value = value; 
}
});

</script>

</body>
</html>
