<?php
  include("../dashboard.php"); 
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Set a past date

session_start();
session_destroy();
session_regenerate_id(true);
header("Location: login.php");


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>log out</title>
</head>
<body>
<script src="../preventback.js"></script>
</body>
</html>

