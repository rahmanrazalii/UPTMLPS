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
    <title>Home</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">UPTM LOAD PROJECTION SYSTEM</a> </p>
        </div>

        <div class="right-links">

            <?php 
            
            $id = $_SESSION['id'];
            $res_Lname = "";
                $res_LID = "";
                $res_id = "";
            $query = mysqli_query($con, "SELECT * FROM user WHERE id=$id");
        if ($query) {
            while ($result = mysqli_fetch_assoc($query)) {
                $res_Lname = $result['lecturerName'];
                $res_LID = $result['lecturerID'];
                $res_id = $result['id'];
    }
} else {
    echo "Query failed: " . mysqli_error($con);
}

            
            echo "<a href='updateprofile.php?lecturerID=$res_LID'>Update Profile</a>";
            

            echo "<a href='edit.php?Id=$res_id'>Change Password</a>";
            ?>

            <a href="php/logout.php"> <button class="btn">Log Out</button> </a>

        </div>
    </div>
    <main>

       <div class="main-box top">
          <div class="top">
            <div class="box">
                <p>Hello <b><?php echo $res_Lname ?></b>, Welcome</p>
            </div>
            <div class="box">
                <p>Your ID is <b><?php echo $res_LID ?></b>.</p>
            </div>
                
            <div class="main">
                <a href="viewprojectionL.php?lecturerID=<?php echo $res_LID; ?>"> <button class="view-button">View Projection</button> </a>
            </div>
          </div>
       </div>
    </main>


</body>
</html>