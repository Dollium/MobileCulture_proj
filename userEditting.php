<?php
session_start();
include 'config.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);


$firstName = mysqli_real_escape_string($conn, $_POST['eName']);
$lastName = mysqli_real_escape_string($conn, $_POST['eSurName']);
$Email = mysqli_real_escape_string($conn, $_POST['eEmail']);
$start_year = mysqli_real_escape_string($conn, $_POST['eYear']);
$student_school = mysqli_real_escape_string($conn, $_POST['eSchool']);
$user_id = mysqli_real_escape_string($conn, $_POST['eID']);



if(strlen($firstName)>0 && strlen($lastName)>0 && strlen($Email)>0 && strlen($start_year)>0 && strlen($student_school)>0 && strlen($student_school)>0){
    $query = "UPDATE user 
      SET First_name='".$firstName."', Last_name='".$lastName."', Email='".$Email."' 
      WHERE user_id='".$user_id."'";

    if (mysqli_query($conn, $query)) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    $updateQuery = "UPDATE student 
      SET school_id='".$student_school."', Starting_year='".$start_year."'
      WHERE user_id='".$user_id."'";
    if (mysqli_query($conn, $updateQuery)) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}


// check if page was accessed through submitting data
//if(isset($_POST['submit']))
//{
//    if (mysqli_query($conn, "START TRANSACTION;
//      UPDATE user
//      SET First_name='".$firstName."', Last_name='".$lastName."', Email='".$Email."'
//      WHERE user_id='".$user_id."';UPDATE student
//      SET school_id='".$student_school."', Starting_year='".$start_year."'
//      WHERE user_id='".$user_id."';
//
//      COMMIT;")) {
//        $_SESSION['update_status'] = "Opiskelija on vaihdettu onnistuneesti.";
//    }
//    else { $_SESSION['update_status'] = "Varmista että kaikki tiedot ovat täytettyinä.";}
//}

$sql = "SELECT us.user_id as userid, us.First_name as First_name, us.Last_name as Last_name, us.Email as Email, scl.Name as school_name, scl.school_id as scl_id, stu.Starting_year as Year
              FROM user AS us
              LEFT JOIN student AS stu ON stu.user_id = us.user_id
              LEFT JOIN school AS scl ON stu.school_id = scl.school_id
              WHERE us.user_type_id ='3'
              AND scl.school_id = '".$_SESSION['currentShowingSchool']."'
              ORDER BY stu.Starting_year DESC, us.Last_name ASC";
echo $sql;

$result = $conn->query($sql);
    echo '<tr>
                            <th><input type="checkbox" id="checkAll"></th>
                            <th>Nimi</th>
                            <th>Sukunimi</th>
                            <th>Sähköposti</th>
                            <th>Koulu</th>
                            <th>Aloitusvuosi</th>
                            <th>Päivitä</th>
                            <th>Poista</th>
                            <th class="mobile"> Rekisteröidyt käyttäjät </th>
                        </tr>';

// Loop the results to make a table
while($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo '<td class="checkbox"><input type="checkbox" name="box[]" value=' . $row['userid'] . '></td>';
    echo "<td>" . $row['First_name'] . "</td>";
    echo "<td>" . $row['Last_name'] . "</td>";
    echo "<td>" . $row['Email'] . "</td>";
    echo "<td>" . $row['school_name'] . "</td>";
    echo "<td>" . $row['Year'] . "</td>";
    echo '<td><i class="fa fa-pencil-square-o" aria-hidden="true" onclick="updateStudentInfo(' . $row['userid'] . ', event)"></i></label>' .

        '</td>';
    echo "<td>" . $row['Year'] . "</td>";
    echo '<td><a href="Delete.php?did=' . $row['userid'] . '" onclick="return deleteConfirm()" id="delete"><label for="delete"><i class="fa fa-times" aria-hidden="true"></i></label></a></td>';
    echo "</tr>";
}