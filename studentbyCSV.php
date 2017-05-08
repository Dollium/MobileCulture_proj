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
$file = $_FILES["studentFile"]["tmp_name"];
$handle = fopen($file,"r");
$i = 0;
$f = 0;
$t = 0;
$arr = array();
$arrf = array();
//loop through the csv file and insert into database
while ($data = fgetcsv($handle,1000, ";", '"' ))
    {
      if ($data && $data[0] != '' && $data[1] != '' && $data[2] != ''  && $data[3] != '') {
          $insertToUser = mysqli_query($conn, "INSERT INTO user (Email,First_name, Last_name, Password, user_type_id ) VALUES ('".$data[0]."','".$data[1]."','".$data[2]."','".md5(123456)."', 3)");
          $i++;
          if(!$insertToUser){
            $arr[] = $data['0'];

            $t++;
            $_SESSION['email_taken'] = "".$t ." emails already in database:</br>". implode("<br>",$arr) ."";
            }
            else {
              $query = "SELECT user_id FROM user WHERE Email = '".$data[0]."'";
              $result = mysqli_query($conn, $query);
              while($row = mysqli_fetch_array($result))
              {
                  $thisStudentID = $row[0];
                  echo $thisStudentID;

              }
              echo $thisStudentID.$_SESSION['schoolID'];

              $insertToStudent = mysqli_query($conn, "INSERT INTO student
          (user_id,school_id, Starting_year) VALUES ('".$thisStudentID."','".$_SESSION['schoolID']."', '".$data[3]."')");
      //        echo   $insertToStudent;
        $_SESSION['success_registration'] = ''. $i .' users have successfully been registered';
          }

        }
        elseif ($data[0] == '' || $data[1] == '' || $data[2] == '' || $data[3] == '') {
              $arrf[] = $data['0'];
              $f++;
              $_SESSION['error'] = 'Failed to register '. $f .' users:</br>'. implode("<br>",$arrf) .'';
            }

}
if($_SESSION['isSchool'] == true)
{
header('location:school.php');
}
else {
  header('location:addstudent_resp.php');
}
//
