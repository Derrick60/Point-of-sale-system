<?php
// Set error reporting level to exclude notices
error_reporting(E_ALL & ~E_NOTICE);

// control error messages from being displayed on the screen
ini_set('display_errors', 0);
session_start();
// Simulate a database connection
function getDatabaseConnection() {
    $db = mysqli_connect("localhost", "root", "", "debt_mgt");
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $db;
}

// Define the getUserData function
function getUserData($username) {
    $db = getDatabaseConnection();
    $username = mysqli_real_escape_string($db, $username);
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($db, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        mysqli_close($db);
        return $user_data;
    } else {
        mysqli_close($db);
        return null;
    }
}

// Debugging output
//echo "Session username: " . $_SESSION['username'];

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Get the user's information from the session or database
$user_username = $_SESSION['username'];
// Replace this with your logic to fetch user data
$user = getUserData($user_username);

?>

<!DOCTYPE html>
<html>
<head>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>User Profile</title>
</head>
<body>
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
         <div class="card-header">
         <p><h4>Welcome, <?php echo $user['username']; ?>!<h4></p>
         </div>
         <div class="container">
            
         </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12"> 
                            <div class="col-md-6">
                            <h4 class="card-title">Change Password</h4> 
                            </div>
                            <div class="col-md-6">
                            <a href="debtor.php" class="btn btn-danger">Back</a>
                            </div>
                    </div>
                </div>
                
                <form action="../php/login/change_password.php" method="POST">
                    <div class="form-group">
                        <label for="current_password">Current Password:</label>
                        <input type="password" class="form-control" name="current_password" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="new_password">New Password:</label>
                        <input type="password" class="form-control" name="new_password" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="confirm_password">Confirm New Password:</label>
                        <input type="password" class="form-control" name="confirm_password" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </form>
            </div>
         </div>
        </div>
     </div>
    </div>
 </div>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
