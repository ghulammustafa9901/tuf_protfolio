<?php
  require 'include/config.php';

  if (isset($_SESSION['is_login'])) {
    header('Location: dashboard.php');
  }

  if (isset($_GET['UN'])) {
    $usernameShow = $_GET['UN'];
  }

?>

<!DOCTYPE html>
<html>
<head>
  <?php require_once 'include/css_libraries.php' ?>
</head>
<body>

  <?php include 'navbar.php'; ?>

  <div class="container">
    <?php
      if(isset($_GET['activate'])) {
        if (strpos($fullUrl, "activate=true")) {
          echo "<div class='alert alert-success alert-dismissible fade show mt-3 mb-0' role='alert'>
                  Your Account Successfully Activated!
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
              </div>
              <script type='text/javascript'>setTimeout(function() { $('.alert-success').fadeOut('fast'); }, 5000);</script>";
          } elseif (strpos($fullUrl, "activate=already")) {
            echo "<div class='alert alert-warning already alert-dismissible fade show mt-3 mb-0' role='alert'>
                    Your Account is Already Activate!
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                      <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                <script type='text/javascript'>setTimeout(function() { $('.already').fadeOut('fast'); }, 5000);</script>";
          } elseif (strpos($fullUrl, "activate=notactivate")) {
            echo "<div class='alert alert-warning notactivate alert-dismissible fade show mt-3 mb-0' role='alert'>
                    You have not Activate your account yet. Please check your inbox and verify your account!
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                      <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                <script type='text/javascript'>setTimeout(function() { $('.notactivate').fadeOut('fast'); }, 5000);</script>";
          }
      }

      if(isset($_GET['PWSC'])) {
        echo "<div class='alert alert-success alert-dismissible fade show mt-3 mb-0' role='alert'>
                Your Password Successfully Change!
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <script type='text/javascript'>setTimeout(function() { $('.alert-success').fadeOut('fast'); }, 5000);</script>";
      }
    ?>

    <div class="row ">
      <div class="offset-md-3 col-md-6 font-weight-bold text-dark">
        <div class="card my-5">
          <div class="card-header lead font-weight-bold text-uppercase text-center">
            Sign In
          </div>
          <div class="card-body">
            <form
              name="sigup"
              id="signup"
              method="POST"
              action="action_signin.php"
              onsubmit="return SignInValidation();">
              <div class="form-group">
                <label for="text">Username</label>
                <input
                  type="text"
                  name="si_username"
                  id="si_username"
                  class="form-control"
                  placeholder="Username"
                  value="<?php echo @$usernameShow ?>">
                  <div id="errorSigninUsername"></div>
                  <?php
                    if(isset($_GET['UNE'])) {
                      if (strpos($fullUrl, "UNE=empty")) {
                        echo '<script type="text/javascript">
                                document.getElementById("si_username").style.borderColor = "#aa0000";
                                document.getElementById("si_username").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("si_username").focus();
                              </script>';
                        echo '<div class="error-style" id="error_SU_UN">Please Enter Your Userame</div>';
                      } elseif (strpos($fullUrl, "UNE=lenght")) {
                        echo '<script type="text/javascript">
                                document.getElementById("si_username").style.borderColor = "#aa0000";
                                document.getElementById("si_username").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("si_username").focus();
                              </script>';
                        echo '<div class="error-style" id="error_SI_UN">Please enter between 6 and 30 characters</div>';
                      } elseif (strpos($fullUrl, "UNE=invalid")) {
                        echo '<script type="text/javascript">
                                document.getElementById("si_username").style.borderColor = "#aa0000";
                                document.getElementById("si_username").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("si_username").focus();
                              </script>';
                        echo '<div class="error-style" id="error_SI_UN">Only Use alphabets, numerical, _ . </div>';
                      } elseif (strpos($fullUrl, "UNE=notexists")) {
                        echo '<script type="text/javascript">
                                document.getElementById("si_username").style.borderColor = "#aa0000";
                                document.getElementById("si_username").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("si_username").focus();
                              </script>';
                        echo '<div class="error-style" id="error_SI_UN">Username is Incorrect!</div>';
                      } elseif (strpos($fullUrl, "UNE=success")) {
                        echo '<script type="text/javascript">
                                document.getElementById("si_username").style.borderColor = "#28a745";
                                document.getElementById("si_username").style.boxShadow = "0 0 9px rgba(40, 167, 69, 0.25)";
                                document.getElementById("error_SI_UN")?.remove();
                              </script>';
                      }
                    }
                  ?>
              </div>

              <div class="form-group form-group-show-PWD">
                <label for="text">Password</label>
                <input
                  type="password"
                  name="si_password"
                  id="si_password"
                  class="form-control"
                  placeholder="Password">
                  <span class="showPWDIcon">
                    <i class="fas fa-eye" id="SH_SI_PWD_Icon" onclick="SH_SI_PWD()" data-toggle="tooltip" data-placement="bottom" title="Hide Password"></i>
                  </span>
                  <div id="errorSigninPassword"></div>
                  <?php
                    if(isset($_GET['PWE'])) {
                      if (strpos($fullUrl, "PWE=empty")) {
                        echo '<script type="text/javascript">
                                document.getElementById("si_password").style.borderColor = "#aa0000";
                                document.getElementById("si_password").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("si_password").focus();
                              </script>';
                        echo '<div class="error-style" id="error_SI_PW">Please Enter Your Password</div>';
                      } elseif (strpos($fullUrl, "PWE=lenght")) {
                        echo '<script type="text/javascript">
                                document.getElementById("si_password").style.borderColor = "#aa0000";
                                document.getElementById("si_password").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("si_password").focus();
                              </script>';
                        echo '<div class="error-style" id="error_SI_PW">Please enter between 6 and 30 characters</div>';
                      } elseif (strpos($fullUrl, "PWE=invalid")) {
                        echo '<script type="text/javascript">
                                document.getElementById("si_password").style.borderColor = "#aa0000";
                                document.getElementById("si_password").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("si_password").focus();
                              </script>';
                        echo '<div class="error-style" id="error_SI_PW">Only Use alphabets, numerical, _ - . @ &</div>';
                      } elseif (strpos($fullUrl, "PWE=notexists")) {
                        echo '<script type="text/javascript">
                                document.getElementById("si_password").style.borderColor = "#aa0000";
                                document.getElementById("si_password").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("si_password").focus();
                              </script>';
                        echo '<div class="error-style" id="error_SI_PW">Password is Incorrect!</div>';
                      } elseif (strpos($fullUrl, "PWE=success")) {
                        echo '<script type="text/javascript">
                                document.getElementById("si_password").style.borderColor = "#28a745";
                                document.getElementById("si_password").style.boxShadow = "0 0 9px rgba(40, 167, 69, 0.25)";
                                document.getElementById("error_SI_PW")?.remove();
                              </script>';
                      }
                    }
                  ?>
              </div>

              <div class="form-group">
                <button
                  name="btnSignin"
                  id="btnSignin"
                  class="
                    btn
                    btn-block
                    btn-outline-dark
                    font-weight-bold
                    mt-4">Sign In</button>
              </div>

              <div class="clearfix mt-4">
                <div class="float-left">No Account Yet? <a href="signup.php">Sign Up</a></div>
                <a class="float-right" href="forgot.php">Forgot Password?</a>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>

  </div>

  <?php include 'footer.php'; ?>

  <?php require_once 'include/js_libraries.php' ?>

</body>
</html>
