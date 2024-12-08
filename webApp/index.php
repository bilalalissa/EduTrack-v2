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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = array();

    $username = isset($_POST["username"]) ? test_input($_POST["username"]) : '';
    $password = isset($_POST["password"]) ? test_input($_POST["password"]) : '';

    if (!empty($username) && !empty($password)) {
        try {
            $db = $conn;
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable error mode

            // Query the database to check whether the username exists
            $query = "SELECT u_id, username, password_hash FROM users WHERE username = :username";
            $stmt = $db->prepare($query);
            $stmt->execute([':username' => $username]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                // Verify the password
                if (password_verify($password, $result['password_hash'])) {
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

    if (!empty($errors)) {
        foreach ($errors as $type => $message) {
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
    <title>[EduTrack] Personalized Academic Planner</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="wrapper">
        <header>
            <h1>EduTrack</h1>
        </header>
        <div class="main-container">
            <div class="left-section">
                <form id="loginForm" method="POST" action="index.php">
                    <h3>Login</h3>
                    <div class="input-group">
                        <input type="text" id="usernames" name="username" required placeholder="Username">
                    </div>
                    <div class="input-group">
                        <input type="password" id="password" name="password" required placeholder="Password">
                    </div>
                    <div class="form-footer">
                        <button type="button" id="signupButton">Sign-up</button>
                        <button type="submit" id="loginButton">Login</button>
                    </div>
                </form>
            </div>

            <div class="right-section">
                <div class="content">
                    <h2>Welcome to Personalized Academic Planner EduTrack</h2>
                    <p><strong>Embark on Your Organized Academic Journey!</strong></p>
                    <p>Welcome to Personalized Academic Planner EduTrack, your innovative companion in the realm of
                        academic organization and efficiency. EduTrack is designed to transform how students, educators,
                        and
                        academic professionals approach their daily, weekly, and long-term educational planning. With
                        EduTrack, navigating through your academic life becomes not just easier, but more effective and
                        enjoyable.</p>

                    <h2>Why Choose EduTrack?</h2>
                    <ul>
                        <li><strong>Customized Planning</strong>: Tailor your academic schedule to fit your unique
                            needs. Whether you're juggling multiple classes, assignments, or exams, EduTrack adapts to
                            your
                            personal study habits and goals.</li>
                        <li><strong>Streamlined Organization</strong>: Say goodbye to cluttered notes and missed
                            deadlines. EduTrack’s intuitive interface allows you to organize your academic tasks with
                            ease.
                            Track your assignments, exams, class schedules, and more—all in one place.</li>
                        <li><strong>Progress Tracking</strong>: Monitor your academic progress with built-in tracking
                            features. Set milestones and celebrate your achievements as you move closer to your academic
                            objectives.</li>
                        <li><strong>Collaborative Tools</strong>: Collaborate with peers or educators effortlessly.
                            Share your schedules, coordinate study sessions, or work on group projects, making teamwork
                            more efficient and less stressful.</li>
                        <li><strong>Accessible Anywhere</strong>: With cloud-based technology, your planner is
                            accessible across multiple devices. Whether you're at home, in the library, or on the go,
                            EduTrack is right there with you.</li>
                        <li><strong>Personalized Reminders</strong>: Never miss an important date again. EduTrack sends
                            you
                            personalized reminders about upcoming deadlines, ensuring you’re always on track.</li>
                        <li><strong>Enhanced Focus</strong>: With all your academic responsibilities clearly organized,
                            you can focus more on learning and less on managing schedules.</li>
                    </ul>

                    <h2>Join the EduTrack Community</h2>
                    <p>Become part of a growing community that values structured and stress-free academic life. Whether
                        you're a high school student, a college attendee, or an academic professional, EduTrack is your
                        partner in achieving academic excellence.</p>
                    <p>Start your journey today with Personalized Academic Planner [EduTrack] – where your academic
                        success
                        is our priority!</p>
                </div>
            </div>
        </div>
        <footer>
            <p>ENSE 400 Capstone © 2024</p>
        </footer>
    </div>
    <!-- <script src="/js/script.js" defer></script> -->

    <script src="js/script.js"></script>
    <script src="js/script2.js"></script>

</body>

</html>