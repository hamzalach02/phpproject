<?php 

session_start();

	include("connection.php");
	include("functions.php");
   
  
	$er = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Something was posted
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {

        // Read from the database
        $query = "SELECT * FROM users WHERE user_name = '$user_name' LIMIT 1";
        $result = mysqli_query($con, $query);

        if ($result) {
            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);

                if ($user_data['password'] === $password) {
                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("Location: index.php");
                    die;
                }
            }
            $er = "0";
        }

    } else {
        $er = "0";
    }
}
?>



	





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyApp - Login and Sign Up</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Add some custom styles for the forms and center the title */
        .login-form, .register-form {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .centered {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="centered">
                    <h1>MyApp</h1>
                </div>
                <div class="login-form">
                    <h2>Login</h2>
                    <form id="login-form"  method="post">
                        <div class="form-group">
                            <label for="loginEmail">Username:</label>
                            <input type="text" class="form-control" id="loginEmail" placeholder="Enter username" name="user_name" value="">
                        </div>
                        <div class="form-group">
                            <label for="loginPassword">Password:</label>
                            <input type="password" class="form-control" id="loginPassword" placeholder="Enter password" name="password">
                        </div>
						
                        <button type="submit" class="btn btn-primary">Login</button>
                        <!-- Login form fields go here -->

					
							<div style="color: red;" id="err"  class="fade-in-out"></div>


							<script>
								<?php if ($er === "0") : ?>
								// Show the error message with fade-in animation and set its content
								var errorMessage = document.getElementById("err");
								errorMessage.style.opacity = "1"; // Set opacity to 1 (visible)
								errorMessage.innerHTML = "error"; // Set the content

								// Hide the error message after a delay
								setTimeout(function() {
									errorMessage.style.opacity = "0"; // Set opacity back to 0 (hidden)
								}, 3000); // Adjust the delay as needed
								<?php endif; ?>
							</script>
					

                    </form>
                    <p><a href="signup.php" id="register-link">Don't have an account? Register</a></p>
                </div>
				</div>
        </div>
    </div>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	</body>
</html>