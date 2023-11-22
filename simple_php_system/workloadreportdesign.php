<!DOCTYPE html>
<html lang="en">
<head>
    <?php ini_set('display_errors', 1);
        error_reporting(E_ALL); 
        $totalContactHours = '';
        $currentTotalWorkload= 0;
        $sessionName = "";
    ?>

    <?php include("php/config.php"); ?>
    <?php include("dashboard.php"); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecturer Information</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <h3>WORKLOAD PROJECTION REPORT</h3>
    <div class="table-container" id="tabulate" name="tabulate">
        <style>
            .table-container {
                justify-content: center;
                align-items: center;
                height: 380vh; /* Center vertically in the viewport */
                margin-left: 20px;
                padding-left: 20px;
                width: 1750px;
            }
        </style>

        <table border="4">
            <tr>
                <th>No. </th>
                <th>Lecturer ID</th>
                <th>Lecturer Name</th>
                <th>Subject Code</th>
                <th>Subject Name</th>
                <th>Programme</th>
                <th>Level</th>
                <th>Semester</th>
                <th>Total Student</th>
                <th>Total Contact Hour</th>
                <th>Mentor</th>
                <th>Supervising</th>
                <th>Total Workload</th>
                <th>Teaching Period</th>
                <th>Other Roles</th>
            </tr>
            <?php

                    if (isset($_GET['session'])) {
                        $sessionName = $_GET['session'];
                        // Now, you can use $sessionName in your code.
                        echo "Selected session: $sessionName";
                    }
                $recordsPerPage = 100;
                $currentpage = isset($_GET['page']) ? $_GET['page'] : 1;
                $offset = ($currentpage - 1) * $recordsPerPage;
                
                $result = mysqli_query($con, "
                    SELECT 
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
                    FROM workload w
                    INNER JOIN Lecturer l ON w.lecturerID = l.lecturerID
                    INNER JOIN Subject s ON w.subjectCode = s.subjectCode
                    WHERE w.session = '$sessionName'
                    ORDER BY w.lecturerID
                    LIMIT $offset, $recordsPerPage
                ");

                $totalRecords = mysqli_num_rows($result);
                $totalPages = ceil($totalRecords / $recordsPerPage);
                $previousLecturerID = null;
                $increment = 1;
                $count = 1;

                while ($row = mysqli_fetch_assoc($result)) {
                    $lecturerID = $row['lecturerID'];
                    $lecturerName = $row['lecturerName'];
                    $subjectCode = $row['subjectCode'];
                    $subjectName = $row['subjectName'];
                    $programme = $row['programme'];
                    $level = $row['level'];
                    $semester = $row['semester'];
                    $totalStudents = $row['totalStudent'];
                    $contactHour = $row['totalContactHours'];
                    $mentor = $row['mentor'];
                    $supervising = $row['supervising'];
                    $workload = $row['totalWorkload'];
                    $teachingPeriod = $row['teachingPeriod'];
                    $otherRoles = $row['otherRoles'];

                        if ($lecturerID !== $previousLecturerID ) {
                            // Output a new row for the lecturer
                            if($currentTotalWorkload == 0)
                            {
                                echo "<td>$increment</td>";
                                    echo "<td>$lecturerID</td>";
                                    echo "<td>$lecturerName</td>";
                                    echo "<td>$subjectCode</td>";
                                    echo "<td>$subjectName</td>";
                                    echo "<td>$programme</td>";
                                    echo "<td>$level</td>";
                                    echo "<td>$semester</td>";
                                    echo "<td>$totalStudents</td>";
                                    echo "<td>$contactHour</td>";
                                    echo "<td>$mentor</td>";
                                    echo "<td>$supervising</td>";
                                    echo "<td>$workload</td>";
                                    echo "<td>$teachingPeriod</td>";
                                    echo "<td>$otherRoles</td>";
                                    echo "</tr>";

                                    $totalContactHour = $contactHour;
                                    $totalWorkload = $workload;
                                    $currentTotalWorkload = $workload;

                                    /*echo"<tr>";
                                    echo"<td> Total:  </td>";
                                    echo "<td>$currentTotalWorkload</td>";
                                    echo "</tr>";*/

                                    // Update the previous lecturer
                                    $previousLecturerID = $lecturerID;
                            }
                            else{
                                
                                echo"<tr>";
                                    echo "<td colspan = 15>Total Workload:    $currentTotalWorkload</td>";
                                    //echo"<td>$currentTotalWorkload</td>";
                                    echo "</tr>";                        
                                    echo "<tr>";
                                    echo "<td>$increment</td>";
                                    echo "<td>$lecturerID</td>";
                                    echo "<td>$lecturerName</td>";
                                    echo "<td>$subjectCode</td>";
                                    echo "<td>$subjectName</td>";
                                    echo "<td>$programme</td>";
                                    echo "<td>$level</td>";
                                    echo "<td>$semester</td>";
                                    echo "<td>$totalStudents</td>";
                                    echo "<td>$contactHour</td>";
                                    echo "<td>$mentor</td>";
                                    echo "<td>$supervising</td>";
                                    echo "<td>$workload</td>";
                                    echo "<td>$teachingPeriod</td>";
                                    echo "<td>$otherRoles</td>";
                                    echo "</tr>";

                                    $totalContactHour = $contactHour;
                                    $totalWorkload = $workload;
                                    $currentTotalWorkload = $workload;

                                    /*echo"<tr>";
                                    echo"<td> Total:  </td>";
                                    echo "<td>$currentTotalWorkload</td>";
                                    echo "</tr>";*/

                                    // Update the previous lecturer
                                    $previousLecturerID = $lecturerID;
                            }

                        /*}elseif($lecturerID !== $previousLecturerID && $increment ==1){

                                // Output a new row for the lecturer
                                /*echo"<tr>";
                                echo "<td colspan = 14>Total Workload:    $currentTotalWorkload</td>";
                                //echo"<td>$currentTotalWorkload</td>";
                                echo "</tr>";                        
                                echo "<tr>";
                                echo "<td>$increment</td>";
                                echo "<td>$lecturerID</td>";
                                echo "<td>$lecturerName</td>";
                                echo "<td>$subjectCode</td>";
                                echo "<td>$subjectName</td>";
                                echo "<td>$programme</td>";
                                echo "<td>$level</td>";
                                echo "<td>$totalStudents</td>";
                                echo "<td>$contactHour</td>";
                                echo "<td>$mentor</td>";
                                echo "<td>$supervising</td>";
                                echo "<td>$workload</td>";
                                echo "<td>$teachingPeriod</td>";
                                echo "<td>$otherRoles</td>";
                                echo "</tr>";

                                $totalContactHour = $contactHour;
                                $totalWorkload = $workload;
                                $currentTotalWorkload = $workload;

                                /*echo"<tr>";
                                echo "<td colspan = 14>Total Workload:    $currentTotalWorkload</td>";
                                //echo"<td>$currentTotalWorkload</td>";
                                echo "</tr>";                  
                                

                                // Update the previous lecturer
                                $previousLecturerID = $lecturerID;*/
                        } else {
                            // Output an empty cell for lecturer ID and lecturer name
                            $totalContactHour += $contactHour;
                            $totalWorkload = $mentor + $supervising + $totalContactHour;
                            if ($mentor == 1 && $supervising == 1){

                                $currentTotalWorkload = 2 + $totalContactHour;
                            }
                            elseif ($mentor == 1 && $supervising == 0){

                                $currentTotalWorkload = 1 + $totalContactHour;

                            }
                            elseif ($mentor == 0 && $supervising == 1){

                                $currentTotalWorkload = 1 + $totalContactHour;

                            }
                            elseif ($mentor == 0 && $supervising == 0){

                                $currentTotalWorkload = $totalContactHour;
                            }
                            else{}


                            //$count += $count;
                            
                            echo "<tr>";
                            echo "<td>$increment</td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "<td>$subjectCode</td>";
                            echo "<td>$subjectName</td>";
                            echo "<td>$programme</td>";
                            echo "<td>$level</td>";
                            echo "<td>$semester</td>";
                            echo "<td>$totalStudents</td>";
                            echo "<td>$contactHour</td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "<td>$workload</td>";
                            echo "<td>$teachingPeriod</td>";
                            echo "<td>$otherRoles</td>";
                            echo "</tr>";
                        }

                    // Display the "Total Workload" for the last lecturer
                    /*if ($previousLecturerID == null) {
                        echo "<tr>";
                        echo "<td colspan='14'>Total Workload: $currentTotalWorkload</td>";
                        echo "</tr>";
                    }*/
                    $increment++;
                }
                echo "<tr>";
                        echo "<td colspan='15'>Total Workload: $currentTotalWorkload</td>";
                        echo "</tr>";

                        $currentTotalWorkload = 0;
            ?>

            

            <button class="button23" id="print-button1">Print</button>
            <style>

                .button23{
                    background: rgba(76, 68, 182, 0.808);
                    border: 0;
                    border-radius: 5px;
                    color: #fff;
                    font-size: 15px;
                    cursor: pointer;
                    transition: all .3s;
                    width: 150px;
                    height: 40px;
                    margin-bottom: 20px;
                    margin-top: 20px;
                    margin-left: 10px;
                    padding: 0px 10px;
                    margin-right: 30px;

                }

            </style>
            <button class="button23" id="download-csv-button">Export CSV</button>
            <?php echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>"; ?>
            <style>
                .btn{
                    background: rgba(76, 68, 182, 0.808);
                    border: 0;
                    border-radius: 5px;
                    color: #fff;
                    font-size: 15px;
                    cursor: pointer;
                    transition: all .3s;
                    width: 150px;
                    height: 40px;
                    margin-bottom: 20px;
                    margin-top: 20px;
                    margin-left: 10px;
                    padding: 0px 10px;
                    margin-right: 30px;
                }
            </style>
            <!--<button class="button23" type=submit id="selectSection" name="selectSession">Select Session</button>-->
            <?php
                /*if (isset($_POST['selectSession'])) {
                    
                    echo '<script>window.location.href = "../sessionmenu.php";</script>';
                    exit(); // Ensure that no further code is executed after the redirect
                }*/
            ?>

        </table>
            </div>

        <div class="pagination">
            <?php if ($currentpage > 1) : ?>
                <a href="?page=<?= $currentpage - 1 ?>">Previous</a>
            <?php endif; ?>

            <?php if ($currentpage < $totalPages) : ?>
                <a href="?page=<?= $currentpage + 1 ?>">Next</a>
            <?php endif; ?>
        </div>
    

    


    <script>
    document.getElementById("download-csv-button").addEventListener("click", function () {
        // Send a POST request to download the CSV
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "downloadcsv.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.responseType = "blob";

        xhr.onload = function () {
            if (this.status === 200) {
                const blob = new Blob([this.response], { type: "text/csv" });
                const link = document.createElement("a");
                link.href = window.URL.createObjectURL(blob);
                link.download = "workload_report.csv";
                link.click();
            }
        };

        xhr.send("download_csv=1");
    });
</script>


    <script>
        document.getElementById("print-button1").addEventListener("click", function() {
            window.print();
        });
    </script>
</body>
</html>
