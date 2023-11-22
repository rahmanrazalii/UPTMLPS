<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Register</title>
</head>
<body>
      <div class="container">
        <div class="box form-box">

        <?php 

            include("php/config.php");
            if(isset($_POST['submit'])){
            $username = $_POST['lecturerName'];
            $lecturerID = $_POST['lecturerID'];
            $password = $_POST['password'];
            $userType = "lecturer";

            // Password constraints
            $password_min_length = 8;
            $uppercase_required = true;
            $lowercase_required = true;
            $digit_required = true;
            $special_characters_required = false; // You can set this to true if you want to require special characters.

            $errors = [];

            // Check password length
            if (strlen($password) < $password_min_length) {
                $errors[] = "Password must be at least $password_min_length characters long.";
            }

            // Check for uppercase letter
            if ($uppercase_required && !preg_match('/[A-Z]/', $password)) {
                $errors[] = "Password must contain at least one uppercase letter.";
            }

            // Check for lowercase letter
            if ($lowercase_required && !preg_match('/[a-z]/', $password)) {
                $errors[] = "Password must contain at least one lowercase letter.";
            }

            // Check for a digit
            if ($digit_required && !preg_match('/\d/', $password)) {
                $errors[] = "Password must contain at least one digit.";
            }

            // You can add special character validation here if needed.

            if (empty($errors)) {
                // Password is valid, proceed with registration.
                mysqli_query($con, "INSERT INTO user(lecturerName, lecturerID, password, userType) VALUES('$username', '$lecturerID', '$password', '$userType')") or die("Error Occurred");

                echo "<div class='message'>
                            <p>Registration successfully!</p>
                        </div> <br>";
                echo "<a href='index.php'><button class='btn'>Login Now</button>";
            } else {
                // Password is invalid, display error messages.
                echo "<div class='message'>";
                foreach ($errors as $error) {
                    echo "<p>$error</p>";
                }
                echo "</div> <br>";
                echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
            }
            }
         
         /*include("php/config.php");
         if(isset($_POST['submit'])){
            $username = $_POST['lecturerName'];
            $lecturerID = $_POST['lecturerID'];
            $password = $_POST['password'];
            $userType = "lecturer";

         //verifying the unique email

         /*$verify_query = mysqli_query($con,"SELECT lecturerID FROM user WHERE lecturerID='$lecturerID'");

         if(mysqli_num_rows($verify_query) !=0 ){
            echo "<div class='message'>
                      <p>This lecturerID is invalid, Try another One Please!</p>
                  </div> <br>";
            echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
         }
         else{

            mysqli_query($con,"INSERT INTO user(lecturerName,lecturerID,password,userType) VALUES('$username','$lecturerID','$password','$userType')") or die("Error Occured");

            echo "<div class='message'>
                      <p>Registration successfully!</p>
                  </div> <br>";
            echo "<a href='index.php'><button class='btn'>Login Now</button>";
         

         }*/

        // }
        else{
         
        ?>

            <header>Sign Up</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="lecturerName">Lecturer Name</label>
                    <input type="text" name="lecturerName" id="lecturerName" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="lecturerID">Lecturer ID</label>
                    <input type="text" name="lecturerID" id="lecturerID" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Register" required>
                </div>
                <div class="links">
                    Already a member? <a href="index.php">Sign In</a>
                </div>
            </form>
        </div>
        <?php } ?>
      </div>
</body>
</html>