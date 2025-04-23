<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                <a href="StudentNotification.php">
                    <img src="icons8-notification-48.png" alt="Notification Icon" class="notification-icon">
                </a>
                <div class="notification-dot"></div>
        </div>
</body>
<script>
       
       $(document).ready(function() {
            function checkNotifications() {
            $.ajax({
                url: 'check_notifications.php',
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