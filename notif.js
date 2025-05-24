$(document).ready(function () {
    let isDown = false;

    $('#bell').click(function () {
        if (isDown) {
            $('#box').animate({ height: '0', opacity: '0' }, 300, function () {
                $(this).css('display', 'none');
            });
            isDown = false;
        } else {
            $('#box').css('display', 'block').animate({ height: 'auto', opacity: '1' }, 300);
            isDown = true;
        }
    });

    const hasNotifications = true; 

    if (hasNotifications) {
        $('.notification-dot').show();
    }
});