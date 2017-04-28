<?php
include 'config.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();


if(isset($_POST['email_result'])) {
  echo $_POST['email_result'];
  $email = mysqli_real_escape_string($conn, ($_POST['email_result']));

  if (mysqli_query($conn, "SELECT * FROM user WHERE Email='$email'"))
  {
  if (mysqli_query($conn, "UPDATE user SET Password= md5(123456) WHERE Email='$email'"))
  {
      echo "You have successfully changed user ". $email ."'s password.";
      $_SESSION['pass_reset'] = "You have successfully changed user ". $email ."'s password.";
  }
}
  else
  {
      $_SESSION['email_exist'] = "Email doesn't exist";
      mysqli_error($conn);
  }
}

else {
  $_SESSION['error'] = 'There was an error with your input. Please make sure all fields are filled out.';

}
header('Location: ' . $_SERVER['HTTP_REFERER']);
