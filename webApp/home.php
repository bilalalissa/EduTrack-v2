<?php
// enabling error messages
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("db.php");


function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


session_start();
if (isset($_SESSION['signupSuccess']) && $_SESSION['signupSuccess']) {
    $username = $_SESSION['signedUpUsername'];
    echo "<div id='successMessage' style='display:none;'>Congratulations, $username! You have successfully signed up.</div>";
    unset($_SESSION['signupSuccess']);
    unset($_SESSION['signedUpUsername']);
}

// Add new year
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['year'])) {
    $year = $_POST['year'];

    // Connect to the database and verify the connection
    try {
        $db = $conn;
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }

    // Check if year already exists
    $query = "SELECT y_id FROM years WHERE year = :year";
    $stmt = $db->prepare($query);
    $stmt->execute([':year' => $year]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo 'The year you entered ' . $year . ' already exists.';
    } else {
        // Insert the new year
        $insertQuery = "INSERT INTO years (year) VALUES (:year)";
        $insertStmt = $db->prepare($insertQuery);
        if ($insertStmt->execute([':year' => $year])) {
            echo "New record created successfully. Last inserted ID is: " . $db->lastInsertId();
        } else {
            $errorInfo = $insertStmt->errorInfo();
            echo "Error: " . $errorInfo[2]; // ErrorInfo returns an array of error information
        }
    }

    $db = null;
    exit();
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Personalized Academic Planner EduTrack</title>
    <link rel="stylesheet" href="./css/styles.css">
    <!-- Include jQuery for simplicity to show slide down conrats message -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#successMessage").slideDown(1000).delay(3000).slideUp(1000); // Adjust timing as needed
            $("#successMessage").slideDown(1000).delay(3000).slideUp(1000); // Adjust timing as needed
        });
    </script>
</head>

<body>
    <div class="wrapper">
        <header>
            <h1>[EduTrack] - Home</h1>
            <button id="exitButton" class="action-button left-button">Exit</button>
            <span id="usernameDisplay">
                <?php
                if (isset($_SESSION['loggedinUsername']) && $_SESSION['loggedinUsername']) {
                    echo htmlspecialchars($_SESSION['loggedinUsername']);
                } else {
                    echo " USERNAME";
                }
                ?>
            </span>
            <div>
                <a href="Transcribe/index.html">
                    <button type="button">Transcribe</button>
                </a>
                <a href="addReminder.html">
                    <button type="button">Add Reminder</button>
                </a>
            </div>
        </header>

        <div class="main-container">
            <div class="left-section">
                <span class="clsTitle">Quizzes</span>
                <div class="segment">
                    <div class="subseg">
                        <sub>Class-1</sub>
                        <div class="subsubseg">
                            <sup>Qz-1</sup>
                            <sup class="duration-attention">2 days</sup>
                        </div>
                        <div class="subsubseg">
                            <sup>Qz-2</sup>
                            <sup class="duration-critical">7 days</sup>
                        </div>
                        <div class="subsubseg">
                            <sup>Qz-3</sup>
                            <sup class="duration-regular">15 days</sup>
                        </div>
                    </div>
                </div>
                <div class="line"></div>

                <span class="clsTitle">Assignments</span>
                <div class="segment">
                    <div class="subseg">
                        <sub>Class-2</sub>
                        <div class="subsubseg">
                            <sup>Amnt-1</sup>
                            <sup class="duration-overdue">2 days</sup>
                        </div>
                        <div class="subsubseg">
                            <sup>Amnt-2</sup>
                            <sup class="duration-critical">7 days</sup>
                        </div>
                        <div class="subsubseg">
                            <sup>Amnt-3</sup>
                            <sup class="duration-regular">15 days</sup>
                        </div>
                    </div>
                </div>
                <div class="line"></div>

                <span class="clsTitle">MTs</span>
                <div class="segment">
                    <div class="subseg">
                        <sub>Class-1</sub>
                        <div class="subsubseg">
                            <sup>MT</sup>
                            <sup class="duration-attention">2 days</sup>
                        </div>
                        <sub>Class-2</sub>
                        <div class="subsubseg">
                            <sup>MT</sup>
                            <sup class="duration-critical">7 days</sup>
                        </div>
                    </div>
                </div>
                <div class="line"></div>

                <span class="clsTitle">Finals</span>
                <div class="segment">
                    <div class="subseg">
                        <sub>Class-1</sub>
                        <div class="subsubseg">
                            <sup>Final</sup>
                            <sup class="duration-regular">12 days</sup>
                        </div>
                        <sub>Class-2</sub>
                        <div class="subsubseg">
                            <sup>Final</sup>
                            <sup class="duration-regular">17 days</sup>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mid-section">

                <div class="schd-section">
                    <h3>Schdeule</h3>
                    <p>More work will be added here.</p>
                </div>

                <div class="tasks-section">
                    <h3>Tasks</h3>
                    <form id="tasksForm">
                        <label for="tasksInput">Tasks: </label>
                        <input type="text" id="taskInput" name="task" placeholder="Add a task" />
                        <button type="submit">Submit</button>
                    </form>
                    <ul class="tasksList">
                        <li>
                            <div class="taskDiv">
                                <input type="text" class="ctaskValue" id="task-1" disabled value="Project" />
                                <button class="editSaveBtn">Edit</button>
                                <button class="delBtn">Delete</button>
                            </div>
                        </li>
                        <!-- More list items containing yearDiv will be added here -->
                    </ul>
                    <!-- <br><br><span>Note: <strong></strong><code style="color: red;">  deleting  a class   </code></strong>
                        will delete all related tasks.</span> -->
                </div>

                <div class="classes-section">
                    <h3>Classes</h3>
                    <form id="classesForm">
                        <label for="classesInput">Class: </label>
                        <input type="text" id="classInput" name="class" placeholder="Add a class" />
                        <button type="submit">Submit</button>
                    </form>
                    <ul class="classesList">
                        <li>
                            <div class="classDiv">
                                <input type="text" class="classValue" id="class-1" disabled value="ENSE 400" />
                                <button class="editSaveBtn">Edit</button>
                                <button class="delBtn">Delete</button>
                            </div>
                        </li>
                        <!-- More list items containing yearDiv will be added here -->
                    </ul>
                    <br><br><span>Note: <strong></strong><code style="color: red;"> deleting a class </code></strong>
                        will delete all related tasks.</span>
                </div>

                <div class="semesters-section">
                    <h3>Semesters</h3>
                    <form id="semestersForm">
                        <label for="semesterInput">Semester: </label>
                        <input type="text" id="semesterInput" name="semester" placeholder="Add a semester" />
                        <button type="submit">Submit</button>
                    </form>
                    <ul class="semestersList">
                        <li>
                            <div class="semesterDiv">
                                <input type="text" class="semesterValue" id="semester-1" disabled value="Fall" />
                                <button class="editSaveBtn">Edit</button>
                                <button class="delBtn">Delete</button>
                            </div>
                        </li>
                        <!-- More list items containing yearDiv will be added here -->
                    </ul>
                    <br><br><span>Note: <strong></strong><code style="color: red;"> deleting a semester </code></strong>
                        will delete all related classes.</span>
                </div>

                <div class="years-section">
                    <h3>Years</h3>
                    <form id="yearsForm">
                        <label for="yearInput">Year: </label>
                        <input type="text" id="yearInput" name="year" placeholder="Add a year" />
                        <button type="submit">Submit</button>
                    </form>
                    <ul class="yearsList">
                        <li>
                            <div class="yearDiv">
                                <input type="text" class="yearValue" id="year-1" disabled value="2024" />
                                <button class="editSaveBtn">Edit</button>
                                <button class="delBtn">Delete</button>
                            </div>
                        </li>
                        <!-- More list items containing yearDiv will be added here -->
                    </ul>
                    <br><br><span>Note: <strong></strong><code style="color: red;"> deleting a year </code></strong>
                        will delete all related semesters and classes.</span>
                </div>

            </div>

            <div class="mid-tap">
                <div class="button-container">
                    <button class="vertical-button" id="schdBtn" style="background-color: #6f622ca6;">Schdeule</button>
                    <button class="vertical-button" id="taskBtn" style="background-color: #586729a6;">Tasks</button>
                    <button class="vertical-button" id="classesBtn"
                        style="background-color: #1e411ea6;">Classes</button>
                    <button class="vertical-button" id="semestersBtn"
                        style="background-color: #401616ab;">Smesters</button>
                    <button class="vertical-button" id="yearsBtn" style="background-color: #22223fa1;">Years</button>
                    <!-- Add more buttons as needed -->
                </div>
            </div>


            <div class="right-section">

                <div class="schd-header">

                </div>
                <div class="schd-body">
                    <div class="schd-matrix">

                    </div>
                </div>
            </div>
        </div>

        <footer>
            <p>ENSE 400 Capstone © 2024</p>
        </footer>
    </div>
    <script src="./js/script.js"></script>
    <script src="./js/script2.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('exitButton').addEventListener('click', function() {
                window.location.href = 'signout.php';
            });
        });
    </script>
</body>

</html>