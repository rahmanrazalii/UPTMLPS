<!DOCTYPE html>
<html lang="en">
<head>

    <?php include ("dashboard.php"); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subject Information</title>
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
             $subjectCode = "";
             $subjectName = "";
             $contactHours = "";


             include("php/config.php");
             if (isset($_POST['submit'])) {
                $subjectCode = $_POST['subjectCode'];
                $subjectName = $_POST['subjectName'];
                $contactHours = $_POST['contactHours'];
            
                // Check if any of the fields is empty
                if (empty($subjectCode) || empty($subjectName) || empty($contactHours)) {
                    echo "<div class='alert alert-danger' role='alert'>
                        All fields are required. Please fill in all the fields.
                    </div>";
                } else {
                    // All fields are filled, proceed with adding a new subject
                    mysqli_query($con,"INSERT INTO subject(subjectCode, subjectName, contactHours) VALUES('$subjectCode', '$subjectName', '$contactHours')") or die("Error Occurred");
            
                    $subjectCode = "";
                    $subjectName = "";
                    $contactHours = "";
                    echo "<div class='alert alert-success' role='alert'>
                        New course successfully added!
                    </div>";
                }
            }
             elseif(isset($_POST['searchSubj'])){
                $searchquery = $_POST['searchquery'];

                $result = mysqli_query($con, "SELECT * FROM subject WHERE subjectCode LIKE '%$searchquery%'") or die("Error Occurred");


                if (mysqli_num_rows($result) > 0) {
                    // Display the first result in the form fields
                    $row = mysqli_fetch_assoc($result);
                    $subjectCode = $row['subjectCode'];
                    $subjectName = $row['subjectName'];
                    $contactHours = $row['contactHours'];
                    
                } else {
                    echo "<div class='message'>
                        <p>No matching subject found</p>
                    </div> <br>";
                    
                }
            }
             elseif (isset($_POST['update'])) {

                $subjectCode = $_POST['subjectCode'];
                $subjectName = $_POST['subjectName'];
                $contactHours = $_POST['contactHours'];

                // Check if any of the fields is empty
                if (empty($subjectCode) || empty($subjectName) || empty($contactHours)) {
                    echo "<div class='alert alert-danger' role='alert'>
                        All fields are required. Please fill in all the fields.
                    </div>";
                } else {
                    // All fields are filled, proceed with the update
                    mysqli_query($con,"UPDATE subject SET subjectName = '$subjectName', contactHours = '$contactHours' WHERE subjectCode = '$subjectCode'") or die("Error Occurred");

                    echo '<div class="alert alert-warning" role="alert">
                        Subject Code: ' . $subjectCode . ' updated successfully.
                    </div>';
                }
            }
             elseif (isset($_POST['delete'])){
             
                $subjectCodeToDelete = $_POST['subjectCode'];


                if ($subjectCodeToDelete ===""){
                    echo '<script>alert("Please search correct subject code first");</script>';
                }
                else{
                // Perform the deletion based on subject code
                $deleteQuery = mysqli_query($con, "DELETE FROM subject WHERE subjectCode = '$subjectCodeToDelete'");
        
                if($deleteQuery) {
                    echo '<script>alert("Subject Code: ' . $subjectCodeToDelete . ' deleted successfully.");</script>';
                } else {
                    echo "Error deleting lecturer: " . mysqli_error($con);
                }

                }
                
        

            }
             

             ?>

    <div class="container">
        <h1 class="text-center">Manage Subject Information</h1>
        
        <form action="" method="post" id="form">
            <div class="mb-3">
                <label for="subjectCode" class="form-label">Subject Code</label>
                <input type="text" class="form-control" id="subjectCode" name="subjectCode" value="<?php echo $subjectCode; ?>">
            </div>
            <div class="mb-3">
                <label for="subjectName" class="form-label">Subject Name</label>
                <input type="text" class="form-control" id="subjectName" name="subjectName" value="<?php echo $subjectName; ?>">
            </div>
            <div class="mb-3">
                <label for="contactHours" class="form-label">Contact Hours</label>
                <input type="text" class="form-control" id="contactHours" name="contactHours" value="<?php echo $contactHours; ?>">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Add</button>
            <button type="submit" class="btn btn-danger" id="deleteButton" name="delete">Delete</button>
            <button type="submit" class="btn btn-warning" name="update">Update</button>
        </form>
        <form method="post" action="" class="searchSubj">
            <style>
                
                .searchSubj{
                    margin-left: 20px ;
                }

            </style>
        <label for="search">Search:</label>
        <input type="text" id="search" name="searchquery" placeholder="Enter search query">
        <button type="submit" name="searchSubj">Search</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.getElementById('deleteButton').addEventListener('click', function () {
        if (confirm('Are you sure you want to delete this subject?')) {
            // If the user confirms, submit the form
            document.getElementById('form').submit();
        }
    });
    </script>
</body>
</html>
