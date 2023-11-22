<!DOCTYPE html>
<html lang="en">
<head>
    <?php ini_set('display_errors', 1);
        error_reporting(E_ALL); ?>

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
    <?php $searchedLecturerID = ""; ?>

<div class="container">
                <div class="search-bar">
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        
                <?php
                    // Database connection ($con) assumed to be established already

                    $query = "SELECT * FROM workload";
                    $result = mysqli_query($con, $query);

                    if (isset($_POST['search'])) {
                        $searchedLecturerID = $_POST['search'];
                        $query = "SELECT * FROM workload WHERE lecturerID LIKE '%$searchedLecturerID%'";
                        $result = mysqli_query($con, $query);
                    }
                    ?>
                <form method="post" action="">
                <input type="text" name="search" placeholder="Search by Lecturer ID">
                <button type="submit">Search</button>
                </form>
                </div>
                <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Lecturer ID        </th>
                    <th>Subject Code       </th>
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
                    <th>Actions            </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                        <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['lecturerID'] . "</td>";
                                echo "<td>" . $row['subjectCode'] . "</td>";
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
                                echo '<span onclick="updateRow(' . $row['lecturerID'] . ')" style="cursor: pointer;"><i class="fas fa-edit"></i></span>';
                                echo '<span onclick="deleteRow(' . $row['lecturerID'] . ')" style="cursor: pointer;"><i class="fas fa-trash-alt"></i></span>';
                                echo '</td>';
                                echo "</tr>";
                            }
                        ?>
                        
                        <!--<span onclick="updateRow(this)" style="cursor: pointer;"><i class="fas fa-edit"></i></span>
                        <span onclick="deleteRow(this)" style="cursor: pointer;"><i class="fas fa-trash-alt"></i></span>-->
                        
                    </tbody>
                </table>
            </div>
        </div>

        <div class="container mt-5">
            <div class="row">
                <div class="col-md-10">
                    <h2>Manage Workload</h2>
                    <form action="" method="post" id="formLoad">
                    <div class="form-group">
                            <label for="lecturerID">Lecturer:</label>
                            <select class="form-control" id="lecturerIDlist" name="lecturerIDlist">
                            <?php

                                $result = mysqli_query($con, "SELECT lecturerID, lecturerName, lecturerGrade, lecturerQualification FROM lecturer");

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<option value="' . $row['lecturerID'] . '">' . $row['lecturerName'] . '</option>';
                                        $lecturerID = $row['lecturerID'];
                                        $lecturerName = $row['lecturerName'];
                                        echo '<option value="' . $lecturerID. '|' . $lecturerName . '">' . $lecturerID . ' - ' . $lecturerName . '</option>';
                                    }
                                } else {
                                    echo '<option value="">No Lecturers Found</option>';
                                }

                                
                                ?>
                            </select>
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
                                        echo '<option value="' . $subjectCode . '|' . $subjectName . '">' . $subjectCode . ' - ' . $subjectName . '</option>';
                                    }
                                } else {
                                    echo '<option value="">No subject found</option>';
                                }
                                ?>
                            </select>
                            </div>

                        <div class="mb-1">

                            <label for="program" class="form-label">Programme: </label>   
                            <input type="hidden" id="selectedCourses" name="selectedCourses" value=""> 
                            <label for="AA103"><input type="checkbox" id="AA103" name="programme[]" class="course-checkbox" value="AA103">AA103</label><br>
                            <label for="BE101"><input type="checkbox" id="BE101" name="programme[]" class="course-checkbox" value="BE101">BE101</label><br>
                            <label for="BK101"><input type="checkbox" id="BK101" name="programme[]" class="course-checkbox" value="BK101">BK101</label><br>
                            <label for="CC101"><input type="checkbox" id="CC101" name="programme[]" class="course-checkbox" value="CC101">CC101</label><br>
                            <label for="AA201"><input type="checkbox" id="AA201" name="programme[]" class="course-checkbox" value="AA201">AA201</label><br>
                            <label for="AB201"><input type="checkbox" id="AB201" name="programme[]" class="course-checkbox" value="AB201">AB201</label><br>
                            <label for="AB202"><input type="checkbox" id="AB202" name="programme[]" class="course-checkbox" value="AB202">AB202</label><br>
                            <label for="AC201"><input type="checkbox" id="AC201" name="programme[]" class="course-checkbox" value="AC201">AC201</label><br>
                            <label for="BE201"><input type="checkbox" id="BE201" name="programme[]" class="course-checkbox" value="BE201">BE201</label><br>
                            <label for="BE202"><input type="checkbox" id="BE202" name="programme[]" class="course-checkbox" value="BE202">BE202</label><br>
                            <label for="BE203"><input type="checkbox" id="BE203" name="programme[]" class="course-checkbox" value="BE203">BE203</label><br>
                            <label for="BK201"><input type="checkbox" id="BK201" name="programme[]" class="course-checkbox" value="BK201">BK201</label><br>
                            <label for="CM201"><input type="checkbox" id="CM201" name="programme[]" class="course-checkbox" value="CM201">CM201</label><br>
                            <label for="CT203"><input type="checkbox" id="CT203" name="programme[]" class="course-checkbox" value="CT203">CT203</label><br>
                            <label for="CT204"><input type="checkbox" id="CT204" name="programme[]" class="course-checkbox" value="CT204">CT204</label><br>
                            <label for="CT206"><input type="checkbox" id="CT206" name="programme[]" class="course-checkbox" value="CT206">CT206</label><br>
                            <label for="AA301"><input type="checkbox" id="AA301" name="programme[]" class="course-checkbox" value="AA301">AA301</label><br>
                            <label for="AB301"><input type="checkbox" id="AB301" name="programme[]" class="course-checkbox"  value="AB301">AB301</label><br>
                            <label for="AB302"><input type="checkbox" id="AB302" name="programme[]" class="course-checkbox" value="AB302">AB302</label><br>
                            <label for="BE301"><input type="checkbox" id="BE301" name="programme[]" class="course-checkbox" value="BE301">BE301</label><br>
                            <label for="CT301"><input type="checkbox" id="CT301" name="programme[]" class="course-checkbox" value="CT301">CT301</label><br>
                            <label for="AA002"><input type="checkbox" id="AA002" name="programme[]" class="course-checkbox" value="AA002">AA002</label><br>
                            <label for="AA211"><input type="checkbox" id="AA211" name="programme[]" class="course-checkbox" value="AA211">AA211</label><br>

                            <p>Selected Value: <span id="selectedCourses" name = "selectedCourses"></span></p>
                        </div>
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
                            <input type="text" class="form-control" id="totalStudent" name="totalStudent">
                        </div>
                        <div class="mb-1">
                            <label for="totalContactHours" class="form-label">Total Contact Hours</label>
                            <input type="text" class="form-control" id="totalContactHours" name="totalContactHours">
                        </div>

                        <div class="mb-3">
                        <label for="" class="form-label">Mentor</label>
                        <input type="checkbox" name="mentor" value="1" id="mentorYes"> Yes
                        <input type="checkbox" name="mentor" value="0" id="mentorNo"> No
                        </div>
                        <div class="mb-1">
                        <label for="" class="form-label">Supervising</label>
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
                        <h3>User Roles</h3>
                        <div class="roles-container">
                            <div class="role-input">
                                <label for="role1">Role 1:</label>
                                <input type="text" name="roles[]" id="role1" required>
                            </div>
                        </div>
                        <button type="button" id="add-role">+ Add Another Role</button>
                        
                        <!-- Buttons for workload operations -->
                        <button type="submit" class="btn btn-primary" id="submit" name="submit">Add</button>
                        <button type="submit" class="btn btn-danger" id="deleteWorkload" name="DeleteWorkload">Delete</button>
                        <button type="submit" class="btn btn-warning" name="updateWorkload">Update</button>
                    </form>
                </div>
            </div>
        </div>

            <?php

            if (isset($_POST['updateWorkload'])) {

                echo "PHP code is executing.";
                ini_set('display_errors', 1);
                error_reporting(E_ALL);

                // Get values from form
                $selectedLecturerValue = $_POST['lecturerIDlist'];
                $selectedSubjectValue = $_POST['subjectCodelist'];
                // Split the selected value into subject code and subject name
                list($selectedSubjectCode, $selectedSubjectName) = explode('|', $selectedSubjectValue);
                list($selectedLecturerID, $selectedLecturerName) = explode('|', $selectedLecturerValue);

                $lecturerID = $selectedLecturerID;
                $lecturerName = $selectedLecturerName;
                $subjectCode = $selectedSubjectCode;
                $subjectName = $selectedSubjectName;
                $programme = $_POST['selectedCourses'];
                $level = $_POST['level'];
                $semester = $_POST['semester'];
                $totalStudent = (int) $_POST['totalStudent'];
                $totalContactHours = (int) $_POST['totalContactHours'];
                $mentor = (int) $_POST['mentor'];
                $supervising = (int) $_POST['supervising'];
                $totalWorkload =(int) $_POST['totalWorkload'];
                $teachingPeriod = $_POST['teachingPeriod'];


                // Get the roles array and serialize it to JSON
                $rolesArray = $_POST['roles'];
                $otherRoles = json_encode($rolesArray);

                // Insert the data into the database
                mysqli_query($con,"UPDATE workload SET subjectCode = '$subjectCode', programme = '$programme',level = '$level', semester = '$semester', totalStudent = '$totalStudent', totalContactHours = '$totalContactHours', totalWorkload = '$totalWorkload', teachingPeriod = '$teachingPeriod', otherRoles = '$otherRoles'   WHERE lecturerID = '$lecturerID'") or die("Error Occured");

                echo '<script>alert("Lecturer ID: ' . $lecturerID . ' updated successfully.");</script>';
                
                
                
            }
            
            ?>
            <div class="container">
                <div class="search-bar">
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        
                <?php
                    // Database connection ($con) assumed to be established already

                    $query = "SELECT * FROM workload";
                    $result = mysqli_query($con, $query);

                    if (isset($_POST['search'])) {
                        $searchedLecturerID = $_POST['search'];
                        $query = "SELECT * FROM workload WHERE lecturerID LIKE '%$searchedLecturerID%'";
                        $result = mysqli_query($con, $query);
                    }
                    ?>
                <form method="post" action="">
                <input type="text" name="search" placeholder="Search by Lecturer ID">
                <button type="submit">Search</button>
                </form>
                </div>
                <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Lecturer ID        </th>
                    <th>Subject Code       </th>
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
                    <th>Actions            </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                        <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['lecturerID'] . "</td>";
                                echo "<td>" . $row['subjectCode'] . "</td>";
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
                                echo '<span onclick="updateRow(' . $row['lecturerID'] . ')" style="cursor: pointer;"><i class="fas fa-edit"></i></span>';
                                echo '<span onclick="deleteRow(' . $row['lecturerID'] . ')" style="cursor: pointer;"><i class="fas fa-trash-alt"></i></span>';
                                echo '</td>';
                                echo "</tr>";
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

                function updateRow(span) {
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

                    // Implement your update logic here
                }

                function deleteRow(span) {
                    // Implement delete logic here
                    // You can access the row data using JavaScript and delete it
                    const row = span.parentNode.parentNode; // Get the row
                    row.remove(); // Remove the row from the table
                }

            });

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


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>  