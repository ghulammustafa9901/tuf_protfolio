<?php
  require 'include/config.php';

  if (isset($_SESSION['is_login'])) {
    header('Location: dashboard.php');
  }

  //Get Value From URL
  if (isset($_GET['FN'])) {
    $fullnameShow = $_GET['FN'];
  }

  if (isset($_GET['UN'])) {
    $usernameShow = $_GET['UN'];
  }

  if (isset($_GET['EM'])) {
    $emailShow = $_GET['EM'];
  }

  if (isset($_GET['PW'])) {
    $passwordShow = $_GET['PW'];
  }

  if (isset($_GET['CPW'])) {
    $confrimPasswordConfirm = $_GET['CPW'];
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
        echo "<div class='alert alert-danger alert-dismissible fade show mt-3 mb-0' role='alert'>
                We've just sent a verification link to <strong>".$_GET['email']."</strong>. Please check your inbox and click on the link to get started.
                <!-- If you can't find this email (which could be due to spam filters), just request a new one here. -->
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <script type='text/javascript'>setTimeout(function() { $('.alert-danger').fadeOut('fast'); }, 5000);</script>";
      }
    ?>

    <div class="row">
      <div class="offset-md-3 col-md-6 font-weight-bold text-dark">
        <div class="card my-5">
          <div class="card-header lead font-weight-bold text-uppercase text-center">
            Sign Up
          </div>
          <div class="card-body">
            <form
              name="sigup"
              id="signup"
              method="POST"
              action="action_signup.php"
              onsubmit="return SignUpValidation()">
              <div class="form-group">
                <label for="text">Fullname</label>
                <input
                  type="text"
                  name="su_fullname"
                  id="su_fullname"
                  class="form-control"
                  placeholder="Fullname"
                  value="<?php echo @$fullnameShow ?>">
                  <div id="errorSignupFullname"></div>
                  <?php
                    if(isset($_GET['FNE'])) {
                      if (strpos($fullUrl, "FNE=empty")) {
                        echo '<script type="text/javascript">
                                document.getElementById("su_fullname").style.borderColor = "#aa0000";
                                document.getElementById("su_fullname").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("su_fullname").focus();
                              </script>';
                        echo '<div class="error-style" id="error_SU_FN">Please Enter Your Name</div>';
                      } elseif (strpos($fullUrl, "FNE=lenght")) {
                        echo '<script type="text/javascript">
                                document.getElementById("su_fullname").style.borderColor = "#aa0000";
                                document.getElementById("su_fullname").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("su_fullname").focus();
                              </script>';
                        echo '<div class="error-style" id="error_SU_FN">Please enter between 2 and 30 characters</div>';
                      } elseif (strpos($fullUrl, "FNE=invalid")) {
                        echo '<script type="text/javascript">
                                document.getElementById("su_fullname").style.borderColor = "#aa0000";
                                document.getElementById("su_fullname").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("su_fullname").focus();
                              </script>';
                        echo '<div class="error-style" id="error_SU_FN">Please use alphabets only</div>';
                      } elseif (strpos($fullUrl, "FNE=success")) {
                        echo '<script type="text/javascript">
                                document.getElementById("su_fullname").style.borderColor = "#28a745";
                                document.getElementById("su_fullname").style.boxShadow = "0 0 9px rgba(40, 167, 69, 0.25)";
                                document.getElementById("error_SU_FN")?.remove();
                              </script>';
                      }
                    }
                  ?>
              </div>

              <div class="form-group">
                <label for="text">Username</label>
                <input
                  type="text"
                  name="su_username"
                  id="su_username"
                  class="form-control"
                  placeholder="Username"
                  value="<?php echo @$usernameShow ?>">
                  <div id="errorSignupUsername"></div>
                  <?php
                    if(isset($_GET['UNE'])) {
                      if (strpos($fullUrl, "UNE=empty")) {
                        echo '<script type="text/javascript">
                                document.getElementById("su_username").style.borderColor = "#aa0000";
                                document.getElementById("su_username").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("su_username").focus();
                              </script>';
                        echo '<div class="error-style" id="error_SU_UN">Please Enter Your Userame</div>';
                      } elseif (strpos($fullUrl, "UNE=lenght")) {
                        echo '<script type="text/javascript">
                                document.getElementById("su_username").style.borderColor = "#aa0000";
                                document.getElementById("su_username").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("su_username").focus();
                              </script>';
                        echo '<div class="error-style" id="error_SU_UN">Please enter between 6 and 30 characters</div>';
                      } elseif (strpos($fullUrl, "UNE=invalid")) {
                        echo '<script type="text/javascript">
                                document.getElementById("su_username").style.borderColor = "#aa0000";
                                document.getElementById("su_username").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("su_username").focus();
                              </script>';
                        echo '<div class="error-style" id="error_SU_UN">Only Use alphabets, numerical, _ . </div>';
                      } elseif (strpos($fullUrl, "UNE=exists")) {
                        echo '<script type="text/javascript">
                                document.getElementById("su_username").style.borderColor = "#aa0000";
                                document.getElementById("su_username").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("su_username").focus();
                              </script>';
                        echo '<div class="error-style" id="error_SU_UN">Username Already Exists!</div>';
                      } elseif (strpos($fullUrl, "UNE=success")) {
                        echo '<script type="text/javascript">
                                document.getElementById("su_username").style.borderColor = "#28a745";
                                document.getElementById("su_username").style.boxShadow = "0 0 9px rgba(40, 167, 69, 0.25)";
                                document.getElementById("error_SU_UN")?.remove();
                              </script>';
                      }
                    }
                  ?>
              </div>

              <div class="form-group">
                <label for="text">Email</label>
                <input
                  type="text"
                  name="su_email"
                  id="su_email"
                  class="form-control"
                  placeholder="Email"
                  value="<?php echo @$emailShow ?>">
                  <div id="errorSignupEmail"></div>
                  <?php
                    if(isset($_GET['EME'])) {
                      if (strpos($fullUrl, "EME=empty")) {
                        echo '<script type="text/javascript">
                                document.getElementById("su_email").style.borderColor = "#aa0000";
                                document.getElementById("su_email").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("su_email").focus();
                              </script>';
                        echo '<div class="error-style" id="error_SU_EM">Please Enter Your Email</div>';
                      } elseif (strpos($fullUrl, "EME=invalid")) {
                        echo '<script type="text/javascript">
                                document.getElementById("su_email").style.borderColor = "#aa0000";
                                document.getElementById("su_email").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("su_email").focus();
                              </script>';
                        echo '<div class="error-style" id="error_SU_EM">Please Enter Your Valid Email</div>';
                      } elseif (strpos($fullUrl, "EME=exists")) {
                        echo '<script type="text/javascript">
                                document.getElementById("su_email").style.borderColor = "#aa0000";
                                document.getElementById("su_email").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("su_email").focus();
                              </script>';
                        echo '<div class="error-style" id="error_SU_EM">Email Already Exists!</div>';
                      } elseif (strpos($fullUrl, "EME=success")) {
                        echo '<script type="text/javascript">
                                document.getElementById("su_email").style.borderColor = "#28a745";
                                document.getElementById("su_email").style.boxShadow = "0 0 9px rgba(40, 167, 69, 0.25)";
                                document.getElementById("error_SU_EM")?.remove();
                              </script>';
                      }
                    }
                  ?>
              </div>

              <div class="form-group form-group-show-PWD">
                <label for="text">Password</label>
                <input
                  type="password"
                  name="su_password"
                  id="su_password"
                  class="form-control"
                  placeholder="Password"
                  value="<?php // echo @$passwordShow ?>">
                  <span class="showPWDIcon">
                    <i class="fas fa-eye" id="SH_SU_PWD_Icon" onclick="SH_SU_PWD()" data-toggle="tooltip" data-placement="bottom" title="Hide Password"></i>
                  </span>
                  <div id="errorSignupPassword"></div>
                  <?php
                    if(isset($_GET['PWE'])) {
                      if (strpos($fullUrl, "PWE=empty")) {
                        echo '<script type="text/javascript">
                                document.getElementById("su_password").style.borderColor = "#aa0000";
                                document.getElementById("su_password").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("su_password").focus();
                              </script>';
                        echo '<div class="error-style" id="error_SU_PW">Please Enter Your Password</div>';
                      } elseif (strpos($fullUrl, "PWE=lenght")) {
                        echo '<script type="text/javascript">
                                document.getElementById("su_password").style.borderColor = "#aa0000";
                                document.getElementById("su_password").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("su_password").focus();
                              </script>';
                        echo '<div class="error-style" id="error_SU_PW">Please enter between 6 and 30 characters</div>';
                      } elseif (strpos($fullUrl, "PWE=invalid")) {
                        echo '<script type="text/javascript">
                                document.getElementById("su_password").style.borderColor = "#aa0000";
                                document.getElementById("su_password").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("su_password").focus();
                              </script>';
                        echo '<div class="error-style" id="error_SU_PW">Only Use alphabets, numerical, _ - . @ &</div>';
                      } elseif (strpos($fullUrl, "PWE=success")) {
                        echo '<script type="text/javascript">
                                document.getElementById("su_password").style.borderColor = "#28a745";
                                document.getElementById("su_password").style.boxShadow = "0 0 9px rgba(40, 167, 69, 0.25)";
                                document.getElementById("error_SU_PW")?.remove();
                              </script>';
                      }
                    }
                  ?>
              </div>

              <div class="form-group form-group-show-PWD">
                <label for="text">Confirm Password</label>
                <input
                  type="password"
                  name="su_confirmPassword"
                  id="su_confirmPassword"
                  class="form-control"
                  placeholder="Confirm Password"
                  value="<?php //echo @$confirmPasswordShow ?>">
                  <span class="showPWDIcon">
                    <i class="fas fa-eye" id="SH_SU_CPWD_Icon" onclick="SH_SU_CPWD()" data-toggle="tooltip" data-placement="bottom" title="Hide Password"></i>
                  </span>
                  <div id="errorSignupConfirmPassword"></div>
                  <?php
                    if(isset($_GET['PWCE'])) {
                      if (strpos($fullUrl, "PWCE=empty")) {
                        echo '<script type="text/javascript">
                                document.getElementById("su_confirmPassword").style.borderColor = "#aa0000";
                                document.getElementById("su_confirmPassword").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("su_confirmPassword").focus();
                              </script>';
                        echo '<div class="error-style" id="error_SU_CPW">Please Enter Your Confirm Password</div>';
                      } elseif (strpos($fullUrl, "PWCE=lenght")) {
                        echo '<script type="text/javascript">
                                document.getElementById("su_confirmPassword").style.borderColor = "#aa0000";
                                document.getElementById("su_confirmPassword").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("su_confirmPassword").focus();
                              </script>';
                        echo '<div class="error-style" id="error_SU_CPW">Please enter between 6 and 30 characters</div>';
                      } elseif (strpos($fullUrl, "PWCE=incorrect")) {
                        echo '<script type="text/javascript">
                                document.getElementById("su_confirmPassword").style.borderColor = "#aa0000";
                                document.getElementById("su_confirmPassword").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("su_confirmPassword").focus();
                              </script>';
                        echo '<div class="error-style" id="error_SU_CPW">Your Password is not Correct</div>';
                      } elseif (strpos($fullUrl, "PWCE=success")) {
                        echo '<script type="text/javascript">
                                document.getElementById("su_confirmPassword").style.borderColor = "#28a745";
                                document.getElementById("su_confirmPassword").style.boxShadow = "0 0 9px rgba(40, 167, 69, 0.25)";
                                document.getElementById("error_SU_CPW")?.remove();
                              </script>';
                      }
                    }
                  ?>
              </div>

              <div class="form-group">
                <button
                  name="btnSignup"
                  id="btnSignup"
                  class="
                    btn
                    btn-block
                    btn-outline-dark
                    font-weight-bold
                    mt-4">Sign Up</button>
              </div>

              <div class="mt-4">
                Already have an account? <a href="signin.php">Sign In</a>
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
