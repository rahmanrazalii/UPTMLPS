<!DOCTYPE html>
<html lang="en">
<head>
    <?php include ("dashboard.php"); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programme Information</title>
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
             
            $programme = '';
            $programmeName = '';


             include("php/config.php");
             if(isset($_POST['submit'])){
                $programmeName = $_POST['programmeName'];
                $programme = $_POST['programme'];


                if (empty($programme) || empty($programmeName)) {
                    echo "<div class='alert alert-danger' role='alert'>
                        All fields are required. Please fill in all the fields.
                    </div>";
                } else {
                    // All fields are filled, proceed with adding a new program
                    mysqli_query($con,"INSERT INTO programme (programmeName, programme) VALUES('$programmeName', '$programme')") or die("Error Occurred");
            
                    $programme = '';
                    $programmeName = '';
            
                    echo "<div class='alert alert-success' role='alert'>
                        New program added successfully!
                    </div>";
                }
            }
             elseif(isset($_POST['searchProgramme'])){
                $searchquery = $_POST['searchquery'];

                $result = mysqli_query($con, "SELECT * FROM programme WHERE programme LIKE '%$searchquery%'") or die("Error Occurred");


                if (mysqli_num_rows($result) > 0) {
                    // Display the first result in the form fields
                    $row = mysqli_fetch_assoc($result);
                    $programme = $row['programme'];
                    $programmeName = $row['programmeName'];

                } else {
                    echo "<div class='message'>
                        <p>No matching programmes found</p>
                    </div> <br>";
                    // Set variables to empty strings if no results are found
                    /*$lecturerID = '';
                    $lecturerName = '';
                    $lecturerGrade = '';
                    $lecturerQualification = '';*/
                }
            }

            
             elseif(isset($_POST['update'])){
                $programmeName = $_POST['programmeName'];
                $programme = $_POST['programme'];

                if (empty($programme) || empty($programmeName)) {
                    echo "<div class='alert alert-danger' role='alert'>
                        All fields are required. Please fill in all the fields.
                    </div>";
                } else {
                    // All fields are filled, proceed with the update
                    mysqli_query($con,"UPDATE programme SET programmeName = '$programmeName' WHERE programme = '$programme'") or die("Error Occurred");
            
                    echo '<div class="alert alert-warning" role="alert">
                        Programme Code: ' . $programme . ' updated successfully.
                    </div>';
                }
            
             }
             elseif(isset($_POST['delete'])){
                $programmeToDelete = $_POST['programme'];

                if ($programmeToDelete ===""){
                    echo '<script>alert("Please search correct programme code");</script>';
                }
                else{

                    // Perform the deletion based on lecturer name
                $deleteQuery = mysqli_query($con, "DELETE FROM programme WHERE programme = '$programmeToDelete'");
        
                if($deleteQuery) {
                    echo '<script>alert("Programme Code: ' . $programmeToDelete . ' deleted successfully.");</script>';
                } else {
                    echo "Error deleting lecturer: " . mysqli_error($con);
                }

                }
                
            }

             ?>

    <div class="container">
        <h1 class="text-center">Manage Programme Information</h1>
        
        <form action="" method="post" id="form" class="formProg">
            <style>

                .formProg{

                    margin-right: 10px;
                    max-width: 30%;

                }

            </style>
            <div class="mb-1">
                <label for="programme" class="form-label">Programme Code</label>
                <input type="text" class="form-control" id="programme" name="programme" value="<?php echo $programme; ?>">
            </div>
            <div class="mb-1">
                 <label for="programmeName" class="form-label">Programme Name</label>
                <input type="text" class="form-control" id="programmeName" name="programmeName" value="<?php echo $programmeName; ?>">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Add</button>
            <button type="submit" class="btn btn-danger" id="deleteButton" name="delete">Delete</button>
            <button type="submit" class="btn btn-warning" name="update">Update</button>
        </form>
        <form method="post" action="" class="searchProgramme">
        <style>
                
                .searchProgramme{
                    margin-left: 20px ;
                }

            </style>
        <label for="search">Search:</label>
        <input type="text" id="search" name="searchquery" placeholder="Enter search query">
        <button type="submit" name="searchProgramme">Search</button>
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
        if (confirm('Are you sure you want to delete this programme?')) {
            // If the user confirms, submit the form
            document.getElementById('form').submit();
        }
    });
    </script>
</body>
</html>
