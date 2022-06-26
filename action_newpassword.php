<?php
	require 'include/config.php';
	include 'include/mailer.php';

	if(isset($_POST['btnNewPassord'])) {

    	$token = $_REQUEST['token'];
    	$email = $_REQUEST['email'];
		$password = mysqli_real_escape_string($con, trim($_POST['new_password']));
		$confirmPassword = mysqli_real_escape_string($con, trim($_POST['new_confirmPassword']));

		// For Password Validation
		if(!empty($password)) {
			if(strlen($password) >= 6 && strlen($password) <= 30) {
				if(!preg_match('/[^a-zA-Z\d_.@&-]/', $password)) {
					header("Location: newpassword.php?email=$email&token=$token&PW=$password&PWE=success");
				} else {
					// Invalid character
					header("Location: newpassword.php?email=$email&token=$token&PWE=invalid");
					Exists();
				}
			} else {
				// Invalid Length
				header("Location: newpassword.php?email=$email&token=$token&PWE=lenght");
				Exists();
			}
		} else {
			// Bank Input
			header("Location: newpassword.php?email=$email&token=$token&PWE=empty");
			Exists();
		}

		// For Confirm Password Validation
		if(!empty($confirmPassword)) {
			if(strlen($confirmPassword) >= 6 && strlen($confirmPassword) <= 30) {
				if($password == $confirmPassword) {

          			$querySetPassword = "UPDATE users SET password='$password' WHERE email='$email' AND token='$token'";
					$setPasswordFire = mysqli_query($con, $querySetPassword);

					$queryUsername = "SELECT username FROM users WHERE token='$token'";
					$usernameFire = mysqli_query($con, $queryUsername);

					$usernameArray = mysqli_fetch_assoc($usernameFire);
					$username = $usernameArray['username'];

          			$body = '<div style="@import url("https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap");">
								<div style="margin: 100px auto; width: 70%; font-family: Raleway, sans-serif;">
									<div style="box-shadow: 0 0 9px rgba(0, 0, 0, 0.25); border:1px solid #dadce0; border-radius: 8px; overflow: hidden;">
										<div style="text-align: center; padding: 50px; color: #fff; background-color: #343a40;">
												<h1>'.$projectName.'</h1>
										</div>

										<div style="text-align: center; width: 80%; margin: 30px auto; font-size: 18px; color:rgba(0,0,0,0.87);">
											<p>Dear '.$username.',</p>
											<p>
												The password on your <b>'.$projectName.'</b> account was recently changed.
												<br><br>
												If you made this change, you are all set. No additional action is required from your end.
												<br><br>
												If not, please reset your password on any sign-in screen by clicking
												<a style="color: #343a40;"
												href="'.$serverName.'forgot.php">Forgot Password</a>.
											</p>

											<p>Regards <br> Your '.$projectName.' Team</p>
											<a style="color: #343a40;"  href="'.$serverName.'">'.$serverName.'</a>
										</div>

									</div>

									<div style="text-align: center; font-size: 12px; width: 95%; margin: 19px auto; color: #5f6368;">
										If you do not want to receive emails from '.$projectName.', you can <a style="color: #343a40;" href="#">unsubscribe</a>.
										<br><br>
										You have received this email because you or someone else has reset your password. This would like to receive email communication from '.$projectName.'. We will never share your personal information (such as your email address with any other 3rd party without your consent).
										<br><br>
										This email was sent by: West Canal Road, Faisal Town, Faisalabad, Pakistan
									</div>
								</div>
							</div>';

							header("Location: signin.php?UN=$username&PWSC=sucess");
          					smtpMailer($email, 'Your '.$projectName.' password has been changed', $body);

				} else {
					// Incorrect Password
					header("Location: newpassword.php?email=$email&token=$token&PW=$password&PWE=success&PWCE=incorrect");
					Exists();
				}
			} else {
				// Invalid Length
				header("Location: newpassword.php?email=$email&token=$token&PW=$password&PWE=success&PWCE=lenght");
				Exists();
			}
		} else {
			// Bank Input
			header("Location: newpassword.php?email=$email&token=$token&PW=$password&PWE=success&PWCE=empty");
			Exists();
		}

	} else {
		header("Location: signin.php");
	}

?>
