<?php 
session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{

			//save to database
			$user_id = random_num(20);
			$query = "insert into users (user_id,user_name,password) values ('$user_id','$user_name','$password')";

			mysqli_query($con, $query);

			header("Location: login.php");
			die;
		}else
		{
			echo "Please enter some valid information!";
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
				<div class="register-form" >
                    <h2>Sign Up</h2>
                    <form id="register-form"  method="post">
                        <div class="form-group">
                            <label for="signupName">username:</label>
                            <input type="text" class="form-control" id="signupName" placeholder="Enter your username" name="user_name">
                        </div>
                      
                        <div class="form-group">
                            <label for="signupPassword">Password:</label>
                            <input type="password" class="form-control" id="signupPassword" placeholder="Enter password" name="password">
                        </div>
                        <button type="submit" class="btn btn-success">Sign Up</button>
                    </form>
                    <p><a href="login.php" id="login-link">Already have an account? Login</a></p>
                </div>
               
				</div>
        </div>
    </div>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	</body>
</html>