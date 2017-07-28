<?php
session_start();
include 'config.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

function better_crypt($input, $rounds = 10)
{
    $crypt_options = array(
        'cost' => $rounds
    );
    return password_hash($input, PASSWORD_BCRYPT, $crypt_options);
}

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

$_SESSION['username'] = $username;

$sql = "SELECT * FROM user WHERE Email='$username'";
$result= mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)) {
    $password_hash = $row['Password'];
    $_SESSION['password'] = $row['Password'];
  	$userID = $row['user_id'];
  	$user_type = $row['user_type_id'];
}
if (empty($username) || empty($password)) {
    $_SESSION['field_null'] = 'Username and password required';
    header('location:index.php');

}
else {
    if (!password_verify($password, $password_hash)) {
	     // echo password_verify($password, $password_hash);
        $_SESSION['error'] = 'Username or password incorrect.';
         header('location:index.php');
    }
    else {
	     $_SESSION['id'] = $userID;

        if ($password == 'Kultmob1') {
            $_SESSION["isStudent"] = false;
            $_SESSION["isAdmin"] = false;
            $_SESSION["isInst"] = false;
            $_SESSION["isSchool"] = false;
            $_SESSION["First"] = true;

            header('location:newPassword.php');
        }
        else {

            if ($user_type == 3) {
                $_SESSION["isStudent"] = true;
                $_SESSION["isAdmin"] = false;
                $_SESSION["isInst"] = false;
                $_SESSION["isSchool"] = false;
                $_SESSION["First"] = false;

                header('location:student.php');
            }
            elseif ($user_type == 4) {
                $_SESSION["isStudent"] = false;
                $_SESSION["isAdmin"] = false;
                $_SESSION["isInst"] = true;
                $_SESSION["isSchool"] = false;
                $_SESSION["First"] = false;

                header('location:Institution.php');
            }
            elseif ($user_type == 1) {
                $_SESSION["isStudent"] = false;
                $_SESSION["isAdmin"] = false;
                $_SESSION["isInst"] = false;
                $_SESSION["isSchool"] = true;
                $_SESSION["First"] = false;

                header('location:school.php');
            }
            elseif ($user_type == 0) {
                $_SESSION["isStudent"] = false;
                $_SESSION["isAdmin"] = true;
                $_SESSION["isInst"] = false;
                $_SESSION["isSchool"] = false;
                $_SESSION["First"] = false;

                header('location:admin.php');
            }
            else {
                'Your authorization level has not been set.';
            }
        }
    }
}
