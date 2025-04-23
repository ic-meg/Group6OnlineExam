<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700&display=swap"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,900;1,500&display=swap"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@400&display=swap"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montagu+Slab:wght@700&display=swap"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" />
</head>
<style>
            .notification-container {
            position: relative;
            display: inline-block;
        }

        .notification-dot {
            position: absolute;
            top: 0;
            right: 13px;
            width: 10px;
            height: 10px;
            background-color: red;
            border-radius: 50%;
            display: none; 
        }
</style>
<body>
        <div class="notification-container" style="position: relative; display: inline-block;">
                <a href="AdminNotification.php">
                    <img src="icons8-notification-48.png" alt="Notification Icon" class="notification-icon">
                </a>
                <div class="notification-dot"></div>
        </div>
</body>
<script>
       
       $(document).ready(function() {
            function checkNotifications() {
            $.ajax({
                url: 'check_admin_notifications.php',
                method: 'GET',
                success: function(response) {
                
                if (response.trim() === 'true') {
                    $('.notification-dot').show();
                } else {
                    $('.notification-dot').hide();
                }
                },
                error: function() {
                console.error('Failed to check notifications.');
                }
            });
            }

            
            checkNotifications();
            setInterval(checkNotifications, 60000); 
        });
</script>
</html>