<?php
  include 'include/config.php';

  session_start();
	session_destroy();
  setcookie("profile_path", "", time() - 3600);
	header("Location: signin.php");

?>
