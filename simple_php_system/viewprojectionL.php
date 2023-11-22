<?php 
   error_reporting(E_ALL);
   ini_set('display_errors', 1);
   
   session_start();

   include("php/config.php");
   if(!isset($_SESSION['valid'])){
      header("Location: index.php");
      exit; // Ensure script stops execution
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>View Projection</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">UPTM LOAD PROJECTION SYSTEM</a></p>
        </div>

        <div class="right-links">
            <a href="php/logout.php"> <button class="btn">Log Out</button> </a>
        </div>
    </div>
    <div class="container">
        <div class="box form-box">
            <style>

                .form-box{

                    width: 120%;
                    margin-left: 100px;
                }
                

            </style>
            <?php 
               // Check if 'lecturerID' is set in the URL
               if(isset($_GET['lecturerID'])){
                
                  $lecturerID = $_GET['lecturerID'];
                  
                  // Attempt to execute the query
                  $query = mysqli_query($con, "SELECT * FROM workload WHERE lecturerID='$lecturerID'");
                  
                  if (!$query) {
                     die("Database Error: " . mysqli_error($con));
                  }
               } else {
                  die("Error: 'lecturerID' is not set in the URL.");
               }
            ?>
            <header>PROJECTION</header>
            <table>
                <thead>
                    <tr>
                        <th>Lecturer ID</th>
                        <th>Subject Code</th>
                        <th>Programme</th>
                        <th>Education Level</th>
                        <th>Semester</th>
                        <th>Mentor</th>
                        <th>Supervising</th>
                        <th>Total Student</th>
                        <th>Total Contact Hours</th>
                        <th>Total Workload</th>
                        <th>Teaching Period</th>
                        <th>Roles</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Loop through the fetched data and generate table rows
                    while ($row = mysqli_fetch_assoc($query)) {
                        echo "<tr>";
                        echo "<td>" . $row['lecturerID'] . "</td>";
                        echo "<td>" . $row['subjectCode'] . "</td>";
                        echo "<td>" . $row['programme'] . "</td>";
                        echo "<td>" . $row['level'] . "</td>";
                        echo "<td>" . $row['semester'] . "</td>";
                        echo "<td>" . $row['mentor'] . "</td>";
                        echo "<td>" . $row['supervising'] . "</td>";
                        echo "<td>" . $row['totalStudent'] . "</td>";
                        echo "<td>" . $row['totalContactHours'] . "</td>";
                        echo "<td>" . $row['totalWorkload'] . "</td>";
                        echo "<td>" . $row['teachingPeriod'] . "</td>";
                        echo "<td>" . $row['otherRoles'] . "</td>";
                        // Add more table data cells for additional columns
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>           
</body>
</html>
