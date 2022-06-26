<?php
	require 'include/config.php';

	if(isset($_POST['btnSignin'])) {

		$username = mysqli_real_escape_string($con, trim($_POST['si_username']));
		$password = mysqli_real_escape_string($con, trim($_POST['si_password']));

		// For Username Validation
		if(!empty($username)) {
			if(strlen($username) >= 6 && strlen($username) <= 30) {
				if(!preg_match('/[^a-zA-Z\d_.]/', $username)) {
					$queryCheckUsername = "SELECT * FROM users WHERE username='$username'";
					$checkUsernameFire = mysqli_query($con, $queryCheckUsername);

					if (mysqli_num_rows($checkUsernameFire) == 1) {
						header("Location: signin.php?UN=$username&UNE=success");
					} else {
						// Username not Exists
						header("Location: signin.php?UN=$username&UNE=notexists");
						Exists();
					}

				} else {
					// Invalid character
					header("Location: signin.php?UN=$username&UNE=invalid");
					Exists();
				}
			} else {
				// Invalid Length
				header("Location: signin.php?UN=$username&UNE=lenght");
				Exists();
			}
		} else {
			// Bank Input
			header("Location: signin.php?UNE=empty");
			Exists();
		}

		// For Password Validation
		if(!empty($password)) {
			if(strlen($password) >= 6 && strlen($password) <= 30) {
				if(!preg_match('/[^a-zA-Z\d_.@&-]/', $password)) {
					$queryCheckPassword = "SELECT * FROM users WHERE username='$username' AND password='$password'";
					$checkPasswordFire = mysqli_query($con, $queryCheckPassword);

					if (mysqli_num_rows($checkPasswordFire) == 1) {

						$queryCheckStatus = "SELECT * FROM users WHERE username='$username' AND password='$password' AND status=1";
						$checkStatusFire = mysqli_query($con, $queryCheckStatus);

						$usersArray = mysqli_fetch_assoc($checkStatusFire);
						$statusValue = $usersArray['status'];
						$userID = $usersArray['id'];
						$userEmail = $usersArray['email'];
						$userFullName = $usersArray['fullname'];
						$userPhoneNumber = $usersArray['phonenumber'];
						$userCountry = $usersArray['country'];
						$userAddress = $usersArray['address'];
						$userGender = $usersArray['gender']; 
						$userProfile = $usersArray['profile'];

						if($statusValue == 1) {
							$_SESSION['is_login'] = true;
							$_SESSION['username'] = $username;
							$_SESSION['email'] = $userEmail;
							$_SESSION['fullname'] = $userFullName;
							$_SESSION['phonenumber'] = $userPhoneNumber;
							$_SESSION['country'] = $userCountry;
							$_SESSION['address'] = $userAddress;
							$_SESSION['gender'] = $userGender;
							if($userProfile != '') { $_SESSION['profile'] = $userProfile; }
							$_SESSION['id'] = $userID;

							header("Location: dashboard.php");
						} else {
							header("Location: signin.php?UN=$username&activate=notactivate");
						}

					} else {
						// Password not Exists
						header("Location: signin.php?UN=$username&UNE=success&PWE=notexists");
						Exists();
					}

				} else {
					// Invalid character
					header("Location: signin.php?UN=$username&UNE=success&PWE=invalid");
					Exists();
				}
			} else {
				// Invalid Length
				header("Location: signin.php?UN=$username&UNE=success&PWE=lenght");
				Exists();
			}
		} else {
			// Bank Input
			header("Location: signin.php?UN=$username&UNE=success&PWE=empty");
			Exists();
		}

	}

?>
