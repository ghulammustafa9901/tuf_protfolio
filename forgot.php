<?php
  require 'include/config.php';

  if (isset($_GET['EM'])) {
    $emailShow = $_GET['EM'];
  }

  if (isset($_SESSION['is_login'])) {
    header('Location: signin.php');
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
      if(isset($_GET['EME'])) {
        if (strpos($fullUrl, "EME=notexists")) {
          echo "<div class='alert alert-warning notexists alert-dismissible fade show mt-3 mb-0' role='alert'>
                  This email doesn't exist. <a href='signup.php'>Sign up here.</a>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
              </div>
              <script type='text/javascript'>setTimeout(function() { $('.notexists').fadeOut('fast'); }, 5000);</script>";
        } elseif (strpos($fullUrl, "EME=success")) {
          echo "<div class='alert alert-success alert-dismissible fade show mt-3 mb-0' role='alert'>
                  Reset Password link sent to <b>".$_GET['EM']."</b>! Please check Your email.
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
              </div>
              <script type='text/javascript'>setTimeout(function() { $('.alert-success').fadeOut('fast'); }, 3000);</script>";
        }
      }
    ?>

    <div class="row">
      <div class="offset-md-3 col-md-6 font-weight-bold text-dark">
        <div class="card my-5">
          <div class="card-header lead font-weight-bold text-uppercase text-center">
            Forgot Your Password
            <!-- <p style="font-size: 14px;">Please enter your email address to reset password</p> -->
          </div>
          <div class="card-body">
            <p class="font-weight-normal">Enter your email address and we will send you a link to reset your password.</p>
            <form
              name="forgot"
              id="forgot"
              method="POST"
              action="action_forgot.php">

              <div class="form-group">
                <label for="text">Email</label>
                <input
                  type="text"
                  name="fg_email"
                  id="fg_email"
                  class="form-control"
                  placeholder="Email"
                  value="<?php echo @$emailShow ?>">
                  <div id="errorForgotEmail"></div>
                  <?php
                    if(isset($_GET['EME'])) {
                      if (strpos($fullUrl, "EME=empty")) {
                        echo '<script type="text/javascript">
                                document.getElementById("fg_email").style.borderColor = "#aa0000";
                                document.getElementById("fg_email").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("fg_email").focus();
                              </script>';
                        echo '<div class="error-style" id="error_FG_EM">Please Enter Your Email</div>';
                      } elseif (strpos($fullUrl, "EME=invalid")) {
                        echo '<script type="text/javascript">
                                document.getElementById("fg_email").style.borderColor = "#aa0000";
                                document.getElementById("fg_email").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("fg_email").focus();
                              </script>';
                        echo '<div class="error-style" id="error_FG_EM">Please Enter Your Valid Email</div>';
                      } elseif (strpos($fullUrl, "EME=notexists")) {
                        echo '<script type="text/javascript">
                                document.getElementById("fg_email").style.borderColor = "#aa0000";
                                document.getElementById("fg_email").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("fg_email").focus();
                              </script>';
                        echo '<div class="error-style" id="error_FG_EM">Email Not Exists!</div>';
                      } elseif (strpos($fullUrl, "EME=success")) {
                        echo '<script type="text/javascript">
                                document.getElementById("fg_email").style.borderColor = "#28a745";
                                document.getElementById("fg_email").style.boxShadow = "0 0 9px rgba(40, 167, 69, 0.25)";
                                document.getElementById("error_FG_EM")?.remove();
                              </script>';
                      }
                    }
                  ?>
              </div>

              <div class="form-group">
                <button
                  name="btnResetPassword"
                  id="btnResetPassword"
                  class="
                    btn
                    btn-block
                    btn-outline-dark
                    font-weight-bold
                    mt-4">Reset Password</button>
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
