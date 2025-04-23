<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>CvSU IMUS</title>  
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,900;1,500&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@400&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montagu+Slab:wght@700&display=swap">
    <link rel="stylesheet" href="personal.css">
</head>
<body>
<?php 
include 'Header.php';
include 'dbconn.php'; 
session_start();

$email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : '';
if ($email) {
    $firstName = $middleName = $lastName = $suffix = $region = $province = $town = $barangay = $street = $zipCode = $cellphoneNumber = $landline = $civilStatus = $sex = $dateOfBirth = $placeOfBirth = $religion = $indigenous = '';
    $isReadOnly = false;
    $buttonText = "Save Personal Information";
    $buttonClass = "btn-success";
    $formError = '';

    if (isset($_POST['savePersonal'])) {
        if ($_POST['savePersonal'] === "Reset Personal Information") {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                var resetModal = new bootstrap.Modal(document.getElementById('resetModal'));
                resetModal.show();
            });
            </script>";
        } else {
         
            $firstName = isset($_POST['FirstName']) ? $_POST['FirstName'] : '';
            $middleName = isset($_POST['MiddleName']) ? $_POST['MiddleName'] : '';
            $lastName = isset($_POST['LastName']) ? $_POST['LastName'] : '';
            $suffix = isset($_POST['Suffix']) ? $_POST['Suffix'] : '';
            $region = isset($_POST['Region']) ? $_POST['Region'] : '';
            $province = isset($_POST['Province']) ? htmlspecialchars($_POST['Province']) : '';
            $town = isset($_POST['Town']) ? htmlspecialchars($_POST['Town']) : '';

            $barangay = isset($_POST['Barangay']) ? $_POST['Barangay'] : '';
            $street = isset($_POST['Street']) ? $_POST['Street'] : '';
            $zipCode = isset($_POST['ZipCode']) ? $_POST['ZipCode'] : '';
            $cellphoneNumber = isset($_POST['CellphoneNumber']) ? $_POST['CellphoneNumber'] : '';
            $landline = isset($_POST['LandlineNumber']) ? $_POST['LandlineNumber'] : '';
            $civilStatus = isset($_POST['CivilStatus']) ? $_POST['CivilStatus'] : '';
            $sex = isset($_POST['Sex']) ? $_POST['Sex'] : '';
            $dateOfBirth = isset($_POST['DateOfBirth']) ? $_POST['DateOfBirth'] : '';
            $placeOfBirth = isset($_POST['PlaceOfBirth']) ? $_POST['PlaceOfBirth'] : '';
            $religion = isset($_POST['Religion']) ? $_POST['Religion'] : '';
            $indigenous = isset($_POST['Indigenous']) ? $_POST['Indigenous'] : '';
            

            
            if (empty($firstName) || empty($lastName) || empty($region) || empty($province) || empty($town) || empty($barangay) || empty($street) || empty($zipCode) || empty($cellphoneNumber) || empty($dateOfBirth) || empty($placeOfBirth) || empty($indigenous)) {
                $formError = 'Please fill out all required fields.';
                echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                    errorModal.show();
                });
                </script>";


            } else {
                $stmt = $conn->prepare("SELECT userID FROM useraccount WHERE email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result && $result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $userID = $row['userID'];

                    $stmt = $conn->prepare("INSERT INTO personalinfo (userID, FirstName, MiddleName, LastName, Suffix, Region, Province, Town, Barangay, Street, ZipCode, CellphoneNumber, LandlineNumber, CivilStatus, Sex, DateOfBirth, PlaceOfBirth, Religion, Indigenous) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                    ON DUPLICATE KEY UPDATE FirstName = VALUES(FirstName), MiddleName = VALUES(MiddleName), LastName = VALUES(LastName), Suffix = VALUES(Suffix), Region = VALUES(Region), Province = VALUES(Province), Town = VALUES(Town), Barangay = VALUES(Barangay), Street = VALUES(Street), ZipCode = VALUES(ZipCode), CellphoneNumber = VALUES(CellphoneNumber), LandlineNumber = VALUES(LandlineNumber), CivilStatus = VALUES(CivilStatus), Sex = VALUES(Sex), DateOfBirth = VALUES(DateOfBirth), PlaceOfBirth = VALUES(PlaceOfBirth), Religion = VALUES(Religion), Indigenous = VALUES(Indigenous)");
                
                $stmt->bind_param("issssssssssssssssss", $userID, $firstName, $middleName, $lastName, $suffix, $region, $province, $town, $barangay, $street, $zipCode, $cellphoneNumber, $landline, $civilStatus, $sex, $dateOfBirth, $placeOfBirth, $religion, $indigenous);
                

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
                        echo "<script>alert('Error saving personal information: " . $stmt->error . "');</script>";
                    }
                } else {
                    echo "<script>alert('User not found.');</script>";
                }
            }
        }
    } else {
        $stmt = $conn->prepare("SELECT * FROM personalinfo WHERE userID = (SELECT userID FROM useraccount WHERE email = ?)");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $firstName = $row['FirstName'];
            $middleName = $row['MiddleName'];
            $lastName = $row['LastName'];
            $suffix = $row['Suffix'];
            $region = $row['Region'];
            $province = $row['Province'];
            $town = $row['Town'];
            $barangay = $row['Barangay'];
            $street = $row['Street'];
            $zipCode = $row['ZipCode'];
            $cellphoneNumber = $row['CellphoneNumber'];
            $landline = $row['LandlineNumber'];
            $civilStatus = $row['CivilStatus'];
            $sex = $row['Sex'];
            $dateOfBirth = $row['DateOfBirth'];
            $placeOfBirth = $row['PlaceOfBirth'];
            $religion = $row['Religion'];
            $indigenous = $row['Indigenous'];
            $isReadOnly = true;
            $buttonText = "Reset Personal Information"; 
            $buttonClass = "btn-danger"; 
        }
    }
}

?>

      
<div class="container mt-4">
    <div class="required">
         <p>* - required fields</p>
    </div>
<h2>Personal Information</h2>
        
<form method="POST" id="personalForm">
        <div class="row">
            <div class="col-md-4">
                <label for="first-name">*First Name</label>
                <input type="text" id="first-name" class="form-control" name="FirstName" value="<?= htmlspecialchars($firstName) ?>" required <?= $isReadOnly ? 'readonly' : '' ?>>
            </div>

            <div class="col-md-3">
                <label for="middle-name">Middle Name</label>
                <input type="text" id="middle-name" class="form-control" name="MiddleName" value="<?= htmlspecialchars($middleName) ?>" <?= $isReadOnly ? 'readonly' : '' ?>>
            </div>

            <div class="col-md-4">
                <label for="last-name">*Last Name</label>
                <input type="text" id="last-name" class="form-control" name="LastName" value="<?= htmlspecialchars($lastName) ?>" required <?= $isReadOnly ? 'readonly' : '' ?>>
            </div>

            <div class="col-md-1">
                <label for="suffix">Suffix</label>
                <select id="suffix" class="form-control" name="Suffix"  <?= $isReadOnly ? 'disabled' : '' ?>>
                    <option value=""></option>
                    <option value="Jr" <?php echo $suffix == 'Jr' ? 'selected' : ''; ?>>Jr</option>
                    <option value="Sr" <?php echo $suffix == 'Sr' ? 'selected' : ''; ?>>Sr</option>
                    <option value="II" <?php echo $suffix == 'II' ? 'selected' : ''; ?>>II</option>
                    <option value="III" <?php echo $suffix == 'III' ? 'selected' : ''; ?>>III</option>
                </select>
                <br>
            </div>

            <div class="col-md-2">
                <label for="region">*Region</label>
                <select id="region" class="form-control" name="Region" onchange="updateProvinces()" required  <?= $isReadOnly ? 'disabled' : '' ?>>
                    <option value=""></option>
                    <option value="NCR" <?php echo $region == 'NCR' ? 'selected' : ''; ?>>National Capital Region (NCR)</option>
                    <option value="CAR" <?php echo $region == 'CAR' ? 'selected' : ''; ?>>Cordillera Administrative Region (CAR)</option>
                    <option value="I" <?php echo $region == 'I' ? 'selected' : ''; ?>>Ilocos Region (Region I)</option>
                    <option value="II" <?php echo $region == 'II' ? 'selected' : ''; ?>>Cagayan Valley (Region II)</option>
                    <option value="III" <?php echo $region == 'III' ? 'selected' : ''; ?>>Central Luzon (Region III)</option>
                    <option value="IVA" <?php echo $region == 'IVA' ? 'selected' : ''; ?>>CALABARZON (Region IV-A)</option>
                    <option value="IVB" <?php echo $region == 'IVB' ? 'selected' : ''; ?>>MIMAROPA (Region IV-B)</option>
                    <option value="V" <?php echo $region == 'V' ? 'selected' : ''; ?>>Bicol Region (Region V)</option>
                    <option value="VI" <?php echo $region == 'VI' ? 'selected' : ''; ?>>Western Visayas (Region VI)</option>
                    <option value="VII" <?php echo $region == 'VII' ? 'selected' : ''; ?>>Central Visayas (Region VII)</option>
                    <option value="VIII" <?php echo $region == 'VIII' ? 'selected' : ''; ?>>Eastern Visayas (Region VIII)</option>
                    <option value="IX" <?php echo $region == 'IX' ? 'selected' : ''; ?>>Zamboanga Peninsula (Region IX)</option>
                    <option value="X" <?php echo $region == 'X' ? 'selected' : ''; ?>>Northern Mindanao (Region X)</option>
                    <option value="XI" <?php echo $region == 'XI' ? 'selected' : ''; ?>>Davao Region (Region XI)</option>
                    <option value="XII" <?php echo $region == 'XII' ? 'selected' : ''; ?>>SOCCSKSARGEN (Region XII)</option>
                    <option value="XIII" <?php echo $region == 'XIII' ? 'selected' : ''; ?>>Caraga (Region XIII)</option>
                    <option value="BARMM" <?php echo $region == 'BARMM' ? 'selected' : ''; ?>>Bangsamoro Autonomous Region in Muslim Mindanao (BARMM)</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="province">*Province</label>
                <select id="province" class="form-control" name="Province" required <?= $isReadOnly ? 'disabled' : '' ?>>
                    <option value=""><?php echo htmlspecialchars($province)?></option>
                    
                </select>
            </div>

            <div class="col-md-2">
                <label for="town">*Town</label>
                <select id="town" class="form-control" name="Town" required <?= $isReadOnly ? 'disabled' : '' ?>>
                    <option value=""><?php echo htmlspecialchars($town) ?></option>
                   
                </select>
            </div>


            <div class="col-md-2">
                <label for="barangay">*Barangay</label>
                <input type="text" id="barangay" class="form-control" name="Barangay" value="<?= htmlspecialchars($barangay) ?>" required <?= $isReadOnly ? 'readonly' : '' ?>>
        
            </div>

            <div class="col-md-2">
                <label for="street">*Street</label>
                <input type="text" id="street" class="form-control" name="Street" value="<?= htmlspecialchars($street) ?>" required <?= $isReadOnly ? 'readonly' : '' ?>>
          
            </div>

            <div class="col-md-2">
                <label for="zip-code">*Zip Code</label>
                <input type="text" id="zip-code" class="form-control" name="ZipCode" value="<?php echo htmlspecialchars($zipCode); ?>" readonly>
                <br>
            </div>

            <div class="col-md-4">
                <label for="cellphone-number">*Cellphone Number (11-digit format)</label>
                <input type="tel" id="cellphone-number" class="form-control" pattern="\d{11}" maxlength="11" name="CellphoneNumber" value="<?= htmlspecialchars($cellphoneNumber) ?>" required <?= $isReadOnly ? 'readonly' : '' ?>>
          
            </div>

            <div class="col-md-4">
                <label for="landline">Landline Number</label>
                <input type="tel" id="landline" class="form-control" pattern="\d*" maxlength="15" oninput="validateNumber(this)" name="LandlineNumber" value="<?= htmlspecialchars($landline) ?>"  <?= $isReadOnly ? 'readonly' : '' ?>>
           
            </div>

            <div class="col-md-2">
                <label for="civil-status">Civil Status</label>
                <select id="civil-status" class="form-control" name="CivilStatus" <?= $isReadOnly ? 'disabled' : '' ?>>
                    <option value=""></option>
                    <option value="Single" <?php echo $civilStatus == 'Single' ? 'selected' : ''; ?>>Single</option>
                    <option value="Married" <?php echo $civilStatus == 'Married' ? 'selected' : ''; ?>>Married</option>
                    <option value="Widowed" <?php echo $civilStatus == 'Widowed' ? 'selected' : ''; ?>>Widowed</option>
                    <option value="Divorced" <?php echo $civilStatus == 'Divorced' ? 'selected' : ''; ?>>Divorced</option>
                    <option value="Separated" <?php echo $civilStatus == 'Separated' ? 'selected' : ''; ?>>Separated</option>
                </select>
            </div>

            <div class="col-md-2">
                <label for="sex">Sex</label>
                <select id="sex" class="form-control" name="Sex" <?= $isReadOnly ? 'disabled' : '' ?>>
                    <option value=""></option>
                    <option value="Male" <?php echo $sex == 'Male' ? 'selected' : ''; ?>>Male</option>
                    <option value="Female" <?php echo $sex == 'Female' ? 'selected' : ''; ?>>Female</option>
                    <option value="prefer-not-to-say" <?php echo $sex == 'prefer-not-to-say' ? 'selected' : ''; ?>>Prefer Not to Say</option>
                </select>
                <br>
            </div>

            <div class="col-md-3">
                <label for="date-of-birth">*Date of Birth</label>
                <input type="date" id="date-of-birth" name="DateOfBirth" class="form-control" value="<?= htmlspecialchars($dateOfBirth) ?>" required <?= $isReadOnly ? 'readonly' : '' ?>>
            </div>

            <div class="col-md-3">
                <label for="place-of-birth">*Place of Birth</label>
                <input type="text" id="place-of-birth" name="PlaceOfBirth" class="form-control" value="<?= htmlspecialchars($placeOfBirth) ?>" required <?= $isReadOnly ? 'readonly' : '' ?>>
            </div>

            <div class="col-md-3">
                <label for="religion">Religion</label>
                <input type="text" id="religion" name="Religion" class="form-control" value="<?= htmlspecialchars($religion) ?>"  <?= $isReadOnly ? 'readonly' : '' ?>>
            </div>

            <div class="col-md-3">
                <label for="indigenous">*Are you from an indigenous tribe?</label>
                <select id="indigenous" name="Indigenous" class="form-control" <?= $isReadOnly ? 'disabled' : '' ?>> required>
                    <option value=""></option>
                    <option value="Yes" <?php echo $indigenous == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                    <option value="No" <?php echo $indigenous == 'No' ? 'selected' : ''; ?>>No</option>
                </select>
            </div>
        </div>
        <br><br>
        <button type="submit" class="btn <?= htmlspecialchars($buttonClass) ?>" name="savePersonal" value="<?= htmlspecialchars($buttonText) ?>"><?= htmlspecialchars($buttonText) ?></button>
                 
        </div>
    </div>
</form>


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
                    <button type="submit" name="savePersonal" value="Reset Personal Information" class="btn btn-danger">Reset</button>
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
  <script src="personal.js">
    
  </script>
  
  
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
document.addEventListener('DOMContentLoaded', function() {
    const dateOfBirthInput = document.getElementById('date-of-birth');

    dateOfBirthInput.addEventListener('change', function() {
        // Check if the input is a valid date
        const inputDate = new Date(this.value);
        const today = new Date();
        
        // Check if the date input is valid
        if (isNaN(inputDate.getTime()) || inputDate > today) {
            alert('Please enter a valid date.');
            this.value = '';
            return;
        }
        
        const minAge = 16;
        const age = today.getFullYear() - inputDate.getFullYear();
        const monthDifference = today.getMonth() - inputDate.getMonth();
        
        if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < inputDate.getDate())) {
            age--;
        }
        
        // Check if the age is less than the minimum required
        if (age < minAge) {
            alert(`You must be at least ${minAge} years old.`);
            this.value = '';
        }
    });
});

  </script>
</body>
</html>
