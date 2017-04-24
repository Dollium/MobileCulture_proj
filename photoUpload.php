<?php
include 'config.php';
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

$username = $_SESSION['username'];
$password = $_SESSION['password'];




//Get the content of the image and then add slashes to it
$imagetmp=addslashes (file_get_contents($_FILES['myimage']['tmp_name']));

//Insert the image name and image content in image_table
$insert_image="UPDATE `user` SET `Profile_photo`= '$imagetmp' WHERE Email='$username' AND Password='$password'";

if (!($insert_image))
{
  echo "Didn't work";

}
else {
  echo "worked";
}
mysqli_query($conn, $insert_image);


mysqli_close($conn);
header('location:student.php');
?>
