<?php
// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}

// Include config file
require_once 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>M&S Paving Job Portal</title>

   <!-- Bootstrap Core CSS CDN -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

   <link rel="stylesheet" href="<?php echo CSSURL . 'album.css' ?>">
</head>
<body>
<!-- Header Begin -->
   <?php include PARTIALSDIR . 'header/header.php' ?>
<!-- Header End -->

   <main role="main">
      <div class="container-fluid">
         <div class="row mt-5">
            <!-- Left Nav Menu -->
            <div class="col-sm-2">
                  <a href="register.php" class="btn btn-primary btn-lg btn-block">Add User</a>
            </div>  <!-- div .col-sm-2 end -->
            
            <!-- Center Column -->
            <div class="col-sm">
               <div class="shadow p-3 mb-5 rounded">
                  <h3><u>User Accounts</u></h3>
                  <p>Use this page to add, view, or edit users.</p>
               </div>

               <table id="users-table" class="table table-striped table-hover jobsites-table">                     
                  <div class="table responsive">
                     <thead>
                        <tr>
                           <th>Select</th>
                           <th>ID #</th>
                           <th>Username (Email)</th>
                           <th>Date Created</th>
                           <th>Account Type</th>
                        </tr>
                     </thead>
                     <tbody>
<?php 
// Prepare a select statement
        $sql = "SELECT id, username, created_at, permission FROM users;";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            //mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            //$param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
               /* store result */
               mysqli_stmt_store_result($stmt);
                
               // Bind variables to the prepared statement
               mysqli_stmt_bind_result($stmt, $id, $username, $created_at, $permission);

               if(mysqli_stmt_num_rows($stmt) < 1){
                  echo "No Users Found.";
               } else{
                  // output data of each row
                  while(mysqli_stmt_fetch($stmt)) {
                     echo '<tr>
                              <td>
                                 <div class="form-check">
                                    <input class="form-check-input position-static" type="checkbox" value="" id="uid-'. $id . '" aria-label="Select User">
                                 </div>
                              </td>   
                              <td>' . $id .'</td>';
                     echo '   <td>' . $username .'</td>';
                     echo '   <td> '. $created_at .'</td>';
                     echo '   <td> ';
                     if ($permission == 1) {
                        echo "Admin";
                     } else if ($permission == 10) {
                        echo "Employee";
                     } else if ($permission == 20) {
                        echo "Client";
                     } else {
                        echo "Permissions Error.";
                     }
                     echo '</td>';
                     echo '</tr>';
                  }
               }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
?>
                     </tbody>
                  </div>
               </table>
            </div>  <!-- div .col-sm end -->

            <!-- Third Column -->
            <div class="col-sm-2">
            </div>  <!-- div .col-sm-2 end -->

          </div>  <!-- div .row end -->
       </div>  <!-- div .container end -->	 
    </main>

    <footer class="text-muted">
      <div class="container">
        <p class="float-right">
          <a href="#">Back to top</a>
        </p>
        <p>&copy; M&S Paving 2018</p>
      </div>
    </footer>

<!-- jQuery, Poppler, and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.4/holder.min.js"></script>

</body>
</html>

