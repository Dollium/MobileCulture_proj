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
$ID = $_SESSION['instID'];
if(isset($_POST['institutionEmail'])){
    var_dump($_POST);
    echo "Institution id is ".$_SESSION['instID']."";
    $insertToUser = mysqli_query($conn, "INSERT INTO user
    (Email, Password, user_type_id ) VALUES ('".$_POST['institutionEmail']."','".md5(123456)."'
, 4)");
    if(!$insertToUser){
        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert(\"Some one have taken this email!!!!\")
        window.location.href='addstudent.php'
        </SCRIPT>");
    }

    $query = "SELECT user_id FROM user WHERE Email = '".$_POST['institutionEmail']."'";
    $result = mysqli_query($conn, $query);

    while($row = mysqli_fetch_array($result))
    {
        $thisInstID = $row[0];

    }
 echo $thisInstID.$_SESSION['instID'];

    $insertToInstitution = mysqli_query($conn, "UPDATE `institution` SET
    `institution_user_id` = '$thisInstID' WHERE `institution_id` = '$ID'");
    echo  $insertToInstitution;

}
