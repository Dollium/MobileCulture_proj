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

$ID = mysqli_real_escape_string($conn, ($_POST['instID']));
if(isset($_POST['institutionEmail']) && $_POST['institutionEmail'] != ''){

  if (!filter_var($_POST['institutionEmail'], FILTER_VALIDATE_EMAIL)) {
    $_SESSION['format'] = "Sähköpostiosoite ei kelpaa. Tarkista sähköpostin muoto.";
  }

  else {
    var_dump($_POST);
    echo "Institution id is ".$ID."";
    $insertToUser = mysqli_query($conn, "INSERT INTO user
    (Email, First_name, Last_name, Password, user_type_id ) VALUES ('".$_POST['institutionEmail']."','','','".better_crypt(Kultmob1)."', 4)");

    if(!$insertToUser){
        $_SESSION['email_taken'] = 'Sähköpostiosoite on jo käytössä.';
    }

    else {
      $query = "SELECT user_id FROM user WHERE Email = '".$_POST['institutionEmail']."'";
      $result = mysqli_query($conn, $query);

      while($row = mysqli_fetch_array($result)) {
          $thisInstID = $row[0];
      }
      // echo $thisInstID.$ID;

      $insertToInstitution = mysqli_query($conn, "UPDATE `institution` SET
      `institution_user_id` = '$thisInstID' WHERE `institution_id` = '$ID'");
      // echo  $insertToInstitution;
      $_SESSION['success_registration'] = 'Käyttäjä rekisteröity onnistuneesti';
    }
  }
}

else {
  $_SESSION['error'] = 'Antamissasi tiedoissa oli jotain vikaa. Varmista että kaikki tiedot ovat täytettyinä.';
}

header('location:addInst.php');
