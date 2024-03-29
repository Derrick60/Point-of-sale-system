<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Simulate a database connection
function getDatabaseConnection() {
    // Replace with your actual database connection logic
    $db = mysqli_connect("localhost", "root", "", "hospital_booking_sys");
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $db;
}

// Start session


// Check if the user is logged in


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    $user_username = $_SESSION['username'];

    // Verify that the current password matches the user's actual password
    $db = getDatabaseConnection();
    $query = "SELECT password FROM users WHERE username = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $user_username);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();
    $stmt->close();
    $db->close();

    if (password_verify($current_password, $hashed_password)) {
        if ($new_password === $confirm_password) {
            // Hash the new password securely
            $new_hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

            // Update the user's password in the database
            $db = getDatabaseConnection();
            $update_query = "UPDATE users SET password = ? WHERE username = ?";
            $update_stmt = $db->prepare($update_query);
            $update_stmt->bind_param("ss", $new_hashed_password, $user_username);

            if ($update_stmt->execute()) {
                $_SESSION["change_success"] = "Password changed successfully";
                header("Location: ../../pages/debtor.php"); // Redirect to the login page
                exit(); 
            } else {
                echo "Error updating password: " . $update_stmt->error;
            }

            $update_stmt->close();
            $db->close();
        } else {
            echo "New passwords do not match. Please try again.";
        }
    } else {
        echo "Incorrect current password.";
    }
}
