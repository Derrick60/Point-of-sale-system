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
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];
    if ($password !== $confirmPassword) {
        echo "Passwords do not match. Please try again.";
    }else{

    // Hash the password securely
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    
    // Prepare and execute an SQL statement
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashedPassword);

    if ($stmt->execute()) {
       //
        $_SESSION["change_success"] = "User  crfeated successfully";
                header("Location: ../../pages/product.php"); // Redirect to the login page
                exit(); 
    } else {
        echo "Error: " . $stmt->error;
    }
}

    $stmt->close();
}

$conn->close();

