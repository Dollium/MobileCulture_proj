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

    if(empty($_POST['institutionCode']))
    {
      $_SESSION['insert_code'] = "Koodia ei syötetty!";
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit();
    }

    else {
    $sql = "SELECT * FROM institution_code_".$inst." WHERE week_year='$week_year_value'";
    $result= mysqli_query($conn,$sql);
    // echo $inst;

    if ($inst == '0')
    {
      $_SESSION['wrong_code'] = "Koodi ei kelvollinen!";
    }

    else {
      while ($row = $result->fetch_assoc()) {
        if($row['week_year'] == $week_year_value && $row['code'] == $code){
        $q = mysqli_query($conn, "INSERT INTO `student_visits`(`user_id`, `institution_id`, `time`) VALUES ('$ID','$inst',NOW())");
        $_SESSION['code_success'] = "Käynti kirjattu onnistuneesti!";
        }
        else {
          $_SESSION['wrong_code'] = "Koodi ei kelvollinen!";
        }
      }
    }
  }
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
