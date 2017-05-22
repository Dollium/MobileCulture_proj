<?php
include 'config.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

function better_crypt($input, $rounds = 10)
{
    $crypt_options = array(
        'cost' => $rounds
    );
    return password_hash($input, PASSWORD_BCRYPT, $crypt_options);
}

if(isset($_POST['email_result'])) {
  // echo $_POST['email_result'];
  $email = mysqli_real_escape_string($conn, ($_POST['email_result']));
  // echo $email;

  if (mysqli_query($conn, "SELECT * FROM user WHERE Email='$email'"))
  {
    if (mysqli_query($conn, "UPDATE user SET Password='". better_crypt(Kultmob1) ."' WHERE Email='$email'"))
    {
        $_SESSION['pass_reset'] = "Olet onnistuneesti vaihtanut käyttäjän ". $email ." salasanan.";
    }
    else {
    }
  }
  else
  {
      $_SESSION['email_exist'] = "Sähköpostiosoitetta ei ole tietokannassa";
      mysqli_error($conn);
  }
}

else {
  $_SESSION['error'] = 'Varmista että kaikki tiedot ovat täytettyinä.';

}
header('Location: settings.php');
