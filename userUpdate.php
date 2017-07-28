<?php
session_start();
include 'config.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);


$firstName = mysqli_real_escape_string($conn, $_POST['fname']);
$lastName = mysqli_real_escape_string($conn, $_POST['lname']);
$Email = mysqli_real_escape_string($conn, $_POST['email']);
$start_year = mysqli_real_escape_string($conn, $_POST['year']);
$student_school = mysqli_real_escape_string($conn, $_POST['school']);
$user_id = mysqli_real_escape_string($conn, $_POST['updateID']);
/*
$user_id=$_POST['updateID'];
$firstName = $_POST['fname'];
$lastName = $_POST['lname'];
$Email = $_POST['email'];
$start_year = $_POST['year'];
$student_school = $_POST['school'];
*/


// check if page was accessed through submitting data
if(isset($_POST['submit']))
{
    if (mysqli_query($conn, "START TRANSACTION;
      UPDATE user 
      SET First_name='".$firstName."', Last_name='".$lastName."', Email='".$Email."' 
      WHERE user_id='".$user_id."';UPDATE student 
      SET school_id='".$student_school."', Starting_year='".$start_year."'
      WHERE user_id='".$user_id."';

      COMMIT;")) {
      $_SESSION['update_status'] = "Opiskelija on vaihdettu onnistuneesti.";
    }
    else { $_SESSION['update_status'] = "Varmista että kaikki tiedot ovat täytettyinä.";}
}
?>
