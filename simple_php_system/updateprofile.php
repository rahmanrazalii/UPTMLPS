<?php 
   session_start();

   include("php/config.php");
   if(!isset($_SESSION['valid'])){
    header("Location: index.php");
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Change Profile</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">UPTM LOAD PROJECTION SYSTEM</a></p>
        </div>

        <div class="right-links">
            <!--<a href="#">Change Profile</a>-->
            <a href="php/logout.php"> <button class="btn">Log Out</button> </a>
        </div>
    </div>
    <div class="container">
        <div class="box form-box">
            <?php 
                $updateCompleted = false;

               if (isset($_POST['submit'])) {
                $lecturerName = $_POST['lecturerName'];
                $lecturerID = $_POST['lecturerID'];
                $lecturerGrade = $_POST['lecturerGrade'];
                $lecturerQualification = $_POST['lecturerQualification'];
         
                // Check if the lecturerID is not empty
                if (!empty($lecturerID)) {
                    $id = $_GET['lecturerID'];
         
                    // Check if the provided lecturerID matches the session lecturerID
                    if ($lecturerID == $id) {
                        $edit_query = mysqli_query($con, "UPDATE lecturer SET lecturerName='$lecturerName', lecturerGrade='$lecturerGrade', lecturerQualification='$lecturerQualification' WHERE lecturerID='$id'") or die("Error occurred");
         
                        $edit_query1 = mysqli_query($con, "UPDATE user SET lecturerName='$lecturerName' WHERE lecturerID='$id'") or die("Error occurred");
         
                        if ($edit_query && $edit_query1) {
                            $updateCompleted = true;
                            
                        } else {
                            echo "Error: " . mysqli_error($con);
                        }
                    } else {
                        echo "Error: Provided lecturer ID does not match the session lecturer ID.";
                    }
                } else {
                    echo "Error: Lecturer ID is empty.";
                }
            } else{
                // Display the form
                if (!$updateCompleted) {
                $id = $_GET['lecturerID'];
                $query = mysqli_query($con, "SELECT * FROM user WHERE lecturerID='$id'");
                $query1 = mysqli_query($con, "SELECT * FROM lecturer WHERE lecturerID='$id'");
         
                if (!$query || !$query1) {
                    die("Error: " . mysqli_error($con));
                }
         
                // Initialize variables to store data
                $res_Lname1 = "";
                $res_LID1 = "";
                $res_Lgrade = "";
                $res_Lqualification = "";
         
                while ($result = mysqli_fetch_assoc($query)) {
                    $res_Lname1 = $result['lecturerName'];
                    $res_LID1 = $result['lecturerID'];
                    // Assuming you have a column named 'password' in the 'user' table
                    $res_Password = $result['password'];
                }
         
                while ($result = mysqli_fetch_assoc($query1)) {
                    $res_Lname1 = $result['lecturerName'];
                    $res_LID1 = $result['lecturerID'];
                    $res_Lgrade = $result['lecturerGrade'];
                    $res_Lqualification = $result['lecturerQualification'];
                }
            }
        }
         ?>   
         
         <div class="container">
        <div class="box form-box">
            <?php
            if ($updateCompleted) {
                // Display a success message instead of the form
                echo "<div class='message'>
                <p>Profile updated!</p>
                </div> <br>";
                echo "<a href='home.php'><button class='btn'>Go Home</button>";
            } else {
                ?>
            <header>Change Profile</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="lectureName">Lecturer name</label>
                    <input type="text" name="lecturerName" id="lecturerName" value="<?php echo $res_Lname1; ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="lecturerID">Lecturer ID</label>
                    <input type="text" name="lecturerID" id="lecturerID" value="<?php echo $res_LID1; ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="lecturerGrade">Lecturer Grade</label>
                    <input type="text" name="lecturerGrade" id="lecturerGrade" value="<?php echo $res_Lgrade; ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="lecturerQualification">Lecturer Qualification</label>
                    <input type="text" name="lecturerQualification" id="lecturerQualification" value="<?php echo $res_Lqualification; ?>" autocomplete="off" required>
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Update" required>
                </div>
                <div>
                    <button class="btn" onclick="goBack()">Back</button>
                </div>
            </form>
        </div>
        <?php } ?>
      </div>

    <script>
    function goBack() {
        window.history.back();
    }
    </script>

</body>
</html>
