<?php
  require 'include/config.php';

  if (!isset($_SESSION['is_login'])) {
    header('Location: signin.php');
  }

  if (isset($_GET['CPW'])) {
    $currentPasswordShow = $_GET['CPW'];
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
    
    <div class="row">
      <div class="offset-lg-3 col-lg-6 col-md-12 font-weight-bold text-dark">
        <div class="card my-5">
          <div class="card-header lead font-weight-bold text-uppercase text-center">
            Change Password
          </div>
          <div class="card-body">
            <form
              name="newpassword"
              id="newpassword"
              method="POST"
              action="action_changepassword.php">

              <div class="form-group form-group-show-PWD">
                <label for="text">Current Password</label>
                <input
                  type="password"
                  name="current_password"
                  id="current_password"
                  class="form-control"
                  placeholder="Current Password"
                  value="<?php echo @$currentPasswordShow ?>">
                  <span class="showPWDIcon">
                    <i class="fas fa-eye" id="SH_CURRENT_PWD_Icon" onclick="SH_CURRENT_PWD()" data-toggle="tooltip" data-placement="bottom" title="Hide Password"></i>
                  </span>
                  <div id="errorCurrentPassword"></div>
                  <?php
                    if(isset($_GET['CPWE'])) {
                      if (strpos($fullUrl, "CPWE=empty")) {
                        echo '<script type="text/javascript">
                                document.getElementById("current_password").style.borderColor = "#aa0000";
                                document.getElementById("current_password").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("current_password").focus();
                              </script>';
                        echo '<div class="error-style" id="error_CURRENT_PW">Please Enter Your Current Password</div>';
                      } elseif (strpos($fullUrl, "CPWE=lenght")) {
                        echo '<script type="text/javascript">
                                document.getElementById("current_password").style.borderColor = "#aa0000";
                                document.getElementById("current_password").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("current_password").focus();
                              </script>';
                        echo '<div class="error-style" id="error_CURRENT_PW">Please enter between 6 and 30 characters</div>';
                      } elseif (strpos($fullUrl, "CPWE=invalid")) {
                        echo '<script type="text/javascript">
                                document.getElementById("current_password").style.borderColor = "#aa0000";
                                document.getElementById("current_password").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("current_password").focus();
                              </script>';
                        echo '<div class="error-style" id="error_CURRENT_PW">Only Use alphabets, numerical, _ - . @ &</div>';
                      } elseif (strpos($fullUrl, "CPWE=notmatch")) {
                        echo '<script type="text/javascript">
                                document.getElementById("current_password").style.borderColor = "#aa0000";
                                document.getElementById("current_password").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("current_password").focus();
                              </script>';
                        echo '<div class="error-style" id="error_CURRENT_PW">Your current password does not match with the password you provided.</div>';
                      } elseif (strpos($fullUrl, "CPWE=success")) {
                        echo '<script type="text/javascript">
                                document.getElementById("current_password").style.borderColor = "#28a745";
                                document.getElementById("current_password").style.boxShadow = "0 0 9px rgba(40, 167, 69, 0.25)";
                                document.getElementById("error_CURRENT_PW")?.remove();
                              </script>';
                      }
                    }
                  ?>
              </div>

              <div class="form-group form-group-show-PWD">
                <label for="text">New Password</label>
                <input
                  type="password"
                  name="new_password"
                  id="new_password"
                  class="form-control"
                  placeholder="Password"
                  value="<?php echo @$passwordShow ?>">
                  <span class="showPWDIcon">
                    <i class="fas fa-eye" id="SH_NEW_PWD_Icon" onclick="SH_NEW_PWD()" data-toggle="tooltip" data-placement="bottom" title="Hide Password"></i>
                  </span>
                  <div id="errorNewPassword"></div>
                  <?php
                    if(isset($_GET['PWE'])) {
                      if (strpos($fullUrl, "PWE=empty")) {
                        echo '<script type="text/javascript">
                                document.getElementById("new_password").style.borderColor = "#aa0000";
                                document.getElementById("new_password").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("new_password").focus();
                              </script>';
                        echo '<div class="error-style" id="error_NEW_PW">Please Enter Your Password</div>';
                      } elseif (strpos($fullUrl, "PWE=lenght")) {
                        echo '<script type="text/javascript">
                                document.getElementById("new_password").style.borderColor = "#aa0000";
                                document.getElementById("new_password").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("new_password").focus();
                              </script>';
                        echo '<div class="error-style" id="error_NEW_PW">Please enter between 6 and 30 characters</div>';
                      } elseif (strpos($fullUrl, "PWE=invalid")) {
                        echo '<script type="text/javascript">
                                document.getElementById("new_password").style.borderColor = "#aa0000";
                                document.getElementById("new_password").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("new_password").focus();
                              </script>';
                        echo '<div class="error-style" id="error_NEW_PW">Only Use alphabets, numerical, _ - . @ &</div>';
                      } elseif (strpos($fullUrl, "PWE=same")) {
                        echo '<script type="text/javascript">
                                document.getElementById("new_password").style.borderColor = "#aa0000";
                                document.getElementById("new_password").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("new_password").focus();
                              </script>';
                        echo '<div class="error-style" id="error_NEW_PW">Create a new password that is not your current password.</div>';
                      } elseif (strpos($fullUrl, "PWE=success")) {
                        echo '<script type="text/javascript">
                                document.getElementById("new_password").style.borderColor = "#28a745";
                                document.getElementById("new_password").style.boxShadow = "0 0 9px rgba(40, 167, 69, 0.25)";
                                document.getElementById("error_NEW_PW")?.remove();
                              </script>';
                      }
                    }
                  ?>
              </div>

              <div class="form-group form-group-show-PWD">
                <label for="text">Confirm Password</label>
                <input
                  type="password"
                  name="new_confirmPassword"
                  id="new_confirmPassword"
                  class="form-control"
                  placeholder="Confirm Password"
                  value="<?php //echo @$confirmPasswordShow ?>">
                  <span class="showPWDIcon">
                    <i class="fas fa-eye" id="SH_NEW_CPWD_Icon" onclick="SH_NEW_CPWD()" data-toggle="tooltip" data-placement="bottom" title="Hide Password"></i>
                  </span>
                  <div id="errorNewConfirmPassword"></div>
                  <?php
                    if(isset($_GET['PWCE'])) {
                      if (strpos($fullUrl, "PWCE=empty")) {
                        echo '<script type="text/javascript">
                                document.getElementById("new_confirmPassword").style.borderColor = "#aa0000";
                                document.getElementById("new_confirmPassword").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("new_confirmPassword").focus();
                              </script>';
                        echo '<div class="error-style" id="error_NEW_CPW">Please Enter Your Confirm Password</div>';
                      } elseif (strpos($fullUrl, "PWCE=lenght")) {
                        echo '<script type="text/javascript">
                                document.getElementById("new_confirmPassword").style.borderColor = "#aa0000";
                                document.getElementById("new_confirmPassword").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("new_confirmPassword").focus();
                              </script>';
                        echo '<div class="error-style" id="error_NEW_CPW">Please enter between 6 and 30 characters</div>';
                      } elseif (strpos($fullUrl, "PWCE=incorrect")) {
                        echo '<script type="text/javascript">
                                document.getElementById("new_confirmPassword").style.borderColor = "#aa0000";
                                document.getElementById("new_confirmPassword").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("new_confirmPassword").focus();
                              </script>';
                        echo '<div class="error-style" id="error_NEW_CPW">Your Password is not Correct</div>';
                      } elseif (strpos($fullUrl, "PWCE=success")) {
                        echo '<script type="text/javascript">
                                document.getElementById("new_confirmPassword").style.borderColor = "#28a745";
                                document.getElementById("new_confirmPassword").style.boxShadow = "0 0 9px rgba(40, 167, 69, 0.25)";
                                document.getElementById("error_NEW_CPW")?.remove();
                              </script>';
                      }
                    }
                  ?>
              </div>

              <div class="form-group">
                <button
                  name="btnChangePassword"
                  id="btnChangePassword"
                  class="
                    btn
                    btn-block
                    btn-outline-dark
                    font-weight-bold
                    mt-4">Set Password</button>
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
