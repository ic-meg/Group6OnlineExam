<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            padding: 0;
            height: 100vh;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            margin: 0 auto;
            max-width: 1200px;
        }

        .calendar {
            margin-left: auto;
            margin-right: auto;
            margin-top: 50px;
            width: 100%;
            max-width: 500px;
            padding: 1rem;
            background: #fff;
            box-shadow: 0 4px 4px rgba(0, 0, 0, 0.2);
        }

        .calendar header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .calendar nav {
            display: flex;
            align-items: center;
        }

        .calendar ul {
            list-style: none;
            display: flex;
            flex-wrap: wrap;
            text-align: center;
        }

        .calendar ul li {
            width: calc(100% / 7);
            margin-top: 25px;
            position: relative;
            z-index: 2;
        }

        #prev,
        #next {
            width: 20px;
            height: 20px;
            position: relative;
            border: none;
            background: transparent;
            cursor: pointer;
        }

        #prev::before,
        #next::before {
            content: "";
            width: 50%;
            height: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            border-style: solid;
            border-width: 0.25em 0.25em 0 0;
            border-color: #ccc;
        }

        #next::before {
            transform: translate(-50%, -50%) rotate(45deg);
        }

        #prev::before {
            transform: translate(-50%, -50%) rotate(-135deg);
        }

        #prev.disabled::before,
        #next.disabled::before {
            border-color: #ddd;
            cursor: not-allowed;
        }

        #prev:hover::before,
        #next:hover::before {
            border-color: #000;
        }

        .days {
            font-weight: 600;
        }

        .dates li.today {
            color: #fff;
        }

        .dates li.today::before {
            content: "";
            width: 2rem;
            height: 2rem;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #000;
            border-radius: 50%;
            z-index: -1;
        }

        .dates li.inactive {
            color: #ccc;
        }

        .dates li.disabled {
            color: #ccc;
            pointer-events: none;
            cursor: not-allowed;
        }

        .dates li.selected {
            position: relative;
            color: white;
        }

        .dates li.selected::before {
            content: "";
            width: 2rem;
            height: 2rem;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #01343E;
            border-radius: 50%;
            z-index: -1;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                align-items: center;
                justify-content: flex-start;
            }

            .calendar {
                margin-left: 0px;
                margin-top: 2rem;
            }
        }
    </style>
</head>

<body>
    <div class="">
        <div class="">
            <div class="calendar mr-5" style="cursor: pointer;">
                <header>
                    <h3></h3>
                    <nav>
                        <button id="prev"></button>
                        <button id="next"></button>
                    </nav>
                </header>
                <section>
                    <ul class="days">
                        <li>Sun</li>
                        <li>Mon</li>
                        <li>Tue</li>
                        <li>Wed</li>
                        <li>Thu</li>
                        <li>Fri</li>
                        <li>Sat</li>
                    </ul>
                    <ul class="dates"></ul>
                </section>
            </div>
        </div>
    </div>
    <div id="current-date" style="margin-top: 20px; font-size: 1.2rem; font-weight: bold;">

    </div>
    <form id="dateForm" method="post" action="">
        <input type="hidden" id="selectedDate" name="selectedDate">
    </form>
    <script>
        const header = document.querySelector(".calendar h3");
        const dates = document.querySelector(".dates");
        const prevButton = document.querySelector("#prev");
        const nextButton = document.querySelector("#next");

        const months = [
            "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];

        let date = new Date();
        let month = date.getMonth();
        let year = date.getFullYear();
        let selectedDate = null;

        function renderCalendar() {
            const start = new Date(year, month, 1).getDay();
            const endDate = new Date(year, month + 1, 0).getDate();
            const end = new Date(year, month, endDate).getDay();
            const endDatePrev = new Date(year, month, 0).getDate();

            let datesHtml = "";

            for (let i = start; i > 0; i--) {
                datesHtml += `<li class="inactive">${endDatePrev - i + 1}</li>`;
            }

            for (let i = 1; i <= endDate; i++) {
                let className = '';
                const currentDate = new Date(year, month, i);
                const today = new Date();
                today.setHours(0, 0, 0, 0);

                if (currentDate < today) {
                    className = ' class="disabled"';
                } else if (currentDate.getDay() === 0 || currentDate.getDay() === 6) {
                    className = ' class="disabled"';
                } else if (i === today.getDate() && month === today.getMonth() && year === today.getFullYear()) {
                    className = ' class="today"';
                }

                datesHtml += `<li${className}>${i}</li>`;
            }

            for (let i = end; i < 6; i++) {
                datesHtml += `<li class="inactive">${i - end + 1}</li>`;
            }

            dates.innerHTML = datesHtml;
            header.textContent = `${months[month]} ${year}`;

            document.querySelectorAll(".dates li:not(.inactive)").forEach((dateEl) => {
                dateEl.addEventListener("click", (e) => {
                    if (e.currentTarget.classList.contains("disabled")) {
                        return;
                    }


                    document.querySelectorAll('.dates li').forEach(d => d.classList.remove('selected'));


                    e.currentTarget.classList.add('selected');

                    selectedDate = new Date(year, month, parseInt(e.target.textContent));
                });
            });


            prevButton.classList.toggle('disabled', month === 0 && year === new Date().getFullYear());

            nextButton.classList.toggle('disabled', month === 11 && year === new Date().getFullYear());
        }

        prevButton.addEventListener("click", () => {
            if (prevButton.classList.contains('disabled')) return;

            if (month === 0) {
                year--;
                month = 11;
            } else {
                month--;
            }

            date = new Date(year, month, new Date().getDate());
            renderCalendar();
        });

        nextButton.addEventListener("click", () => {
            if (nextButton.classList.contains('disabled')) return;

            if (month === 11) {
                year++;
                month = 0;
            } else {
                month++;
            }

            date = new Date(year, month, new Date().getDate());
            renderCalendar();
        });

        renderCalendar();
    </script>
</body>

</html>