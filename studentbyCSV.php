<?php

/**
 * Created by PhpStorm.
 * User: nguyenlinh
 * Date: 21/03/2017
 * Time: 15.55
 */
include 'config.php';
ini_set('display_errors', 1);
// error_reporting(E_ALL);
// session_start();

function better_crypt($input, $rounds = 10)
{
    $crypt_options = array(
        'cost' => $rounds
    );
    return password_hash($input, PASSWORD_BCRYPT, $crypt_options);
}

$file = $_FILES["studentFile"]["tmp_name"];
$handle = fopen($file,"r");
$i = 0;
$f = 0;
$t = 0;
$o = 0;
$arr = array();
$arrf = array();
$arro = array();




//loop through the csv file and insert into database


while ($data = fgetcsv($handle,1000, ";", '"' ))
{

  if ($data && $data[0] != '' && $data[1] != '' && $data[2] != ''  && $data[3] != '') {

    if (!filter_var($data[0], FILTER_VALIDATE_EMAIL)) {
      $arro[] = $data['0'];
      $o++;
      $_SESSION['format'] = "".$o ." sähköpostiosoitetta ei kelpaa:</br>". implode("<br>",$arro) ."";
      }

      else {
      $insertToUser = mysqli_query($conn, "INSERT INTO user (Email,First_name, Last_name, Password, user_type_id ) VALUES ('".$data[0]."','".$data[1]."','".$data[2]."','".better_crypt(Kultmob1)."', 3)");

      if(!$insertToUser) {
        $arr[] = $data['0'];
        $t++;
        $_SESSION['email_taken'] = "". $t ." sähköpostiosoitetta jo järjestelmässä:</br>". implode("<br>",$arr) ."";
        }

        elseif ($insertToUser) {
          $i++;
          $query = "SELECT user_id FROM user WHERE Email = '".$data[0]."'";
          $result = mysqli_query($conn, $query);

          while($row = mysqli_fetch_array($result)) {
              $thisStudentID = $row[0];
              echo $thisStudentID;
          }

          echo $thisStudentID.$_SESSION['schoolID'];
          $insertToStudent = mysqli_query($conn, "INSERT INTO student
          (user_id,school_id, Starting_year) VALUES ('".$thisStudentID."','".$_SESSION['schoolID']."', '".$data[3]."')");
          $_SESSION['success_registration'] = ''. $i .' uutta käyttäjää rekisteröitiin onnistuneesti.';
        }
      }
    }
    elseif ($data[0] == '' || $data[1] == '' || $data[2] == '' || $data[3] == '') {
          $arrf[] = $data['0'];
          $f++;
          $_SESSION['error'] = ''. $f .' käyttäjää ei rekisteröity, tarkista tiedot:</br>'. implode("<br>",$arrf) .'';
    }
}

// Check where to return to
if($_SESSION['isSchool'] == true){
  header('location:school.php');
}
else {
  header('location:addstudent.php');
}
//
