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
 if(isset($_POST['nameManually'])&& $_POST['surNameManually'] && $_POST['emailManually']){
     var_dump($_POST);
     echo "School Id is ".$_SESSION['schoolID'];
     $insertToUser = mysqli_query($conn, "INSERT INTO user
     (Email,First_name, Last_name, Password, user_type_id ) VALUES ('".$_POST['emailManually']."','".$_POST['nameManually']."','".$_POST['surNameManually']."','".md5(123456)."'
 , 2)");
     if(!$insertToUser){
         echo ("<SCRIPT LANGUAGE='JavaScript'>
         window.alert(\"Some one have taken this email!!!!\")
         window.location.href='addstudent.php'
         </SCRIPT>");
     }

     $query = "SELECT user_id FROM user WHERE Email = '".$_POST['emailManually']."'";
     $result = mysqli_query($conn, $query);
     while($row = mysqli_fetch_array($result))
     {
         $thisTeacherID = $row[0];

     }
  echo $thisTeacherID.$_SESSION['schoolID'];

     $insertToTeacher = mysqli_query($conn, "INSERT INTO teachers_in_schools
     (user_id,school_id) VALUES ('".$thisTeacherID."','".$_SESSION['schoolID']."')");
     echo   $insertToTeacher;

 }
