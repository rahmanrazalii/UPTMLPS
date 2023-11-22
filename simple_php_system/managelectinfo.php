<!DOCTYPE html>
<html lang="en">
<head>
    <?php include ("dashboard.php"); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecturer Information</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css">
    <style>
        .container {
            margin-top: 30px;
        }
    </style>
</head>
<body>
<?php
            include("php/config.php");

            $lecturerID = '';
            $lecturerName = '';
            $lecturerGrade = '';
            $lecturerQualification = '';

            if (isset($_POST['submit'])) {
                $lecturerName = $_POST['lecturerName'];
                $lecturerID = $_POST['lecturerID'];
                $lecturerGrade = $_POST['lecturerGrade'];
                $lecturerQualification = $_POST['lecturerQualification'];

                // Check if any of the fields is empty
                if (empty($lecturerName) || empty($lecturerID) || empty($lecturerGrade) || empty($lecturerQualification)) {
                    echo "<div class='message'>
                        <p>All fields are required. Please fill in all the fields.</p>
                    </div> <br>";
                } else {
                    // All fields are filled, proceed with registration
                    mysqli_query($con, "INSERT INTO lecturer(lecturerName, lecturerID, lecturerGrade, lecturerQualification) VALUES('$lecturerName', '$lecturerID', '$lecturerGrade', '$lecturerQualification')") or die("Error Occurred");

                    $lecturerID = '';
                    $lecturerName = '';
                    $lecturerGrade = '';
                    $lecturerQualification = '';
                    echo "<div class='message'>
                        <p>Registration successfully!</p>
                    </div> <br>";
                    
                }
            } elseif (isset($_POST['searchLect'])) {
                
                    $searchquery = $_POST['searchquery'];
    
                    $result = mysqli_query($con, "SELECT * FROM lecturer WHERE lecturerName LIKE '%$searchquery%'") or die("Error Occurred");
    
    
                    if (mysqli_num_rows($result) > 0) {
                        // Display the first result in the form fields
                        $row = mysqli_fetch_assoc($result);
                        $lecturerID = $row['lecturerID'];
                        $lecturerName = $row['lecturerName'];
                        $lecturerGrade = $row['lecturerGrade'];
                        $lecturerQualification = $row['lecturerQualification'];
                    } else {
                        
                        echo "<div class='message'>
                        <p>No matching lecturers found</p>
                    </div> <br>";
                        // Set variables to empty strings if no results are found
                        /*$lecturerID = '';
                        $lecturerName = '';
                        $lecturerGrade = '';
                        $lecturerQualification = '';*/
                    }
                }

            elseif (isset($_POST['update'])) {
                $lecturerName = $_POST['lecturerName'];
                $lecturerID = $_POST['lecturerID'];
                $lecturerGrade = $_POST['lecturerGrade'];
                $lecturerQualification = $_POST['lecturerQualification'];

                // Check if any of the fields is empty
                if (empty($lecturerName) || empty($lecturerID) || empty($lecturerGrade) || empty($lecturerQualification)) {
                    echo "<div class='message'>
                        <p>All fields are required. Please fill in all the fields.</p>
                    </div> <br>";
                } else {
                    // All fields are filled, proceed with the update
                    mysqli_query($con, "UPDATE lecturer SET lecturerName = '$lecturerName', lecturerGrade = '$lecturerGrade', lecturerQualification = '$lecturerQualification' WHERE lecturerID = '$lecturerID'") or die("Error Occurred");

                    echo '<script>alert("Lecturer ID: ' . $lecturerID . ' updated successfully.");</script>';
                }
            }elseif(isset($_POST['delete'])){
                $lecturerIDToDelete = $_POST['lecturerID'];
                if ($lecturerIDToDelete ===""){
                    echo '<script>alert("Please search correct lecturer ID");</script>';
                }
                else{

                
                    $deleteQuery = mysqli_query($con, "DELETE FROM lecturer WHERE lecturerID = '$lecturerIDToDelete'") or die("");
        
                    if($deleteQuery) {
                        echo '<script>alert("Lecturer ID: ' . $lecturerIDToDelete . ' deleted successfully.");</script>';
                    } else {
                        echo "Error deleting lecturer: " . mysqli_error($con);
                    }

                }
        
                // Perform the deletion based on lecturer name
                
            }

             ?>

    <div class="container">
        <h1 class="text-center">Manage Lecturer Information</h1>

        
        <form action="" method="post" id="form">
            <div class="mb-1">
                <label for="lecturerID" class="form-label">Lecturer ID</label>
                <input type="text" class="form-control" id="lecturerID" name="lecturerID" value="<?php echo $lecturerID; ?>">
            </div>
            <div class="mb-1">
                <label for="lecturerName" class="form-label">Lecturer Name</label>
                <input type="text" class="form-control" id="lecturerName" name="lecturerName" value="<?php echo $lecturerName; ?>">
            </div>
            <div class="mb-1">
                <label for="lecturerGrade" class="form-label">Lecturer Grade</label>
                <input type="text" class="form-control" id="lecturerGrade" name="lecturerGrade" value="<?php echo $lecturerGrade; ?>">
            </div>
            <div class="mb-1">
                <label for="lecturerQualification" class="form-label">Highest Qualification</label>
                <input type="text" class="form-control" id="lecturerQualification" name="lecturerQualification" value="<?php echo $lecturerQualification; ?>">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Add</button>
            <button type="submit" class="btn btn-danger" id="deleteButton" name="delete">Delete</button>
            <button type="submit" class="btn btn-warning" name="update">Update</button>
        </form>
        <form method="post" action="" class="searchlect">
        <style>
                
                .searchlect{
                    margin-left: 20px ;
                }

            </style>
        <label for="search">Search:</label>
        <input type="text" id="search" name="searchquery" placeholder="Enter search query">
        <button type="submit" name="searchLect">Search</button>
        </form>


        <!--
        <div class="mt-4">
            <input type="text" class="form-control" id="search" placeholder="Search">
        </div>
        
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Lecturer ID</th>
                    <th>Lecturer Name</th>
                    <th>Lecturer Grade</th>
                    <th>Lecturer Qualification</th>
                </tr>
            </thead>
            <tbody>
                Data rows will be displayed here 
            </tbody> -->
        <!--</table>-->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.getElementById('deleteButton').addEventListener('click', function () {
        if (confirm('Are you sure you want to delete this lecturer?')) {
            // If the user confirms, submit the form
            document.getElementById('form').submit();
        }
    });
    </script>
</body>
</html>
