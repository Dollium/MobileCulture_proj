<?php
/**
 * Created by PhpStorm.
 * User: nguyenlinh
 * Date: 20/03/2017
 * Time: 23.29
 */
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
$schoolID = mysqli_real_escape_string($conn, ($_POST['schoolID']));

if(isset($_POST['name']) && $_POST['surname'] && $_POST['email'] && $_POST['name'] != '' && $_POST['surname'] != '' && $_POST['email'] != ''){

  // validate email
  if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $_SESSION['format'] = "Sähköpostiosoite ei kelpaa. Tarkista sähköpostin muoto.";
  }
  // if email is valid, continue
  else {
    // var_dump($_POST);
    // echo "School Id is ".$ID;
    $insertToUser = mysqli_query($conn, "INSERT INTO user
    (Email,First_name, Last_name, Password, user_type_id ) VALUES ('".$_POST['email']."','".$_POST['name']."','".$_POST['surname']."','".better_crypt(Kultmob1)."', 1)");

    // check if email is already in database
    if(!$insertToUser){
      $_SESSION['email_taken'] = 'Sähköpostiosoite on jo käytössä.';
    }

    else {
      $query = "SELECT user_id FROM user WHERE Email = '".$_POST['email']."'";
      $result = mysqli_query($conn, $query);

      while($row = mysqli_fetch_array($result))
      {
          $schoolAdminID = $row[0];

      }
      // echo $thisSchoolID.$ID;

      $insertToSchool = mysqli_query($conn, "INSERT INTO `school_admin_users` VALUES ($schoolID, $schoolAdminID)");
      // echo  $insertToSchool;
      $_SESSION['success_registration'] = 'Käyttäjä rekisteröity onnistuneesti.';
    }
  }
}
// information is missing or other
else {
  $_SESSION['error'] = 'Antamissasi tiedoissa oli jotain vikaa. Varmista että kaikki tiedot ovat täytettyinä.';
}
header('location:addSclAd.php');
