   <header>
      <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 col-md-7 py-4">
              <h4 class="text-white">M&S Paving Job Portal</h4>
              <p class="text-muted">Use this area to add/view/edit users or logout.</p>
            </div>
            <div class="col-sm-4 offset-md-1 py-4">
              <h4 class="text-white">User Menu</h4>
              <ul class="list-unstyled">
                <li><a href="register.php" class="text-white">Add A New User</a></li>
                <li><a href="#" class="text-white">Remove A User (Coming Soon)</a></li>
                <li><a href="logout.php" class="text-white">Sign Out</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
          <a href="https://jobsites.mspave.com/" class="navbar-brand d-flex align-items-center">
            <img src="images/logo.png" class="mr-3" style="height:20px;width:auto;"></img>
            <strong>Admin Dashboard</strong>
          </a>
          <div>
             <?php if ($_SESSION["username"] != null || $_SESSION["username"] != "") { echo "<span class='text-white mr-2'>" . $_SESSION["username"] . "</span>"; } ?>
             <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
             </button>
          </div>
        </div>
      </div>
    </header>
