<?php
  // Image Crop and Store in Local Storage
  if(isset($_POST['image'])) {
    $profile_img = $_POST['image'];

    $image_parts = explode(";base64,", $profile_img);
    // Input data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAZ
    // Output [0] => data:image/png    [1] => iVBORw0KGgoAAAANSUhEUgAAAZ

    $image_type = explode("image/", $image_parts[0]);
    // Input data:image/png
    // Output [0] => data:    [1] => png

    $profile_img = base64_decode($image_parts[1]);
    $profile_path = 'assets/img/' . time() . '.png';
    // $_SESSION['profile_path'] = $profile_path;
    file_put_contents($profile_path, $profile_img);
    echo json_encode($profile_path);

  }
?>