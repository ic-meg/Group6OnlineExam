const header = document.querySelector(".calendar h3");
const dates = document.querySelector(".dates");
const navs = document.querySelectorAll("#prev, #next");
const selectedDateDisplay = document.getElementById("selected-date");

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
        let className =
            i === date.getDate() &&
            month === new Date().getMonth() &&
            year === new Date().getFullYear()
                ? ' class="today"'
                : "";

        const currentDate = new Date(year, month, i);
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        if (currentDate < today) {
            className += ' disabled';
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
                return; // Do not proceed if date is disabled (in the past)
            }

            selectedDate = new Date(year, month, parseInt(e.target.textContent));
            selectedDateDisplay.textContent = selectedDate.toDateString();
            renderCalendar();
        });
    });
}

navs.forEach((nav) => {
    nav.addEventListener("click", (e) => {
        const btnId = e.target.id;

        if (btnId === "prev" && month === 0) {
            year--;
            month = 11;
        } else if (btnId === "next" && month === 11) {
            year++;
            month = 0;
        } else {
            month = btnId === "next" ? month + 1 : month - 1;
        }

        date = new Date(year, month, new Date().getDate());
        year = date.getFullYear();
        month = date.getMonth();

        renderCalendar();
    });
});

renderCalendar();
