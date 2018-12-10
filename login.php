<?php
// Include config file
require_once 'config.php';
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = 'Please enter username.';
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST['password']))){
        $password_err = 'Please enter your password.';
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            /* Password is correct, so start a new session and
                            save the username to the session */
                            session_start();
                            $_SESSION['username'] = $username;      
                            header("location: index.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = 'The password you entered was not valid.';
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = 'No account found with that username.';
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html>
<head>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>M&S Paving Job Portal Login</title>

   <!-- Bootstrap Core CSS CDN -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   <!-- FontAwesome CDN -->
   <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

   <!-- Main CSS file -->
   <link rel="stylesheet" href="/css/style.css">
</head>
<body class="text-center">

    <div class="container-fluid d-flex w-100 h-100 p-3 mx-auto flex-column">
      <header class="masthead mb-auto">
        <div class="inner">
          <h3 class="masthead-brand">M&S Paving Job Portal Login</h3>
          <nav class="nav nav-masthead justify-content-center">
            <a class="nav-link active" href="#">Home</a>
            <a class="nav-link" href="#">News</a>
            <a class="nav-link" href="http://www.mspave.com">Main Website</a>
          </nav>
        </div>
      </header>

      <main role="main" class="inner cover">

         <img src="/images/logo.png" class="img-fluid mt-5" alt="M&S Paving Logo">

         <form class="form-signin" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> 
            <div class="text-center mb-4">
              <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
              <h1 class="h3 mb-3 font-weight-normal">Job Portal Login</h1>
              <p>Enter your email address and password below to access the employee job portal.</p>
            </div>

            <div class="form-label-group">
              <input type="email" id="inputEmail" name="username" class="form-control" placeholder="Email address" required autofocus>
              <label for="inputEmail">Email address</label>
            </div>

            <div class="form-label-group">
              <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
              <label for="inputPassword">Password</label>
            </div>

            <div class="checkbox mb-3">
              <label>
                <input type="checkbox" value="remember-me"> Remember me
              </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>         
          </form>

			<!-- Container (Services Section) -->
			<div class="container-fluid text-center mt-6 mb-6">
			  <h2>SERVICES</h2>
			  <h4>What we offer</h4>
			  <br>
			  <div class="row">
				 <div class="col-sm-4">
					<i class="fa fa-power-off fa-3x"></i>
					<h4>POWER</h4>
					<p>Lorem ipsum dolor sit amet..</p>
				 </div>
				 <div class="col-sm-4">
					<i class="fa fa-heart fa-3x"></i>
					<h4>LOVE</h4>
					<p>Lorem ipsum dolor sit amet..</p>
				 </div>
				 <div class="col-sm-4">
					<i class="fa fa-lock fa-3x"></i>
					<h4>JOB DONE</h4>
					<p>Lorem ipsum dolor sit amet..</p>
				 </div>
			  </div>
			  <br><br>
			  <div class="row">
				 <div class="col-sm-4">
					<i class="fa fa-leaf fa-3x"></i>
					<h4>GREEN</h4>
					<p>Lorem ipsum dolor sit amet..</p>
				 </div>
				 <div class="col-sm-4">
					<i class="fa fa-certificate fa-3x"></i>
					<h4>CERTIFIED</h4>
					<p>Lorem ipsum dolor sit amet..</p>
				 </div>
				 <div class="col-sm-4">
					<i class="fa fa-wrench fa-3x"></i>
					<h4>HARD WORK</h4>
					<p>Lorem ipsum dolor sit amet..</p>
				 </div>
			  </div>
			</div>
     </main>

      <footer class="mastfoot mt-auto">
        <div class="inner">
          <p class="mb-3 text-muted text-center">Cover template for <a href="https://getbootstrap.com/">Bootstrap</a>, by <a href="https://twitter.com/mdo">@mdo</a>. &copy; 2017-2018</p>
        </div>
      </footer>

    </div>

<!-- jQuery, Poppler, and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>

