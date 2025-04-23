<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Educational Background</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700&display=swap"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,900;1,500&display=swap"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@400&display=swap"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montagu+Slab:wght@700&display=swap"/>

</head>
<body>
<?php 
include 'Header.php';
include 'dbconn.php'; 
session_start();

$email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : '';
if ($email) {
    $elemSchoolName = $elemSchoolAddress = $elemYearGraduated = $elemType = $highSchoolName = $highSchoolAddress = $highSchoolGraduated = $highSchoolType = $shsName = $shsAddress = $shsYearGraduated = $shsType = $vocName = $vocAddress = $vocYearGraduated = $vocType = '';
    $isReadOnly = false;
    $buttonText = "Save Educational Information";
    $buttonClass = "btn-success";
    $formError = '';

    if (isset($_POST['saveEducational'])) {
        if ($_POST['saveEducational'] === "Reset Educational Information") {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                var resetModal = new bootstrap.Modal(document.getElementById('resetModal'));
                resetModal.show();
            });
            </script>";
        } else {
         
            $elemSchoolName = isset($_POST['ElemSchoolName']) ? $_POST['ElemSchoolName'] : '';
            $elemSchoolAddress = isset($_POST['ElemSchoolAddress']) ? $_POST['ElemSchoolAddress'] : '';
            $elemYearGraduated = isset($_POST['ElemYearGraduated']) ? $_POST['ElemYearGraduated'] : '';
            $elemType = isset($_POST['ElemType']) ? $_POST['ElemType'] : '';
            $highSchoolName = isset($_POST['HighSchoolName']) ? $_POST['HighSchoolName'] : '';
            $highSchoolAddress = isset($_POST['HighSchoolAddress']) ? $_POST['HighSchoolAddress'] : '';
            $highSchoolGraduated = isset($_POST['HighSchoolGraduated']) ? $_POST['HighSchoolGraduated'] : '';
            $highSchoolType = isset($_POST['HighSchoolType']) ? $_POST['HighSchoolType'] : '';
            $shsName = isset($_POST['SHSName']) ? $_POST['SHSName'] : '';
            $shsAddress = isset($_POST['SHSAddress']) ? $_POST['SHSAddress'] : '';
            $shsYearGraduated = isset($_POST['SHSYearGraduated']) ? $_POST['SHSYearGraduated'] : '';
            $shsType = isset($_POST['SHSType']) ? $_POST['SHSType'] : '';
            $vocName = isset($_POST['VocName']) ? $_POST['VocName'] : '';
            $vocAddress = isset($_POST['VocAddress']) ? $_POST['VocAddress'] : '';
            $vocYearGraduated = isset($_POST['VocYearGraduated']) ? $_POST['VocYearGraduated'] : '';
            $vocType = isset($_POST['VocType']) ? $_POST['VocType'] : '';
            

            
            if (empty($elemSchoolName) || empty($elemSchoolAddress) || empty($elemYearGraduated) || empty($elemType) || empty($highSchoolName) || empty($highSchoolAddress) || empty($highSchoolGraduated) || empty($highSchoolType) || empty($shsName) || empty($shsAddress) || empty($shsYearGraduated) || empty($shsType)) {
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

                    $stmt = $conn->prepare("INSERT INTO educationalbackground (userID, ElemSchoolName, ElemSchoolAddress, ElemYearGraduated, ElemType, HighSchoolName, HighSchoolAddress, HighSchoolGraduated, HighSchoolType, SHSName, SHSAddress, SHSYearGraduated, SHSTYPE, VocName, VocAddress, VocYearGraduated, VocType) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                  $stmt->bind_param("issssssssssssssss", $userID, $elemSchoolName, $elemSchoolAddress, $elemYearGraduated, $elemType, $highSchoolName, $highSchoolAddress, $highSchoolGraduated, $highSchoolType, $shsName, $shsAddress, $shsYearGraduated, $shsType, $vocName, $vocAddress, $vocYearGraduated, $vocType);

                
               
            
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
        $stmt = $conn->prepare("SELECT * FROM educationalbackground WHERE userID = (SELECT userID FROM useraccount WHERE email = ?)");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $elemSchoolName = $row['ElemSchoolName'];
            $elemSchoolAddress = $row['ElemSchoolAddress'];
            $elemYearGraduated = $row['ElemYearGraduated'];
            $elemType = $row['ElemType'];
            $highSchoolName = $row['HighSchoolName'];
            $highSchoolAddress = $row['HighSchoolAddress'];
            $highSchoolGraduated = $row['HighSchoolGraduated'];
            $highSchoolType = $row['HighSchoolType'];
            $shsName = $row['SHSName'];
            $shsAddress = $row['SHSAddress'];
            $shsYearGraduated = $row['SHSYearGraduated'];
            $shsType = $row['SHSType'];
            $vocName = $row['VocName'];
            $vocAddress = $row['VocAddress'];
            $vocYearGraduated = $row['VocYearGraduated'];
            $vocType = $row['VocType'];
            $isReadOnly = true;
            $buttonText = "Reset Educational Information"; 
            $buttonClass = "btn-danger"; 
        }
    }
}

?>
                <div class="content" id="content">
                <div class="container"> <br>
                    <p style="color: red;"><b>* -required fields</b></p>
                    <p style="font-size: 20px;"><b>Educational Background</b></p>
                    <form class="row g-3" method="POST">

                        <h6>Elementary</h6>
                        <div class="col-md-4">
                            <label for="inputZip" class="form-label">*School Name</label>
                            <input type="text" class="form-control" id="inputZip" name="ElemSchoolName" value="<?= htmlspecialchars($elemSchoolName) ?>" required <?= $isReadOnly ? 'disabled' : '' ?>>
                        </div>
                        <div class="col-md-4">
                            <label for="inputZip" class="form-label">*School Address</label>
                            <input type="text" class="form-control" id="inputZip" name="ElemSchoolAddress" value="<?= htmlspecialchars($elemSchoolAddress) ?>" required <?= $isReadOnly ? 'disabled' : '' ?>>
                        </div>
                        <div class="col-md-2">
                            <label for="inputState" class="form-label">*Year Graduated</label>
                            <select id="inputState" class="form-control" name="ElemYearGraduated"<?= $isReadOnly ? 'disabled' : '' ?>> >
                                <option value=""><?php echo htmlspecialchars($elemYearGraduated)?></option>
                                <option>2025</option>
                                <option>2024</option>
                                <option>2023</option>
                                <option>2022</option>
                                <option>2021</option>
                                <option>2020</option>
                                <option>2019</option>
                                <option>2018</option>
                                <option>2017</option>
                                <option>2016</option>
                                <option>2015</option>
                                <option>2014</option>
                                <option>2013</option>
                                <option>2012</option>
                                <option>2011</option>
                                <option>2010</option>
                                <option>2009</option>
                                <option>2008</option>
                                <option>2007</option>
                                <option>2006</option>
                                <option>2005</option>
                                <option>2004</option>
                                <option>2003</option>
                                <option>2002</option>
                                <option>2001</option>
                                <option>2000</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="inputState" class="form-label">*Type</label>
                            <select id="inputState" class="form-control" name="ElemType" <?= $isReadOnly ? 'disabled' : '' ?>>
                                <option value=""><?php echo htmlspecialchars($elemType)?></option>
                                <option>Public</option>
                                <option>Private</option>
                            </select>
                        </div>
                        <hr>

                        <h6>High School</h6>
                        <div class="col-md-4">
                            <label for="inputZip" class="form-label">*School Name</label>
                            <input type="text" class="form-control" id="inputZip" name="HighSchoolName" value="<?= htmlspecialchars($highSchoolName) ?>" required <?= $isReadOnly ? 'disabled' : '' ?>>
                        </div>
                        <div class="col-md-4">
                            <label for="inputZip" class="form-label">*School Address</label>
                            <input type="text" class="form-control" id="inputZip" name="HighSchoolAddress" value="<?= htmlspecialchars($highSchoolAddress) ?>" required <?= $isReadOnly ? 'disabled' : '' ?>>
                        </div>
                        <div class="col-md-2">
                            <label for="inputState" class="form-label">*Year Graduated</label>
                            <select id="inputState" class="form-control" name="HighSchoolGraduated" <?= $isReadOnly ? 'disabled' : '' ?>>
                                <option value=""> <?php echo htmlspecialchars($highSchoolGraduated)?></option>
                                <option>2025</option>
                                <option>2024</option>
                                <option>2023</option>
                                <option>2022</option>
                                <option>2021</option>
                                <option>2020</option>
                                <option>2019</option>
                                <option>2018</option>
                                <option>2017</option>
                                <option>2016</option>
                                <option>2015</option>
                                <option>2014</option>
                                <option>2013</option>
                                <option>2012</option>
                                <option>2011</option>
                                <option>2010</option>
                                <option>2009</option>
                                <option>2008</option>
                                <option>2007</option>
                                <option>2006</option>
                                <option>2005</option>
                                <option>2004</option>
                                <option>2003</option>
                                <option>2002</option>
                                <option>2001</option>
                                <option>2000</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="inputState" class="form-label">*Type</label>
                            <select id="inputState" class="form-control" name="HighSchoolType" value="<?= htmlspecialchars($highSchoolType) ?>" required <?= $isReadOnly ? 'disabled' : '' ?>>
                                <option value=""><?php echo htmlspecialchars($highSchoolType)?></option>
                                <option>Public</option>
                                <option>Private</option>
                            </select>
                        </div>

                        <hr>

                        <h6>Senior High School</h6>
                        <div class="col-md-4">
                            <label for="inputZip" class="form-label">*School Name</label>
                            <input type="text" class="form-control" id="inputZip" name="SHSName" value="<?= htmlspecialchars($shsName) ?>" required <?= $isReadOnly ? 'disabled' : '' ?>>
                        </div>
                        <div class="col-md-4">
                            <label for="inputZip" class="form-label">*School Address</label>
                            <input type="text" class="form-control" id="inputZip" name="SHSAddress" value="<?= htmlspecialchars($shsAddress) ?>" required <?= $isReadOnly ? 'disabled' : '' ?>>
                        </div>
                        <div class="col-md-2">
                            <label for="inputState" class="form-label">*Year Graduated</label>
                            <select id="inputState" class="form-control" name="SHSYearGraduated"  <?= $isReadOnly ? 'disabled' : '' ?>>
                                <option value=""> <?php echo htmlspecialchars($shsYearGraduated)?></option>
                                <option>2025</option>
                                <option>2024</option>
                                <option>2023</option>
                                <option>2022</option>
                                <option>2021</option>
                                <option>2020</option>
                                <option>2019</option>
                                <option>2018</option>
                                <option>2017</option>
                                <option>2016</option>
                                <option>2015</option>
                                <option>2014</option>
                                <option>2013</option>
                                <option>2012</option>
                                <option>2011</option>
                                <option>2010</option>
                                <option>2009</option>
                                <option>2008</option>
                                <option>2007</option>
                                <option>2006</option>
                                <option>2005</option>
                                <option>2004</option>
                                <option>2003</option>
                                <option>2002</option>
                                <option>2001</option>
                                <option>2000</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="inputState" class="form-label">*Type</label>
                            <select id="inputState" class="form-control" name="SHSType" value="<?= htmlspecialchars($shsType) ?>" required <?= $isReadOnly ? 'disabled' : '' ?>>
                                <option value=""><?php echo htmlspecialchars($shsType)?></option>
                                <option>Public</option>
                                <option>Private</option>
                            </select>
                        </div>

                        <hr>

                        <h6>Vocational</h6>
                        <div class="col-md-4">
                            <label for="inputZip" class="form-label">School Name</label>
                            <input type="text" class="form-control" id="inputZip" name="VocName" value="<?= htmlspecialchars($vocName) ?>"  <?= $isReadOnly ? 'disabled' : '' ?>>
                        </div>
                        <div class="col-md-4">
                            <label for="inputZip" class="form-label">School Address</label>
                            <input type="text" class="form-control" id="inputZip" name="VocAddress" value="<?= htmlspecialchars($vocAddress) ?>"  <?= $isReadOnly ? 'disabled' : '' ?>>
                        </div>
                        <div class="col-md-2">
                            <label for="inputState" class="form-label">Year Graduated</label>
                            <select id="inputState" class="form-control" name="VocYearGraduated" value="<?= htmlspecialchars($vocType) ?>"  <?= $isReadOnly ? 'disabled' : '' ?>>
                                <option value=""><?php echo htmlspecialchars($vocYearGraduated)?></option>
                                <option>2025</option>
                                <option>2024</option> 
                                <option>2023</option>
                                <option>2022</option>
                                <option>2021</option>
                                <option>2020</option>
                                <option>2019</option>
                                <option>2018</option>
                                <option>2017</option>
                                <option>2016</option>
                                <option>2015</option>
                                <option>2014</option>
                                <option>2013</option>
                                <option>2012</option>
                                <option>2011</option>
                                <option>2010</option>
                                <option>2009</option>
                                <option>2008</option>
                                <option>2007</option>
                                <option>2006</option>
                                <option>2005</option>
                                <option>2004</option>
                                <option>2003</option>
                                <option>2002</option>
                                <option>2001</option>
                                <option>2000</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="inputState" class="form-label">Type</label>
                            <select id="inputState" class="form-control" name="VocType" value="<?= htmlspecialchars($vocType) ?>"  <?= $isReadOnly ? 'disabled' : '' ?>>
                            <option value=""><?php echo htmlspecialchars($vocType)?></option>
                                <option>Public</option>
                                <option>Private</option>
                            </select>
                        </div>

                        <div class="col-12">
                        <button type="submit" class="btn <?= htmlspecialchars($buttonClass) ?>" name="saveEducational" value="<?= htmlspecialchars($buttonText) ?>"><?= htmlspecialchars($buttonText) ?></button>
     
                        </div>
                    </form>
                </div>
            </div>
        </div>
<!-- Modal HTML -->
<div class="modal fade" id="resetModal" tabindex="-1" aria-labelledby="resetModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resetModalLabel">Confirm Reset</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to reset the educational information? This action cannot be undone.
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
                Your educational information has been saved successfully.

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
                Your educational information has been successfully reset.
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
        <script src="educational.js">

        </script>
    </body>
    </html>
    
