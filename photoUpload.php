<?php
include 'config.php';
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

$username = $_SESSION['username'];
$password = $_SESSION['password'];
$sql = "SELECT * FROM user WHERE Email = '$username' AND Password = '$password'";
$sth = $conn->query($sql);
$row=mysqli_fetch_array($sth);
// print_r($_SESSION);

$folderPath = "img/user_img/".$row['user_id']."";

// Check to see if directory already exists
$exist = is_dir($folderPath);

// If directory doesn't exist, create directory
if(!$exist) {
mkdir("$folderPath");
chmod("$folderPath", 0755);
}

// delete earlier profile picture if exists
if($row['Profile_photo'] != NULL)
{
  unlink($row['Profile_photo']);
}
// check image exif value and rotate it if needed
$image = imagecreatefromstring(file_get_contents($_FILES['myimage']['tmp_name']));
$exif = exif_read_data($_FILES['myimage']['tmp_name']);
if(!empty($exif['Orientation'])) {
  switch($exif['Orientation']) {
      case 8:
          $image = imagerotate($image,90,0);
          break;
      case 3:
          $image = imagerotate($image,180,0);
          break;
      case 6:
          $image = imagerotate($image,-90,0);
          break;
  }
}
// $image now contains a resource with the image oriented correctly
$target_dir = "$folderPath/";
$target_file = $target_dir . basename($_FILES["myimage"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["myimage"]["tmp_name"]);
    if($check !== false) {
      //  echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
      $_SESSION['photo_fail'] = "Vain JPG, JPEG & PNG päätteiset tiedostot sallittu.";
      $_SESSION['photo_fail_mobi'] = "Vain JPG, JPEG & PNG päätteiset tiedostot sallittu.";
      $uploadOk = 0;
    }
}
// Check file size
if ($_FILES["myimage"]["size"] > 5000000) {
  $_SESSION['size_large'] = "Maksimi sallittu tiedostokoko on 5MB.";
  $_SESSION['size_large_mobi'] = "Maksimi sallittu tiedostokoko on 5MB.";
  $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
  $_SESSION['photo_fail'] = "Vain JPG, JPEG & PNG päätteiset tiedostot sallittu.";
  $_SESSION['photo_fail_mobi'] = "Vain JPG, JPEG & PNG päätteiset tiedostot sallittu.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
//echo "Sorry, your file was not uploaded.";
}
// if everything is ok, try to upload file
else {
    if (imagejpeg($image, $target_file)) {
      $query_upload="UPDATE user SET Profile_photo = '".$target_file."' WHERE Email = '$username' AND Password = '$password' ";
      mysqli_query($conn, $query_upload);
        //  echo "The file ". basename( $_FILES["myimage"]["name"]). " has been uploaded.";
      //  echo $target_file;
    } else {
      $_SESSION['unsuccess_photo'] = "Kuvan lataaminen epäonnistui.";
      $_SESSION['unsuccess_photo_mobi'] = "Kuvan lataaminen epäonnistui.";
    }
}
header('location:student.php');
mysqli_close($conn);
?>
