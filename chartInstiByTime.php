<?php
/**
 * Created by PhpStorm.
 * User: nguyenlinh
 * Date: 06/05/2017
 * Time: 11.21
 */
session_start();
include 'config.php';
//ini_set('display_errors', 1);
//error_reporting(E_ALL);
header('Context-type: text/javascript');


    $institution = array();
    $array = array();
    array_push($array, 'Institution', 'Number of Visit');
    array_push($institution, $array);

    $instiQuery = "SELECT Name, visit_number FROM institution LEFT OUTER JOIN 
    (SELECT `institution_id`, `time`, COUNT(institution_id) AS visit_number FROM `student_visits` 
	WHERE time BETWEEN '".$_POST['startDate']."' AND '".$_POST['endDate']."' group BY institution_id) 
    AS visits ON institution.institution_id = visits.institution_id";

//    echo $instiQuery;
    $instiResult = mysqli_query($conn, $instiQuery);

    while($row = mysqli_fetch_array($instiResult))
    {
        $array = array();
        array_push($array,$row['Name'],$row['visit_number']);
        array_push($institution,$array);
    }
    echo json_encode($institution);