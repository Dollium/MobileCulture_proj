<?php
session_start();
include 'config.php';

$passwordCheck = mysqli_real_escape_string($conn, md5($_POST['oldPassword']));
$password1 = mysqli_real_escape_string($conn, md5($_POST['newPassword']));
$password2 = mysqli_real_escape_string($conn, md5($_POST['confirmPassword']));
$username = mysqli_real_escape_string($conn, $_SESSION['username']);
$re = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/";
 print_r($_SESSION);
$pattern = preg_match($re, $_POST['newPassword']);

if(isset($_POST['submit']))
{

  if ($passwordCheck != $_SESSION['password'])
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
echo $error;
  if(isset($_SESSION['pass_str']) && !empty($_SESSION['pass_str']) || isset($_SESSION['passMatch']) && !empty($_SESSION['passMatch']) || isset($_SESSION['Oldpass']) && !empty($_SESSION['Oldpass']))
  {
    if(($_SESSION['isAdmin'] == true) || ($_SESSION['isSchool'] == true) || ($_SESSION['isStudent']== true))
  {

    header('location:settings.php');
    exit;
  }
  else{
    $_SESSION['bbbb'] = 'bbbb';
    print $error;
    exit;
  }
}
else {
    if (mysqli_query($conn, "UPDATE user SET Password='$password1' WHERE Email='$username'"))
    {
        $_SESSION['pass_success'] = "Salasanasi on vaihdettu onnistuneesti.";
        $_SESSION['password'] = $password1;

        if(($_SESSION['isAdmin'] == true) || ($_SESSION['isSchool'] == true) || ($_SESSION['isStudent']== true))
        {
              header('location:settings.php');
            }
        else {
        header('location:index.php');
      }
    }
  else {
      $_SESSION['pass_fail'] = "Salasanan vaihto ei onnistunut.";


      if(($_SESSION['isAdmin'] == true) || ($_SESSION['isSchool'] == true) || ($_SESSION['isStudent']== true))
      {
            header('location:settings.php');
          }
      else {
      header('location:index.php');
    }
  }


}
}

?>
