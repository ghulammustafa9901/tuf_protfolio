<?php

	require 'include/config.php';
	
	if(isset($_POST['btnUploadImage'])) {

		$fileName = $_FILES['inputUploadImage']['name'];
		$fileName = preg_replace('/\s+/', '_', $fileName);
		$tmpFileName = $_FILES['inputUploadImage']['tmp_name'];
		$fileSize = $_FILES['inputUploadImage']['size'];
		$fileType = $_FILES['inputUploadImage']['type'];
		$fileError = $_FILES['inputUploadImage']['error'];
		$fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
		$fileName = pathinfo($fileName, PATHINFO_FILENAME);
		$fileNameFinal = $fileName."_".date('mdYHmisu').".".$fileExt;

		// echo $fileSize."<br>".$fileError."<br>";
		if(!empty($fileName)) {
			if($fileSize <= 10000000) {
				if($fileExt == "jpg" || $fileExt == "jpeg" || $fileExt == "png") {
					$final_file = "assets/img/".$fileNameFinal;
					// echo $final_file."<br>".$tmpFileName."<br>";
					$upload = move_uploaded_file($tmpFileName, $final_file);
					if($upload) {
						$msg = "File Uploaded Successfully";
						$query = "INSERT INTO img(file_path) VALUES('$final_file')";
						$fire = mysqli_query($con, $query) or die("Can not insert file into database <br>".mysqli_error($con));
						if($fire) {
							$msg .= " and also insert into database. <br>";
							echo $msg;
						}
					}
				} else {
					echo "only jpg, jpeg and png files are allowed to upload";
				}
			} else {
				echo "File size is too large";
			}
		}	else {
			echo "Please select an image to upload";
		}

	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title> File Upload </title>
	<!-- <link rel="icon" type="image/x-icon" href="./assets/img/favicon.png"> -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="assets/css/all.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
</head>
<body class="bg-light mx-2">

	<div class="container-fluid">
		<h2 class="text-center text-dark display-4">File Upload</h2>
    <div class="row">
    	<div class="offset-md-4 col-md-4 font-weight-bold text-dark">
	    	<div class="card my-5">
					<div class="card-header lead font-weight-bold text-uppercase text-center">
						File Upload
					</div>
					<div class="card-body">
						<form 
							name="sigup"
							id="signup"
							method="POST"
							action="<?php $_SERVER['PHP_SELF'] ?>"
							enctype="multipart/form-data">
							
							<div class="input-group mb-3">
							  <div class="input-group-prepend">
							    <span class="input-group-text">Select An Image</span>
							  </div>
							  <div class="custom-file">
							    <input 
							    	type="file"
							    	class="custom-file-input"
							    	id="inputUploadImage"
							    	name="inputUploadImage">
							    <label class="custom-file-label" for="inputUploadImage">
							    	Choose file
							    </label>
							  </div>
							</div>

							<div class="form-group">
								<button 
									name="btnUploadImage"
									id="btnUploadImage"
									class="
										btn
										btn-block
										btn-outline-dark
										font-weight-bold
										mt-4">Upload Image</button>
							</div>

						</form>
					</div>
		    </div>
	    </div>

    </div>
	</div>

	<script type="text/javascript" src="assets/js/jquery.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="assets/js/main.js"></script>

</body>
</html>
