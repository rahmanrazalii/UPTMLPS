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
    <title>Change Password</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">UPTM LOAD PROJECTION SYSTEM</a></p>
        </div>

        <div class="right-links">
            <a href="#">Change Password</a>
            <a href="php/logout.php"> <button class="btn">Log Out</button> </a>
        </div>
    </div>
    <div class="container">
        <div class="box form-box">
            <?php 
               if(isset($_POST['submit'])){
                $username = $_POST['lecturerName'];
                $lecturerID = $_POST['lecturerID'];
                $password = $_POST['password'];

                $id = $_SESSION['id'];

                $edit_query = mysqli_query($con,"UPDATE user SET lecturerName='$username', lecturerID='$lecturerID', password = '$password' WHERE Id=$id ") or die("error occurred");

                if($edit_query){
                    echo "<div class='message'>
                    <p>Password changed!</p>
                </div> <br>";
              echo "<a href='home.php'><button class='btn'>Go Home</button>";
       
                }
               }else{

                $id = $_SESSION['id'];
                $query = mysqli_query($con,"SELECT * FROM user WHERE Id=$id ");

                if (!$query) {
                    die("Error: " . mysqli_error($con));
                }
                else{

                    while($result = mysqli_fetch_assoc($query)){
                    $res_Lname = $result['lecturerName'];
                    $res_LID = $result['lecturerID'];
                    $res_Password = $result['password'];

                }


                }

            ?>
            <header>Change Password</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="lectureName">Lecturer name</label>
                    <input type="text" name="lecturerName" id="lecturerName" value="<?php echo $res_Lname; ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="lecturerID">Lecturer ID</label>
                    <input type="text" name="lecturerID" id="lecturerID" value="<?php echo $res_LID; ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">New password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>


                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Update" required>
                </div>
                <div>
                    <a href="php/home.php"> <button class="btn">Back</button> </a>
                </div>
                
            </form>
        </div>
        <?php } ?>
      </div>
</body>
</html>