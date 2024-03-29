<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// Database connection setup
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "osman_pos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query the database for the user's hashed password
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($hashedPassword);
    
    if ($stmt->fetch()) {
        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            // Password is correct, set session and redirect
            $_SESSION["username"] = $username;
            header("Location: ../../pages/header.php"); 
            exit();
        } else {
            $_SESSION["login_error"] = "Invalid username or password";
            header("Location: ../../pages/login.php"); // Redirect to the login page
            exit(); 
        }
    } else {
        $_SESSION["login_error"] = "Invalid username or password";
            header("Location: ../../pages/login.php"); // Redirect to the login page
            exit();
    }

   
}

$conn->close();

// Pass the error message to the HTML page
echo "<script>document.getElementById('error-message').textContent = '$errorMsg';</script>";
