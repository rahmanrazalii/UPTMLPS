<?php 
   session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>UPTM Load Projection System</title>

    <style>
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: #f8f9fa; /* Set your desired background color */
        }

        .uptm-logo {
            max-width: 80px;
            height: auto;
        }

        h1 {
            margin: 15px; /* Remove margin to prevent spacing */
            font-size: 1.5rem;
            text-align: left; /* Adjust the font size as needed */
        }
    </style>
</head>




<body>
      <div class="container">
        <div class="box form-box">
            <?php 
             
              include("php/config.php");
              if(isset($_POST['submit'])){
                $lecturerID = mysqli_real_escape_string($con,$_POST['lecturerID']);
                $password = mysqli_real_escape_string($con,$_POST['password']);

                $result = mysqli_query($con,"SELECT * FROM user WHERE lecturerID='$lecturerID' AND password='$password' ") or die("Select Error");
                $row = mysqli_fetch_assoc($result);

                if(is_array($row) && !empty($row)){
                    $_SESSION['valid'] = $row['lecturerID'];
                    $_SESSION['lecturerName'] = $row['lecturerName'];
                    $_SESSION['id'] = $row['id'];

                    $role = $row['userType'];
                    if ($role === 'lecturer') {
                        header("Location: home.php"); // Redirect to lecturer's home page
                    } elseif ($role === 'admin') {
                        header("Location: dashboard.php"); // Redirect to admin's home page
                    } else {
                        echo "Invalid role detected."; // Handle other roles if needed
                    }
                }else{
                    echo "<div class='message'>
                      <p>Wrong Username or Password</p>
                       </div> <br>";
                   echo "<a href='index.php'><button class='btn'>Go Back</button>";
         
                }
                
              }else{

            
            ?>
            <header>
                <img src="uptm.png" alt="UPTM Logo" class="uptm-logo">
                <h1>UPTM Load Projection System</h1>
            </header>
                

            <form action="" method="post">
                <div class="field input">
                    <label for="lecturerID">Lecturer ID</label>
                    <input type="text" name="lecturerID" id="lecturerID" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Login" required>
                </div>
                <div class="links">
                    Don't have account? <a href="register.php">Sign Up Now</a>
                </div>
            </form>
        </div>
        <?php } ?>
      </div>
</body>
</html>