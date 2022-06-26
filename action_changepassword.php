<?php
	require 'include/config.php';
	include 'include/mailer.php';

	if(isset($_POST['btnChangePassword'])) {
		
		$userID = $_SESSION['id'];
		$username = $_SESSION['username'];
		$email = $_SESSION['email'];
		$currentPassword = mysqli_real_escape_string($con, trim($_POST['current_password']));
		$password = mysqli_real_escape_string($con, trim($_POST['new_password']));
		$confirmPassword = mysqli_real_escape_string($con, trim($_POST['new_confirmPassword']));

		// For Current Password Validation
		if(!empty($currentPassword)) {
			if(strlen($currentPassword) >= 6 && strlen($currentPassword) <= 30) {
				if(!preg_match('/[^a-zA-Z\d_.@&-]/', $currentPassword)) {
					$queryCheckPassword = "SELECT * FROM users WHERE id='$userID' AND password='$currentPassword'";
					$checkPasswordFire = mysqli_query($con, $queryCheckPassword);

					if (mysqli_num_rows($checkPasswordFire) == 1) {
						header("Location: changepassword.php?CPW=$currentPassword&CPWE=success");
					} else {
						// Not Match Password 
						header("Location: changepassword.php?CPWE=notmatch");
						Exists();
					}

				} else {
					// Invalid character
					header("Location: changepassword.php?CPWE=invalid");
					Exists();
				}
			} else {
				// Invalid Length
				header("Location: changepassword.php?CPWE=lenght");
				Exists();
			}
		} else {
			// Bank Input
			header("Location: changepassword.php?CPWE=empty");
			Exists();
		}


		// For Password Validation
		if(!empty($password)) {
			if(strlen($password) >= 6 && strlen($password) <= 30) {
				if(!preg_match('/[^a-zA-Z\d_.@&-]/', $password)) {
					if($currentPassword != $password) {
						header("Location: changepassword.php?CPW=$currentPassword&PW=$password&CPWE=success&PWE=success");
					} else {
						// Current Password and New Password are not same
						header("Location: changepassword.php?CPW=$currentPassword&CPWE=success&PWE=same");
						Exists();
					}
				} else {
					// Invalid character
					header("Location: changepassword.php?CPW=$currentPassword&CPWE=success&PWE=invalid");
					Exists();
				}
			} else {
				// Invalid Length
				header("Location: changepassword.php?CPW=$currentPassword&CPWE=success&PWE=lenght");
				Exists();
			}
		} else {
			// Bank Input
			header("Location: changepassword.php?CPW=$currentPassword&CPWE=success&PWE=empty");
			Exists();
		}

		// For Confirm Password Validation
		if(!empty($confirmPassword)) {
			if(strlen($confirmPassword) >= 6 && strlen($confirmPassword) <= 30) {
				if($password == $confirmPassword) {

          			$querySetPassword = "UPDATE users SET password='$password' WHERE id='$userID'";
					$setPasswordFire = mysqli_query($con, $querySetPassword);

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

							header("Location: changepassword.php?PWSC=sucess");
          					smtpMailer($email, 'Your Password Successfully Change!', $body);

				} else {
					// Incorrect Password
					header("Location: changepassword.php?CPW=$currentPassword&PW=$password&CPWE=success&PWE=success&PWCE=incorrect");
					Exists();
				}
			} else {
				// Invalid Length
				header("Location: changepassword.php?CPW=$currentPassword&PW=$password&CPWE=success&PWE=success&PWCE=lenght");
				Exists();
			}
		} else {
			// Bank Input
			header("Location: changepassword.php?CPW=$currentPassword&PW=$password&CPWE=success&PWE=success&PWCE=empty");
			Exists();
		}

	} else {
		header("Location: signin.php");
	}

?>
