<?php
include 'config.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();


if(isset($_GET['did'])) {
    $delete_id = mysqli_real_escape_string($conn, $_GET['did']);
    $sql = mysqli_multi_query($conn, "DELETE FROM user WHERE user_id = '".$delete_id."'");
    if($sql)
    {

        $delete_id = mysqli_real_escape_string($conn, $_GET['did']);
        $sql2 = mysqli_query($conn, "DELETE FROM student WHERE user_id = '".$delete_id."'");


        if($sql2)
        {
          $delete_id = mysqli_real_escape_string($conn, $_GET['did']);
          $sql3 = mysqli_query($conn, "DELETE FROM student_visits WHERE user_id = '".$delete_id."'");
          echo "<br/><br/><span>deleted successfully...!!</span>";

        }
        else {
            echo "no, HERE";
          }
      }
      else {
          echo "ERROR HERE";
        }
    }

    // Deletion through checkboxes
elseif($_POST["dltBox"]) {
    // Loop through each selection
      foreach($_REQUEST['box'] as $val)
      {

        $delIds = array($val);

        //var_dump($delIds);

        $delSql = implode(",", $delIds);

        // Delete users
        mysqli_query($conn, "DELETE FROM user WHERE user_id IN ($delSql)");
        echo "Deletion successful!";
      }
}

else {
  echo "ERROR";
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
