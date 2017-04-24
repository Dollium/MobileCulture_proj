<?php
session_start();
include 'config.php';

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, md5($_POST['password']));

$_SESSION['username'] = $username;
$_SESSION['password'] = $password;


$sql = "SELECT * FROM user WHERE Email='$username' AND Password='$password'";
$result= mysqli_query($conn,$sql);

if (empty($username) || empty($password))
{
  $_SESSION['field_null'] = 'Username and password required';
  header('location:index.php');
  exit;
  }
else {
  if (!$row = $result->fetch_assoc()) {

    $_SESSION['error'] = 'Username or password incorrect.';
    header('location:index.php');
    exit;
   }
   else {
     $_SESSION['id'] = $row['user_id'];


     if($password == md5('123456')){
       $_SESSION["isStudent"] = false;
       $_SESSION["isAdmin"] = false;
       $_SESSION["isTeacher"] = false;
       $_SESSION["isSchool"] = false;

      header('location:newPassword.php');

     }
     else
     {

     if ($row['user_type_id'] == 3)
      {
        $_SESSION["isStudent"] = true;
        $_SESSION["isAdmin"] = false;
        $_SESSION["isTeacher"] = false;
        $_SESSION["isSchool"] = false;



        header('location:student.php');
      }
      elseif ($row['user_type_id'] == 2)
      {
        $_SESSION["isStudent"] = false;
        $_SESSION["isAdmin"] = false;
        $_SESSION["isTeacher"] = true;
        $_SESSION["isSchool"] = false;

        header('location:teacher.php');
      }
      elseif ($row['user_type_id'] == 1)
      {
        $_SESSION["isStudent"] = false;
        $_SESSION["isAdmin"] = false;
        $_SESSION["isTeacher"] = false;
        $_SESSION["isSchool"] = true;

        header('location:school.php');
      }
      elseif ($row['user_type_id'] == 0)
      {
        $_SESSION["isStudent"] = false;
        $_SESSION["isAdmin"] = true;
        $_SESSION["isTeacher"] = false;
        $_SESSION["isSchool"] = false;

        header('location:admin.php');
      }

      else {
        'Your authorization level has not been set.';
      }
    }
   }
}
