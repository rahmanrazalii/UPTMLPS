<!DOCTYPE html>
<html lang="en">
<head>

    <?php include("php/config.php"); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css">

</head>
<body>
    
<!-- Sidebar -->
<div id="sidebar" class="sidebar">
    <div class="sidebar-header">
        <h3>Admin Dashboard</h3>
    </div>
    <ul class="list-unstyled components">
        <li><a href="managelectinfo.php">Manage Lecturer Information</a></li>
        <li><a href="managesubjinfo.php">Manage Subject Information</a></li>
        <li><a href="maintainProgramme.php">Manage Programme Information</a></li>
        <li><a href="manageworkloadinfo.php">Manage Workload Information</a></li>
        <li><a href="sessionmenu.php">View and Print Report</a></li>
        <li><a href="php/logout.php">Logout</a></li>
    </ul>
</div>

<!-- Page Content -->
<div id="content">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button type="button" id="sidebarCollapse" class="btn btn-info">
                <i class="fas fa-align-left"></i>
                <span>MENU</span>
            </button>
            <!-- UPTM Logo 
            <img src="uptm.png" alt="UPTM Logo" class="uptm-logo">
            <style>
                .uptm-logo{
                    max-width: 170px; /* Set the maximum width as needed */
        height: auto;
                }
            </style>
            End UPTM Logo -->
            <h3>UPTM Load Projection System</h3>
        </div>
    </nav>
    <div class="container-fluid">
        <h2>Welcome, Admin</h2>
        <?php
        
        if (isset($_GET['task'])) {
            $task = $_GET['task'];
        
            if ($task === 'lecturer') {
                header("Location: php/managelectinfo.php");
                exit;              
            } elseif ($task === 'subject') {
                header("Location: php/managesubjinfo.php");
                exit; 
            } elseif ($task === 'workload') {
                header("Location: php/manageworkloadinfo.php");
                exit; 
            }
        }
        ?>
        
        
    </div>
</div>


<!-- Include Bootstrap and jQuery JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // Toggle the sidebar
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    });
</script>
</body>
</html>
