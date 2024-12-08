<?php
// enabling error messages
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("db.php");

function test_input($data) {
    if ($data === null) {
        return '';
    }
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data); //encodes
    return $data;
}

// Check whether the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = array();
    $signupData = TRUE;
    $dataOK = TRUE;

    ////////////////////////////
    // signup process
    ////////////////////////////
    $usernameup = isset($_POST["usernameup"]) ? test_input($_POST["usernameup"]) : '';
    $email = isset($_POST["email"]) ? test_input($_POST["email"]) : '';
    $passwordup = isset($_POST["passwordup"]) ? test_input($_POST["passwordup"]) : '';
    $confirmPassword = isset($_POST["confirmPassword"]) ? test_input($_POST["confirmPassword"]) : '';

    if ($passwordup == $confirmPassword) {
        $signupData = TRUE;
        $hashedPassword = password_hash($passwordup, PASSWORD_DEFAULT); // hashing the password
    } else {
        $signupData = FALSE;
        $errors["Signup Error"] = "Passwords do not match!";
    }

    // Check whether the signup fields are not empty
    if ($signupData) {

        // Connect to the database and verify the connection
        try {
            $db = $conn;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }

        // Check if the user already exists
        $query = "SELECT password_hash FROM Users WHERE username = :username AND email = :email";
        $stmt = $db->prepare($query);
        $stmt->execute([
            ':username' => $usernameup,
            ':email' => $email
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // User already exists
            $errors["User Exists"] = "User with this username or email already exists.";
        } else {
            // Insert new user
            $insertQuery = "INSERT INTO Users (username, email, password_hash) VALUES (:username, :email, :password)";
            $insertStmt = $db->prepare($insertQuery);
            $insertStmt->execute([
                ':username' => $usernameup,
                ':email' => $email,
                ':password' => $hashedPassword
            ]);

            // After successful signup redirect or start a session
            session_start();
            $_SESSION['signupSuccess'] = true;
            $_SESSION['signedUpUsername'] = $usernameup; // where $usernameup is the username from the form
            $_SESSION['loggedinUsername'] = $usernameup; // where $usernameup is the username from the form

            // Redirect to home or other page
            header("Location: home.php");
            exit();
        }

        $db = null;
    } else {
        $errors['Signup Failed'] = "You entered invalid data while signing up.";
    }





    ////////////////////////////
    // signin process
    ////////////////////////////
    // Get and validate the username and password fields
    $errors = array();
    
    $username = isset($_POST["username"]) ? test_input($_POST["username"]) : '';
    $password = isset($_POST["password"]) ? test_input($_POST["password"]) : '';

    if (!empty($username) && !empty($password)) {
        try {
            $db = $conn;
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable error mode

            // Query the database to check whether the username exists
            $query = "SELECT u_id, username, password_hash FROM Users WHERE username = :username";
            $stmt = $db->prepare($query);
            $stmt->execute([':username' => $username]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                // Verify the password
                if (password_verify($password, $result['password'])) {
                    session_start();
                    // $_SESSION['username'] = $result['username'];
                    $_SESSION['signupSuccess'] = false;
                    $_SESSION['loggedinUsername'] = $username;
                    header("Location: home.php");
                    exit();
                } else {
                    $errors["Login Failed"] = "Incorrect password.";
                }
            } else {
                $errors["Login Failed"] = "Username does not exist.";
            }
        } catch (PDOException $e) {
            $errors["Database Error"] = $e->getMessage();
        }
    } else {
        $errors['Login Failed'] = "Username and password are required.";
    }

    if(!empty($errors)){
        foreach($errors as $type => $message) {
            echo "$type: $message <br />\n";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Personalized Academic Planner PAP</title>
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
    <div class="wrapper">
        <header>
            <h1>[EduTrack] - Sign Up</h1>
        </header>
        <div class="main-container">
            <div class="left-section">
                <form id="loginForm" method="POST" action="signup.php">
                    <h3>Login</h3>
                    <div class="input-group">
                        <input type="text" id="loginUsername" name="username" required placeholder="Username">
                    </div>
                    <div class="input-group">
                        <input type="password" id="loginPassword" name="password" required placeholder="Password">
                    </div>
                    <div class="form-footer">
                        <button type="button" id="mainButton">Main</button>
                        <button type="submit" id="loginButton">Login</button>
                    </div>
                </form>
            </div>
            <div class="right-section">
                <div class="form-container">
                    <form id="signupForm" method="POST" action="signup.php" enctype="multipart/form-data">
                        <h3>Sign-Up</h3>
                        <span class="note">* Fields are required</span>

                        <div class="input-group">
                            <input type="text" id="username" name="usernameup" required placeholder="* Username">
                        </div>
                        <div class="input-group">
                            <input type="email" id="email" name="email" required placeholder="* Email">
                        </div>
                        <div class="input-group-1">
                            <input type="password" id="password" name="passwordup" required placeholder="* Password">
                            <input type="password" id="confirmPassword" name="confirmPassword" required
                                placeholder="* Confirm Password">
                        </div>

                        <div class="input-group-1">
                            <input type="text" id="firstName" name="firstName" placeholder="First Name">
                            <input type="text" id="lastName" name="lastName" placeholder="Last Name">
                        </div>
                        <div class="input-group">
                            <input type="text" id="studentNumber" name="studentNumber" placeholder="Student Number">
                        </div>

                        <!-- <div class="input-group file-input-group">
                            <label for="avatar">Avatar:</label>
                            <input type="file" id="avatar" name="avatar">
                        </div> -->
                        <div id="signupMessage" style="display:none;"></div>
                        <div class="form-footer">
                            <button type="submit" id="signupSubmit">Sign-up</button>
                        </div>
                    </form>

                </div>
            </div>
            <!-- You can add an info section here similar to the landing page if needed -->
        </div>
        <footer>
            <p>ENSE 374 Fall-23 Group 5 © 2023</p>
        </footer>
    </div>

    <script src="./js/script.js"></script>
    <script src="./js/script2.js"></script>
</body>

</html>