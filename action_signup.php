<?php
	require 'include/config.php';
	include 'include/mailer.php';

	if(isset($_POST['btnSignup'])) {

		$fullname = mysqli_real_escape_string($con, trim($_POST['su_fullname']));
		$username = mysqli_real_escape_string($con, trim($_POST['su_username']));
		$email = mysqli_real_escape_string($con, trim($_POST['su_email']));
		$password = mysqli_real_escape_string($con, trim($_POST['su_password']));
		$confirmPassword = mysqli_real_escape_string($con, trim($_POST['su_confirmPassword']));
		$token = bin2hex(openssl_random_pseudo_bytes(50));
		$time = time();

		$fullname_valid = $username_valid = $email_valid = $password_valid = $confirmPassword_valid = false;

		// For Fullname Validation
		if(!empty($fullname)) {
			if(strlen($fullname) >= 2 && strlen($fullname) <= 30) {
				if(!preg_match('/[^a-zA-Z\s]/', $fullname)) {
					$fullname_valid = true;
					header("Location: signup.php?FN=$fullname&FNE=success");
				} else {
					// Invalid character
					header("Location: signup.php?FN=$fullname&FNE=invalid");
					Exists();
				}
			} else {
				// Invalid Length
				header("Location: signup.php?FN=$fullname&FNE=lenght");
				Exists();
			}
		} else {
			// Bank Input
			header("Location: signup.php?FNE=empty");
			Exists();
		}

		// For Username Validation
		if(!empty($username)) {
			if(strlen($username) >= 6 && strlen($username) <= 30) {
				if(!preg_match('/[^a-zA-Z\d_.]/', $username)) {
					$queryCheckUsername = "SELECT * FROM users WHERE username='$username'";
					$checkUsernameFire = mysqli_query($con, $queryCheckUsername);

					if (mysqli_num_rows($checkUsernameFire) == 0) {
						$username_valid = true;
						header("Location: signup.php?FN=$fullname&UN=$username&FNE=success&UNE=success");
					} else {
						// Username Already Exists
						header("Location: signup.php?FN=$fullname&UN=$username&FNE=success&UNE=exists");
						Exists();
					}

				} else {
					// Invalid character
					header("Location: signup.php?FN=$fullname&UN=$username&FNE=success&UNE=invalid");
					Exists();
				}
			} else {
				// Invalid Length
				header("Location: signup.php?FN=$fullname&UN=$username&FNE=success&UNE=lenght");
				Exists();
			}
		} else {
			// Bank Input
			header("Location: signup.php?FN=$fullname&FNE=success&UNE=empty");
			Exists();
		}

		// For Email Validation
		if(!empty($email)) {
			if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$queryCheckEmail = "SELECT * FROM users WHERE email='$email'";
					$checkEmailFire = mysqli_query($con, $queryCheckEmail);

					if (mysqli_num_rows($checkEmailFire) == 0) {
						$email_valid = true;
						header("Location: signup.php?FN=$fullname&UN=$username&EM=$email&FNE=success&UNE=success&EME=success");
					} else {
						// Email Already Exists
						header("Location: signup.php?FN=$fullname&UN=$username&EM=$email&FNE=success&UNE=success&EME=exists");
						Exists();
					}

				} else {
					// Invalid Email
					header("Location: signup.php?FN=$fullname&UN=$username&EM=$email&FNE=success&UNE=success&EME=invalid");
					Exists();
				}
		} else {
			// Bank Input
			header("Location: signup.php?FN=$fullname&UN=$username&FNE=success&UNE=success&EME=empty");
			Exists();
		}

		// For Password Validation
		if(!empty($password)) {
			if(strlen($password) >= 6 && strlen($password) <= 30) {
				if(!preg_match('/[^a-zA-Z\d_.@&-]/', $password)) {
					$password_valid = true;
					header("Location: signup.php?FN=$fullname&UN=$username&EM=$email&PW=$password&FNE=success&UNE=success&EME=success&PWE=success");
				} else {
					// Invalid character
					header("Location: signup.php?FN=$fullname&UN=$username&EM=$email&FNE=success&UNE=success&EME=success&PWE=invalid");
					Exists();
				}
			} else {
				// Invalid Length
				header("Location: signup.php?FN=$fullname&UN=$username&EM=$email&FNE=success&UNE=success&EME=success&PWE=lenght");
				Exists();
			}
		} else {
			// Bank Input
			header("Location: signup.php?FN=$fullname&UN=$username&EM=$email&FNE=success&UNE=success&EME=success&PWE=empty");
			Exists();
		}

		// For Confirm Password Validation
		if(!empty($confirmPassword)) {
			if(strlen($confirmPassword) >= 6 && strlen($confirmPassword) <= 30) {
				if($password == $confirmPassword) {
					$confirmPassword_valid = true;
					header("Location: signup.php?FN=$fullname&UN=$username&EM=$email&PW=$password&FNE=success&UNE=success&EME=success&PWE=success&PWCE=success");
				} else {
					// Incorrect Password
					header("Location: signup.php?FN=$fullname&UN=$username&EM=$email&FNE=success&UNE=success&EME=success&PWE=success&PWCE=incorrect");
					Exists();
				}
			} else {
				// Invalid Length
				header("Location: signup.php?FN=$fullname&UN=$username&EM=$email&FNE=success&UNE=success&EME=success&PWE=success&PWCE=lenght");
				Exists();
			}
		} else {
			// Bank Input
			header("Location: signup.php?FN=$fullname&UN=$username&EM=$email&FNE=success&UNE=success&EME=success&PWE=success&PWCE=empty");
			Exists();
		}


		//Insert Data into Database
		if($fullname_valid = true && $username_valid = true && $email_valid = true && $password_valid = true && $confirmPassword_valid = true) {
			
			$query = "INSERT INTO users(fullname,username,email,password,token,status,time) VALUES('$fullname','$username','$email','$password','$token','0', '$time')";
			$fire = mysqli_query($con,$query);
			
			$body = '<div style="@import url("https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap");">
									<div style="margin: 100px auto; width: 70%; font-family: Raleway, sans-serif;">
										<div style="box-shadow: 0 0 9px rgba(0, 0, 0, 0.25); border:1px solid #dadce0; border-radius: 8px; overflow: hidden;">
												<div style="text-align: center; padding: 50px; color: #fff; background-color: #343a40;">
														<h1>'.$projectName.'</h1>
												</div>

												<div style="text-align: center; width: 80%; margin: 30px auto; font-size: 18px; color:rgba(0,0,0,0.87);">
														<p>Hello '.$username.',</p>
														<p>Thank you for registering your '.$projectName.'. To finally activate your account please click the following button</p>
														<a style="color: #fff; text-decoration: none; border: 1px solid #343a40; border-radius: 5px; padding: 7px 12px; margin: 6px; display: inline-block; background-color: #343a40;"
															 href="'.$serverName.'activate.php?token='.$token.'">
																Activate Account
														</a>
														<p>If clicking the button does not work you can copy the button link into your browser window or type it there directly.</p>
														<p>Regards <br> Your '.$projectName.' Team</p>
														<a style="color: #343a40;"  href="'.$serverName.'">'.$serverName.'</a>
												</div>

										</div>

										<div style="text-align: center; font-size: 12px; width: 95%; margin: 19px auto; color: #5f6368;">
												If you do not want to receive emails from '.$projectName.', you can <a style="color: #343a40;" href="#">unsubscribe</a>.
												<br><br>
												You have received this email because you or someone else has confirmed the email address. This would like to receive email communication from '.$projectName.'. We will never share your personal information (such as your email address with any other 3rd party without your consent).
												<br><br>
												This email was sent by: West Canal Road, Faisal Town, Faisalabad, Pakistan
										</div>
								</div>
							</div>';
			
			header("Location:signup.php?email=$email&activate=false");
			smtpMailer($email, 'Account Activation', $body);
		}

	} else {
		header("Location: signup.php");
	}

?>
