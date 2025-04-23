// proctoring.js

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
    showHowToVideo: false
};

const CLIENT_ID = 'fpVpWdhY'; 
const CLIENT_SECRET = 'Kx49EfyHWkXkCCd'; 

function getTestAttemptId() {
    return Math.random().toString(36).slice(2, 7);
}

function getHashTestAttemptId(testAttemptId) {
    if (!CLIENT_SECRET) return null;
    const secretWordArray = CryptoJS.enc.Utf8.parse(CLIENT_SECRET);
    const messageWordArray = CryptoJS.enc.Utf8.parse(testAttemptId);
    const hash = CryptoJS.HmacSHA256(messageWordArray, secretWordArray);
    return CryptoJS.enc.Base64.stringify(hash);
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

const getReportOptions = () => ({
    groupReportsIntoTabs: true,
    userDetails: {
        name: "First Last",
        email: "megangeline08@gmail.com"
    }
});

async function init() {
    try {
        const credentials = getCredentials();
        const apInstance = new AutoProctor(credentials);
        await apInstance.setup(proctoringOptions);

        document.getElementById("btn-start").addEventListener("click", () => apInstance.start());

        window.addEventListener("apMonitoringStarted", () => {
            document.getElementById("btn-start").disabled = true;
            document.getElementById("btn-stop").disabled = false;
            document.getElementById("ap-test-proctoring-status").innerHTML = "Proctoring...";
        });

        document.getElementById("btn-stop").addEventListener("click", () => apInstance.stop());

        window.addEventListener("apMonitoringStopped", async () => {
            const reportOptions = getReportOptions();
            apInstance.showReport(reportOptions);

            document.getElementById("ap-proctoring-container").style.visibility = "hidden";
            document.getElementById("ap-test-proctoring-status").innerHTML = "Proctoring stopped";
        });

        document.getElementById("submit-button").addEventListener("click", async (e) => {
            e.preventDefault(); 

            const reportData = {
                name: "First Last",
                email: "user@gmail.com",
                proctoringStatus: "Completed",
                testAttemptId: credentials.testAttemptId,
                timestamp: new Date().toLocaleString()
            };

            try {
                const response = await fetch('server.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(reportData)
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok.');
                }

                const data = await response.json();
                console.log("Data sent to the server:", data);

                document.getElementById("submitAnswers").submit();
            } catch (error) {
                console.error("Error sending data to the server:", error);
                alert("There was an issue submitting the data. Please try again.");
            }
        });
    } catch (error) {
        console.error("Initialization error:", error);
    }
}

window.addEventListener("load", init);
