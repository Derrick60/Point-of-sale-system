<!DOCTYPE html>
<html>
<head>
    
<script language ="javascript" type="text/javascript">
        window.history.forward();
        
    </script>

    <link rel="stylesheet" href="../components/jquery-confirm-master/css/jquery-confirm.css">
    <link rel="stylesheet" href="../bootstrap.min.css">
    <link rel="stylesheet" href="../components/data tables/DataTables/css/jquery.dataTables.min.css">
    <title>Login</title>
</head>
<body>
<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Login</h4>
                    </div>
                    <div class="card-body">
                        <form action="../php/login/login.php"  method="post">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <!-- Display the error message -->
                            <p id="error-message" style="color: red;">
                                <?php echo isset($_SESSION["login_error"]) ? $_SESSION["login_error"] : ""; ?>
                            </p>
                            <!-- Reset the error message after displaying it -->
                            <?php unset($_SESSION["login_error"]); ?>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                        <!--<p id="error-message" style="color: red;"></p> Placeholder for error message -->

                      <!-- <a href="register.php">Register</a>-->
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Get references to the form fields and the error message element
        const usernameInput = document.getElementById('username'); // Replace with the actual IDs of your form fields
        const passwordInput = document.getElementById('password');
        const errorMessage = document.getElementById('error-message');

        // Clear the error message when user starts typing
        usernameInput.addEventListener('input', clearErrorMessage);
        passwordInput.addEventListener('input', clearErrorMessage);

        function clearErrorMessage() {
            errorMessage.textContent = ''; // Clear the error message text
        }
    </script>
    <script src="../components/jquery/dist/jquery.js"></script>
        <script src="../components/jquery/dist/jquery-min.js"></script>
        <script src="../components/jquery.validate.min.js"></script>
        <script src="../components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="../components/jquery-confirm-master/js/jquery-confirm.js"></script>

        <script src= "../components/data tables/DataTables/js/jquery.dataTables.min.js"></script>
</body>
</html>


