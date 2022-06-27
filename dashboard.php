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

  <div class="container for_footer">
    <h2 class="text-center my-5 py-5">
      Asslam-o-Alaikum <?php echo @$_SESSION['fullname'] ?>
    </h2>
  </div>
  
  <?php include 'footer.php'; ?>

  <?php require_once 'include/js_libraries.php' ?>

</body>
</html>
