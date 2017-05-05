<?php
session_start();
include 'config.php';
$passwordCheck = mysqli_real_escape_string($conn, md5($_POST['oldPassword']));
$password1 = mysqli_real_escape_string($conn, md5($_POST['newPassword']));
$password2 = mysqli_real_escape_string($conn, md5($_POST['confirmPassword']));
$username = mysqli_real_escape_string($conn, $_SESSION['username']);
print_r($_SESSION);
echo strlen($_POST['newPassword']);

 if(strlen($_POST['newPassword']) < '8')
 {
   $_SESSION['passLen'] = "Password must be at least 8 characters long.";
   if(($_SESSION['isAdmin'] == true) || ($_SESSION['isSchool'] == true) || ($_SESSION['isStudent']== true))
   {
         header('location:settings.php');
         exit;
       }
 else {
   header('location:newPassword.php');
   exit;
 }
 }
 else if (strlen($_POST['newPassword']) >= '8') {

    if ($passwordCheck == $_SESSION['password'])
    {
      if ($password1 <> $password2)
      {
           $_SESSION['passMatch'] = "Your passwords do not match";

           if(($_SESSION['isAdmin'] == true) || ($_SESSION['isSchool'] == true) || ($_SESSION['isStudent']== true))
           {

                 header('location:settings.php');
                 exit;
               }
         else {
           header('location:newPassword.php');
           exit;
         }
      }

      else if (mysqli_query($conn, "UPDATE user SET Password='$password1' WHERE Email='$username'"))
      {
          $_SESSION['pass_success'] = "You have successfully changed your password.";
          $_SESSION['password'] = $password1;
      }
      else
      {
          mysqli_error($conn);
      }
    }
  else {
    $_SESSION['Oldpass'] = "Password incorrect";
    if(($_SESSION['isAdmin'] == true) || ($_SESSION['isSchool'] == true) || ($_SESSION['isStudent']== true))
    {
          header('location:settings.php');
          exit;
        }
  else {
    header('location:newPassword.php');
    exit;
  }
  }
mysqli_close($conn);
if(($_SESSION['isAdmin'] == true) || ($_SESSION['isSchool'] == true) || ($_SESSION['isStudent']== true))
{
      header('location:settings.php');
    }
else {
header('location:index.php');
}
}
?>
