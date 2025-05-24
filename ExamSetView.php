<?php
session_start();
include "dbcon.php";


$categories = [
    'admin_math',
    'admin_logic',
    'admin_science',
    'admin_reading_comprehension'
];


$totalItems = 0;


foreach ($categories as $tableName) {
    $sql = "SELECT COUNT(*) AS total_questions FROM $tableName";
    $result = $conn->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();
        $totalItems += $row['total_questions'];
    }
}
$_SESSION['totalItems'] = $totalItems;



$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Entrance Exam | Admin Exam Set </title>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">

    <script src="Redirect.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-POE4FppVGG4n4C2u5Jz7f6ZQJq/j53ECM6S/NjGDEClgU/FtIBYyQQWu24lRwhET0N25xwTJAM2Lqg4q8HJfFg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="SPEL.css">
    <link rel="stylesheet" href="ExamSetView.css">
    <link rel="stylesheet" href="View.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,900;1,500&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@400&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montagu+Slab:wght@700&display=swap" />

</head>
<style>
    .medium-box {
        height: fit-content;

    }

    .radio-label {
        flex-grow: 1;
        min-width: 0;
        /* overflow-wrap: break-word;  */
        white-space: normal;
        display: inline-block;
        max-width: 10%;
    }


    @media (min-width: 576px) {
        .radio-label {
            max-width: 50%;
        }
    }

    @media (min-width: 768px) {
        .radio-label {
            max-width: 60%;
        }
    }
</style>

<body>
    <div class="d-flex">
        <div class="sidebar bg-dark-green" id="sidebar">
            <div class="logo-and-campus">
                <img src="CvSU_LOGO.png" alt="School Logo" class="school-logo" onclick="toggleSidebar()">
                <h4 class="SchoolName" style="display: none; font-size: 18px;">CvSU - Imus Campus</h4>
            </div>
            <div class="iconsandLabel">
                <a href="AdminDashboard.php">
                    <img src="./public/home1.svg" alt="Dashboard Icon" class="menu-icon">
                    <span class="menu-label">Dashboard</span>
                </a>
                <a href="AdminProfile.php">
                    <img src="./public/vector2.svg" alt="Profile Icon" class="menu-icon">
                    <span class="menu-label">Profile</span>
                </a>
                <a href="AdminPortalExamSet.php" style="border-right: 5px solid white;">
                    <img src="./public/union1.svg" alt="Exam Icon" class="menu-icon">
                    <span class="menu-label">Exam Set</span>
                </a>
                <a href="AdminManageExaminee.php">
                    <img src="    ./public/icon25.svg" alt="Result Icon" class="menu-icon">
                    <span class="menu-label">Manage Examinee</span>
                </a>
            </div>
        </div>
        <div class="flex-grow-1">
            <div class="header d-flex justify-content-between align-items-center">
                <button class="btn btn-primary d-md-none" onclick="toggleSidebar()">☰</button>

                <h4>Admin Exam Set</h4>

                <div class="header-icons">
                    <img src="icons8-notification-48.png" alt="Notification Icon" class="notification-icon">
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

                    <script src="redirect.js"></script>
                    <button class="Btn">
                        <div class="sign">
                            <svg viewBox="0 0 512 512">
                                <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
                            </svg>
                        </div>
                        <div class="text" onclick="logoutRedirect()">Logout</div>
                    </button>
                </div>
            </div>
            <div class="content" id="content">
                <!-- CONTENT HERE -->

                <div class="big-box">
                    <div class="header-box">

                        <h2>Exam Set Details</h2>
                        <button class="button-back" onclick="backRedirect()">Back</button>
                    </div>
                    <div class="content">
                        <div class="left-content">
                            <div class="exam-title-con">
                                <p>Exam Title</p>
                                <b><span>Entrance Exam</span></b>
                            </div><br>

                            <div class="to-be">
                                <p>To be taken by:</p>
                                <b><span>All Courses</span></b>
                            </div><br>

                            <div class="total-category">
                                <p>Total Category</p>
                                <b><span>4</span></b>
                            </div><br>

                            <?php

                            echo '<div class="total-items">';
                            echo '<p>Total items</p>';
                            echo '<b><span>' . htmlspecialchars($totalItems) . '</span></b>';
                            echo '</div><br>';
                            ?>

                            <div class="duration">
                                <p>Duration</p>
                                <b><span>60 mins</span></b>
                            </div><br>

                            <div class="status-con">
                                <p>Status</p>
                                <b><span>Active</span></b>
                            </div>
                        </div>

                        <div class="right-content">
                            <div class="small-box">
                                <div class="small-box-text">
                                    <p>Questions</p>
                                </div>
                                <div class="small-box-buttons ">
                                    <!-- <button type="button" class="btn btn-secondary custom-btn">+ Add Category</button> -->
                                    <!-- Button trigger modal -->
                                    <!-- <button type="button" class="btn btn-primary addModal" data-toggle="modal" data-target="#category">
                                            + Add Category
                                    </button> -->
                                    <!-- <button type="button" class="btn btn-secondary custom-btn">+ Add Question</button> -->
                                    <button type="button" class="btn btn-primary addModal" data-toggle="modal" data-target="#Question">
                                        + Add Question
                                    </button>
                                </div>
                            </div>
                            <div class="outerBoxContainer">
                                <div class="outer-box" id="Math">
                                    <h5 class="selectedCategory">Math</h5>
                                    <div class="questionsContainer">

                                    </div>
                                </div>

                                <div class="outer-box" id="Logic">
                                    <h5 class="selectedCategory">Logic</h5>
                                    <div class="questionsContainer">

                                    </div>
                                </div>

                                <div class="outer-box" id="Science">
                                    <h5 class="selectedCategory">Science</h5>
                                    <div class="questionsContainer">

                                    </div>
                                </div>

                                <div class="outer-box" id="ReadingComprehension">
                                    <h5 class="selectedCategory">Reading Comprehension</h5>
                                    <div class="questionsContainer">

                                    </div>
                                </div>
                            </div> <!-- END OF OUTER BOX -->

                        </div> <!--END RIGHT BOX -->
                    </div>
                </div>
                <!-- End of Box Layout -->
            </div><!-- END OF CONTENT -->
        </div><!--END OF FLEXGROW1 -->
    </div><!--END OF DFLEX -->



    <!-- Modal for adding questions -->
    <div class="modal fade" id="Question" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="QuestionLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="QuestionLabel">New Question</h3>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="categorySelect" class="form-label">Category</label>
                    <select id="categorySelect" class="form-select" aria-label="Default select example" name="category">
                        <option selected disabled>Select Category</option>
                        <option value="Math">Math</option>
                        <option value="Logic">Logic</option>
                        <option value="Science">Science</option>
                        <option value="ReadingComprehension">Reading Comprehension</option>
                    </select>
                    <br>
                    <div class="mb-3">
                        <label for="questionTextarea" class="form-label">Question</label>
                        <textarea class="form-control" id="questionTextarea" rows="3" placeholder="Add a question" name="questionText"></textarea>
                    </div>
                    <div id="choices-container">
                        <label for="choices-text" class="col-form-label">Choices:</label>
                        <div id="choices">
                            
                            <div class="form-group">
                                <textarea class="form-control mb-2" name="choice[]" rows="1" placeholder="Enter choice"></textarea>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="correctChoice" value="0">
                                    <label class="form-check-label">Right Answer</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn button-back mt-3 mx-auto d-block" onclick="addChoice()">+ Add Choice</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveQuestion()">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Editing Question -->
    <div class="modal fade" id="editQuestionModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="QuestionLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="QuestionLabel">Edit Question</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="editcategorySelect" class="form-label">Category</label>
                    <select id="editcategorySelect" class="form-select" aria-label="Default select example" name="category" disabled>
                        <option selected disabled>Select Category</option>
                        <option value="Math">Math</option>
                        <option value="Logic">Logic</option>
                        <option value="Science">Science</option>
                        <option value="ReadingComprehension">Reading Comprehension</option>
                    </select>
                    <br>
                    <div class="mb-3">
                        <label for="editquestionTextarea" class="form-label">Question</label>
                        <textarea class="form-control" id="editquestionTextarea" rows="3" placeholder="Add a question" name="editquestionText"></textarea>
                    </div>
                    <div id="editchoices-container">
                        <label for="choices-text" class="col-form-label">Choices:</label>
                        <div id="editchoices">
                          
                            <div class="form-group">
                                <textarea class="form-control mb-2" name="editchoice[]" rows="1" placeholder="Enter choice"></textarea>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="correctChoice" value="0">
                                    <label class="form-check-label">Right Answer</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <button class="btn button-back mt-3 mx-auto d-block" onclick="addChoice()">+ Add Choice</button> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveEditChanges()">Save Changes</button>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        </div>
    </div>





    <script>
        function resetModal() {

            var categorySelect = document.getElementById('categorySelect');
            categorySelect.selectedIndex = 0;


            var questionTextarea = document.getElementById('questionTextarea');
            questionTextarea.value = '';


            var choicesContainer = document.getElementById('choices');
            choicesContainer.innerHTML = `
        <div class="form-group">
            <textarea class="form-control mb-2" name="choice[]" rows="1" placeholder="Enter choice"></textarea>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="correctChoice" value="0">
                <label class="form-check-label">Right Answer</label>
            </div>
        </div>
    `;
        }
        $('#Question').on('hidden.bs.modal', function() {
            resetModal();
        });


        function addChoice() {
            var choicesContainer = document.getElementById('choices');
            var choiceCount = choicesContainer.children.length;

            if (choiceCount >= 4) {
                alert('You can only add 4 choices.');
                return;
            }

            var choiceHTML = `
        <div class="form-group">
            <textarea class="form-control mb-2" name="choice[]" rows="1" placeholder="Enter choice"></textarea>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="correctChoice" value="${choiceCount}">
                <label class="form-check-label">Right Answer</label>
            </div>
        </div>
    `;

            choicesContainer.insertAdjacentHTML('beforeend', choiceHTML);
        }


        function disableRadioButtons(selectedRadio) {
            var radioButtons = document.getElementsByName('correctChoice');
            radioButtons.forEach((radio) => {
                if (!radio.checked) {
                    radio.disabled = true;
                }
            });
        }

        //Add Question
        function saveQuestion() {
            var categorySelect = document.getElementById('categorySelect');
            var selectedCategory = categorySelect.value;
            var questionText = document.getElementById('questionTextarea').value;
            var choiceElements = document.getElementsByName('choice[]');
            var correctChoiceRadio = document.querySelector('input[name="correctChoice"]:checked');

            if (choiceElements.length !== 4) {
                alert('Please provide exactly four choices.');
                return;
            }

            if (!correctChoiceRadio) {
                alert('Please select the correct answer.');
                return;
            }

            var choices = [];
            choiceElements.forEach(function(choice) {
                choices.push(choice.value);
            });


            var correctChoiceInput = correctChoiceRadio.closest('.form-group').querySelector('textarea').value.trim();

            if (!correctChoiceInput) {
                alert('Failed to determine correct answer text.');
                return;
            }

            if (selectedCategory && questionText && choices.length > 0) {
                var data = {
                    category: selectedCategory,
                    questionText: questionText,
                    choices: choices,
                    correctChoiceText: correctChoiceInput
                };

                console.log('Data being sent to server:', data);

                fetch('save_question.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => response.json())
                    .then(result => {
                        if (result.success) {
                            addQuestionToCategory(selectedCategory, questionText, choices, correctChoiceInput);



                            $('#Question.modal').modal('hide').data('bs.modal', null);
                            $('body').removeClass('modal-open');
                            $('.modal-backdrop').remove();

                            alert('Question Successfully inserted.');
                            window.location.href = 'ExamSetView.php';


                        } else {
                            alert('Failed to save question: ' + result.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error saving question:', error);
                        alert('Error saving question: ' + error.message);
                    });
            }
        }

        function fetchQuestions(category) {
            fetch(`fetch_questions.php?category=${category}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to fetch questions');
                    }
                    return response.json();
                })
                .then(questions => {
                    questions.forEach(question => {
                        addQuestionToCategory(question.category, question.questionID, question.questionText, question.choices, question.correctChoiceText);
                    });
                    console.log(`Questions fetched successfully for ${category}`);
                })
                .catch(error => {
                    console.error(`Error fetching questions for ${category}:`, error);
                    alert(`Error fetching questions for ${category}: ${error.message}`);
                });
        }


        fetchQuestions('Math');
        fetchQuestions('Logic');
        fetchQuestions('Science');
        fetchQuestions('ReadingComprehension');

        function addQuestionToCategory(category, questionId, questionText, choices, correctChoiceText) {
            if (!questionId) {
                console.error('questionId is not defined or invalid.');
                return;
            }

            if (!choices || choices.length !== 4) {
                console.error('Choices array is not valid:', choices);
                return;
            }

            var radioGroupName = `radio-group-${category}-${questionId}`;


            var mediumBox = `
        <div class="medium-box" data-question-id="${questionId}" data-category="${category}">
            <div class="question">
                <p>${questionText}</p>
                <div class="options">   
                    <div class="dropdown">
                        <button class="btn dots-btn" type="button" aria-expanded="false" style="margin-top: -18px;">
                            <span class="dots">⋮</span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dotsMenu">
                            <a class="dropdown-item edit-btn" href="#">Edit</a>
                            <a class="dropdown-item delete-btn" href="#">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="choices">
                ${choices.map((choice, index) => `
                    <li>
                        <div class="radio-container">
                            <div class="radio-wrapper">
                                <label class="radio-button">
                                    <input id="option${index}" name="${radioGroupName}" type="radio" ${choice === correctChoiceText ? 'checked' : ''} ${choice !== correctChoiceText ? 'disabled' : ''}>
                                    <span class="radio-checkmark"></span>
                                    <span class="radio-label">${choice}</span>
                                </label>
                            </div>
                        </div>
                    </li>`).join('')}
            </ul>
        </div>
    `;

            var outerBox = document.getElementById(category);
            if (outerBox) {
                outerBox.insertAdjacentHTML('beforeend', mediumBox);
            } else {
                console.error('Outer box container not found.');
            }


            attachQuestionBoxEventListeners();
        }


        function attachQuestionBoxEventListeners() {
            var editButtons = document.querySelectorAll('.edit-btn');
            var deleteButtons = document.querySelectorAll('.delete-btn');

            editButtons.forEach(function(btn) {
                btn.removeEventListener('click', editButtonClickHandler);
                btn.addEventListener('click', editButtonClickHandler);
            });

            deleteButtons.forEach(function(btn) {
                btn.removeEventListener('click', deleteButtonClickHandler);
                btn.addEventListener('click', deleteButtonClickHandler);
            });

            var dotsButtons = document.querySelectorAll('.dots-btn');
            dotsButtons.forEach(function(btn) {
                btn.removeEventListener('click', dotsButtonClickHandler);
                btn.addEventListener('click', dotsButtonClickHandler);
            });

            document.addEventListener('click', closeDropdownsOnClickOutside);
        }

        function editButtonClickHandler(event) {
            event.stopPropagation();
            var questionId = this.dataset.questionId;
            var category = this.dataset.category;

            var questionElement = this.closest('.medium-box');
            populateEditModal(questionElement, questionId, category);

            var editQuestionModal = new bootstrap.Modal(document.getElementById('editQuestionModal'));
            editQuestionModal.show();
        }



        function deleteQuestion(questionId, category) {
            if (!confirm('Are you sure you want to delete the question?')) {
                return;
            }

            fetch('delete_question.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'question_id=' + encodeURIComponent(questionId) + '&category=' + encodeURIComponent(category),
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to delete question');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Question deleted successfully from the database.');

                    var questionBox = document.querySelector(`.medium-box[data-question-id="${questionId}"][data-category="${category}"]`);
                    if (questionBox) {
                        questionBox.remove();
                    } else {
                        console.error('Question box not found in the UI.');
                    }
                })
                .catch(error => {
                    console.error('Error deleting question:', error);
                    alert('Error deleting question: ' + error.message);
                });
        }



        function deleteButtonClickHandler(event) {
            event.stopPropagation();

            var questionElement = this.closest('.medium-box');
            var questionId = questionElement.dataset.questionId;
            var category = questionElement.dataset.category;

            console.log('Deleting question with ID:', questionId);
            console.log('Category:', category);

            deleteQuestion(questionId, category);
        }


        function dotsButtonClickHandler(event) {
            event.stopPropagation();
            var dropdownMenu = this.nextElementSibling;
            if (dropdownMenu.classList.contains('show')) {
                dropdownMenu.classList.remove('show');
            } else {
                var allDropdowns = document.querySelectorAll('.dropdown-menu');
                allDropdowns.forEach(function(dropdown) {
                    dropdown.classList.remove('show');
                });
                dropdownMenu.classList.add('show');
            }
        }

        function closeDropdownsOnClickOutside(event) {
            if (!event.target.closest('.dropdown')) {
                var allDropdowns = document.querySelectorAll('.dropdown-menu');
                allDropdowns.forEach(function(dropdown) {
                    dropdown.classList.remove('show');
                });
            }
        }

        function populateEditModal(questionElement) {

            var questionId = questionElement.getAttribute('data-question-id');


            var questionText = questionElement.querySelector('.question p').textContent.trim();

            document.getElementById('editquestionTextarea').value = questionText;


            var category = questionElement.closest('.medium-box').getAttribute('data-category');
            document.getElementById('editcategorySelect').value = category;


            var choicesElements = questionElement.querySelectorAll('.choices .radio-label');
            var choices = Array.from(choicesElements).map(choice => choice.textContent.trim());

            var editChoicesContainer = document.getElementById('editchoices');
            editChoicesContainer.innerHTML = '';

            choices.forEach((choice, index) => {
                var isChecked = questionElement.querySelector(`input[name^="radio-group"]:checked`).nextSibling.textContent.trim() === choice;
                var choiceHTML = `
            <div class="form-group">
                <textarea class="form-control mb-2" name="editchoice[]" rows="1" placeholder="Enter choice">${choice}</textarea>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="correctChoice" value="${index}" ${isChecked ? 'checked' : ''}>
                    <label class="form-check-label">Right Answer</label>
                </div>
            </div>
        `;
                editChoicesContainer.insertAdjacentHTML('beforeend', choiceHTML);
            });


            document.getElementById('editQuestionModal').setAttribute('data-question-id', questionId);

            document.getElementById('editQuestionModal').setAttribute('data-question-element', questionElement.outerHTML);
        }

        function saveEditChanges() {
            var modal = document.getElementById('editQuestionModal');
            var questionElementHTML = modal.getAttribute('data-question-element');
            var questionId = modal.getAttribute('data-question-id');


            if (!questionElementHTML || !questionId) {
                alert('Error: Question element or ID not found.');
                return;
            }


            var tempDiv = document.createElement('div');
            tempDiv.innerHTML = questionElementHTML;
            var questionElement = tempDiv.firstChild;


            if (!(questionElement instanceof Element)) {
                alert('Error: Invalid question element.');
                console.error('Invalid question element:', questionElement);
                return;
            }

            // Update question text
            var newQuestionText = document.getElementById('editquestionTextarea').value.trim();
            questionElement.querySelector('.question p').textContent = newQuestionText;

            // Update choices
            var newChoices = Array.from(document.querySelectorAll('#editchoices textarea')).map(choice => choice.value.trim());
            var correctChoiceIndex = document.querySelector('#editchoices input[name="correctChoice"]:checked');
            var correctIndex = correctChoiceIndex ? correctChoiceIndex.value : null;

            var choicesList = questionElement.querySelector('.choices');
            choicesList.innerHTML = '';

            newChoices.forEach((choice, index) => {
                var isChecked = correctIndex !== null && index == correctIndex;
                var inputName = questionElement.querySelector('.radio-button input') ? questionElement.querySelector('.radio-button input').name : '';
                var choiceHTML = `
            <li>
                <div class="radio-container">
                    <div class="radio-wrapper">
                        <label class="radio-button">
                            <input id="option${index}" name="${inputName}" type="radio" ${isChecked ? 'checked' : ''} ${isChecked ? '' : 'disabled'}>
                            <span class="radio-checkmark"></span>
                            <span class="radio-label">${choice}</span>
                        </label>
                    </div>
                </div>
            </li>
        `;
                choicesList.insertAdjacentHTML('beforeend', choiceHTML);
            });


            var originalElement = document.querySelector(`.medium-box[data-question-id="${questionId}"]`);
            if (originalElement) {

                originalElement.outerHTML = questionElement.outerHTML;


                var category = document.getElementById('editcategorySelect').value;


                updateQuestionOnServer(questionId, newQuestionText, newChoices, correctIndex, category, function(success) {
                    if (success) {
                        $('#editQuestionModal.modal').modal('hide').data('bs.modal', null);
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();

                        alert('Changes saved successfully!');
                    } else {

                        alert('Error: Unable to save changes.');
                    }
                });
            } else {

                alert('Error: Unable to save changes.');
            }
        }

        function updateQuestionOnServer(questionId, questionText, choices, correctChoiceIndex, category, callback) {
            const payload = {
                questionId: questionId,
                questionText: questionText,
                choices: choices,
                correctChoiceIndex: correctChoiceIndex,
                category: category
            };

            console.log('Sending payload to server:', payload);

            fetch('update_question.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(payload),
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Server response:', data);
                    if (data.success) {
                        if (typeof callback === 'function') {
                            callback(true); 
                        }
                    } else {
                        if (typeof callback === 'function') {
                            callback(false); // Indicate failure
                        }
                    }
                })
                .catch(error => {
                    console.error('Error updating question:', error);
                    alert('Error updating question: ' + error.message);
                    if (typeof callback === 'function') {
                        callback(false); // Indicate failure
                    }
                });
        }


        //Sidebar
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            var content = document.getElementById('content');
            var schoolName = document.querySelector('.SchoolName');

            schoolName.style.display = 'none';

            sidebar.classList.toggle('show');
            content.classList.toggle('sidebar-show');

            if (sidebar.classList.contains('show')) {
                schoolName.style.display = 'block';
            } else {
                schoolName.style.display = 'none';
            }
        }

        function backRedirect() {
            window.location.href = 'AdminPortalExamSet.php';
        }
    </script>


</body>

</html>