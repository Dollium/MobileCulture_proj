<?php
session_start();
include 'config.php';
$passwordCheck = mysqli_real_escape_string($conn, md5($_POST['oldPassword']));
$password1 = mysqli_real_escape_string($conn, md5($_POST['newPassword']));
$password2 = mysqli_real_escape_string($conn, md5($_POST['confirmPassword']));
$username = mysqli_real_escape_string($conn, $_SESSION['username']);
print_r($_SESSION);
echo strlen($_POST['newPassword']);
$uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-z]@', $password);
$number    = preg_match('@[0-9]@', $password);

if(isset($_POST['submit']))
{
$error = 0;
  if ($passwordCheck != $_SESSION['password'])
    {
      $_SESSION['Oldpass'] = "Virheellinen salasana";
      $error = 1;
    }

  if ($password1 <> $password2)
  {

   $_SESSION['passMatch'] = "Salasanasi eivät vastaa toisiaan";
   $error = 1;

  }
  if (!$uppercase || !$lowercase || !$number) {

    $_SESSION['pass_str'] = "Vähintään 1 iso kirjain, 1 pieni kirjain sekä 1 numero vaadittu.";
    $error = 1;

  }
  if($error = 1)
  {
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
