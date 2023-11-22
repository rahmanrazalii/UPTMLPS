<!DOCTYPE html>
<html lang="en">
<head>
    <?php ini_set('display_errors', 1);
        error_reporting(E_ALL); 
        $totalContactHours = '';
        $sessionName = "";
        ?>

    <?php include("php/config.php"); ?>
    <?php include ("dashboard.php"); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecturer Information</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css">
    <style>

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
            max-height: 70%; /* Limit the maximum height */
            overflow-y: auto; /* Add vertical scrollbar if content overflows */
        }

    </style>

</head>
<body>



<!-- The overlay -->
<div class="overlay" id="overlay"></div>

<!-- The popup -->
<div class="popup" id="popup">
    <span class="close" onclick="closePopup()">&times;</span>
    <h2>Lecturer Information</h2>
    <p>Search lecturer information and search past subject matters</p>
    <div class="containerPopup">
        <style>

            .containerPopup{
                margin: 0px 0px;
                padding: 0px 15px;
            }

        </style>
        <div class="row">
            <div class="col-md-10">
                <h2>Select a Lecturer:</h2>
                <form action="" method="post">
                <div class="form-group">
                    <label for="lecturerID">Lecturer:</label>
                    <select class="form-control" id="lecturerIDlist" name="lecturerIDlist">
                    <?php

                    $result = mysqli_query($con, "SELECT lecturerID, lecturerName, lecturerGrade, lecturerQualification FROM lecturer");

                    if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['lecturerID'] . '">' . $row['lecturerName'] . '</option>';
                    }
                    } else {
                    echo '<option value="">No Lecturers Found</option>';
                    }


                    ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Select Lecturer</button>
                </form>
                </div>
                <div class="col-md-8">
                <h2>Lecturer Information:</h2>
                <?php
                // Display selected lecturer information here
                if (isset($_POST['submit'])) {
                $selectedLecturerID = $_POST['lecturerIDlist'];


                $result = mysqli_query($con, "SELECT * FROM lecturer WHERE lecturerID = $selectedLecturerID");

                if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                echo '<p><strong>Lecturer ID:</strong> ' . $row['lecturerID'] . '</p>';
                echo '<p><strong>Lecturer Name:</strong> ' . $row['lecturerName'] . '</p>';
                echo '<p><strong>Lecturer Grade:</strong> ' . $row['lecturerGrade'] . '</p>';
                echo '<p><strong>Lecturer Qualification:</strong> ' . $row['lecturerQualification'] . '</p>';

                // Add more fields as needed
                } else {
                echo '<p>No information found for the selected lecturer.</p>';
                }


                }
                ?>
            </div>
        </div>
    </div>

    <div class="containerPopup">
        <div class="row">
            <div class="col-md-10">
                <h2>Select a subject:</h2>
                <form action="" method="post">
                <div class="form-group">
                <label for="subjectCode">Subject:</label>
                <select class="form-control" id="subjectCodelist" name="subjectCodelist">
                <?php
                $result = mysqli_query($con, "SELECT subjectCode, subjectName, contactHours FROM subject");

                if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $subjectCode = $row['subjectCode'];
                    $subjectName = $row['subjectName'];
                    echo '<option value="' . $subjectCode . '|' . $subjectName . '">' . $subjectCode . ' - ' . $subjectName . '</option>';
                }
                } else {
                echo '<option value="">No subject found</option>';
                }
                ?>
                </select>

                </div>
                <button type="submit" class="btn btn-primary" name="Submit">Select Subject</button>
                </form>
                </div>
                <div class="col-md-8">
                <h2>Subject Information:</h2>
                <?php
                // Display selected subject information here
                if (isset($_POST['Submit'])) {
                $selectedSubjectValue = $_POST['subjectCodelist'];

                // Split the selected value into subject code and subject name
                list($selectedSubjectCode, $selectedSubjectName) = explode('|', $selectedSubjectValue);

                $stmt = $con->prepare("SELECT * FROM subject WHERE subjectCode = ?");
                $stmt->bind_param("s", $selectedSubjectCode);

                // Execute the query
                $stmt->execute();

                // Get the result
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                echo '<p><strong>Subject Code:</strong> ' . $row['subjectCode'] . '</p>';
                echo '<p><strong>Subject Name:</strong> ' . $row['subjectName'] . '</p>';
                echo '<p><strong>Contact Hours:</strong> ' . $row['contactHours'] . '</p>';

                }
                }
                else {
                echo '<p>No information found for the selected subject.</p>';
                }


                }
                ?>
            </div>
        </div>
    </div>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-4">
                <?php

                if (isset($_POST['Submit'])) {
                $con2 = mysqli_connect("localhost","root","","dummydatabase") or die("Couldn't connect");
                $selectedSubjectValue = $_POST['subjectCodelist'];

                // Split the selected value into subject code and subject name
                list($selectedSubjectCode, $selectedSubjectName) = explode('|', $selectedSubjectValue);
                $keyword = $selectedSubjectCode; // Keyword to search for
                $allResults = [];

                $tableName = "0421";

                //foreach ($tableNames as $tableName) {

                $query = "SELECT * FROM `$tableName` WHERE subjectCode LIKE ?";
                $likePattern = "%$keyword%";
                $stmt = $con2->prepare($query);
                $stmt->bind_param("s", $likePattern);
                $stmt->execute();
                $result = $stmt->get_result();


                if ($result) {
                // Fetch and store the results
                while ($row2 = $result->fetch_assoc()) {
                $allResults[] = $row2;
                }

                } else {
                // Print any errors for debugging
                echo "Error in query: " . mysqli_error($con2);
                }

                $tableName = "0721";

                //foreach ($tableNames as $tableName) {

                $query = "SELECT * FROM `$tableName` WHERE subjectCode LIKE ?";
                $likePattern = "%$keyword%";
                $stmt = $con2->prepare($query);
                $stmt->bind_param("s", $likePattern);
                $stmt->execute();
                $result = $stmt->get_result();


                if ($result) {
                // Fetch and store the results
                while ($row2 = $result->fetch_assoc()) {
                $allResults[] = $row2;
                }

                } else {
                // Print any errors for debugging
                echo "Error in query: " . mysqli_error($con2);
                }

                $tableName = "1121";

                //foreach ($tableNames as $tableName) {

                $query = "SELECT * FROM `$tableName` WHERE subjectCode LIKE ?";
                $likePattern = "%$keyword%";
                $stmt = $con2->prepare($query);
                $stmt->bind_param("s", $likePattern);
                $stmt->execute();
                $result = $stmt->get_result();


                if ($result) {
                // Fetch and store the results
                while ($row2 = $result->fetch_assoc()) {
                $allResults[] = $row2;
                }

                } else {
                // Print any errors for debugging
                echo "Error in query: " . mysqli_error($con2);
                }

                $tableName = "0722";

                //foreach ($tableNames as $tableName) {

                $query = "SELECT * FROM `$tableName` WHERE subjectCode LIKE ?";
                $likePattern = "%$keyword%";
                $stmt = $con2->prepare($query);
                $stmt->bind_param("s", $likePattern);
                $stmt->execute();
                $result = $stmt->get_result();


                if ($result) {
                // Fetch and store the results
                while ($row2 = $result->fetch_assoc()) {
                $allResults[] = $row2;
                }

                } else {
                // Print any errors for debugging
                echo "Error in query: " . mysqli_error($con2);
                }

                $tableName = "1122";

                //foreach ($tableNames as $tableName) {

                $query = "SELECT * FROM `$tableName` WHERE subjectCode LIKE ?";
                $likePattern = "%$keyword%";
                $stmt = $con2->prepare($query);
                $stmt->bind_param("s", $likePattern);
                $stmt->execute();
                $result = $stmt->get_result();


                if ($result) {
                // Fetch and store the results
                while ($row2 = $result->fetch_assoc()) {
                $allResults[] = $row2;
                }

                } else {
                // Print any errors for debugging
                echo "Error in query: " . mysqli_error($con2);
                }

                $tableName = "0423";

                //foreach ($tableNames as $tableName) {

                $query = "SELECT * FROM `$tableName` WHERE subjectCode LIKE ?";
                $likePattern = "%$keyword%";
                $stmt = $con2->prepare($query);
                $stmt->bind_param("s", $likePattern);
                $stmt->execute();
                $result = $stmt->get_result();


                if ($result) {
                // Fetch and store the results
                while ($row2 = $result->fetch_assoc()) {
                $allResults[] = $row2;
                }

                } else {
                // Print any errors for debugging
                echo "Error in query: " . mysqli_error($con2);
                }

                $tableName = "0723";

                //foreach ($tableNames as $tableName) {

                $query = "SELECT * FROM `$tableName` WHERE subjectCode LIKE ?";
                $likePattern = "%$keyword%";
                $stmt = $con2->prepare($query);
                $stmt->bind_param("s", $likePattern);
                $stmt->execute();
                $result = $stmt->get_result();


                if ($result) {
                // Fetch and store the results
                while ($row2 = $result->fetch_assoc()) {
                $allResults[] = $row2;
                }

                } else {
                // Print any errors for debugging
                echo "Error in query: " . mysqli_error($con2);
                }


                }


                // Display the results
                if (!empty($allResults)) {
                echo "<h2>Search by Subject Code</h2>";
                echo "<table border='2'>";
                echo "<tr><th>Subject Code</th><th>Past Lecturers</th><th>Subject Name</th></tr>";
                foreach ($allResults as $result) {
                echo "<tr>";
                echo "<td>" . $result['subjectCode'] . "</td>";
                echo "<td>" . $result['lecturerName'] . "</td>";
                echo "<td>" . $result['subjectName'] . "</td>";
                echo "</tr>";
                }
                echo "</table>";
                } else {
                echo "<p>No results found.</p>"; // Moved this message inside the else condition
                if (isset($_POST['Submit'])) {
                $selectedSubjectValue = $_POST['subjectCodelist'];

                // Split the selected value into subject code and subject name
                list($selectedSubjectCode, $selectedSubjectName) = explode('|', $selectedSubjectValue);

                $tableName = "0421";

                $query = "SELECT * FROM `$tableName` WHERE subjectName LIKE ?";
                $keyword = $selectedSubjectName;
                $likePattern = "%$keyword%";
                $stmt = $con2->prepare($query);
                $stmt->bind_param("s", $likePattern);
                $stmt->execute();
                $result = $stmt->get_result();


                if ($result) {
                // Fetch and store the results
                while ($row2 = $result->fetch_assoc()) {
                $allResults[] = $row2;
                }

                } else {
                // Print any errors for debugging
                echo "Error in query: " . mysqli_error($con2);
                }

                $tableName = "0721";

                $query = "SELECT * FROM `$tableName` WHERE subjectName LIKE ?";
                $keyword = $selectedSubjectName;
                $likePattern = "%$keyword%";
                $stmt = $con2->prepare($query);
                $stmt->bind_param("s", $likePattern);
                $stmt->execute();
                $result = $stmt->get_result();


                if ($result) {
                // Fetch and store the results
                while ($row2 = $result->fetch_assoc()) {
                $allResults[] = $row2;
                //array_push($allResults, $tableName);
                }

                } else {
                // Print any errors for debugging
                echo "Error in query: " . mysqli_error($con2);
                }


                $tableName = "1121";

                $query = "SELECT * FROM `$tableName` WHERE subjectName LIKE ?";
                $keyword = $selectedSubjectName;
                $likePattern = "%$keyword%";
                $stmt = $con2->prepare($query);
                $stmt->bind_param("s", $likePattern);
                $stmt->execute();
                $result = $stmt->get_result();


                if ($result) {
                // Fetch and store the results
                while ($row2 = $result->fetch_assoc()) {
                $allResults[] = $row2;
                //array_push($allResults, $tableName);
                }

                } else {
                // Print any errors for debugging
                echo "Error in query: " . mysqli_error($con2);
                }


                $tableName = "0722";

                $query = "SELECT * FROM `$tableName` WHERE subjectName LIKE ?";
                $keyword = $selectedSubjectName;
                $likePattern = "%$keyword%";
                $stmt = $con2->prepare($query);
                $stmt->bind_param("s", $likePattern);
                $stmt->execute();
                $result = $stmt->get_result();


                if ($result) {
                // Fetch and store the results
                while ($row2 = $result->fetch_assoc()) {
                $allResults[] = $row2;
                //array_push($allResults, $tableName);
                }

                } else {
                // Print any errors for debugging
                echo "Error in query: " . mysqli_error($con2);
                }


                $tableName = "1122";

                $query = "SELECT * FROM `$tableName` WHERE subjectName LIKE ?";
                $keyword = $selectedSubjectName;
                $likePattern = "%$keyword%";
                $stmt = $con2->prepare($query);
                $stmt->bind_param("s", $likePattern);
                $stmt->execute();
                $result = $stmt->get_result();


                if ($result) {
                // Fetch and store the results
                while ($row2 = $result->fetch_assoc()) {
                $allResults[] = $row2;
                //array_push($allResults, $tableName);
                }

                } else {
                // Print any errors for debugging
                echo "Error in query: " . mysqli_error($con2);
                }


                $tableName = "0423";

                $query = "SELECT * FROM `$tableName` WHERE subjectName LIKE ?";
                $keyword = $selectedSubjectName;
                $likePattern = "%$keyword%";
                $stmt = $con2->prepare($query);
                $stmt->bind_param("s", $likePattern);
                $stmt->execute();
                $result = $stmt->get_result();


                if ($result) {
                // Fetch and store the results
                while ($row2 = $result->fetch_assoc()) {
                $allResults[] = $row2;
                //array_push($allResults, $tableName);
                }

                } else {
                // Print any errors for debugging
                echo "Error in query: " . mysqli_error($con2);
                }


                $tableName = "0723";

                $query = "SELECT * FROM `$tableName` WHERE subjectName LIKE ?";
                $keyword = $selectedSubjectName;
                $likePattern = "%$keyword%";
                $stmt = $con2->prepare($query);
                $stmt->bind_param("s", $likePattern);
                $stmt->execute();
                $result = $stmt->get_result();


                if ($result) {
                // Fetch and store the results
                while ($row2 = $result->fetch_assoc()) {
                $allResults[] = $row2;
                //array_push($allResults, $tableName);
                }

                } else {
                // Print any errors for debugging
                echo "Error in query: " . mysqli_error($con2);
                }




                }
                }

                // Display the results
                if (!empty($allResults)) {
                echo "<h2>Search by Subject Name</h2>";
                echo "<table border='2'>";
                echo "<tr><th>Subject Code</th><th>Past Lecturers</th><th>Subject Name</th></tr>";
                foreach ($allResults as $result) {
                echo "<tr>";
                echo "<td>" . $result['subjectCode'] . "</td>";
                echo "<td>" . $result['lecturerName'] . "</td>";
                echo "<td>" . $result['subjectName'] . "</td>";
                //echo "<td>".$result[$tableName]. "</td>";
                echo "</tr>";
                }
                echo "</table>";
                } else {
                echo "<p>No results found.</p>"; // Moved this message inside the else condition
                }







                // Now $allResults contains all matching rows from all 10 tables
                // You can display or process them as needed
                ?>
        </div>
    </div>
</div>
            </div>
            
        


    <div class="container mt-5">
            <div class="row">
                <div class="col-md-8">
                    <h2 class="text-center">Manage Workload</h2>
                    <form action="" method="post" id="formLoad">
                    <div class="form-group">

                            <label for="Session">Session:</label>
                            <select class="form-control" id="sessionList" name="sessionList">
                                <?php

                                    $result = mysqli_query($con, "SELECT sessionName FROM session");
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            //echo '<option value=' . $row['sessionName'].'</option>';
                                            $sessionName = $row['sessionName'];
                                            
                                            echo '<option value="' . $sessionName.'">' . $sessionName .'</option>';
                                        }
                                    } else {
                                        echo '<option value="">No Session Available</option>';
                                    }

                                ?>
                                </select>

                            <label for="lecturerID">Lecturer:</label>
                            <select class="form-control" id="lecturerIDlist" name="lecturerIDlist">
                            <?php

                                $result = mysqli_query($con, "SELECT lecturerID, lecturerName, lecturerGrade, lecturerQualification FROM lecturer");

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        //echo '<option value="' . $row['lecturerID'] . '">' . $row['lecturerName'] . '</option>';
                                        $lecturerID = $row['lecturerID'];
                                        $lecturerName = $row['lecturerName'];
                                        echo '<option value="' . $lecturerID.'">' . $lecturerID . ' - ' . $lecturerName . '</option>';
                                    }
                                } else {
                                    echo '<option value="">No Lecturers Found</option>';
                                }

                                
                                ?>
                            </select>
                        </div>
                        <div class="search-past">
                            <style>
                                .search-past{
                                    
                                    margin-top: 2px;
                                    margin-bottom: 2px;
                                    padding: 20px;
                                }
                                

                            </style>
                        <button onclick="openPopup()">Search Past Subject Matter</button>
                        </div>
                        <div class="form-group">
                            <label for="subjectCode">Subject:</label>
                        <select class="form-control" id="subjectCodelist" name="subjectCodelist">
                                <?php
                                $result = mysqli_query($con, "SELECT subjectCode, subjectName, contactHours FROM subject");

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $subjectCode = $row['subjectCode'];
                                        $subjectName = $row['subjectName'];
                                        $contactHours = $row['$contactHours'];
                                        //echo json_encode(['contactHours' => $contactHours]);
                                        //echo '<option value="' . $subjectCode . '|' . $subjectName . ' | ' . $contactHours .'">' . $subjectCode . ' - ' . $subjectName . '</option>';
                                        echo '<option value="' . $subjectCode .'">' . $subjectCode . ' - ' . $subjectName . '</option>';
                                    }
                                } else {
                                    echo '<option value="">No subject found</option>';
                                }
                                ?>
                            </select>
                            </div>

                            <div class="mb-1">

                                <?php 

                                $sql = "SELECT * FROM programme";
                                $result = mysqli_query($con, $sql);

                                if (!$result) {
                                    die("Error in SQL query: " . mysqli_error($con));
                                }

                                // Step 3: Create checkboxes dynamically
                                echo '<div class="mb-1">';
                                echo '<label for="selectedSubjects" class="form-label">Programme:</label><br>';
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $programme = $row['programme'];

                                    
                                    echo '<label>';
                                    echo '<input type="checkbox" name="selectedSubjects[]" class="course-checkbox" value="' . $programme . '">';
                                    echo $programme;
                                    echo '</label><br>';
                                }
                                echo '</div>';

                                ?>
                            </div>
                            <input type="hidden" id="selectedCourses" name="selectedCourses" value="">
                        <div class="mb-1">
                            <label for="level" class="form-label">Level:</label>
                            <select id="level" name="level">
                                <option value="Foundation">Foundation</option>
                                <option value="Professional">Professional</option>
                                <option value="Degree">Degree</option>
                                <option value="Diploma">Diploma</option>
                                <option value="Master">Master</option>
                            </select>

                            <p>Selected Value: <span id="selected-level" name= "selected-level"></span></p>
                        </div>

                        <div class="mb-1">
                            <label for="semester" class="form-label">Semester:</label>
                            <select id="semester" name="semester">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>

                            <p>Selected Value: <span id="selected-semester" name="selected-semester"></span></p>
                        </div>

                        <div class="mb-1">
                            <label for="totalStudent" class="form-label">Total Student</label>
                            <input type="text" class="form-control" id="totalStudent" name="totalStudent" oninput="updateSectionsSuggestion()">

                            <p>Suggested Sections: <span id="sectionSuggestion"></span></p>
                        </div>
                        
                        <div class="mb-1">
                            <label for="totalContactHours" class="form-label">Total Contact Hours</label>
                            <input type="text" class="form-control" id="totalContactHours" name="totalContactHours" value = "<?php echo $totalContactHours; ?>">
                        </div>

                        <div class="mb-3">
                        <label for="" class="form-label">Mentor: </label>
                        <input type="checkbox" name="mentor" value="1" id="mentorYes"> Yes
                        <input type="checkbox" name="mentor" value="0" id="mentorNo"> No
                        </div>
                        <div class="mb-1">
                        <label for="" class="form-label">Supervising: </label>
                        <input type="checkbox" name="supervising" value="1" id="supervisingYes"> Yes
                        <input type="checkbox" name="supervising" value="0" id="supervisingNo"> No
                        </div>

                        <div class="mb-1">
                            <label for="totalWorkload" class="form-label">Total Workload</label>
                            <input type="text" class="form-control" id="totalWorkload" name="totalWorkload">
                        </div>
                        <div class="mb-1">
                            <label for="teachingPeriod" class="form-label">Teaching Period</label>
                            <input type="text" class="form-control" id="teachingPeriod" name="teachingPeriod">
                        </div>
                        
                        <!-- Roles section -->
                        <h3>Committees</h3>
                        <div class="roles-container">
                            <div class="role-input">
                                <label for="role1">Role 1:</label>
                                <input type="text" name="roles[]" id="role1">
                            </div>
                        </div>
                        <div class="button-role">
                            <style>
                                    .button-role{
                                        margin-right: 3px;
                                        margin-bottom: 3px;
                                        margin-left: auto;
                                    }
                            </style>
                        <button type="button" id="add-role">+ Add Another Role</button>
                        </div>

                        
                        <input type="hidden" id="recordNo" name="recordNo">

                        
                        <!-- Buttons for workload operations -->
                        <button type="submit" class="btn btn-primary" id="submit" name="submit">Add</button>
                        <button type="submit" class="btn btn-danger" id="deleteWorkload" name="DeleteWorkload">Delete</button>
                        <button type="submit" class="btn btn-warning" name="updateWorkload">Update</button>
                    </form>
                </div>
            </div>
        </div>
        <?php 

                if (isset($_GET['session'])) {
                    $sessionName = $_GET['session'];
                    // Now, you can use $sessionName in your code.
                    echo "Selected session: $sessionName";}
           

            if (isset($_POST['totalStudent']) && isset($_POST['subjectCodelist'])) {
                $totalStudent = $_POST['totalStudent'];
                $selectedSubjectValue = $_POST['subjectCodelist'];

                $subjectCode = $selectedSubjectValue;
                //$contactHours = "";

                $result = mysqli_query($con, "SELECT subjectCode, subjectName, contactHours FROM subject WHERE subjectCode = '$subjectCode'");

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $subjectCode = $row['subjectCode'];
                        $subjectName = $row['subjectName'];
                        $contactHours = $row['contactHours'];
                    }
                    
                }
                // Split the selected value into subject code and subject name
                //list($selectedSubjectCode, $selectedSubjectName, $selectedContactHours) = explode('|', $selectedSubjectValue);

                // Ensure that $selectedContactHours is a valid number
                //$selectedContactHours = floatval($selectedContactHours);

                if (!empty($totalStudent) && !empty($contactHours) && $contactHours > 0) {
                    // Calculate total contact hours, considering the selected contact hours per subject
                    $totalContactHours = ceil($totalStudent / ($contactHours * 10));
                }
            }
            ?>

            <?php
            if (isset($_POST['submit'])) {
                // Initialize an array to store validation errors
                $errors = array();

                // Get values from form
                $sessionName = $_POST['sessionList'];
                $selectedLecturerValue = $_POST['lecturerIDlist'];
                $selectedSubjectValue = $_POST['subjectCodelist'];

                // Validate lecturer and subject values
                if (empty($selectedLecturerValue) || empty($selectedSubjectValue)) {
                    $errors[] = "Please select a lecturer and a subject.";
                }

                $lecturerID = $selectedLecturerValue;
                $subjectCode = $selectedSubjectValue;

                $programme = $_POST['selectedCourses'];
                $level = $_POST['level'];
                $semester = $_POST['semester'];
                $totalStudent = (int) $_POST['totalStudent'];
                $totalContactHours = (int) $_POST['totalContactHours'];
                $mentor = (int) $_POST['mentor'];
                $supervising = (int) $_POST['supervising'];
                $totalWorkload = (int) $_POST['totalWorkload'];
                $teachingPeriod = $_POST['teachingPeriod'];

                // Validate other fields
                if (empty($sessionName) || empty($programme) || empty($level) || empty($semester) || empty($teachingPeriod)) {
                    $errors[] = "Please fill in all the required fields.";
                }

                // Get the roles array and serialize it to JSON
                $rolesArray = $_POST['roles'];
                $numberedRoles = array();

                foreach ($rolesArray as $index => $role) {
                    $numberedRole = ($index + 1) . '. ' . $role;
                    $numberedRoles[] = $numberedRole;
                }

                // Serialize the numbered roles to JSON
                $otherRoles = json_encode($numberedRoles);

                if (empty($errors)) {
                    // Insert the data into the database
                    $query = "INSERT INTO workload (session, lecturerID, subjectCode, programme, level, semester, totalStudent, totalContactHours, mentor, supervising, totalWorkload, teachingPeriod, otherRoles) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
                    $stmt = mysqli_prepare($con, $query);

                    if ($stmt === false) {
                        echo "Error preparing statement: " . mysqli_error($con);
                    } else {
                        mysqli_stmt_bind_param($stmt, "ssssssiiiiiss", $sessionName, $lecturerID, $subjectCode, $programme, $level, $semester, $totalStudent, $totalContactHours, $mentor, $supervising, $totalWorkload, $teachingPeriod, $otherRoles);

                        if (mysqli_stmt_execute($stmt)) {
                            echo '<script>alert("Workload for Lecturer ID: ' . $lecturerID . ' and Subject: ' . $subjectCode . ' inserted successfully.");</script>';
                        } else {
                            //echo "Error: " . mysqli_error($con);
                        }

                        mysqli_stmt_close($stmt);
                    }
                } else {
                    // Display validation errors
                    foreach ($errors as $error) {
                        echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
                    }
                }
            }

                                        
                //mysqli_close($con);
                
            
            /*elseif(isset($_POST['updateWorkload'])){

                //$programmeData = json_decode($row['programme'], true);

                // Get values from form
                $recordNo = $_POST['recordNo'];
                $selectedLecturerValue = $_POST['lecturerIDlist'];
                $selectedSubjectValue = $_POST['subjectCodelist'];

                // Split the selected value into subject code and subject name
                //list($selectedSubjectCode, $selectedSubjectName) = explode('|', $selectedSubjectValue);
                //list($selectedLecturerID, $selectedLecturerName) = explode('|', $selectedLecturerValue);

                $lecturerID = $selectedLecturerValue;
                //$lecturerName = $selectedLecturerName;
                $subjectCode = $selectedSubjectValue;
                //$subjectName = $selectedSubjectName;

                // Programme is an array of values, so it's better to store it as JSON
                $programme = $_POST['selectedCourses'];
                //$programme = json_encode($_POST['programme']);

                $level = $_POST['level'];
                $semester = $_POST['semester'];
                $totalStudent = (int)$_POST['totalStudent'];
                $totalContactHours = (int)$_POST['totalContactHours'];
                $mentor = (int)$_POST['mentor'];
                $supervising = (int)$_POST['supervising'];
                $totalWorkload = (int)$_POST['totalWorkload'];
                $teachingPeriod = $_POST['teachingPeriod'];

                // Get the roles array and serialize it to JSON
                $rolesArray = $_POST['roles'];
                $otherRoles = json_encode($rolesArray);

            mysqli_query($con,"UPDATE workload SET lecturerID = '$lecturerID', subjectCode = '$subjectCode', programme = '$programme',level = '$level', semester = '$semester', totalStudent = '$totalStudent', totalContactHours = '$totalContactHours', totalWorkload = '$totalWorkload', teachingPeriod = '$teachingPeriod', otherRoles = '$otherRoles'   WHERE No = '$recordNo'") or die("Error Occured");

            echo '<script>alert("Lecturer ID: ' . $lecturerID . ' updated successfully.");</script>';
            }*/

            elseif (isset($_POST['updateWorkload'])) {
                // Initialize an array to store validation errors
                $errors = [];
            
                // Check if any of the required fields are empty
                if (empty($_POST['lecturerIDlist'])) {
                    $errors[] = "Lecturer ID is required.";
                }
                if (empty($_POST['subjectCodelist'])) {
                    $errors[] = "Subject Code is required.";
                }
                if (empty($_POST['selectedCourses'])) {
                    $errors[] = "Selected Courses are required.";
                }
                if (empty($_POST['level'])) {
                    $errors[] = "Level is required.";
                }
                if (empty($_POST['semester'])) {
                    $errors[] = "Semester is required.";
                }
                if (empty($_POST['totalStudent'])) {
                    $errors[] = "Total Student is required.";
                }
                if (empty($_POST['totalContactHours'])) {
                    $errors[] = "Total Contact Hours is required.";
                }
                if (empty($_POST['mentor'])) {
                    $errors[] = "Mentor is required.";
                }
                if (empty($_POST['supervising'])) {
                    $errors[] = "Supervising is required.";
                }
                if (empty($_POST['totalWorkload'])) {
                    $errors[] = "Total Workload is required.";
                }
                if (empty($_POST['teachingPeriod'])) {
                    $errors[] = "Teaching Period is required.";
                }
                
                // Check if there are validation errors
                if (!empty($errors)) {
                    // Display the validation errors
                    foreach ($errors as $error) {
                        echo '<script>alert("' . $error . '");</script>';
                    }
                } else {
                    // No validation errors, perform the database update
            
                    // Get values from form
                    $recordNo = $_POST['recordNo'];
                    $selectedLecturerValue = $_POST['lecturerIDlist'];
                    $selectedSubjectValue = $_POST['subjectCodelist'];
            
                    $lecturerID = $selectedLecturerValue;
                    $subjectCode = $selectedSubjectValue;
                    $programme = $_POST['selectedCourses'];
                    $level = $_POST['level'];
                    $semester = $_POST['semester'];
                    $totalStudent = (int)$_POST['totalStudent'];
                    $totalContactHours = (int)$_POST['totalContactHours'];
                    $mentor = (int)$_POST['mentor'];
                    $supervising = (int)$_POST['supervising'];
                    $totalWorkload = (int)$_POST['totalWorkload'];
                    $teachingPeriod = $_POST['teachingPeriod'];
            
                    // Get the roles array and serialize it to JSON
                    $rolesArray = $_POST['roles'];
                    $otherRoles = json_encode($rolesArray);
            
                    // Perform the database update
                    mysqli_query($con,"UPDATE workload SET lecturerID = '$lecturerID', subjectCode = '$subjectCode', programme = '$programme',level = '$level', semester = '$semester', totalStudent = '$totalStudent', totalContactHours = '$totalContactHours', totalWorkload = '$totalWorkload', teachingPeriod = '$teachingPeriod', otherRoles = '$otherRoles'   WHERE No = '$recordNo'") or die("Error Occurred");
            
                    echo '<script>alert("Lecturer ID: ' . $lecturerID . ' updated successfully.");</script>';
                }
            }
            
            
            
            elseif (isset($_POST['DeleteWorkload'])) {
                //if (isset($_POST['rowToDelete'])) {
                    $rowToDelete = $_POST['recordNo'];
            
                    // Perform the deletion based on the $rowToDelete value
                    $deleteQuery = mysqli_query($con, "DELETE FROM workload WHERE No = '$rowToDelete'");
            
                    if ($deleteQuery) {
                        echo '<script>alert("Record with index: ' . $rowToDelete . ' deleted successfully.");</script>';
                    } else {
                        echo "Error deleting record: " . mysqli_error($con);
                    }
                } else {
                    
                }
                
            
            
            ?>
            <div class="container">
                <div class="search-bar">
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        
                    <?php
                    // Database connection ($con) assumed to be established already

                    $query = "SELECT 
                    w.No,
                    w.lecturerID,
                    l.lecturerName,
                    w.subjectCode,
                    s.subjectName,
                    w.programme,
                    w.level,
                    w.semester,
                    w.totalStudent,
                    w.totalContactHours,
                    w.mentor,
                    w.supervising,
                    w.totalWorkload,
                    w.teachingPeriod,
                    w.otherRoles
                    w.session
                    FROM workload w
                    INNER JOIN Lecturer l ON w.lecturerID = l.lecturerID
                    INNER JOIN Subject s ON w.subjectCode = s.subjectCode";
                    $result = mysqli_query($con, $query);

                    if (isset($_POST['search'])) {
                        $searchedLecturerID = $_POST['search'];
                        $query = "SELECT w.No,
                        w.lecturerID,
                        l.lecturerName,
                        w.subjectCode,
                        s.subjectName,
                        w.programme,
                        w.level,
                        w.semester,
                        w.totalStudent,
                        w.totalContactHours,
                        w.mentor,
                        w.supervising,
                        w.totalWorkload,
                        w.teachingPeriod,
                        w.otherRoles
                        w.session
                        FROM workload w
                        INNER JOIN Lecturer l ON w.lecturerID = l.lecturerID
                        INNER JOIN Subject s ON w.subjectCode = s.subjectCode
                        WHERE w.lecturerID LIKE '%$searchedLecturerID%'";
                        $result = mysqli_query($con, $query);

                        if (mysqli_num_rows($result) == 0) { // Check if there are no results
                            //echo '<div class="alert alert-danger" role="alert">No workload data found for Lecturer ID: ' . $searchedLecturerID . '</div>';
                            echo '<script>alert("No workload data found for Lecturer ID:' . $searchedLecturerID. ' ");</script>';
                        }
                    }
                    ?>
                <form method="post" action="">
                <input type="text" name="search" placeholder="Search by Lecturer ID">
                <button type="submit">Search</button>
                </form>
                </div>
                <div class="table-container" id="tabulate" name="tabulate">
                    <style>

                        .table-container {
                            display: flex;
                            overflow-x: auto;
                            justify-content: space-between;
                            width: 100%;
                            max-width: 10000px; /* Adjust as needed */
                            margin: 10px; /* Center the form container */
                            font-size: 15px;
                        }

                    </style>
        <table>
            <thead>
                <tr>
                    <th>No.                </th>
                    <th>Lecturer ID        </th>
                    <th>Lecturer Name      </th>
                    <th>Subject Code       </th>
                    <th>Subject Name       </th>
                    <th>Programme          </th>
                    <th>Level              </th>
                    <th>Semester           </th>
                    <th>Total student      </th>
                    <th>Total contact hours</th>
                    <th>Mentor             </th>
                    <th>Supervising        </th>
                    <th>Total Workload     </th>
                    <th>Teaching Period    </th>
                    <th>Other Roles        </th>
                    <th>Session            </th>
                    <th>Actions            </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <?php
                    //$increment = 1; // Initialize an increment variable

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['No'] ."</td>"; // Display the incrementing number
                        echo "<td>" . $row['lecturerID'] . "</td>";
                        echo "<td>". $row['lecturerName'] ."</td>";
                        echo "<td>" . $row['subjectCode'] . "</td>";
                        echo "<td>". $row['subjectName'] ."</td>";
                        echo "<td>" . $row['programme'] . "</td>";
                        echo "<td>" . $row['level'] . "</td>";
                        echo "<td>" . $row['semester'] . "</td>";
                        echo "<td>" . $row['totalStudent'] . "</td>";
                        echo "<td>" . $row['totalContactHours'] . "</td>";
                        echo "<td>" . $row['mentor'] . "</td>";
                        echo "<td>" . $row['supervising'] . "</td>";
                        echo "<td>" . $row['totalWorkload'] . "</td>";
                        echo "<td>" . $row['teachingPeriod'] . "</td>";
                        echo "<td>" . $row['otherRoles'] . "</td>";
                        
                        // Add more table cells for other columns
                        echo "<td>";
                        echo '<span onclick="updateRow(' . $row['No']  . ')" style="cursor: pointer;"><i class="fas fa-edit update-icon"></i></span>';
                        echo '<span onclick="deleteRow(' . $row['No'] . ')" style="cursor: pointer;"><i class="fas fa-trash-alt delete-icon"></i></span>';
                        //echo '<input type="hidden" name="rowToDelete" value="' . $row['No'] . '">';
                        //echo '<button type="submit" name="DeleteWorkload" style="cursor: pointer;"><i class="fas fa-trash-alt delete-icon"></i></button>';
                        echo '</td>';
                        echo "</tr>";

                        //$increment++; // Increment the counter for the next row
                    }
                    ?>







                        
                        <!--<span onclick="updateRow(this)" style="cursor: pointer;"><i class="fas fa-edit"></i></span>
                        <span onclick="deleteRow(this)" style="cursor: pointer;"><i class="fas fa-trash-alt"></i></span>-->
                        
                    </tbody>
                </table>
            </div>
        </div>


        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const addWorkloadButton = document.getElementById("addWorkloadButton");
                const tableBody = document.querySelector("tbody");
                const rolesContainer = document.querySelector(".roles-container");
                let roleCount = 1;

                addWorkloadButton.addEventListener("click", function () {
                    // Get the form values
                    // const lecturerID = document.getElementById("lecturerIDlist").value;
                    const subjectCode = document.getElementById("subjectCodelist").value;
                    const programme = document.querySelector('input[name="programme"]:checked').value;
                    const level = document.getElementById("level").value;
                    const semester = document.getElementById("semester").value;
                    const totalStudent = document.getElementById("totalStudent").value;
                    const totalContactHours = document.getElementById("totalContactHours").value;
                    const mentor = document.querySelector('input[name="mentor"]:checked').value;
                    const supervising = document.querySelector('input[name="supervising"]:checked').value;
                    const totalWorkload = document.getElementById("totalWorkload").value;
                    const teachingPeriod = document.getElementById("teachingPeriod").value;
                    const otherRoles = document.getElementById("role1").value;

                    // Create a new row and populate it with data
                    const newRow = document.createElement("tr");
                    newRow.innerHTML = `
                        <td>${lecturerID}</td>
                        <td>${subjectCode}</td>
                        <td>${programme}</td>
                        <td>${level}</td>
                        <td>${semester}</td>
                        <td>${totalStudent}</td>
                        <td>${totalContactHours}</td>
                        <td>${mentor}</td>
                        <td>${supervising}</td>
                        <td>${totalWorkload}</td>
                        <td>${teachingPeriod}</td>
                        <td>${otherRoles}</td>
                        <td>
                            <span onclick="updateRow(this)" style="cursor: pointer;"><i class="fas fa-edit"></i></span>
                            <span onclick="deleteRow(this)" style="cursor: pointer;"><i class="fas fa-trash-alt"></i></span>
                        </td>
                    `;

                    // Append the new row to the table
                    tableBody.appendChild(newRow);

                    // Clear the form fields
                    document.getElementById("lecturerIDlist").value = "";
                    document.getElementById("subjectCodelist").value = "";
                    document.querySelector('input[name="programme"]:checked').checked = false;
                    document.getElementById("level").value = "";
                    document.getElementById("semester").value = "";
                    document.getElementById("totalStudent").value = "";
                    document.getElementById("totalContactHours").value = "";
                    document.querySelector('input[name="mentor"]:checked').checked = false;
                    document.querySelector('input[name="supervising"]:checked').checked = false;
                    document.getElementById("totalWorkload").value = "";
                    document.getElementById("teachingPeriod").value = "";
                });

                /*function updateRow(span) {
                    // Implement update logic here
                    // You can access the row data using JavaScript and update it
                    const row = span.parentNode.parentNode; // Get the row
                    const lecturerID = row.cells[0].textContent; // Get lecturer ID
                    const subjectCode = row.cells[1].textContent; // Get subject code
                    const programme = row.cells[2].textContent; // Get programme
                    const level = row.cells[3].textContent;
                    const semester = row.cells[4].textContent;
                    const totalStudent = row.cells[5].textContent;
                    const totalContactHours = row.cells[6].textContent;
                    const mentor = row.cells[7].textContent;
                    const supervising = row.cells[8].textContent;
                    const totalWorkload = row.cells[9].textContent;
                    const teachingPeriod = row.cells[10].textContent;
                    const otherRoles = row.cells[11].textContent;

                    
                }*/

                function deleteRow(span) {
                    // Implement delete logic here
                    // You can access the row data using JavaScript and delete it
                    const row = span.parentNode.parentNode; // Get the row
                    row.remove(); // Remove the row from the table
                }

            });

        </script>

                <script>
            // Get the select element
            const semesterSelect = document.getElementById('semester');

            // Get the element to display the selected education level
            const selectedSemester = document.getElementById('selected-semester');

            // Add event listener to the select element
            semesterSelect.addEventListener('change', updateSelectedSemester);

            // Function to update the selected education level display
            function updateSelectedSemester() {
                const selectedOption = semesterSelect.options[semesterSelect.selectedIndex];
                selectedSemester.textContent = selectedOption.value;
            }
        </script>

        <script>
        // Get all checkboxes with class "course-checkbox"
        function updateSelectedCourses() {
            const checkboxes = document.querySelectorAll('.course-checkbox');
            const selected = [];

            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    selected.push(checkbox.value);
                }
            });

            // Update the hidden input field's value with the selected values
            const selectedCoursesInput = document.getElementById('selectedCourses');
            selectedCoursesInput.value = selected.join('/');
        }

        // Add event listeners to checkboxes
        const checkboxes = document.querySelectorAll('.course-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateSelectedCourses);
        });


        </script>

        <script>
            // Get the select element
            const levelSelect = document.getElementById('level');

            // Get the element to display the selected education level
            const selectedLevel = document.getElementById('selected-level');

            // Add event listener to the select element
            levelSelect.addEventListener('change', updateSelectedLevel);

            // Function to update the selected education level display
            function updateSelectedLevel() {
                const selectedOption = levelSelect.options[levelSelect.selectedIndex];
                selectedLevel.textContent = selectedOption.value;
            }
        </script>

        <script>
            // Get the select element
            const semesterSelect = document.getElementById('semester');

            // Get the element to display the selected education level
            const selectedSemester = document.getElementById('selected-semester');

            // Add event listener to the select element
            semesterSelect.addEventListener('change', updateSelectedSemester);

            // Function to update the selected education level display
            function updateSelectedSemester() {
                const selectedOption = semesterSelect.options[semesterSelect.selectedIndex];
                selectedSemester.textContent = selectedOption.value;
            }
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
            const mentorYesCheckbox = document.getElementById('mentorYes');
            const mentorNoCheckbox = document.getElementById('mentorNo');
            const supervisingYesCheckbox = document.getElementById('supervisingYes');
            const supervisingNoCheckbox = document.getElementById('supervisingNo');

            // Add event listeners to checkboxes
            mentorYesCheckbox.addEventListener('change', function () {
                if (this.checked) {
                    mentorNoCheckbox.checked = false;
                }
            });

            mentorNoCheckbox.addEventListener('change', function () {
                if (this.checked) {
                    mentorYesCheckbox.checked = false;
                }
            });

            supervisingYesCheckbox.addEventListener('change', function () {
                if (this.checked) {
                    supervisingNoCheckbox.checked = false;
                }
            });

            supervisingNoCheckbox.addEventListener('change', function () {
                if (this.checked) {
                    supervisingYesCheckbox.checked = false;
                }
            });
        });
    </script>


        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const addRoleButton = document.getElementById("add-role");
                const rolesContainer = document.querySelector(".roles-container");
                let roleCount = 1;

                addRoleButton.addEventListener("click", function () {
                    roleCount++;
                    const newRoleInput = document.createElement("div");
                    newRoleInput.classList.add("role-input");
                    newRoleInput.innerHTML = `
                        <label for="role${roleCount}">Role ${roleCount}:</label>
                        <input type="text" name="roles[]" id="role${roleCount}" required>
                    `;

                    rolesContainer.appendChild(newRoleInput);
                });
            });
        </script>

        <script>
        // JavaScript code to dynamically calculate total contact hours
        
        // JavaScript code to dynamically calculate total contact hours
        const totalStudentInput = document.getElementById('totalStudent');
        const totalContactHoursInput = document.getElementById('totalContactHours');

        totalStudentInput.addEventListener('input', function() {
            const totalStudent = parseInt(totalStudentInput.value);
            
            // You need to fetch the contactHours value from the subject table based on the selected subjectCode
            // For now, I'll assume you have the contactHours value available in a variable
            const contactHours = 30; // Replace with your actual value

            if (!isNaN(totalStudent) && !isNaN(contactHours)) {
                // Calculate total contact hours
                const totalContactHours = Math.ceil(totalStudents / 30);;
                totalContactHoursInput.value = totalContactHours;
            } else {
                totalContactHoursInput.value = '';
            }
        });
        </script>

        <script>
        // JavaScript code to dynamically calculate total contact hours
        
        // JavaScript code to dynamically calculate total contact hours
        function updateSectionsSuggestion() {
        const totalStudentInput = document.getElementById('totalStudent');
        const sectionSuggestion = document.getElementById('sectionSuggestion');

        // Calculate the suggested sections
        const totalStudent = parseInt(totalStudentInput.value);
        const sections = Math.ceil(totalStudent / 30);

        sectionSuggestion.textContent = sections;
        }
        </script>

        <script>
            // JavaScript code to dynamically calculate total contact hours
           /* 
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'basicworkloadmanagement.php', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    const contactHours = response.contactHours;

                    // Now you can use the contactHours variable in your JavaScript code
                    console.log('Contact Hours:', contactHours);

                    
                }
            };
            xhr.send();
            
            const contactHours = document.getElementById('total');
            const totalContactHoursInput = document.getElementById('totalContactHours');

            totalStudentInput.addEventListener('input', function() {
                const totalStudent = parseInt(totalStudentInput.value);

                
                
                // You need to fetch the contactHours value from the subject table based on the selected subjectCode
                // For now, I'll assume you have the contactHours value available in a variable
                const contactHours = 30; // Replace with your actual value

                if (!isNaN(totalStudent) && !isNaN(contactHours)) {
                    // Calculate total contact hours
                    const totalContactHours =  Math.ceil(totalStudents / contactHours);;
                    totalContactHoursInput.value = totalContactHours;
                } else {
                    totalContactHoursInput.value = '';
                }
            });*/
        </script>

        <script>
            // Make an AJAX request to fetch contactHours
         /*   const xhr = new XMLHttpRequest();
            xhr.open('GET', 'basicworkloadmanagement.php', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    const contactHours = response.contactHours;

                    // Now you can use the contactHours variable in your JavaScript code
                    console.log('Contact Hours:', contactHours);

                    const totalStudentInput = document.getElementById('totalStudent');
                    const totalContactHoursInput = document.getElementById('totalContactHours'); // Assuming you have an input element with this ID

                    totalStudentInput.addEventListener('input', function() {
                        const totalStudent = parseInt(totalStudentInput.value);

                        if (!isNaN(totalStudent) && !isNaN(contactHours)) {
                            // Calculate total contact hours
                            const totalContactHours = Math.ceil(totalStudents / 30);;
                            totalContactHoursInput.value = totalContactHours.toFixed(2); // Format to 2 decimal places
                        } else {
                            totalContactHoursInput.value = '';
                        }
                    });
                }
            };
            xhr.send();*/
        </script>

        <script>
            // Function to calculate and update the total workload
            function calculateTotalWorkload() {
                // Get the values of total contact hours, mentor, and supervising
                const totalContactHours = parseFloat(document.getElementById('totalContactHours').value) || 0;
                const mentor = document.getElementById('mentorYes').checked ? 1 : 0;
                const supervising = document.getElementById('supervisingYes').checked ? 1 : 0;

                // Calculate the total workload by adding the values
                const totalWorkload = totalContactHours + mentor + supervising;

                // Update the total workload field
                document.getElementById('totalWorkload').value = totalWorkload;
            }

            // Add event listeners to the input fields and checkboxes
            document.getElementById('totalContactHours').addEventListener('input', calculateTotalWorkload);
            document.getElementById('mentorYes').addEventListener('change', calculateTotalWorkload);
            document.getElementById('supervisingYes').addEventListener('change', calculateTotalWorkload);

            // Initial calculation when the page loads
            calculateTotalWorkload();
        </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    

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
    <script>

document.addEventListener('DOMContentLoaded', function () {
    const updateIcons = document.querySelectorAll('.update-icon');
    const deleteButtons = document.querySelectorAll('.delete-icon');

    function populateFormWithRecordData(row) {
        const no = row.cells[0].textContent;
        const lecturerID = row.cells[1].textContent;
        const subjectCode = row.cells[3].textContent;
        const programme = row.cells[5].textContent;
        const level = row.cells[6].textContent;
        const semester = row.cells[7].textContent;
        const totalStudent = row.cells[8].textContent;
        const totalContactHours = row.cells[9].textContent;
        const mentor = row.cells[10].textContent;
        const supervising = row.cells[11].textContent;
        const totalWorkload = row.cells[12].textContent;
        const teachingPeriod = row.cells[13].textContent;
        const otherRoles = row.cells[14].textContent;
        const session = row.cells[15].textContent;

        document.getElementById('recordNo').value = no;
        document.getElementById('lecturerIDlist').value = lecturerID;
        document.getElementById('subjectCodelist').value = subjectCode;

        const rolesArray = otherRoles.split(', ');
        const rolesContainer = document.querySelector('.roles-container');

        // Clear existing roles
        rolesContainer.innerHTML = '';

        rolesArray.forEach((role, index) => {
            const roleInput = document.createElement('div');
            roleInput.classList.add('role-input');
            roleInput.innerHTML = `
                <label for="role${index + 1}">Role ${index + 1}:</label>
                <input type="text" name="roles[]" id="role${index + 1}" value="${role}">
            `;

            rolesContainer.appendChild(roleInput);
        });

        // Add the 'Add Another Role' button
        const addRoleButton = document.createElement('button');
        addRoleButton.id = 'add-role';
        addRoleButton.type = 'button';
        addRoleButton.textContent = '+ Add Another Role';

        addRoleButton.addEventListener('click', function () {
            const newRoleInput = document.createElement('div');
            newRoleInput.classList.add('role-input');
            const newIndex = rolesArray.length + 1;
            newRoleInput.innerHTML = `
                <label for="role${newIndex}">Role ${newIndex}:</label>
                <input type="text" name="roles[]" id="role${newIndex}" required>
            `;

            rolesContainer.appendChild(newRoleInput);
            rolesArray.push(newIndex);
        });

        rolesContainer.appendChild(addRoleButton);

        const programmeCheckboxes = document.querySelectorAll('.course-checkbox');
            programmeCheckboxes.forEach(function(checkbox) {
                const programCode = checkbox.value;
                checkbox.checked = programme.includes(programCode);
            });


            document.getElementById('level').value = level;
            document.getElementById('semester').value = semester;
            document.getElementById('totalStudent').value = totalStudent;
            document.getElementById('totalContactHours').value = totalContactHours;
            document.getElementById('totalWorkload').value = totalWorkload;
            document.getElementById('teachingPeriod').value = teachingPeriod;



            // Set the selected checkboxes based on the extracted data (mentor and supervising)
            document.getElementById('mentorYes').checked = mentor === '1';
            document.getElementById('mentorNo').checked = mentor === '0';
            document.getElementById('supervisingYes').checked = supervising === '1';
            document.getElementById('supervisingNo').checked = supervising === '0';
            document.getElementById('sessionList').value =session;
            // Set other form fields similarly

            // Scroll to the form for better visibility
            document.getElementById('formLoad').scrollIntoView();
        
    }

    updateIcons.forEach(function (icon) {
        icon.addEventListener('click', function () {
            const row = this.closest('tr');
            populateFormWithRecordData(row);
        });
    });

    deleteButtons.forEach(function (icon) {
        icon.addEventListener('click', function () {
            const row = this.closest('tr');
            populateFormWithRecordData(row);

            // Populate the form fields with the extracted data
            document.getElementById('recordNo').value = no;
            document.getElementById('lecturerIDlist').value = lecturerID;

            // Split the subjectInfo string into subject code and subject name
            //const [subjectCode, subjectName] = subjectInfo.split(' - ');

            // Set the selected option in the subject code dropdown
            //const subjectCodeSelect = document.getElementById('subjectCodelist');
            //subjectCodeSelect.value = subjectCode;
            
            document.getElementById('subjectCodelist').value = subjectCode;

            /*document.getElementById('AA103').checked = programme === 'AA103';
            document.getElementById('BE101').checked = programme === 'BE101';
            document.getElementById('BK101').checked = programme === 'BK101';
            document.getElementById('CC101').checked = programme === 'CC101';
            document.getElementById('AA201').checked = programme === 'AA201';
            document.getElementById('AB201').checked = programme === 'AB201';
            document.getElementById('AB202').checked = programme === 'AB202';
            document.getElementById('AC201').checked = programme === 'AC201';
            document.getElementById('BE201').checked = programme === 'BE201';
            document.getElementById('BE202').checked = programme === 'BE202';
            document.getElementById('BE203').checked = programme === 'BE203';
            document.getElementById('BK201').checked = programme === 'BK201';
            document.getElementById('CM201').checked = programme === 'CM201';
            document.getElementById('CT203').checked = programme === 'CT203';
            document.getElementById('CT204').checked = programme === 'CT204';
            document.getElementById('CT206').checked = programme === 'CT206';
            document.getElementById('AA301').checked = programme === 'AA301';
            document.getElementById('AB301').checked = programme === 'AB301';
            document.getElementById('BE301').checked = programme === 'BE301';
            document.getElementById('CT301').checked = programme === 'CT301';
            document.getElementById('AA002').checked = programme === 'AA002';
            document.getElementById('AA211').checked = programme === 'AA211';*/

            const programmeCheckboxes = document.querySelectorAll('.course-checkbox');
            programmeCheckboxes.forEach(function(checkbox) {
                const programCode = checkbox.value;
                checkbox.checked = programme.includes(programCode);
            });


            document.getElementById('level').value = level;
            document.getElementById('semester').value = semester;
            document.getElementById('totalStudent').value = totalStudent;
            document.getElementById('totalContactHours').value = totalContactHours;
            document.getElementById('totalWorkload').value = totalWorkload;
            document.getElementById('teachingPeriod').value = teachingPeriod;



            // Set the selected checkboxes based on the extracted data (mentor and supervising)
            document.getElementById('mentorYes').checked = mentor === '1';
            document.getElementById('mentorNo').checked = mentor === '0';
            document.getElementById('supervisingYes').checked = supervising === '1';
            document.getElementById('supervisingNo').checked = supervising === '0';
            // Set other form fields similarly

            // Scroll to the form for better visibility
            document.getElementById('formLoad').scrollIntoView();
            });
        });
    });


</script>






    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>  