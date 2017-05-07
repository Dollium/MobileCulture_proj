<?php
include 'config.php';
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

$username = $_SESSION['username'];
$password = $_SESSION['password'];

$file_type = $_FILES['myimage']['type'];
// Check file size
if ($_FILES["myimage"]["size"] > 3000000) {
    $_SESSION['size_large'] = "Maksimi sallittu tiedostokoko on 3MB.";
    $_SESSION['size_large_mobi'] = "Maksimi sallittu tiedostokoko on 3MB.";
    header('location: student.php');
    exit;
}
if($file_type != "image/jpeg" && $file_type != "image/png" && $file_type != "image/jpg") {
    $_SESSION['photo_fail'] = "Vain JPG, JPEG & PNG päätteiset tiedostot sallittu.";
    $_SESSION['photo_fail_mobi'] = "Vain JPG, JPEG & PNG päätteiset tiedostot sallittu.";
    header('location: student.php');
    exit;
}
//Get the content of the image and then add slashes to it
$imagetmp=addslashes (file_get_contents($_FILES['myimage']['tmp_name']));


//Insert the image name and image content in image_table
$insert_image="UPDATE `user` SET `Profile_photo`= '$imagetmp' WHERE Email='$username' AND Password='$password'";

mysqli_query($conn, $insert_image);
header('location: student.php');
mysqli_close($conn);
?>
