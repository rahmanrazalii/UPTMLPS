<!DOCTYPE html>
<html lang="en">
<head>
    <?php ini_set('display_errors', 1);
        error_reporting(E_ALL); 
        $totalContactHours = '';
        ?>

    <?php include("php/config.php"); ?>
    <?php include ("dashboard.php"); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecturer Information</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css">
    
    
    <!--<style>
        .container {
            margin-top: 30px;
        }
    </style>-->
</head>
<body>

 <div class="container mt-5">
        <div class="row">
            <div class="col-md-10">
                <h2>Select a Lecturer:</h2>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="lecturerID">Lecturer:</label>
                        <select class="form-control" id="lecturerIDlist" name="lecturerIDlist">-->
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

<div class="container mt-5">
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
echo "<h2>Search by Search Code</h2>";
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





<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>