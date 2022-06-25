<?php
	require 'include/config.php';

	if(isset($_POST['btnUpdate'])) {

        $userID = $_SESSION['id'];
		$fullname = mysqli_real_escape_string($con, trim($_POST['ep_fullname']));
		$username = mysqli_real_escape_string($con, trim($_POST['ep_username']));
		$email = mysqli_real_escape_string($con, trim($_POST['ep_email']));
        $phonenumber = mysqli_real_escape_string($con, trim($_POST['ep_phonenumber']));
		$address = mysqli_real_escape_string($con, trim($_POST['ep_address']));
		$country = mysqli_real_escape_string($con, trim($_POST['country']));
		$gender = mysqli_real_escape_string($con, trim($_POST['gender']));
		// $profile_path = $_SESSION['profile_path'];
		$profile_path = $_COOKIE['profile_path'];

		// header("Location: profile.php?hi=$profile_path");
		// Exists();

		$fullname_valid = $username_valid = $email_valid = $phonenumber_valid = $address_valid = $gender_valid = $country_valid = false;

		// For Fullname Validation
		if(!empty($fullname)) {
			if(strlen($fullname) >= 2 && strlen($fullname) <= 30) {
				if(!preg_match('/[^a-zA-Z\s]/', $fullname)) {
					$fullname_valid = true;
					header("Location: profile.php?FN=$fullname&FNE=success");
				} else {
					// Invalid character
					header("Location: profile.php?FN=$fullname&FNE=invalid");
					Exists();
				}
			} else {
				// Invalid Length
				header("Location: profile.php?FN=$fullname&FNE=lenght");
				Exists();
			}
		} else {
			// Bank Input
			header("Location: profile.php?FNE=empty");
			Exists();
		}

		// For Username Validation
		if(!empty($username)) {
			if(strlen($username) >= 6 && strlen($username) <= 30) {
				if(!preg_match('/[^a-zA-Z\d_.]/', $username)) {

                    // If user a not change the username
                    $queryUsername = "SELECT * FROM users WHERE id='$userID'";
					$usernameFire = mysqli_query($con, $queryUsername);
                    $usersArray = mysqli_fetch_assoc($usernameFire);
                    $usernameValue = $usersArray['username'];

                    if($usernameValue == $username){
                        $username_valid = true;
						header("Location: profile.php?FN=$fullname&UN=$username&FNE=success&UNE=success");
                    } else {

                        // If the user change username
                        $queryCheckUsername = "SELECT * FROM users WHERE username='$username'";
                        $checkUsernameFire = mysqli_query($con, $queryCheckUsername);

                        if (mysqli_num_rows($checkUsernameFire) == 0) {
                            $username_valid = true;
                            header("Location: profile.php?FN=$fullname&UN=$username&FNE=success&UNE=success");
                        } else {
                            // Username Already Exists
                            header("Location: profile.php?FN=$fullname&UN=$username&FNE=success&UNE=exists");
                            Exists();
                        }

                    }

				} else {
					// Invalid character
					header("Location: profile.php?FN=$fullname&UN=$username&FNE=success&UNE=invalid");
					Exists();
				}
			} else {
				// Invalid Length
				header("Location: profile.php?FN=$fullname&UN=$username&FNE=success&UNE=lenght");
				Exists();
			}
		} else {
			// Bank Input
			header("Location: profile.php?FN=$fullname&UN=$username&FNE=success&UNE=empty");
			Exists();
		}

		// For Email Validation
		if(!empty($email)) {
			if(filter_var($email, FILTER_VALIDATE_EMAIL)) {

                // If user a not change the email
                $query = "SELECT * FROM users WHERE id='$userID'";
                $queryFire = mysqli_query($con, $query);
                $usersArray = mysqli_fetch_assoc($queryFire);
                $emailValue = $usersArray['email'];

                if($emailValue == $email){
                    $email_valid = true;
                    header("Location: profile.php?FN=$fullname&UN=$username&EM=$email&FNE=success&UNE=success&EME=success");
                } else {

                    // If the user change email
					$queryCheckEmail = "SELECT * FROM users WHERE email='$email'";
					$checkEmailFire = mysqli_query($con, $queryCheckEmail);

					if (mysqli_num_rows($checkEmailFire) == 0) {
						$email_valid = true;
						header("Location: profile.php?FN=$fullname&UN=$username&EM=$email&FNE=success&UNE=success&EME=success");
					} else {
						// Email Already Exists
						header("Location: profile.php?FN=$fullname&UN=$username&EM=$email&FNE=success&UNE=success&EME=exists");
						Exists();
					}
                }

				} else {
					// Invalid Email
					header("Location: profile.php?FN=$fullname&UN=$username&EM=$email&FNE=success&UNE=success&EME=invalid");
					Exists();
				}
		} else {
			// Bank Input
			header("Location: profile.php?FN=$fullname&UN=$username&FNE=success&UNE=success&EME=empty");
			Exists();
		}

		// For Phone Number Validation
		if(!empty($phonenumber)) {
			if(strlen($phonenumber) >= 11 && strlen($phonenumber) <= 14) {
				if(!preg_match('/[^a-zA-Z\d_-,.]/', $phonenumber)) {

                    // If user a not change the phone number
                    $query = "SELECT * FROM users WHERE id='$userID'";
                    $queryFire = mysqli_query($con, $query);
                    $usersArray = mysqli_fetch_assoc($queryFire);
                    $phonenumberValue = $usersArray['phonenumber'];

                    if($phonenumberValue == $phonenumber){
                        $phonenumber_valid = true;
                        header("Location: profile.php?FN=$fullname&UN=$username&EM=$email&PN=$phonenumber&FNE=success&UNE=success&EME=success&PNE=success");
                    } else {

                        // If the user change phone number
                        $queryCheckPhoneNumber = "SELECT * FROM users WHERE phonenumber='$phonenumber'";
                        $checkPhoneNumberFire = mysqli_query($con, $queryCheckPhoneNumber);

                        if (mysqli_num_rows($checkPhoneNumberFire) == 0) {
                            $phonenumber_valid = true;
                            header("Location: profile.php?FN=$fullname&UN=$username&EM=$email&PN=$phonenumber&FNE=success&UNE=success&EME=success&PNE=success");
                        } else {
                            // Phone Number Already Exists
                            header("Location: profile.php?FN=$fullname&UN=$username&EM=$email&PN=$phonenumber&FNE=success&UNE=success&EME=success&PNE=exists");
                            Exists();
                        }
                    }

				} else {
					// Invalid character
					header("Location: profile.php?FN=$fullname&UN=$username&EM=$email&FNE=success&UNE=success&EME=success&PNE=invalid");
					Exists();
				}
			} else {
				// Invalid Length
				header("Location: profile.php?FN=$fullname&UN=$username&EM=$email&FNE=success&UNE=success&EME=success&PNE=lenght");
				Exists();
			}
		} else {
			// Bank Input
			header("Location: profile.php?FN=$fullname&UN=$username&EM=$email&FNE=success&UNE=success&EME=success&PNE=empty");
			Exists();
		}


		// For Address Validation
		if(!empty($address)) {
			if(strlen($address) >= 10 && strlen($address) <= 30) {
				if(!preg_match('/[^a-zA-Z\s]/', $address)) {
					$address_valid = true;
					header("Location: profile.php?FN=$fullname&UN=$username&EM=$email&PN=$phonenumber&ADDR=$address&FNE=success&UNE=success&EME=success&PNE=success&ADDRE=success");
                } else {
					// Invalid character
					header("Location: profile.php?FN=$fullname&UN=$username&EM=$email&PN=$phonenumber&ADDR=$address&FNE=success&UNE=success&EME=success&PNE=success&ADDRE=invalid");
					Exists();
				}
			} else {
				// Invalid Length
				header("Location: profile.php?FN=$fullname&UN=$username&EM=$email&PN=$phonenumber&ADDR=$address&FNE=success&UNE=success&EME=success&PNE=success&ADDRE=lenght");
				Exists();
			}
		} else {
			// Bank Input
			header("Location: profile.php?FN=$fullname&UN=$username&EM=$email&PN=$phonenumber&FNE=success&UNE=success&EME=success&PNE=success&ADDRE=empty");
			Exists();
		}

		// For Country Validation
		if(!empty($country)) {
			$country_valid = true;
			header("Location: profile.php?FN=$fullname&UN=$username&EM=$email&PN=$phonenumber&ADDR=$address&CO=$country&FNE=success&UNE=success&EME=success&PNE=success&ADDRE=success&CE=success");
		} else {
			// Bank Input
			header("Location: profile.php?FN=$fullname&UN=$username&EM=$email&PN=$phonenumber&ADDR=$address&FNE=success&UNE=success&EME=success&PNE=success&ADDRE=success&CE=empty");
			Exists();
		}

		// For Gender Validation
		if(!empty($gender)) {
			$gender_valid = true;
			header("Location: profile.php?FN=$fullname&UN=$username&EM=$email&PN=$phonenumber&ADDR=$address&CO=$country&FNE=success&UNE=success&EME=success&PNE=success&ADDRE=success&CE=success&GDE=success");
		} else {
			// Bank Input
			header("Location: profile.php?FN=$fullname&UN=$username&EM=$email&PN=$phonenumber&ADDR=$address&CO=$country&FNE=success&UNE=success&EME=success&PNE=success&ADDRE=success&CE=success&GDE=empty");
			Exists();
		}

		// $fullname_valid = $username_valid = $email_valid = $phonenumber_valid = true;

		//Insert Data into Database
		if($fullname_valid = true && $username_valid = true && $email_valid = true && $phonenumber_valid = true && $address_valid = true && $gender_valid = true && $country_valid = true ) {

			$query = "UPDATE users SET fullname = '$fullname', username = '$username', email = '$email', phonenumber='$phonenumber', address='$address', gender='$gender', country='$country', profile='$profile_path' WHERE id='$userID'";
			$fire = mysqli_query($con,$query);

			$_SESSION['username'] = $username;
			$_SESSION['email'] = $email;
			$_SESSION['fullname'] = $fullname;
			$_SESSION['phonenumber'] = $phonenumber;
			$_SESSION['address'] = $address;
			$_SESSION['gender'] = $gender;
			$_SESSION['country'] = $country;
			$_SESSION['profile'] = $profile_path;
			
			header("Location: profile.php?updateSuccess=true");
		}

	} else {
		header("Location: profile.php");
	}

?>
