<?php
include "dbcon.php";

$sql = "SELECT * FROM useraccount";

$sql2 = "SELECT * FROM admin_booking";

$result1 = mysqli_query($conn, $sql2);

$result = mysqli_query($conn, $sql);

?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="initial-scale=1, width=device-width" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="./global.css" />
  <link rel="stylesheet" href="./AdminNotification.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;900&display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@400&display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montagu+Slab:wght@700&display=swap" />
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
  <style>

  body {
    margin: 0;
    font-family: Arial, sans-serif;
}

.header {
    background-color: white;
    border-bottom: 1px solid #ddd;
    width: 100%;
    padding: 10px 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    position: relative; 
}

.header-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.header h1 {
    margin: 0;
    font-size: 24px;
}

.notification-container {
    position: relative;
}

.notification-btn {
    background: #007bff;
    color: #fff;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
    position: absolute;
    top: 10px;
    left: 20px;
}

.notification {
    position: absolute;
    top: 50px; 
    left: 0;  
    background-color: #333;
    color: #fff;
    padding: 10px;
    border-radius: 5px;
    display: none;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    z-index: 1000;
    opacity: 0;
    transform: translateY(-10px);
    transition: opacity 0.3s, transform 0.3s;
}

.notification.show {
    display: block;
    opacity: 1;
    transform: translateY(0);
}

.close-btn {
    background: none;
    border: none;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
    position: absolute;
    top: 5px;
    right: 10px;
}

@media (max-width: 768px) {
    .header-container {
        flex-direction: column;
        align-items: flex-start;
    }

    .header h1 {
        font-size: 20px;
    }

    .notification-btn {
        margin-top: 10px;
        position: static; 
    }
}


</style>
  </style>
<header class="header">
        <div class="header-container">
            <h1>Notification</h1>
            
        </div>
    </header>
    <br><br><br><br><br>

    <!-- Main -->
    <div class="main-container">
      <div class="container">
      <div class="container-fluid mt-4 ">
        <div class="accordion" id="accordionExample">
          <div class="accordion-item accordion-item-border">
            <h2 class="accordion-header">
              <span style="padding: 0px 0px 0px 19px;">Recent Notification</span>
              </h2>
              <div class="overflow-auto" style="height: 40rem;">
              <?php
                   if ($result->num_rows > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                      $original_datetime_set = $row['created_at'];
                      $timestamp_set = strtotime($original_datetime_set);
                      $formatted_datetime_set = date("n/j/Y - g:i A", $timestamp_set);
                      echo'
                      <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne'.$row['control_number'].'" aria-expanded="false" aria-controls="collapseOne">
                        <img src="./public/frame-42@2x.png" style="height: 50px;width: 50px;" alt="Recent Notification Icon"/>
                        <div class="row">
                          <div class="col-md-12"><b style="padding: 0px 0px 0px 15px;">Hello Admin, New Examinee Registered!</b></div>
                          <div class="col-md-12"><p style="padding: 0px 0px 0px 15px;">'.$formatted_datetime_set.'</div>
                        </div>
                      </button>
                    
                    <div id="collapseOne'.$row['control_number'].'" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                      <div class="accordion-body" style="font-size: 20px;">
                        <b>Hello Admin!</b> <br> 

                       <p> Examinee '.$row['control_number'].' is now registered. Schedule them now! <a href="AdminManageExaminee.php">Click Here!</a></p>
                    </div>
                  </div>
                 ';
              }
            }
            ?>
            </div>
            <div class="container mx-auto mt-8 max-w-5xl" id="ap-report__overview"></div>
                    <div class="container mx-auto mt-8 max-w-5xl" id="ap-report-tab-container"></div>
            
             </div>
          <!-- <div class="accordion-item accordion-item-border">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                <img src="./public/add-user-group-woman-man@2x.png" style="height: 50px;width: 50px;background-color: #001133; border-radius: 5px;" alt="New Registered Students Icon"/>
                <div class="row">
                  <div class="col-md-12"><b style="padding: 0px 0px 0px 15px;">New Registered Students</b></div>
                  <div class="col-md-12"><p style="padding: 0px 0px 0px 15px;">10/21/23 - 02:45pm</p></div>
                </div>
              </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
              <div class="accordion-body" style="font-size: 20px;">
                <b>Hello Admin!</b> <br>
                <p>Just a heads-up that we have new registered students for the upcoming online entrance exam.</p>
                <p><b>Details:</b></p>
                <ul>
                  <li><b>Student ID:</b> 202210291</li>
                  <li><b>Name:</b> Juan Carlos Dela-Cruz</li>
                  <li><b>Reminder:</b> Please ensure all new students are properly enrolled and have access to necessary exam information.</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="accordion-item accordion-item-border">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                <img src="./public/envelope-dots@2x.png" style="height: 50px;width: 50px;background-color: #001133; border-radius: 5px;" alt="New Message Icon"/>
                <div class="row">
                  <div class="col-md-12"><b style="padding: 0px 0px 0px 15px;">New Message</b></div>
                  <div class="col-md-12"><p style="padding: 0px 0px 0px 15px;">03/09/23 - 07:00am</p></div>
                </div>
              </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
              <div class="accordion-body" style="font-size: 20px;">
                <b>Hello Admin!</b> <br>
                <p>You have new messages awaiting your attention. Please log in to your account to view and respond to them.</p>
              </div>
            </div>
          </div>
          <div class="accordion-item accordion-item-border">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                <img src="./public/total-sales@2x.png" style="height: 50px;width: 50px;background-color: #001133; border-radius: 5px;" alt="Number of Students Icon"/>
                <div class="row">
                  <div class="col-md-12"><b style="padding: 0px 0px 0px 15px;">Number of Students</b></div>
                  <div class="col-md-12"><p style="padding: 0px 0px 0px 15px;">05/18/23 - 11:00am</p></div>
                </div>
              </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
              <div class="accordion-body" style="font-size: 20px;">
                <b>Hello Admin!</b> <br>
                <p>The total number of students registered for the upcoming online entrance exam is [number].</p>
              </div>
            </div>
          </div> -->
          
          <div>&nbsp;</div>
        </div>
      </div>
    </div>
  </div>
  <div class="arrow-left-group" id="frameContainer">
<a href="AdminDashboard.php" style="color: black; text-decoration:none;"><img class="arrow-left-icon1" alt="Back Arrow" src="public/16--arrowleft.svg" />

</div>


  <script>
    var buttonText = document.getElementById("buttonText");
    if (buttonText) {
      buttonText.addEventListener("click", function () {
        window.location.href = "./Component.html";
      });
    }

    var frameContainer = document.getElementById("frameContainer");
    if (frameContainer) {
      frameContainer.addEventListener("click", function () {
        window.location.href = "./Component.html";
      });
    }
    document.body.style.zoom = "80%";
  </script>
</body>
</html>