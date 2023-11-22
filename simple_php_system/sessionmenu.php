<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("dashboard.php"); ?>
    <?php include("php/config.php"); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programme Information</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css">
    <style>
        .container {
            
        }

        /* Styles for the overlay */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1;
        }

        /* Styles for the popup */
        .popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            z-index: 2;
            max-height: 70%;
            overflow-y: auto;
        }

        /* Close button style */
        .close {
            position: absolute;
            top: 0;
            right: 0;
            padding: 10px;
            cursor: pointer;
        }

        /* Custom button styles */
        .button24 {
            background: linear-gradient(to bottom, #667db6, #0082c8);
            border: 0;
            border-radius: 5px;
            color: #fff;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.3s;
            width: 150px;
            height: 120px;
            margin-bottom: 20px;
            margin-top: 20px;
            margin-left: 10px;
            padding: 10px 10px;
        }

        /* Add new session button style */
        .button24.add-session {
            background: linear-gradient(to bottom, #2ecc71, #27ae60);
        }

    </style>
</head>
<body>
    <h1 class="text-center">View Workload Projection Report</h1>
<div class="container">
    <h2>Select Session:</h2>
    <?php
    // Fetch session names from the database
    $result = mysqli_query($con, "SELECT sessionName FROM session");

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $sessionName = $row['sessionName'];
            // Create a button for each session
            echo "<form method='get' action='workloadreportdesign.php'>";
            echo "<button type='submit' name='session' value='$sessionName' class='btn btn-primary button24'>$sessionName</button>";
            echo "</form>";
        }
        // Add "All records" button
            echo "<form method='get' action='workloadreportdesign.php'>";
            echo "<button type='submit' name='allRecords' class='btn btn-primary button24'>All records</button>";
            echo "</form>";

        // Add "Add new session" button
        echo "<button class='btn btn-success button24 add-session' onclick='openPopup()'>Add new session</button>";
    } else {
        echo "No sessions found.";
    }
    ?>
</div>

<div class="overlay" id="overlay"></div>

<!-- The popup -->
<div class="popup" id="popup">
    <span class="close" onclick="closePopup()">&times;</span>
    <h2>New Session</h2>
    <form method="post"> <!-- Use POST method for form submission -->
        <div class="mb-3">
            <label for="sessionName" class="form-label">Session:</label>
            <input type="text" class="form-control" id="sessionName" name="sessionName" placeholder="eg: 0723">
        </div>
        <button class="btn btn-success button24" type="submit" name="submit1" id="submit1">Add Session</button>
    </form>
    <?php
    if(isset($_POST['submit1'])){
        $sessionName = $_POST['sessionName'];

        mysqli_query($con,"INSERT INTO session(sessionName) VALUES('$sessionName')") or die("Error Occurred");
        echo "<div class='message'>
                  <p>New session successfully added!</p>
              </div> <br>";
    }
    ?>
</div>

<script>
    function openPopup() {
        document.getElementById("overlay").style.display = "block";
        document.getElementById("popup").style.display = "block";
    }

    function closePopup() {
        document.getElementById("overlay").style.display = "none";
        document.getElementById("popup").style.display = "none";
    }
</script>
</body>
</html>
