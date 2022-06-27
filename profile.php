<?php
  require 'include/config.php';
  require 'include/countrynamelist.php';

  if (!isset($_SESSION['is_login'])) {
    header('Location: signin.php');
  }

  //Get Value From URL
  if (isset($_GET['FN'])) {
    $fullnameShow = $_GET['FN'];
  } else {
    $fullnameShow = $_SESSION['fullname'];
  }

  if (isset($_GET['UN'])) {
    $usernameShow = $_GET['UN'];
  } else {
    $usernameShow = $_SESSION['username'];
  }

  if (isset($_GET['EM'])) {
    $emailShow = $_GET['EM'];
  } else {
    $emailShow = $_SESSION['email'];
  }

  if (isset($_GET['PN'])) {
    $phonenumberShow = $_GET['PN'];
  } else {
    $phonenumberShow = @$_SESSION['phonenumber'];
  }

  if (isset($_GET['ADDR'])) {
    $addressShow = $_GET['ADDR'];
  } else {
    $addressShow = @$_SESSION['address'];
  }

  if (isset($_GET['GD'])) {
    $genderShow = $_GET['GD'];
  } else {
    $genderShow = @$_SESSION['gender'];
  }

  if (isset($_GET['CO'])) {
    $countryShow = $_GET['CO'];
  } else {
    $countryShow = @$_SESSION['country'];
  }

  if(isset($_SESSION['profile'])) { 
      $profileShow = $_SESSION['profile']; 
  } else { 
      $profileShow = 'assets/img/empty_profile.png';
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
      if(isset($_GET['updateSuccess'])) {
        echo "<div class='alert alert-success alert-dismissible fade show mt-3 mb-0' role='alert'>
              Your Profile Successfully Update!
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
          <div class="card-header lead font-weight-bold text-center">
            Edit Profile
          </div>
          <div class="card-body">
            <form
              name="sigup"
              id="signup"
              method="POST"
              action="action_editprofile.php">

              <div class="profile_pic_div">
                <img src="<?php echo @$profileShow ?>" name="hiby" id="profile_show" width="150" height="150"  alt="Profile Pic">
                <input type="file" id="input_profile" name="profile_img" style="display: none;">
                <label for="input_profile" class="label_profile">
                    <i class = "fa fa-camera"></i>    
                    Update
                </label>
              </div>
              <div class="error-style" id="error_EP_IMG"></div>

              <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modalLabel">Upload Profile Picture</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="img-container">
                        <div class="row">
                            <div class="col-md-8">  
                              <!--  default image where we will set the src via jquery-->
                              <img id="model_img">
                            </div>
                            <div class="col-md-4">
                              <div class="preview"></div>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                      <button type="button" class="btn btn-primary" id="upload">Upload</button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="text">Fullname</label>
                <input
                  type="text"
                  name="ep_fullname"
                  id="ep_fullname"
                  class="form-control"
                  placeholder="Fullname"
                  value="<?php echo @$fullnameShow ?>">
                  <div id="errorEditprofileFullname"></div>
                  <?php
                    if(isset($_GET['FNE'])) {
                      if (strpos($fullUrl, "FNE=empty")) {
                        echo '<script type="text/javascript">
                                document.getElementById("ep_fullname").style.borderColor = "#aa0000";
                                document.getElementById("ep_fullname").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("ep_fullname").focus();
                              </script>';
                        echo '<div class="error-style" id="error_EP_FN">Please Enter Your Name</div>';
                      } elseif (strpos($fullUrl, "FNE=lenght")) {
                        echo '<script type="text/javascript">
                                document.getElementById("ep_fullname").style.borderColor = "#aa0000";
                                document.getElementById("ep_fullname").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("ep_fullname").focus();
                              </script>';
                        echo '<div class="error-style" id="error_EP_FN">Please enter between 2 and 30 characters</div>';
                      } elseif (strpos($fullUrl, "FNE=invalid")) {
                        echo '<script type="text/javascript">
                                document.getElementById("ep_fullname").style.borderColor = "#aa0000";
                                document.getElementById("ep_fullname").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("ep_fullname").focus();
                              </script>';
                        echo '<div class="error-style" id="error_EP_FN">Please use alphabets only</div>';
                      } elseif (strpos($fullUrl, "FNE=success")) {
                        echo '<script type="text/javascript">
                                document.getElementById("ep_fullname").style.borderColor = "#28a745";
                                document.getElementById("ep_fullname").style.boxShadow = "0 0 9px rgba(40, 167, 69, 0.25)";
                                document.getElementById("error_EP_FN")?.remove();
                              </script>';
                      }
                    }
                  ?>
              </div>

              <div class="form-group">
                <label for="text">Username</label>
                <input
                  type="text"
                  name="ep_username"
                  id="ep_username"
                  class="form-control"
                  placeholder="Username"
                  value="<?php echo @$usernameShow ?>">
                  <div id="errorEditprofileUsername"></div>
                  <?php
                    if(isset($_GET['UNE'])) {
                      if (strpos($fullUrl, "UNE=empty")) {
                        echo '<script type="text/javascript">
                                document.getElementById("ep_username").style.borderColor = "#aa0000";
                                document.getElementById("ep_username").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("ep_username").focus();
                              </script>';
                        echo '<div class="error-style" id="error_EP_UN">Please Enter Your Userame</div>';
                      } elseif (strpos($fullUrl, "UNE=lenght")) {
                        echo '<script type="text/javascript">
                                document.getElementById("ep_username").style.borderColor = "#aa0000";
                                document.getElementById("ep_username").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("ep_username").focus();
                              </script>';
                        echo '<div class="error-style" id="error_EP_UN">Please enter between 6 and 30 characters</div>';
                      } elseif (strpos($fullUrl, "UNE=invalid")) {
                        echo '<script type="text/javascript">
                                document.getElementById("ep_username").style.borderColor = "#aa0000";
                                document.getElementById("ep_username").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("ep_username").focus();
                              </script>';
                        echo '<div class="error-style" id="error_EP_UN">Only Use alphabets, numerical, _ . </div>';
                      } elseif (strpos($fullUrl, "UNE=exists")) {
                        echo '<script type="text/javascript">
                                document.getElementById("ep_username").style.borderColor = "#aa0000";
                                document.getElementById("ep_username").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("ep_username").focus();
                              </script>';
                        echo '<div class="error-style" id="error_EP_UN">Username Already Exists!</div>';
                      } elseif (strpos($fullUrl, "UNE=success")) {
                        echo '<script type="text/javascript">
                                document.getElementById("ep_username").style.borderColor = "#28a745";
                                document.getElementById("ep_username").style.boxShadow = "0 0 9px rgba(40, 167, 69, 0.25)";
                                document.getElementById("error_EP_UN")?.remove();
                              </script>';
                      }
                    }
                  ?>
              </div>

              <div class="form-group">
                <label for="text">Email</label>
                <input
                  type="text"
                  name="ep_email"
                  id="ep_email"
                  class="form-control"
                  placeholder="Email"
                  value="<?php echo @$emailShow ?>">
                  <div id="errorEditprofileEmail"></div>
                  <?php
                    if(isset($_GET['EME'])) {
                      if (strpos($fullUrl, "EME=empty")) {
                        echo '<script type="text/javascript">
                                document.getElementById("ep_email").style.borderColor = "#aa0000";
                                document.getElementById("ep_email").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("ep_email").focus();
                              </script>';
                        echo '<div class="error-style" id="error_EP_EM">Please Enter Your Email</div>';
                      } elseif (strpos($fullUrl, "EME=invalid")) {
                        echo '<script type="text/javascript">
                                document.getElementById("ep_email").style.borderColor = "#aa0000";
                                document.getElementById("ep_email").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("ep_email").focus();
                              </script>';
                        echo '<div class="error-style" id="error_EP_EM">Please Enter Your Valid Email</div>';
                      } elseif (strpos($fullUrl, "EME=exists")) {
                        echo '<script type="text/javascript">
                                document.getElementById("ep_email").style.borderColor = "#aa0000";
                                document.getElementById("ep_email").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("ep_email").focus();
                              </script>';
                        echo '<div class="error-style" id="error_EP_EM">Email Already Exists!</div>';
                      } elseif (strpos($fullUrl, "EME=success")) {
                        echo '<script type="text/javascript">
                                document.getElementById("ep_email").style.borderColor = "#28a745";
                                document.getElementById("ep_email").style.boxShadow = "0 0 9px rgba(40, 167, 69, 0.25)";
                                document.getElementById("error_EP_EM")?.remove();
                              </script>';
                      }
                    }
                  ?>
              </div>

              <div class="form-group">
                <label for="text">Phone Number</label>
                <input
                  type="text"
                  name="ep_phonenumber"
                  id="ep_phonenumber"
                  class="form-control"
                  placeholder="Phone Number with Country Code"
                  value="<?php echo @$phonenumberShow ?>">
                  <div id="errorEditprofilePhoneNumber"></div>
                  <?php
                    if(isset($_GET['PNE'])) {
                      if (strpos($fullUrl, "PNE=empty")) {
                        echo '<script type="text/javascript">
                                document.getElementById("ep_phonenumber").style.borderColor = "#aa0000";
                                document.getElementById("ep_phonenumber").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("ep_phonenumber").focus();
                              </script>';
                        echo '<div class="error-style" id="error_EP_PN">Please Enter Your Phone Number</div>';
                      } elseif (strpos($fullUrl, "PNE=lenght")) {
                        echo '<script type="text/javascript">
                                document.getElementById("ep_phonenumber").style.borderColor = "#aa0000";
                                document.getElementById("ep_phonenumber").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("ep_phonenumber").focus();
                              </script>';
                        echo '<div class="error-style" id="error_EP_PN">Please enter between 11 and 14 characters</div>';
                      } elseif (strpos($fullUrl, "PNE=invalid")) {
                        echo '<script type="text/javascript">
                                document.getElementById("ep_phonenumber").style.borderColor = "#aa0000";
                                document.getElementById("ep_phonenumber").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("ep_phonenumber").focus();
                              </script>';
                        echo '<div class="error-style" id="error_EP_PN">Please use numerics only</div>';
                      } elseif (strpos($fullUrl, "PNE=exists")) {
                        echo '<script type="text/javascript">
                                document.getElementById("ep_phonenumber").style.borderColor = "#aa0000";
                                document.getElementById("ep_phonenumber").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("ep_phonenumber").focus();
                              </script>';
                        echo '<div class="error-style" id="error_EP_PN">Phone Number Already Exists!</div>';
                      } elseif (strpos($fullUrl, "PNE=success")) {
                        echo '<script type="text/javascript">
                                document.getElementById("ep_phonenumber").style.borderColor = "#28a745";
                                document.getElementById("ep_phonenumber").style.boxShadow = "0 0 9px rgba(40, 167, 69, 0.25)";
                                document.getElementById("error_EP_PN")?.remove();
                              </script>';
                      }
                    }
                  ?>
              </div>

              <div class="form-group">
                <label for="text">Address</label>
                <input
                  type="text"
                  name="ep_address"
                  id="ep_address"
                  class="form-control"
                  placeholder="Address"
                  value="<?php echo @$addressShow ?>">
                  <div id="errorEditprofileAddress"></div>
                  <?php
                    if(isset($_GET['ADDRE'])) {
                      if (strpos($fullUrl, "ADDRE=empty")) {
                        echo '<script type="text/javascript">
                                document.getElementById("ep_address").style.borderColor = "#aa0000";
                                document.getElementById("ep_address").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("ep_address").focus();
                              </script>';
                        echo '<div class="error-style" id="error_EP_ADDR">Please Enter Your Address</div>';
                      } elseif (strpos($fullUrl, "ADDRE=lenght")) {
                        echo '<script type="text/javascript">
                                document.getElementById("ep_address").style.borderColor = "#aa0000";
                                document.getElementById("ep_address").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("ep_address").focus();
                              </script>';
                        echo '<div class="error-style" id="error_EP_ADDR">Please enter between 10 and 80 characters</div>';
                      } elseif (strpos($fullUrl, "ADDRE=invalid")) {
                        echo '<script type="text/javascript">
                                document.getElementById("ep_address").style.borderColor = "#aa0000";
                                document.getElementById("ep_address").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                                document.getElementById("ep_address").focus();
                              </script>';
                        echo '<div class="error-style" id="error_EP_ADDR">Only Use alphabets, numerical, Comma, _ - .</div>';
                      } elseif (strpos($fullUrl, "ADDRE=success")) {
                        echo '<script type="text/javascript">
                                document.getElementById("ep_address").style.borderColor = "#28a745";
                                document.getElementById("ep_address").style.boxShadow = "0 0 9px rgba(40, 167, 69, 0.25)";
                                document.getElementById("error_EP_ADDR")?.remove();
                              </script>';
                      }
                    }
                  ?>
              </div>

              <div class="form-group">
                <label for="text">Country</label>
                <select name="country" id="country" class="custom-select">
                  <option value="" disabled selected>Select your country</option>
                  <?php  foreach ($countryName as $value) {  ?>
                      <option value="<?php echo $value ?>" 
                      <?php if($countryShow == $value) { ?> 
                        selected="<?php echo @$countryShow ?>" <?php } ?>><?php echo $value ?></option>
                    <?php  }  ?>
                </select>
                <div id="errorEditprofileCountry"></div>
                <?php
                  if(isset($_GET['PNE'])) {
                    if (strpos($fullUrl, "CE=empty")) {
                      echo '<script type="text/javascript">
                              document.getElementById("country").style.borderColor = "#aa0000";
                              document.getElementById("country").style.boxShadow = "0 0 9px rgba(170, 0, 0, 0.25)";
                              document.getElementById("country").focus();
                            </script>';
                      echo '<div class="error-style" id="error_EP_C">Please Select Your Country</div>';
                    } elseif (strpos($fullUrl, "CE=success")) {
                      echo '<script type="text/javascript">
                              document.getElementById("country").style.borderColor = "#28a745";
                              document.getElementById("country").style.boxShadow = "0 0 9px rgba(40, 167, 69, 0.25)";
                              document.getElementById("error_EP_C")?.remove();
                            </script>';
                    }
                  }
                ?>
              </div>

              <div class="form-group">
                <label for="text">Gender</label><br>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="male" value="male" <?php if($genderShow == "male") { ?> checked <?php } ?>>
                  <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="female" value="female" <?php if($genderShow == "female") { ?> checked <?php } ?>>
                  <label class="form-check-label" for="female">Female</label>
                </div>
                <?php
                  if(isset($_GET['GDE'])) {
                    if (strpos($fullUrl, "GDE=empty")) {
                      echo '<script type="text/javascript">
                              document.getElementById("country").focus();
                            </script>';
                      echo '<div class="error-style" id="error_EP_GD">Select Your Gender</div>';
                    } elseif (strpos($fullUrl, "GDE=success")) {
                      echo '<script type="text/javascript">
                              document.getElementById("error_EP_GD")?.remove();
                            </script>';
                    }
                  }
                ?>
              </div>

              <div class="form-group">
                <button
                  name="btnUpdate"
                  id="btnUpdate"
                  class="
                    btn
                    btn-block
                    btn-outline-dark
                    font-weight-bold
                    mt-4">Update</button>
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
