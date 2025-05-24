<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="global.css" />
    <link rel="stylesheet" href="try.css" />
    <link rel="stylesheet" href="AdminNotification.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;900&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" />
    <link rel="stylesheet" href="SPEL.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
    <script src="https://cdn.autoproctor.co/ap-entry.js"></script>
    <style>
        /* Additional styling */
        .notification {
            display: none;
            position: absolute;
            top: 50px;
            right: 20px;
            width: 300px;
            z-index: 1000;
        }

        .notification.show {
            display: block;
        }

        .close-btn {
            cursor: pointer;
        }

        .note {
            margin-top: 20px;
            padding: 10px;
            background-color: #f9f9f9;
            border-left: 5px solid #007bff;
            text-align: left;
            margin-left: -10px;
        }

        #report-container {
            margin-top: 20px;
            padding: 10px;
            background-color: #f1f1f1;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <header>
        <div class="header-container">
            <h1>Student Portal</h1>
            <div class="notification-container">
                <button id="notificationBtn" class="notification-btn">Student Notification</button>
                <div id="notification" class="notification">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                <img src="./public/frame-42@2x.png" alt="Recent Notification Icon" />
                                <div class="row">
                                    <div class="col-md-12"><b>Online Entrance Exam Schedule</b></div>
                                    <div class="col-md-12">
                                        <p>10/21/23 - 02:45pm</p>
                                    </div>
                                </div>
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <b>Hello, John Doe</b> <br>
                                <p><b>Exam Details:</b></p>
                                <ul>
                                    <li><b>Date:</b> 10/25/23</li>
                                    <li><b>Time:</b> 09:00am</li>
                                    <li><b>Duration:</b> One Hour</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <button class="close-btn">&times;</button>
                </div>
            </div>
            <div id="ap-proctoring-container">
                <div class="ctas">
                    <button id="btn-start">Start</button>
                    <button id="btn-stop" disabled>Stop</button>
                </div>
                <div class="note">
                    <p><strong>Note:</strong> You must click the "Start" button to begin proctoring. Ensure you start the proctoring process before proceeding with the exam.</p>
                </div>
                <div class="flex flex-row">
                    <div id="ap-test-proctoring-status"></div>
                    <div id="proctor-feedback"></div>
                </div>
            </div>
            <div id="report-container"></div>
        </div>
    </header>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const notificationBtn = document.getElementById('notificationBtn');
            const notification = document.getElementById('notification');
            const closeBtn = document.querySelector('.close-btn');

            notificationBtn.addEventListener('click', () => {
                notification.classList.toggle('show');
            });

            closeBtn.addEventListener('click', () => {
                notification.classList.remove('show');
            });

            window.addEventListener('click', (event) => {
                if (event.target !== notification && !notification.contains(event.target) && event.target !== notificationBtn) {
                    notification.classList.remove('show');
                }
            });
        });

        const proctoringOptions = {
            trackingOptions: {
                audio: false,
                numHumans: false,
                tabSwitch: true,
                photosAtRandom: false,
                detectMultipleScreens: false,
                forceFullScreen: false,
                auxiliaryDevice: false,
                recordSession: false
            },
            showHowToVideo: false,
        };
        async function init() {
        const credentials = getCredentials();
        const apInstance = new AutoProctor(credentials);
        await apInstance.setup(proctoringOptions);

        document.getElementById("btn-start").addEventListener("click", () => apInstance.start());

        window.addEventListener("apMonitoringStarted", () => {
            document.getElementById("btn-start").disabled = true;
            document.getElementById("btn-stop").disabled = false;
            document.getElementById("ap-test-proctoring-status").innerHTML = "Proctoring...";
        });

        document.getElementById("btn-stop").addEventListener("click", async () => {
            try {
                console.log("Stopping proctoring...");
                await apInstance.stop();
                console.log("Proctoring stopped.");
            } catch (error) {
                console.error("Error stopping proctoring:", error);
            }
        });

        window.addEventListener("apMonitoringStopped", async () => {
            console.log("Proctoring stopped event triggered.");
            try {
                const reportOptions = getReportOptions();

                const reportData = await apInstance.getReport(reportOptions);
                await saveReportData(reportData);
                window.location.href = 'report.php';
            } catch (error) {
                console.error("Error generating or saving report:", error);
            }
        });

        });


        }

        async function saveReportData(reportData) {
            try {
                const response = await fetch('save_report.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        reportData
                    })
                });

                if (!response.ok) {
                    throw new Error('Failed to save report data');
                }
                console.log('Report data saved successfully.');
            } catch (error) {
                console.error('Error saving report data:', error);
            }
        }

        window.addEventListener("load", init);



        function displayReportOnPage(reportData) {
            const reportContainer = document.getElementById('report-container');
            if (reportContainer) {
                reportContainer.innerHTML = `
                    <h2>Report Summary</h2>
                    <pre>${JSON.stringify(reportData, null, 2)}</pre>
                `;
            }
        }

        window.addEventListener("load", init);

        const CLIENT_ID = 'OHuIPLGD'; // INSERT YOUR ID HERE!!!!
        const CLIENT_SECRET = 'Qlb80sl0WQNE0ha'; // INSERT YOUR SECRET HERE!!!!    
        const getTestAttemptId = () => Math.random().toString(36).slice(2, 7);

        function getHashTestAttemptId(testAttemptId) {
            if (CLIENT_SECRET === null) {
                return null;
            } else {
                const secretWordArray = CryptoJS.enc.Utf8.parse(CLIENT_SECRET);
                const messageWordArray = CryptoJS.enc.Utf8.parse(testAttemptId);
                const hash = CryptoJS.HmacSHA256(messageWordArray, secretWordArray);
                return CryptoJS.enc.Base64.stringify(hash);
            }
        }

        function getCredentials() {
            const testAttemptId = getTestAttemptId();
            const hashedTestAttemptId = getHashTestAttemptId(testAttemptId);
            return {
                clientId: CLIENT_ID,
                testAttemptId: testAttemptId,
                hashedTestAttemptId: hashedTestAttemptId
            };
        }

        const getReportOptions = () => {
            return {
                groupReportsIntoTabs: true,
                userDetails: {
                    name: "First Last",
                    email: "user@gmail.com"
                }
            };
        };
    </script>

</body>

</html>