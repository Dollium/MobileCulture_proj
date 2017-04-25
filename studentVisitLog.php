<?php
include 'config.php';
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
$ID = $_SESSION['id'];
// print_r($_SESSION);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

    <title>Title</title>
</head>

<body>
    <div class="col-lg-8 container" style="background-color: #FFF;">
        <div class="row">
            <!-- NAV -->
            <nav class="col-lg-12 navbar navbar-toggleable-md navbar-inverse bg-primary centered">
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
                <a class="navbar-brand" href="#">Student Visitation Log</a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="student.php">
                                <i class="fa fa-home" aria-hidden="true"></i> Profile <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="studentVisitLog.php">
                                <i class="fa fa-user-circle-o" aria-hidden="true"></i> Log
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#offers">
                                <i class="fa fa-code" aria-hidden="true"></i> Offers
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#projects">
                                <i class="fa fa-cog" aria-hidden="true"></i> Setting
                            </a>
                        </li>
                    </ul>
                    <a class="navbar-brand pull-sm-right mr-0" style="padding-right: 30px;" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>
                    </a>
                </div>
            </nav>
            <br>
        </div>
        <!-- /NAV -->
<br/>
        <!-- INSTITUTION  LIST-->
        <form name="inst" class="form-inline" method="post">
            <div class="text-sm-center">
              <select class="custom-select mb-2 mr-sm-2 mb-sm-0 institution" name="institution" id="institution">
                  <?php
                  $query = "SELECT * FROM institution";
                  $result = mysqli_query($conn, $query);
                  while($row = mysqli_fetch_array($result))
                  {
                     echo  "<option value=". $row["institution_id"] ." selected>".$row["Name"]."</option>";
                  }
                  ?>

            </select>
                  <button type="submit" class="btn btn-primary">Submit</button>
              </div>

        </form>
<br/>

        <form  method="POST">
            <button name="scan" type="submit" class="btn btn-primary scan">Scan QR</button>
        </form>
        <br/>
        <?php

        if (isset($_POST['institution'])){
            $_SESSION['inst'] = mysqli_real_escape_string($conn, ($_POST['institution']));
$inst = $_SESSION['inst'];

        }

        ?>
        <?php if(isset($_POST['date'])){
        $q = mysqli_query($conn, "INSERT INTO `student_visits`(`user_id`, `institution_id`, `time`) VALUES ('$ID','$inst',NOW())");

        }
        ?>

        <!-- INSTITUTION LIST -->
        <div class="logTable">
            <table>
              <?php

              $sql = "SELECT vi.time as visit_time, ins.Name as name, vi.user_id as id FROM user as us LEFT JOIN student_visits AS vi ON vi.user_id = us.user_id LEFT JOIN institution AS ins ON ins.institution_id = vi.institution_id WHERE vi.user_id = '$ID' ORDER BY visit_time DESC LIMIT 10";

              $result = $conn->query($sql);

              while($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $row["name"]. " </td><td> " . $row["id"]. " </td><td> " . $row["visit_time"]. "</td></tr>";
            } ?>
            </table>
        </div>


    </div>


    <!-- jQuery first, then bootstrap js -->

    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</body>

</html>
