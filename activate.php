<?php

  require 'include/config.php';

  if(isset($_GET['token'])) {
    $tokenURL = $_GET['token'];

    $queryCheckStatus = "SELECT status FROM users WHERE token='$tokenURL'";
    $checkStatusFire = mysqli_query($con, $queryCheckStatus);

    $statusValueArray = mysqli_fetch_assoc($checkStatusFire);
    $statusValue = $statusValueArray['status'];

    $queryUsername = "SELECT username FROM users WHERE token='$tokenURL'";
    $usernameFire = mysqli_query($con, $queryUsername);

    $usernameArray = mysqli_fetch_assoc($usernameFire);
    $username = $usernameArray['username'];

    if($statusValue == 0) {
      $queryUpdateStatus = "UPDATE users SET status='1' WHERE token='$tokenURL'";
      $updateStatusFire = mysqli_query($con, $queryUpdateStatus);

      if($updateStatusFire) {
        $_SESSION['activateStatus'] = true;
        header("Location: signin.php?UN=$username&activate=true");
      }

    } else {
      header("Location: signin.php?UN=$username&activate=already");
    }


  }

?>
