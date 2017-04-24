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
$ID = mysqli_real_escape_string($conn, ($_POST['instID']));
if(isset($_POST['institutionEmail']) && $_POST['institutionEmail'] != ''){
    var_dump($_POST);

    echo "Institution id is ".$ID."";
    $insertToUser = mysqli_query($conn, "INSERT INTO user
    (Email, Password, user_type_id ) VALUES ('".$_POST['institutionEmail']."','".md5(123456)."'
, 4)");
    if(!$insertToUser){
        $_SESSION['email_taken'] = 'This email is already in the database.';
    }
    else {
      $query = "SELECT user_id FROM user WHERE Email = '".$_POST['institutionEmail']."'";
      $result = mysqli_query($conn, $query);

      while($row = mysqli_fetch_array($result))
      {
          $thisInstID = $row[0];

      }
   echo $thisInstID.$ID;

      $insertToInstitution = mysqli_query($conn, "UPDATE `institution` SET
      `institution_user_id` = '$thisInstID' WHERE `institution_id` = '$ID'");
      echo  $insertToInstitution;
      $_SESSION['success_registration'] = 'The user has successfully been registered';

  }

    }

else {
      $_SESSION['error'] = 'There was an error with your input. Please make sure all fields are filled out.';
}
header('location:addInst.php');
