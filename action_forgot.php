<?php
	require 'include/config.php';
	include 'include/mailer.php';

	if(isset($_POST['btnResetPassword'])) {

		$email = mysqli_real_escape_string($con, trim($_POST['fg_email']));

		// For Email Validation
		if(!empty($email)) {
			if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$queryCheckEmail = "SELECT * FROM users WHERE email='$email'";
					$checkEmailFire = mysqli_query($con, $queryCheckEmail);

					if (mysqli_num_rows($checkEmailFire) == 1) {
						$queryToken = "SELECT token FROM users WHERE email='$email'";
						$TokenFire = mysqli_query($con, $queryToken);

						$tokenArray = mysqli_fetch_assoc($TokenFire);
						$token = $tokenArray['token'];

						$queryUsername = "SELECT username FROM users WHERE email='$email'";
	          			$usernameFire = mysqli_query($con, $queryUsername);

	          			$usernameArray = mysqli_fetch_assoc($usernameFire);
	         			$username = $usernameArray['username'];

						$body = '<div style="@import url("https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap");">
												<div style="margin: 100px auto; width: 70%; font-family: Raleway, sans-serif;">
													<div style="box-shadow: 0 0 9px rgba(0, 0, 0, 0.25); border:1px solid #dadce0; border-radius: 8px; overflow: hidden;">
															<div style="text-align: center; padding: 50px; color: #fff; background-color: #343a40;">
																	<h1>TUF Portfolio</h1>
															</div>

															<div style="text-align: center; width: 80%; margin: 30px auto; font-size: 18px; color:rgba(0,0,0,0.87);">
																	<p>Dear '.$username.',</p>
																	<p>You have just sent a request to reset your password from <b>TUF Portolio</b> <br> Here the Reset Password button:</p>
																	<a style="color: #fff; text-decoration: none; border: 1px solid #343a40; border-radius: 5px; padding: 7px 12px; margin: 6px; display: inline-block; background-color: #343a40;"
																		 href="'.$serverName.'newpassword.php?email='.$email.'&token='.$token.'">
																			Reset Password
																	</a>
																	<p>Did not request for a password reset? Please ignore this email.</p>
																	<p>Regards <br> Your TUF Portfolio Team</p>
																	<a style="color: #343a40;"  href="#">www.tufportfolio.com</a>
															</div>

													</div>

													<div style="text-align: center; font-size: 12px; width: 95%; margin: 19px auto; color: #5f6368;">
															If you do not want to receive emails from TUF Portolio, you can <a style="color: #343a40;" href="#">unsubscribe</a>.
															<br><br>
															You have received this email because you or someone else has confirmed the email address. This would like to receive email communication from TUF Portfolio. We will never share your personal information (such as your email address with any other 3rd party without your consent).
															<br><br>
															This email was sent by: West Canal Road, Faisal Town, Faisalabad, Pakistan
													</div>
											</div>
										</div>';

						header("Location: forgot.php?EM=$email&EME=success");
						smtpMailer($email, 'Reset Password', $body);
						
					} else {
						// Email Not Exists
						header("Location: forgot.php?EM=$email&EME=notexists");
						Exists();
					}

				} else {
					// Invalid Email
					header("Location: forgot.php?EM=$email&EME=invalid");
					Exists();
				}
		} else {
			// Bank Input
			header("Location: forgot.php?EME=empty");
			Exists();
		}

	} else {
		header("Location: forgot.php");
	}

?>
