<?php
session_start();
include "dbcon.php";


$sqlAdmin = "SELECT * FROM adminaccount";
$result = mysqli_query($conn, $sqlAdmin);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
} else {
    echo "Error fetching data or no data found";
    exit;
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Management</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="SPEL.css">
    <link rel="stylesheet" href="addadmin.css">
    <link rel="stylesheet" href="AdminPortalExamSet.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="Redirect.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,900;1,500&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@400&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montagu+Slab:wght@700&display=swap" />
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/demo.css">
    <!-- Data Table CSS -->
    <link rel='stylesheet' href='https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css'>

    <style>



    </style>
</head>

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
                <a href="AdminPortalExamSet.php">
                    <img src="./public/union1.svg" alt="Exam Icon" class="menu-icon">
                    <span class="menu-label">Exam Set</span>
                </a>
                <a href="AdminManageExaminee.php">
                    <img src="./public/icon25.svg" alt="Result Icon" class="menu-icon">
                    <span class="menu-label">Manage Examinee</span>
                </a>
                <a href="AddAdmin.php">
                    <img src="./public/items.png" alt="Add Admin Icon" class="menu-icon" style="filter: invert(1) brightness(2);">
                    <span class="menu-label">Add Admin</span>
                </a>
            </div>
        </div>
        <div class="flex-grow-1">
            <div class="header d-flex justify-content-between align-items-center">
                <button class="btn btn-primary d-md-none" onclick="toggleSidebar()">☰</button>
                <h4>Admin Management</h4>
                <div class="header-icons">
                    <?php include "adminnotif.php"; ?>
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
            <div class="content" id="content"><br><br>
                <!-- <div class="search-and-table-container">
                    <div class="group" id="search">
                        <svg viewBox="0 0 24 24" aria-hidden="true" class="icon" >
                            <g>
                                <path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path>
                            </g>
                        </svg>
                        <input class="input" type="search" placeholder="Search" id="search_inpt"/>
                    </div> -->
                <main class="cd__main">
                    <table class="table table-striped" id="example" style="width:100%">
                        <thead class="headExam">
                            <tr>
                                <th colspan="7">
                                    <button type="button" class="btn btn-primary float-right"
                                        style="background-color: black; color: white; border-color: black;"
                                        data-toggle="modal" data-target="#adminModal">
                                        Add Admin
                                    </button>
                                </th>
                            </tr>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">Username</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="search_tbl">

                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <th scope="row"><?php echo htmlspecialchars($row['admin_id']); ?></th>
                                    <td><?php echo htmlspecialchars($row['DateCreated']); ?></td>
                                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                                    <td class="active">Active</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle custom-btn" type="button"
                                                id="dropdownMenuButton<?php echo htmlspecialchars($row['admin_id']); ?>"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton<?php echo htmlspecialchars($row['admin_id']); ?>">
                                                <a class="dropdown-item editAdmin" href="#" data-admin-id="<?php echo htmlspecialchars($row['admin_id']); ?>"
                                                    data-username="<?php echo htmlspecialchars($row['username']); ?>">Edit</a>
                                                <a class="dropdown-item deleteAdmin" href="#" data-admin-id="<?php echo htmlspecialchars($row['admin_id']); ?>">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>


            </div>
        </div>
    </div>
    </div>
    <div class="modal fade" id="adminModal" tabindex="-1" role="dialog" aria-labelledby="adminModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="adminModalLabel">Add Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="adminForm">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            <small id="passwordHelp" class="form-text text-muted">
                                Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one digit, and one special character. Avoid using common passwords and personal information.
                            </small>
                        </div>
                        <input type="hidden" id="adminId" name="adminId">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" form="adminForm" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Admin Modal -->

    <div class="modal fade" id="editAdminModal" tabindex="-1" aria-labelledby="editAdminModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="editAdminForm" method="post" action="editAdmin.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editAdminModalLabel">Edit Admin</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editAdminId" name="adminId">
                        <div class="mb-3">
                            <label for="editUsername" class="form-label">Username</label>
                            <input type="text" class="form-control" id="editUsername" name="username" placeholder="Enter Username" required>
                        </div>
                        <div class="mb-3">
                            <label for="editPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="editPassword" name="password" placeholder="Enter Password" required>
                        </div>
                        <small id="passwordHelp" class="form-text text-muted">
                            Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one digit, and one special character. Avoid using common passwords and personal information.
                        </small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="saveChangesBtn" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- Delete Admin Modal -->
    <div class="modal fade" id="deleteAdminModal" tabindex="-1" role="dialog" aria-labelledby="deleteAdminModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAdminModalLabel">Delete Admin</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="deleteAdminForm">
                        <input type="hidden" id="deleteAdminId">
                        <p>Are you sure you want to delete this admin?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" id="confirmDeleteButton" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="addadmin.js"></script>

    <script src='https://code.jquery.com/jquery-3.7.0.js'></script>

    <script src='https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js'></script>
    <script src='https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js'></script>
    <script src='https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js'></script>

    <script src="script.js"></script>
</body>

</html>