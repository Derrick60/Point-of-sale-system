<?php /*i used this as a test example*/
$hostname = 'localhost';  // Replace with your database hostname
$database = 'osman_pos';  // Replace with your database name
$username = 'root';  // Replace with your database username (default is 'root' for XAMPP)
$password = '';  // Replace with your database password (default is empty for XAMPP)

// Create a connection
$connection = mysqli_connect($hostname, $username, $password, $database);

// Check the connection
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the value from the form
    $catName = $_POST['catname'];

    // Prepare the query
    $query = "INSERT INTO table_test (catname) VALUES ('$catName')";

    // Execute the query
    $result = mysqli_query($connection, $query);

    if ($result) {
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . mysqli_error($connection);
    }
}

// Close the connection
mysqli_close($connection);

