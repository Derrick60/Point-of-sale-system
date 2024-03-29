<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
</head>
<body>
    <?php
  
       
include("header.php"); 
    ?>
<link rel="stylesheet" href="../components/jquery-confirm-master/css/jquery-confirm.css">
    <link rel="stylesheet" href="../bootstrap.min.css">
    <link rel="stylesheet" href="../components/data tables/DataTables/css/jquery.dataTables.min.css">
    <script>
        function checkPasswords() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm_password").value;
            var errorMessage = document.getElementById("error-message");

            if (password !== confirmPassword) {
                errorMessage.style.display = "block";
                errorMessage.innerHTML = "Passwords do not match. Please try again.";
                return false; // Prevent form submission
            }

            errorMessage.style.display = "none";
            return true; // Allow form submission
        }
    </script>
</head>
<body>

<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Register</h4>
                    </div>      
                    <div class="card-body">
                   
                    <form action="../php/login/register.php" method="post"onsubmit="return checkPasswords()" >
                        <div id="error-message" class="alert alert-danger" style="display: none;"></div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" placeholder="username" id="username" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Email" id="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password" id="password"required>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" id="confirm_password" oninput="checkPasswords()" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
 
</body>
</html>
