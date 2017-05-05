<?php
include 'config.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();


if(isset($_GET['did']))
{
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

        if($sql3)
        {
          $_SESSION['delete_success'] = "Käyttäjä poistettu onnistuneesti";
        }
      }
    }
    else
    {
      $_SESSION['delete_unsuccess'] = "Poisto epäonnistui.";
    }
  }


    // Deletion through checkboxes
elseif($_POST["dltBox"]) {
    // Loop through each selection
    if(isset($_POST['box']))
    {
      foreach($_REQUEST['box'] as $val)
      {

        $delIds = array($val);

        //var_dump($delIds);

        $delSql = implode(",", $delIds);

        // Delete users
        $sql = mysqli_query($conn, "DELETE FROM user WHERE user_id IN ($delSql)");
        echo "Deletion successful!";
        if($sql)
        {
            $sql = mysqli_query($conn, "DELETE FROM student WHERE user_id IN ($delSql)");
            if($sql2)
            {

              $sql = mysqli_query($conn, "DELETE FROM student_visits WHERE user_id IN ($delSql)");
              $_SESSION['delete_success'] = "Käyttäjä poistettu onnistuneesti";

            }
          }
          else {
              $_SESSION['delete_unsuccess'] = "Poisto epäonnistui.";
            }
      }
    }
    else {
      $_SESSION['no_delete'] = "Poisto epäonnistui. Ei valittuja käyttäjiä.";
    }
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
