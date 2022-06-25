<?php
  require 'include/config.php';
  if (!isset($_SESSION['is_login'])) {
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

  <h2 class="text-center mt-5">
    HELLO <?php echo @$_SESSION['username'] ?>
  </h2>
  
  <div>
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="">
            Edit Profile
          </div>
        </div>
      </div>
    </div>
  </div>

  

  <?php require_once 'include/js_libraries.php' ?>

</body>
</html>
