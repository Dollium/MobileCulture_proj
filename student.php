<!DOCTYPE html>
<html lang="en">
<?php

session_start();
include 'config.php';


//ini_set('display_errors', 1);
//error_reporting(E_ALL);

$username = $_SESSION['username'];
$password = $_SESSION['password'];
$ID = $_SESSION['id'];

$sql = "SELECT * FROM user AS us LEFT JOIN student AS stu ON stu.user_id = us.user_id LEFT JOIN school AS scl ON stu.school_id = scl.school_id WHERE Email='$username' AND Password='$password' ";
$result= mysqli_query($conn,$sql);
$row = $result->fetch_assoc();

// Show query results
// var_dump($row);
?>
<head>
    <meta charset="UTF-8">
    <title>Culture Mobile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.css">
    <link href="css/jasny-bootstrap.min.css" rel="stylesheet" media="screen">
    <style>

.photo_container
{
  height:400px;
  margin-top: 70px;
  margin-left:auto;
  margin-right:auto;
}

.photo.wrapper
{
height: 470px; text-align:center;
}
    .inputfile {
    	width: 0.1px;
    	height: 0.1px;
    	opacity: 0;
    	overflow: hidden;
    	position: absolute;
    	z-index: -1;
    }

    .inputfile + label {
        margin-top: 10px;
        padding: 0 8px 3px 8px;
        border-radius: 4px;
        font-size: 1.25em;
        font-weight: 700;
        color: white;
        background-color: #0275d8;
        display: inline-block;
    }


    label:hover, label:active, .inputfile:hover+label, .inputfile:active+label {
        background-color: #4E5066;;
    }
    .inputfile + label {
	cursor: pointer; /* "hand" cursor */
    }
    .fa-question:hover
    {
      color:#0275d8;
    }
    body {
        font-family: 'Rubik', sans-serif;
        background-image: url("talvi-4.jpg");
    }

    table {
        font-family: 'Rubik', sans-serif;
        border-collapse: collapse;
        width: 100%;


    }
    thead th{
      font-weight: 100!important;
      border-bottom:5px solid #9ea7af;
      font-size: 20px;
    }
    td, th
    {
      text-align: left;
      padding: 8px;
      font-size: 16px;
      padding-top: 10px;
      padding-bottom: 10px;
      background: #EBEBEB;
    }
    .min_visits tr{
          color: #666B85;
          border-top: 1px solid #666B85;

    }
    .min_visits tr:hover td {
        background: #4E5066;
        color: #FFFFFF;
        border-top: 1px solid #22262e;
        border-bottom: 1px solid #22262e;
      }
      .min_visits td
      {
        padding: 4px;
        padding-left: 20px;
        bor
      }
    .min_visits td:nth-child(n) {
      border-right: 1px solid #666B85;
    }
    .student_id
    {
          margin-bottom: 10px;
          margin-top: 40px;
    }
    .student_id td, .student_id th {
        font-size: 24px;
        background-color: #FFF;
    }

    .text_header
    {
      font-size: 30px;
    }
    .boldie
    {
      font-weight: bold;
    }
    #badge
    {
      color: #25b825;
    }

    .centered
    {
      margin:auto;
    }
    .bordered
    {
      border: 1px solid;
    }
    .banner_image
    {
      display:none;
    }
    .stats
    {
      margin-top: 50px;
    }
    .stat
    {
      margin-top: 20px;
      margin-bottom: 30px;
      border-radius: 20px;
      padding: 10px;
    }
    .stat_icon
    {
      border-right: 1px solid grey;
      padding:0;
      padding-left: 25px;
    }
    .restrict
    {
      font-size: 22px;

    }
    .profile_photo
     {
       /*width: 360px!important;*/
       /*height: 400px!important;*/
        width: 100%!important;
        height: 100%!important;
        border: 5px solid white;
        box-shadow: 0 0 0 1px rgba(0,0,0,0.44);
        border-radius: 5px;
     }
     #outerStuInfo
     {
       height: 470px;
       padding-right: 50px;
     }
     #studentInfo
     {
       height:400px;
       margin-top: 70px;
       padding-top:40px;
       margin-left:auto;
       margin-right:auto;
       border-radius: 10px;
     }
.min_log
{
  margin-top:70px;
}


        @media screen and (max-width: 992px) {
          label:hover, label:active, .inputfile:hover+label, .inputfile:active+label {
              color: #0275d8;
              background-color: transparent;
          }
            #outerStuInfo{
                padding-right: 0px;
            }
            .container-fluid
            {
              padding-left:0!important;
              padding-right:0!important;
            }
            .stat_icon
            {
               max-width: 100px;
            }
              .container
              {
                width:100%!important;
              }
              .banner_image
              {

                display: block;
                background-image: url("talvi-4.jpg");
                height: 200px;
                background-size: cover;

              background-repeat: no-repeat;

              }
              .photo.wrapper
              {
                    height: 380px;
              }
              .photo_container
              {
                margin-top: 0;
                height:328px;
                position: relative;
                z-index: 10;
                bottom: 70px;
              }
              #studentInfo
              {
                margin: 10px auto;
              }

              .form_container
              {
                margin:auto;
                width:340px;
                padding-left:15px!important;
                padding-right:15px!important;
              }
              .min_log
              {
                margin-top:0px;
              }
        }
        @media screen and (max-width: 990px) and (min-width: 401px) {
            .profile_photo
            {
                max-width: 360px !important;
                height: 400px !important;
                margin: auto;
            }
            #studentInfo{
                width: 90%;
            }
            .totalVisits
            {
                  max-width: 170px;
            }
        }
        @media screen and (max-width: 401px) {
            .profile_photo
            {

                margin: auto;
                height: auto;
            }
            .stat_icon
            {
              max-width: 100px;
            }
            .totalVisits
            {
                max-width: 170px;
            }
            #studentInfo
            {
                width: 90%;
                margin: auto;
                padding-left: 0px !important;
                padding-right: 0px !important;
                padding-top: 10px;
                height:300px;
            }
            #outerStuInfo{
                padding-left: 0px !important;
                padding-right: 0px !important;
                height:300px;
            }
            .photo.wrapper
            {
              height:120px;
            }
            .form_container
            {
              position: relative;
              z-index: 10;
              bottom: 70px;
                  width: 179px;
            }
            .student_id
            {
              margin-top: 10px;
            }
            .student_id td:first-child
            {
               display:none;
            }
            .student_id td
            {
              letter-spacing: 2px;
               border:0;
               background-color: #ededed;
               border-style: none;
               text-align:center;
            }
            .student_id tr
            {
               border-bottom:1px solid grey;


            }
          .inputfile + label
            {
              color: #9ea7af;
              background-color: transparent;
              margin-top: 0;
            }
            #studentInfo.bordered
            {
              border:0px;
            }
            .photo_container
            {
              height: 160px!important;
              width: 170px!important;
            }
            h2.boldie
            {
              display:none;
            }


        }
    </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row-fluid">
  <div class="container" style="background-color: #FFF;">
<?php

if($_SESSION["isStudent"] == true)
{
?>

  <div class="row">

    <nav class="col-lg-12 navbar navbar-toggleable-md navbar-inverse bg-primary offcanvas centered ">
      <button class="navbar-toggler navbar-toggler-right" data-toggle="offcanvas" data-target="#myNavmenu" data-canvas="body" type="button" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#">Student page</a>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                  <a class="nav-link" href="student.php">
                      <i class="fa fa-home" aria-hidden="true"></i> Profile <span class="sr-only">(current)</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="studentVisitLog.php">
                      <i class="fa fa-user-circle-o" aria-hidden="true"></i> Log
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#">
                      <i class="fa fa-code" aria-hidden="true"></i> Offers
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="settings.php">
                      <i class="fa fa-cog" aria-hidden="true"></i> Setting
                  </a>
              </li>
          </ul>
          <a class="navbar-brand pull-sm-right mr-0" style="padding-right: 30px;" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
      </div>
    </nav>
    <br>
  </div>
</div>
<div class="col-md-12 col-sm-12 banner_image">

</div>
<div class="centered bordered container" style="background-color:#EDEDED;">
  <div class="row" id="imgAndDetail">

    <div class="col-lg-4 photo wrapper" style="">
      <div class="col-lg-12 photo_container" style="">

        <!-- Photo from database -->
        <?php
        $sql = "SELECT * FROM user WHERE Email='$username' AND Password='$password'";
        $sth = $conn->query($sql);
        $result=mysqli_fetch_array($sth);
        echo '<img class="profile_photo" src="data:image/jpeg;base64,'.base64_encode( $result['Profile_photo'] ).'"/>';
        ?>

        <!-- Photo upload button -->

      </div>
      <div class="container-fluid form_container">
      <form method="POST" action="photoUpload.php" enctype="multipart/form-data"  style="text-align:left;">
        <input type="file" name="myimage" id="file" class="inputfile" onchange="this.form.submit()" />
        <label for="file"><i class="fa fa-camera" aria-hidden="true"></i></label>
      </form>
    </div>
    </div>




    <div class="col-lg-8 info" id="outerStuInfo">
      <div class="col-lg-12 bordered" style="" id="studentInfo">
        <h2 class="boldie" style="color:#0275d8; ">

                Student details
        </h2>
          <table class="student_id boldie">
            <tr>
              <td>
                <h3>Name</h3>
              </td>
              <td>
                <h3><?php echo "" . $row['First_name'] ." ". $row['Last_name']. "" ?></h3>
              </td>
            </tr>
            <tr>
              <td>
                <h3>Starting year</h3>
              </td>
              <td>
                <h3><?php echo $row['Starting_year'] ?></h3>
              </td>
            </tr>
            <tr>
              <td>
                <h3>School</h3>
              </td>
              <td>
                <h3><?php echo $row['Name'] ?></h3>
              </td>
            </tr>

          </table>
          <?php  $query = "SELECT COUNT(*) c FROM student_visits WHERE user_id = '$ID' AND institution_id = '1'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            if ($row['c'] >= '1'){
              ?><i class="fa fa-check-square-o fa-2x" id="badge" aria-hidden="true"></i>
            <?php  } ?>

      </div>
    </div>
  </div>








  <div class="row">
    <div class="col-lg-10 min_log centered">
      <table class="min_visits" style="border: 1px solid #666B85;">
        <thead>
          <tr>
            <th align="center" style="background-color: black; color:white;">
                Institution
            </th>
            <th align="center" style="background-color: black; color:white;">
              Date
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php

            $sql = "SELECT vi.time as visit_time, ins.Name as name, vi.user_id as id FROM user as us LEFT JOIN student_visits AS vi ON vi.user_id = us.user_id LEFT JOIN institution AS ins ON ins.institution_id = vi.institution_id WHERE vi.user_id = '$ID' ORDER BY visit_time DESC LIMIT 3";

            $result = $conn->query($sql);

            while($row = mysqli_fetch_assoc($result)) {
          echo "<tr><td>" . $row["name"].  " </td><td> " . $row["visit_time"]. "</td></tr>";
          } ?>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <div class="wrapper stats">
    <div class="row">

      <div class="col-lg-6">
        <div class="col-lg-8 offset-lg-2 stat bordered">
          <div class="row">
            <div class="col-lg-3 col-md-2 col-sm-2 col-xs-2 stat_icon">
            <i class="fa fa-gamepad fa-3x" aria-hidden="true"></i>
          </div>
            <div class="col-lg-9 col-md-9 col-sm-10 totalVisits" style="padding-top: 7px;">


               <span style="font-size: 24px; font-weight: bold;margin-top: 10px;">
                 <?php
                 $query = "SELECT COUNT(*) c FROM student_visits WHERE user_id = '$ID' AND institution_id = '1'";
                 $result = mysqli_query($conn, $query);
                 $row = mysqli_fetch_assoc($result);
                 echo $row['c'];
                 ?>

               </span>
              <span> &nbsp;visits</span>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="col-lg-8 offset-lg-2 stat bordered">
          <div class="row">
            <div class="col-lg-3 col-md-2 col-sm-2 col-xs-2 stat_icon">
              <i class="fa fa-snowflake-o fa-3x" aria-hidden="true"></i>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-10 totalVisits" style="padding-top: 7px;">
              <span style="font-size: 24px; font-weight: bold;">
                <?php
                $query = "SELECT COUNT(*) c FROM student_visits WHERE user_id = '$ID' AND institution_id = '2'";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);
                echo $row['c'];
                ?>

              </span>
              <span> &nbsp;visits</span>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="col-lg-8 offset-lg-2 stat bordered">
          <div class="row">
            <div class="col-lg-3 col-md-2 col-sm-2 col-xs-2 stat_icon">
              <i class="fa fa-anchor fa-3x" aria-hidden="true"></i>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-10 totalVisits" style="padding-top: 7px;">
              <span style="font-size: 24px; font-weight: bold;margin-top: 10px;">
                <?php
                $query = "SELECT COUNT(*) c FROM student_visits WHERE user_id = '$ID' AND institution_id = '3'";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);
                echo $row['c'];
                ?>

              </span>
              <span>&nbsp; visits</span>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="col-lg-8 offset-lg-2 stat bordered">
          <div class="row">
            <div class="col-lg-3 col-md-2 col-sm-2 col-xs-2 stat_icon">
              <i class="fa fa-heart fa-3x" aria-hidden="true"></i>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-10 totalVisits" style="padding-top: 7px;">
              <span style="font-size: 24px; font-weight: bold; margin-top: 10px;">
                <?php
                $query = "SELECT COUNT(*) c FROM student_visits WHERE user_id = '$ID' AND institution_id = '4'";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);
                echo $row['c'];
                ?>



              </span>
              <span>&nbsp;visits</span>
            </div>
        </div>
        </div>
      </div>

    </div>
  </div>

  <div class="row footer">
    <div class="col-lg-12" style="border-top:1px solid;">
      <p style="margin-right:40px;float:right;margin-top:5px;"><i class="fa fa-question fa-2x" aria-hidden="true"></i></p>
    </div>
  </div>




<?php
}
else{ ?>


    <div class="col-lg-8 container" style="background-color: #FFF;">

        <div class="row">

            <nav class="col-lg-12 navbar navbar-toggleable-md navbar-inverse bg-primary centered">
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button>
                <a class="navbar-brand" href="#">Logo</a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">




                </div>

            </nav>
            <br>
        </div>

        <br>
        <br>
        <!-- /navbar -->
        <div class="restrict"><?php echo "You are not authorized to access this page."; ?> </div>
            <br>

      </div>

  </div>




<?php
}
// print_r($_SESSION);
?>
</div>
</div>

<!-- jQuery first, then bootstrap js -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.2.0.js"></script>
<script src="js/jasny-bootstrap.min.js"></script>
</body>
