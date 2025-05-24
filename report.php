<?php

session_start();


$reportData = isset($_SESSION['reportData']) ? $_SESSION['reportData'] : null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proctoring Report</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="global.css" />
    <link rel="stylesheet" href="./report.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        #report-container {
            margin: auto;
            max-width: 800px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <div id="report-container">
        <h1>Proctoring Report</h1>
        <div id="report-content">
            <?php if ($reportData): ?>
                <h2>Report Summary</h2>
                <?php

                if (is_array($reportData)) {

                    echo '<pre>' . htmlspecialchars(json_encode($reportData, JSON_PRETTY_PRINT)) . '</pre>';
                } else {

                    echo '<pre>' . htmlspecialchars($reportData) . '</pre>';
                }
                ?>
            <?php else: ?>
                <p>No report data available.</p>
            <?php endif; ?>
        </div>
    </div>

</body>

</html>