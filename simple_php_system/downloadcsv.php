<?php

include("php/config.php");

$filename = "workload_report.csv";

    // Set the HTTP response headers to trigger a download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    // Create a writable stream
    $output = fopen('php://output', 'w');

    // Define the CSV header
    $header = array(
        "No.",
        "Lecturer ID",
        "Lecturer Name",
        "Subject Code",
        "Subject Name",
        "Programme",
        "Level",
        "Total Student",
        "Total Contact Hour",
        "Mentor",
        "Supervising",
        "Total Workload",
        "Teaching Period",
        "Other Roles"
    );
    
    // Write the header to the CSV file
    fputcsv($output, $header);
    
    // Query the database and fetch data
    $result = mysqli_query($con, "
        SELECT 
            w.lecturerID,
            l.lecturerName,
            w.subjectCode,
            s.subjectName,
            w.programme,
            w.level,
            w.totalStudent,
            w.totalContactHours,
            w.mentor,
            w.supervising,
            w.totalWorkload,
            w.teachingPeriod,
            w.otherRoles
        FROM workload w
        INNER JOIN Lecturer l ON w.lecturerID = l.lecturerID
        INNER JOIN Subject s ON w.subjectCode = s.subjectCode
        ORDER BY w.lecturerID"
    );
    
    // Initialize a counter for the "No." column
    $counter = 1;
    
    // Write data to the CSV file with counter
    while ($row = mysqli_fetch_assoc($result)) {
        // Add the counter as the first column
        array_unshift($row, $counter);
        fputcsv($output, $row);
    
        // Increment the counter
        $counter++;
    }
    // Close the file stream
    fclose($output);

    // Terminate the script
    exit;


?>
