<?php
/**
 * Created by PhpStorm.
 * User: nguyenlinh
 * Date: 01/05/2017
 * Time: 0.32
 */
session_start();
include 'config.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Context-type: text/javascript');


//INSTITUTION ARRAY
$institution = array('School');

$instiQuery = "SELECT Name FROM `institution`";
$instiResult = mysqli_query($conn, $instiQuery);

while($row = mysqli_fetch_array($instiResult))
{
    array_push($institution, $row['Name']);
}

//echo  json_encode($institution);

// SCHOOL 1 visit;
$school1 = array('Kannaksen lukio ');
$school1Query= "SELECT Name, institution_id, visit_number from school join
                (SELECT school_id, institution_id, COUNT(institution_id) as visit_number FROM student_visits LEFT OUTER JOIN student
                on student_visits.user_id = student.user_id WHERE school_id = 1
                AND time BETWEEN '".$_POST['startDate']."' AND '".$_POST['endDate']."' 
                GROUP BY institution_id, school_id )
                as school_visit on school.school_id = school_visit.school_id ORDER by school.school_id, institution_id ASC";
//echo $school1Query;
$school1Result = mysqli_query($conn, $school1Query);
while($row = mysqli_fetch_object($school1Result))
{
//    array_push($school1,  $row['institution_id']=$row['visit_number']);
//    printf ("%s (%s)\n", $row->institution_id, $row->visit_number);
    array_push($school1, $row);

}


//SCHOOL 2 VISIT
$school2 = array('Tiirismaan lukio ');
$school2Query= "SELECT Name, institution_id, visit_number from school join
                (SELECT school_id, institution_id, COUNT(institution_id) as visit_number FROM student_visits LEFT OUTER JOIN student
                on student_visits.user_id = student.user_id WHERE school_id = 2 
                AND time BETWEEN '".$_POST['startDate']."' AND '".$_POST['endDate']."' 
                GROUP BY institution_id, school_id)
                as school_visit on school.school_id = school_visit.school_id ORDER by school.school_id, institution_id ASC";
$school2Result = mysqli_query($conn, $school2Query);

while($row = mysqli_fetch_object($school2Result))
{
    array_push($school2, $row);
}


//SCHOOL 3 VISIT
$school3 = array('Lahden lyseo ');
$school3Query= "SELECT Name, institution_id, visit_number from school join
                (SELECT school_id, institution_id, COUNT(institution_id) as visit_number FROM student_visits LEFT OUTER JOIN student
                on student_visits.user_id = student.user_id WHERE school_id = 3 AND time BETWEEN '".$_POST['startDate']."' AND '".$_POST['endDate']."' 
                GROUP BY institution_id, school_id )
                as school_visit on school.school_id = school_visit.school_id ORDER by school.school_id, institution_id ASC";
$school3Result = mysqli_query($conn, $school3Query);
while($row = mysqli_fetch_object($school3Result))
{
    array_push($school3, $row);
}
//echo json_encode($school3);
//SCHOOL 2 VISIT
$school4 = array('Nastopolin lukio ');
$school4Query= "SELECT Name, institution_id, visit_number from school join
                (SELECT school_id, institution_id, COUNT(institution_id) as visit_number FROM student_visits LEFT OUTER JOIN student
                on student_visits.user_id = student.user_id WHERE school_id = 4 
                AND time BETWEEN '".$_POST['startDate']."' AND '".$_POST['endDate']."'
                GROUP BY institution_id, school_id )
                as school_visit on school.school_id = school_visit.school_id ORDER by school.school_id, institution_id ASC";
$school4Result = mysqli_query($conn, $school4Query);
while($row = mysqli_fetch_object($school4Result))
{
    array_push($school4, $row);
}


$json = array(
    $institution,
    $school1,
    $school2,
    $school3,
    $school4

);
echo json_encode($json);
