

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,900;1,500&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@400&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montagu+Slab:wght@700&display=swap">
    <title>CVSU - Medical History Form</title>

    <link rel="stylesheet" href="medical.css">

</head>

<body> 


<?php 
include 'Header.php';
include 'dbconn.php'; 
session_start();

$email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : '';


if ($email) {
    $Medications = $PWD = '';
    $typeOfIllness = [];
    $isReadOnly = false;
    $buttonText = "Save Medical Information";
    $buttonClass = "btn-success";
    $formError = '';

    if (isset($_POST['saveMedical'])) {
        
        if ($_POST['saveMedical'] === "Reset Medical Information") {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                var resetModal = new bootstrap.Modal(document.getElementById('resetModal'));
                resetModal.show();
            });
            </script>";
        } else {
           
            $Medications = isset($_POST['Medications']) ? $_POST['Medications'] : '';
            $PWD = isset($_POST['PWD']) ? $_POST['PWD'] : '';
            $typeOfIllness = isset($_POST['typeOfIllness']) ? $_POST['typeOfIllness'] : [];

            if (empty($PWD)) {
                $formError = 'Please fill out all required fields.';
                echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                    errorModal.show();
                });
                </script>";
            } else {
                
                $typeOfIllnessStr = implode(', ', $typeOfIllness);

                $stmt = $conn->prepare("SELECT userID FROM useraccount WHERE email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result && $result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $userID = $row['userID'];

                    $stmt = $conn->prepare("INSERT INTO medicalhistory (userID, Medications, typeOfIllness, PWD) VALUES (?, ?, ?, ?)
                        ON DUPLICATE KEY UPDATE Medications = VALUES(Medications), typeOfIllness = VALUES(typeOfIllness), PWD = VALUES(PWD)");
                    $stmt->bind_param("ssss", $userID, $Medications, $typeOfIllnessStr, $PWD);

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
                        echo "<script>alert('Error saving medical history: " . $stmt->error . "');</script>";
                    }
                } else {
                    echo "<script>alert('User not found.');</script>";
                }
            }
        }
    } else {
        
        $stmt = $conn->prepare("SELECT * FROM medicalhistory WHERE userID = (SELECT userID FROM useraccount WHERE email = ?)");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $Medications = $row['Medications'];
            $PWD = $row['PWD'];
            $typeOfIllness = explode(', ', $row['typeOFIllness']);
            $isReadOnly = true;
            $buttonText = "Reset Medical Information"; 
            $buttonClass = "btn-danger"; 
        }
    }
}
?>

    <main>
        
        <form id="medical-form" method="POST">
            <h2>Medical History Information</h2>
            <div class="form-group">
                <label for="medications">List any medications you are taking:</label>
            </div>
            <div data-mdb-input-init class="form-outline">
                <textarea class="form-control" id="textAreaExample3" rows="2" name="Medications"   <?= $isReadOnly ? 'disabled' : '' ?>><?php echo htmlspecialchars($Medications) ?></textarea>
            </div>
            
            <h3>Do you have any of the following? Kindly put a check:</h3>
            <div class="form-group">
                <input type="checkbox" id="allergy" name="typeOfIllness[]" value="Allergy"
                    <?php echo in_array("Allergy", $typeOfIllness) ? 'checked' : ''; ?>
                    <?php echo $isReadOnly ? 'disabled' : ''; ?>>
                <label for="allergy">Allergy</label>
            </div>
            <div class="form-group">
                <input type="checkbox" id="scoliosis" name="typeOfIllness[]" value="Scoliosis"
                    <?php echo in_array("Scoliosis", $typeOfIllness) ? 'checked' : ''; ?>
                    <?php echo $isReadOnly ? 'disabled' : ''; ?>>
                <label for="scoliosis">Scoliosis or physical condition</label>
            </div>
            <div class="form-group">
                <input type="checkbox" id="asthma" name="typeOfIllness[]" value="Asthma"
                    <?php echo in_array("Asthma", $typeOfIllness) ? 'checked' : ''; ?>
                    <?php echo $isReadOnly ? 'disabled' : ''; ?>>
                <label for="asthma">Asthma</label>
            </div>
            <div class="form-group">
                <input type="checkbox" id="hypertension" name="typeOfIllness[]" value="Hypertension"
                    <?php echo in_array("Hypertension", $typeOfIllness) ? 'checked' : ''; ?>
                    <?php echo $isReadOnly ? 'disabled' : ''; ?>>
                <label for="hypertension">Hypertension</label>
            </div>
            <div class="form-group">
                <input type="checkbox" id="diabetes" name="typeOfIllness[]" value="Diabetes"
                    <?php echo in_array("Diabetes", $typeOfIllness) ? 'checked' : ''; ?>
                    <?php echo $isReadOnly ? 'disabled' : ''; ?>>
                <label for="diabetes">Diabetes</label>
            </div>
            <div class="form-group">
                <input type="checkbox" id="insomnia" name="typeOfIllness[]" value="Insomnia"
                    <?php echo in_array("Insomnia", $typeOfIllness) ? 'checked' : ''; ?>
                    <?php echo $isReadOnly ? 'disabled' : ''; ?>>
                <label for="insomnia">Insomnia</label>
            </div>
            <div class="form-group">
                <input type="checkbox" id="vertigo" name="typeOfIllness[]" value="Vertigo"
                    <?php echo in_array("Vertigo", $typeOfIllness) ? 'checked' : ''; ?>
                    <?php echo $isReadOnly ? 'disabled' : ''; ?>>
                <label for="vertigo">Vertigo</label>
            </div>
            <div class="form-group">
                <input type="checkbox" id="others" name="typeOfIllness[]" value="Others"
                    <?php echo in_array("Others", $typeOfIllness) ? 'checked' : ''; ?>
                    <?php echo $isReadOnly ? 'disabled' : ''; ?>>
                <label for="others">Others</label>
            </div>
            <label for="inputState" class="form-label" >*Are you a PWD?</label>
            <select  class="form-control" data-mdb-select-init name="PWD" <?= $isReadOnly ? 'disabled' : '' ?>>
                <option value=""><?php echo htmlspecialchars($PWD) ?></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>

            <button type="submit" class="btn <?= htmlspecialchars($buttonClass) ?>" name="saveMedical" value="<?= htmlspecialchars($buttonText) ?>"><?= htmlspecialchars($buttonText) ?></button>
        </form>
    </main>
    <!-- Modal HTML -->
<div class="modal fade" id="resetModal" tabindex="-1" aria-labelledby="resetModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resetModalLabel">Confirm Reset</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to reset the personal information? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <form method="POST" id="resetForm">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="saveMedical" value="Reset Medical Information" class="btn btn-danger">Reset</button>
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
            <div class="modal-body" id="modalBodyContent">
                Your personal information has been saved successfully.

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
                Your personal information has been successfully reset.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="goToApplicationFormAfterReset">OK</button>
            </div>
        </div>
    </div>
</div>
<!-- Error Modal -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="errorModalLabel">Error</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php echo htmlspecialchars($formError); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script src="medical.js"></script>
</body>
</html>
