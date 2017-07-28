<?php
include 'config.php';
session_start();
// ini_set('display_errors', 1);
// error_reporting(E_ALL);


if ($_SESSION["isAdmin"] == true)
{
// Escape user inputs for security
$term = mysqli_real_escape_string($conn, $_REQUEST['term']);

if(isset($term)){
    // Attempt SELECT query execution
    $sql = "SELECT * FROM user WHERE Email LIKE '" . $term . "%'";
    if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                echo "<p>" . $row['Email'] . "</p>";
            }
            // Close result set
            mysqli_free_result($result);
        } else{
            echo "<p>Ei tuloksia</p>";
        }
    } else{
        echo "ERROR: COULDN'T EXECUTE $sql. " . mysqli_error($conn);
    }
}
}
elseif ($_SESSION["isSchool"] == true)
{
  $sID = $_SESSION['schoolID'];
  // Escape user inputs for security
  $term = mysqli_real_escape_string($conn, $_REQUEST['term']);

  if(isset($term)){
      // Attempt select query execution
      $sql = "SELECT * FROM user LEFT JOIN student ON user.user_id = student.user_id WHERE user_type_id = '3' AND school_id = '$sID' AND Email LIKE '" . $term . "%'";
      if($result = mysqli_query($conn, $sql)){
          if(mysqli_num_rows($result) > 0){
              while($row = mysqli_fetch_array($result)){
                  echo "<p>" . $row['Email'] . "</p>";
              }
              // Close result set
              mysqli_free_result($result);
          } else{
              echo "<p>Ei tuloksia</p>";
          }
      } else{
          echo "ERROR: COULDN'T EXECUTE $sql. " . mysqli_error($conn);
      }
  }
}
// close connection
mysqli_close($conn);
?>
