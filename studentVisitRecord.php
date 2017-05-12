<?php
include 'config.php';
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
$ID = $_SESSION['id'];

    $code = $_POST['institutionCode'];
    $numbercode= substr($code,2,6);
    $inst = $numbercode % 7;
    $week = date('W');
    $year = date('o');
    $week_year_value= $week . "_" . $year;


    $sql = "SELECT * FROM institution_code_".$inst." WHERE week_year='$week_year_value'";
    $result= mysqli_query($conn,$sql);
    while ($row = $result->fetch_assoc()) {

      if($row['week_year'] == $week_year_value && $row['code'] == $code){
      $q = mysqli_query($conn, "INSERT INTO `student_visits`(`user_id`, `institution_id`, `time`) VALUES ('$ID','$inst',NOW())");
      }
      else
      {
        echo "Wrong code";
      }
      header('location: studentVisitLog.php');

    }

          ?>
