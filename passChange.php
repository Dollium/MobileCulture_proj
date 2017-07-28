<?php
session_start();
include 'config.php';

function better_crypt($input, $rounds = 10)
{
$crypt_options = array(
  'cost' => $rounds
);
return password_hash($input, PASSWORD_BCRYPT, $crypt_options);
}

$passwordCheck = mysqli_real_escape_string($conn, $_POST['oldPassword']);
$password1 = mysqli_real_escape_string($conn, $_POST['newPassword']);
$password2 = mysqli_real_escape_string($conn, $_POST['confirmPassword']);
$username = mysqli_real_escape_string($conn, $_SESSION['username']);
$re = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/";
 print_r($_SESSION);
$pattern = preg_match($re, $_POST['newPassword']);

// check if page was accessed through submitting data
if(isset($_POST['submit']))
{

  if (password_verify($passwordCheck != $_SESSION['password']))
  {
    $_SESSION['Oldpass'] = "Virheellinen salasana";
  }

  if ($password1 <> $password2)
  {
   $_SESSION['passMatch'] = "Salasanasi eivät vastaa toisiaan";
  }

  if (!$pattern)
  {
  $_SESSION['pass_str'] = "Vähintään 1 iso kirjain, 1 pieni kirjain sekä 1 numero vaadittu.";
  }

  // check if any error has occurred and locate user
  if(isset($_SESSION['pass_str']) && !empty($_SESSION['pass_str']) || isset($_SESSION['passMatch']) && !empty($_SESSION['passMatch']) || isset($_SESSION['Oldpass']) && !empty($_SESSION['Oldpass']))
  {
    if(($_SESSION['isAdmin'] == true) || ($_SESSION['isSchool'] == true) || ($_SESSION['isStudent']== true) || ($_SESSION['isInst']== true))
    {
      header('location:settings.php');
      exit;
    }
    else {
      header('location:newPassword.php');
      exit;
    }
  }
  else {
  	$password1 = better_crypt($password1);
    if (mysqli_query($conn, "UPDATE user SET Password='$password1' WHERE Email='$username'"))
    {
      $_SESSION['pass_success'] = "Salasanasi on vaihdettu onnistuneesti.";
      $_SESSION['password'] = $password1;

      if(($_SESSION['isAdmin'] == true) || ($_SESSION['isSchool'] == true) || ($_SESSION['isStudent']== true))
      {
        header('location:settings.php');
        exit;
      }
      else {
        header('location:index.php');
        exit;
      }
    }

      // Couldn't get user information from database
    else {
      $_SESSION['pass_fail'] = "Salasanan vaihto ei onnistunut.";

      if(($_SESSION['isAdmin'] == true) || ($_SESSION['isSchool'] == true) || ($_SESSION['isStudent']== true))
      {
        header('location:settings.php');
        exit;
      }
      else {
        header('location:index.php');
        exit;
      }
    }
  }
}

?>
