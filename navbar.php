<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
  <div class="container">
        <a class="navbar-brand mb-0 mr-0 h1" href="index.php">
            Tuf Portfolio
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#a">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse font-weight-bold" id="a">

            <ul class="navbar-nav ml-auto">

              <?php
                if(isset($_SESSION['is_login'])) {
                  // $username_new = $_SESSION['username'];
                  // $query = "SELECT * FROM users WHERE username='$username_new'";
                  // $fire = mysqli_query($con, $query);
                  // $userArray = mysqli_fetch_assoc($fire);
              ?>
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle text-light" data-toggle="dropdown" href="">
                      <?php echo $_SESSION['fullname'] ?>
                  </a>
                  <div class="dropdown-menu">
                    <a
                      href="profile.php"
                      class="dropdown-item">
                    My Profile</a>
                    <a
                      href="changepassword.php"
                      class="dropdown-item">
                    Change Password</a>
                    <a href="logout.php" class="dropdown-item">Logout</a>
                  </div>
              </li>

              <?php } else { ?>

              <li class="nav-item">
                  <a class="nav-link text-light" href="signin.php">
                      Sign In
                  </a>
              </li>
              <li>
                  <a class="nav-link text-light" href="signup.php">
                      Sign Up
                  </a>
              </li>

              <?php } ?>

            </ul>
        </div>
  </div>
</nav>
