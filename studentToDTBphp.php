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

if(isset($_POST['name']) && isset($_POST['surName']) && isset($_POST['email'])){
    var_dump($_POST);
    echo "School Id is ".$_SESSION['schoolID'];
    $insertToUser = mysqli_query($conn, "INSERT INTO user
    (Email,First_name, Last_name, Password, user_type_id ) VALUES ('".$_POST['email']."','".$_POST['name']."','".$_POST['surName']."','".md5(123456)."', 3)");

    if(!$insertToUser){
          $_SESSION['email_taken'] = 'This email is already in the database.';

    }

    $query = "SELECT user_id FROM user WHERE Email = '".$_POST['email']."'";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result))
    {
        $thisStudentID = $row[0];
    }

    echo $thisStudentID.$_SESSION['schoolID'];

    $insertToStudent = mysqli_query($conn, "INSERT INTO student
    (user_id, school_id, Starting_year) VALUES ('".$thisStudentID."','".$_SESSION['schoolID']."', '". $_POST['year'] ."')");
    echo   $insertToStudent;
    $_SESSION['success_registration'] = 'The user has successfully been registered';
}
else {
  echo "ERROR";
}
header('location:addstudent_resp.php');
