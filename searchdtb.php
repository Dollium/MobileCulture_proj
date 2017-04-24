<?php
include 'config.php';
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
// Escape user inputs for security
$term = mysqli_real_escape_string($conn, $_REQUEST['term']);

if(isset($term)){
    // Attempt select query execution
    $sql = "SELECT * FROM user WHERE Email LIKE '" . $term . "%'";
    if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                echo "<p>" . $row['name'] . "</p>";
            }
            // Close result set
            mysqli_free_result($result);
        } else{
            echo "<p>No matches found</p>";
        }
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }
}

// close connection
mysqli_close($conn);
?>
