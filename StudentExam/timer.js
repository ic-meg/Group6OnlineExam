
function startTimer(duration, display) {
    let timer = duration, hours, minutes, seconds;
    setInterval(function () {
        hours = parseInt(timer / 3600, 10);
        minutes = parseInt((timer % 3600) / 60, 10);
        seconds = parseInt(timer % 60, 10);

        hours = hours < 10 ? "0" + hours : hours;
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = hours + ":" + minutes + ":" + seconds;

      
        if (timer % 10 === 0) {
            updateRemainingTime(timer);
        }

        if (--timer < 0) {
            timer = 0;
        }
    }, 1000);
}

function updateRemainingTime(remainingTime) {
    
    fetch('update_remaining_time.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ remaining_time: remainingTime })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            console.log('Remaining time updated successfully.');
        } else {
            console.error('Failed to update remaining time.');
        }
    })
    .catch(error => {
        console.error('Error updating remaining time:', error);
    });
}


function getRemainingTime() {
  
    return <?php echo isset($_SESSION['remaining_time']) ? $_SESSION['remaining_time'] : 3600; ?>;
}


window.onload = function () {
    let remainingTime = getRemainingTime();
    let display = document.querySelector('#timer');
    startTimer(remainingTime, display);

  
    window.addEventListener('scroll', function () {
        var timerContainer = document.querySelector('.exam-category');
        var timerRect = timerContainer.getBoundingClientRect();
        var contentRect = document.getElementById('content').getBoundingClientRect();

        if (contentRect.top <= 0) {
            display.classList.add('fixed-timer');
        } else {
            display.classList.remove('fixed-timer');
        }
    });
};
