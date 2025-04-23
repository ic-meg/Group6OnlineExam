<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Exam</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,900;1,500&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@400&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montagu+Slab:wght@700&display=swap">
    <link rel="stylesheet" href="SPEDR.css">
</head>
<body>
    <div class="d-flex">
        <div class="sidebar bg-dark-green" id="sidebar">
            <div class="logo-and-campus">
                <img src="public/CvSU_LOGO.png" alt="School Logo" class="school-logo" onclick="toggleSidebar()">
                <h4 class="SchoolName" style="display: none;">CvSU - Imus Campus</h4>
            </div>
            <div class="iconsandLabel">
                <a href="#">
                    <img src="./public/home1.svg" alt="Dashboard Icon" class="menu-icon">
                    <span class="menu-label">Dashboard</span>
                </a>
                <a href="#">
                    <img src="./public/vector2.svg" alt="Profile Icon" class="menu-icon">
                    <span class="menu-label">Profile</span>
                </a>
                <a href="#"style="border-right: 5px solid white;" >
                    <img src="./public/union1.svg" alt="Exam Icon" class="menu-icon">
                    <span class="menu-label">Exam</span>
                </a>
                <a href="#">
                    <img src="./public/icon3.svg" alt="Result Icon" class="menu-icon">
                    <span class="menu-label">Result</span>
                </a>
            </div>
        </div>
        <div class="flex-grow-1">
            <div class="header d-flex justify-content-between align-items-center">
                <button class="btn btn-primary d-md-none" onclick="toggleSidebar()">☰</button>
                <h4>Student Exam</h4>
                <div class="header-icons">
                    <img src="public/icons8-notification-48.png" alt="Notification Icon" class="notification-icon">
                    <button class="Btn">
                        <div class="sign">
                            <svg viewBox="0 0 512 512">
                                <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
                            </svg>
                        </div>
                        <div class="text">Logout</div>
                    </button>
                </div>
            </div>
            <div class="content" id="content">
                <div class="d-flex align-items-center">
                    <div class="vertical-line"></div>
                    <div class="header-title">
                        <h1>Cavite State University Imus Campus</h1>
                        <p>Online Entrance Exam</p>
                    </div>
                </div>
                <div class="exam-notice">
                    <h2 class="text-left mt-3">Hello, Examinee!</h2>
                    <p class="text-left mt-3">In this Examination you will encounter 4 categories of exam which is:</p>
                    <div class="exam-categories bg-gradient-to-r from-blue-400 to-indigo-500 rounded-lg overflow-hidden shadow-xl max-w-sm">
                        <div class="row">
                            <div class="col-md-6 category">
                                <img src="public/Logic.png" alt="Logic Icon" class="category-icon">
                                Logic
                            </div>
                            <div class="col-md-6 category">
                                <img src="public/science.png" alt="Science Icon" class="category-icon">
                                Science
                            </div>
                            <div class="col-md-6 category">
                                <img src="public/math.png" alt="Math Icon" class="category-icon">
                                Math
                            </div>
                            <div class="col-md-6 category">
                                <img src="public/reading.png" alt="Reading Comprehension Icon" class="category-icon">
                                Reading Comprehension
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 detail">
                            <img src="public/items.png" alt="items" class="category-icon">
                            70 items</div>
                        <div class="col-md-6 detail">
                            <img src="public/block.png" alt="items" class="category-icon">
                            Cheating is prohibited.</div>
                        <div class="col-md-6 detail">
                            <img src="public/time.png" alt="items" class="category-icon">
                            1 hour</div>
                    </div>
                    <div class="exam-footer text-center mt-4">
                        <p class="mb-0">Good luck on the exam!</p>
                    </div>
                    <hr style="color: gray;">
                    <div class="text-center mt-2">
                        <button class="proceed-button">Proceed</button>
                    </div>                                    
                </div>
            </div>
        </div>
    </div>
    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            var content = document.getElementById('content');
            var schoolName = document.querySelector('.SchoolName');

            sidebar.classList.toggle('show');
            content.classList.toggle('sidebar-show');

            if (sidebar.classList.contains('show')) {
                schoolName.style.display = 'block';
            } else {
                schoolName.style.display = 'none';
            }
        }
    </script>
</body>
</html>
