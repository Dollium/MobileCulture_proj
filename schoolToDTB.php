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
$ID = mysqli_real_escape_string($conn, ($_POST['schoolID']));

if(isset($_POST['name'])&& $_POST['surname'] && $_POST['email']){
    var_dump($_POST);
    echo "School Id is ".$ID;
    $insertToUser = mysqli_query($conn, "INSERT INTO user
    (Email,First_name, Last_name, Password, user_type_id ) VALUES ('".$_POST['email']."','".$_POST['name']."','".$_POST['surname']."','".md5(123456)."'
, 1)");

    if(!$insertToUser){
      $_SESSION['email_taken'] = 'This email is already in the database.';
    }

    else {
      $query = "SELECT user_id FROM user WHERE Email = '".$_POST['email']."'";
      $result = mysqli_query($conn, $query);
      while($row = mysqli_fetch_array($result))
      {
          $thisSchoolID = $row[0];

      }
   echo $thisSchoolID.$ID;

      $insertToSchool = mysqli_query($conn, "UPDATE `school` SET
      `school_admin_id` = '$thisSchoolID' WHERE `school_id` = '$ID'");
      echo  $insertToSchool;
      $_SESSION['success_registration'] = 'The user has successfully been registered';

        }

    }

else {
      $_SESSION['error'] = 'There was an error with your input. Please make sure all fields are filled out.';
}
header('location:addSclAd.php');
