<?php
/**
 * Created by PhpStorm.
 * User: nguyenlinh
 * Date: 21/03/2017
 * Time: 15.55
 */
include 'config.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
// Set path to CSV file
//function readCSV($csvFile)
//{
//    $file_handle = fopen($csvFile, 'r');
//    echo  $file_handle;
//    while (!feof($file_handle)) {
//        $line_of_text[] = fgetcsv($file_handle, 1024);
//        echo "mo duoc file";
//    }
//    fclose($file_handle);
//    return $line_of_text;
//    echo $csvFile;
//    echo "meo";
//}
////// Set path to CSV file
//$csvFile = $_FILES["studentFile"]["name"];
//
//$csv = readCSV($csvFile);
//echo '<pre>';
//print_r($csv);
//echo '</pre>';

//get the csv file
$file = $_FILES["teacherFile"]["tmp_name"];
$handle = fopen($file,"r");

//loop through the csv file and insert into database
while ($data = fgetcsv($handle,1000, ";", '"' ))
    {
    if ($data) {
        $insertToUser = mysqli_query($conn, "INSERT INTO user
    (Email,First_name, Last_name, Password, user_type_id ) VALUES ('".$data[0]."','".$data[1]."','".$data[2]."','".md5(123456)."'
, 2)");
////        echo $data[1];
//        echo $data[0];
//        echo $data[1];
    }


        $query = "SELECT user_id FROM user WHERE Email = '".$data[0]."'";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result))
        {
            $thisTeacherID = $row[0];
            echo $thisTeacherID;

        }
        echo $thisTeacherID.$_SESSION['schoolID'];

        $insertToTeach = mysqli_query($conn, "INSERT INTO teachers_in_schools
    (user_id,school_id) VALUES ('".$thisTeacherID."','".$_SESSION['schoolID']."')");
//        echo   $insertToStudent;

    }

//
