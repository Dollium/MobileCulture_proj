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

if(isset($_POST['name']) && $_POST['surName'] && $_POST['email'] && $_POST['year']
&& $_POST['name'] != '' && $_POST['surName'] != '' && $_POST['email'] != '' && $_POST['email'] != '')
{
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $_SESSION['format'] = "Sähköpostiosoite ei kelpaa. Tarkista sähköpostin muoto.";
    }

    else {
    // var_dump($_POST);
    // echo "School Id is ".$_SESSION['schoolID'];
    $insertToUser = mysqli_query($conn, "INSERT INTO user
    (Email,First_name, Last_name, Password, user_type_id ) VALUES ('".$_POST['email']."','".$_POST['name']."','".$_POST['surName']."','".better_crypt(Kultmob1)."', 3)");

    if(!$insertToUser){
      $_SESSION['email_taken'] = 'Sähköpostiosoite jo järjestelmässä.';
    }

    else {
      $query = "SELECT user_id FROM user WHERE Email = '".$_POST['email']."'";
      $result = mysqli_query($conn, $query);

      while($row = mysqli_fetch_array($result))
      {
          $thisStudentID = $row[0];
      }

      // echo $thisStudentID.$_SESSION['schoolID'];
      $insertToStudent = mysqli_query($conn, "INSERT INTO student
      (user_id, school_id, Starting_year) VALUES ('".$thisStudentID."','".$_SESSION['schoolID']."', '". $_POST['year'] ."')");
      // echo  $insertToStudent;
      $_SESSION['success_registration'] = 'Käyttäjä rekisteröity onnistuneesti';

    }
  }
}
else {
  $_SESSION['error'] = 'Antamissasi tiedoissa oli jotain vikaa. Varmista että kaikki tiedot ovat täytettyinä.';
}

// Check where to return to
if($_SESSION['isSchool'] == true) {
  header('location:school.php');
}
else {
  header('location:addstudent.php');
}
