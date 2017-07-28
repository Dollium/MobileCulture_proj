
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Culture Mobile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.css">
<style>
.form_container
{
margin-left:20px;
}
    @media screen and (max-width: 992px) {
.form_container
{
  margin:auto;
  width:340px;
  padding-left:15px!important;
  padding-right:15px!important;
}
}
@media screen and (max-width: 400px) {
.form_container
{
  position: relative;
  z-index: 10;
  bottom: 70px;
  width: 179px;
}
}
</style>
</head>
<body>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="container" style="background-color:#f3f3f5;">
<?php

if($_SESSION["isStudent"] == true)
{
?>

  <div class="row">
    <nav class="col-lg-12 navbar navbar-toggleable-md navbar-inverse centered">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="student.php"><img src="img/Lahti_logo_nega_RGB_web.jpg" /></a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item  active">
              <a class="nav-link" href="student.php">
                <i class="fa fa-home" aria-hidden="true"></i> Profiili <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="log.php">
                <i class="fa fa-user-circle-o" aria-hidden="true"></i> Logi
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="settings.php">
                <i class="fa fa-cog" aria-hidden="true"></i> Asetukset
              </a>
            </li>
          </ul>
            <a class="navbar-brand pull-sm-right mr-0" style="padding-right: 30px; padding-top:7px; font-size: 16px;" href="logout.php">Kirjaudu ulos &nbsp;<i class="fa fa-sign-out" aria-hidden="true"></i></a>
        </div>
    </nav>
    <br>
  </div>
</div>
<?php

if(!empty($_SESSION['photo_fail_mobi']))
{
  echo "<div style='background-color: white'><div class='alert danger mobile'>".$_SESSION['photo_fail_mobi']."</div></div>";
  unset($_SESSION['photo_fail_mobi']);
}

if(!empty($_SESSION['unsuccess_photo_mobi']))
{
  echo "<div style='background-color: white'><div class='alert danger mobile'>".$_SESSION['unsuccess_photo_mobi']."</div></div>";
  unset($_SESSION['unsuccess_photo_mobi']);
}

if(!empty($_SESSION['size_large_mobi']))
{
  echo "<div style='background-color: white'><div class='alert danger mobile'>".$_SESSION['size_large_mobi']."</div></div>";
  unset($_SESSION['size_large_mobi']);
}
?>

<div class="col-md-12 col-sm-12 banner_image">
</div>

<div class="centered bordered container" style="background-color:#f3f3f5;">
  <?php if(!empty($_SESSION['photo_fail']))
  {
  echo "<div class='alert danger desktop'>".$_SESSION['photo_fail']."</div>";
  unset($_SESSION['photo_fail']);
  }

  if(!empty($_SESSION['unsuccess_photo']))
  {
  echo "<div class='alert danger desktop'>".$_SESSION['unsuccess_photo']."</div>";
  unset($_SESSION['unsuccess_photo']);
  }

  if(!empty($_SESSION['size_large']))
  {
  echo "<div class='alert danger desktop'>".$_SESSION['size_large']."</div>";
  unset($_SESSION['size_large']);
  }
  ?>
  <div class="row" id="imgAndDetail">
    <div class="col-lg-4 photo wrapper">
      <div class="col-lg-12 photo_container">

        <!-- Photo from database -->
        <?php
        $sql = "SELECT * FROM user WHERE Email='$username' AND Password='$password'";
        $sth = $conn->query($sql);
        $result=mysqli_fetch_array($sth);
        if($result['Profile_photo'] != NULL)
        {
          echo "<img class='profile_photo' src='". $row['Profile_photo'] ."'/>";
        }
        else {
          echo '<div class="profile_photo" style="background-color: lightgrey;"></div>';
        }
        ?>

        <!-- Photo upload button -->
      </div>
      <div class="form_container">
        <form method="POST" action="photoUpload.php" enctype="multipart/form-data"  style="text-align:left;">
          <input type="file" name="myimage" id="file" class="inputfile" onchange="this.form.submit()" />
          <label for="file"><i class="fa fa-camera" aria-hidden="true"></i></label>
        </form>
      </div>
    </div>

    <!-- Student information -->
    <div class="col-lg-8 info" id="outerStuInfo">
      <div class="col-lg-12 bordered" style="" id="studentInfo">
        <h2 class="boldie" style="color: #0050b0; ">
                Opiskelijan tiedot
        </h2>
          <table class="student_id boldie">
            <tr>
              <td>
                <h3>Nimi</h3>
              </td>
              <td>
                <h3><?php echo "" . $row['First_name'] ." ". $row['Last_name']. "" ?></h3>
              </td>
            </tr>
            <tr>
              <td>
                <h3>Aloitusvuosi</h3>
              </td>
              <td>
                <h3><?php echo $row['Starting_year'] ?></h3>
              </td>
            </tr>
            <tr>
              <td>
                <h3>Koulu</h3>
              </td>
              <td>
                <h3><?php echo $row['Name'] ?></h3>
              </td>
            </tr>
          </table>

          <?php
          $query = "SELECT COUNT(*) c FROM student_visits WHERE user_id = '$ID' AND institution_id = '1'";
          $result = mysqli_query($conn, $query);
          $row = mysqli_fetch_assoc($result);
          if ($row['c'] >= '1'){
          ?>
          <i class="fa fa-check-square-o fa-2x" id="badge" aria-hidden="true"></i>
          <?php
          } ?>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-10 min_log centered">
        <div class="box-code" style="padding-bottom:40px;">
        <?php if(!empty($_SESSION['code_success']))
        {
        echo "<div class='alert success'>".$_SESSION['code_success']."</div>";
        unset($_SESSION['code_success']);
        }

        if(!empty($_SESSION['wrong_code']))
        {
        echo "<div class='alert danger'>".$_SESSION['wrong_code']."</div>";
        unset($_SESSION['wrong_code']);
        }

         if(!empty($_SESSION['insert_code']))
        {
        echo "<div class='alert danger'>".$_SESSION['insert_code']."</div>";
        unset($_SESSION['insert_code']);
        }
        ?>
        <br/>
          <h4>Kirjaa käyntisi syöttämällä koodi</h4 >
          <form method="POST" id="formCode" action="studentVisitRecord.php">
              <input type="text" placeholder="Syötä koodi" class="data-input" id="institutionCode" name="institutionCode">
              <button class="btn btn-primary">Kirjaa</button>
           </form>
        </div>
        <table class="min_visits" style="border: 1px solid #666B85;">
          <thead>
            <tr>
              <th align="center" style="background-color: black; color:white;">
                  Kulttuurilaitos
              </th>
              <th align="center" style="background-color: black; color:white;">
                Päivämäärä
              </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <?php
              $sql = "SELECT vi.time as visit_time, ins.Name as name, vi.user_id as id FROM user as us LEFT JOIN student_visits AS vi ON vi.user_id = us.user_id LEFT JOIN institution AS ins ON ins.institution_id = vi.institution_id WHERE vi.user_id = '$ID' ORDER BY visit_time DESC LIMIT 3";
              $result = $conn->query($sql);

              while($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>" . $row["name"].  " </td><td> " . date('j.n.Y', strtotime($row["visit_time"])) . "</td></tr>";
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
              <img src="img/museo.svg" alt="Museo" />
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
              <span> &nbsp;käyntikertaa</span>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="col-lg-8 offset-lg-2 stat bordered">
          <div class="row">
            <div class="col-lg-3 col-md-2 col-sm-2 col-xs-2 stat_icon">
              <img src="img/teatteri.svg" alt="Kaupunginteatteri" />
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
              <span> &nbsp;käyntikertaa</span>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="col-lg-8 offset-lg-2 stat bordered">
          <div class="row">
            <div class="col-lg-3 col-md-2 col-sm-2 col-xs-2 stat_icon">
              <img src="img/sinfonia.svg" alt="Lahti Sinfonia" />
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
              <span>&nbsp;käyntikertaa</span>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="col-lg-8 offset-lg-2 stat bordered">
          <div class="row">
            <div class="col-lg-3 col-md-2 col-sm-2 col-xs-2 stat_icon">
              <img src="img/elokuva.svg" alt="Kino Iiris" />
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
              <span>&nbsp;käyntikertaa</span>
            </div>
        </div>
        </div>
      </div>

    </div>
  </div>

  <div class="row footer">
    <div class="col-lg-12" style="border-top:1px solid;">
      <div class="tooltipz"><i class="fa fa-question fa-2x" aria-hidden="true"></i></p>
        <span class="tooltiptextz">Proofilisivulla näet omat tietosi, viimeisimmät käyntikertasi, sekä käyntikertasi yhteensä eri kulttuurilaitoksissa.</span>
      </div>
    </div>
  </div>
<?php
}
// Show to non-student users
else { ?>
    <div class="row">
      <nav class="col-lg-12 navbar navbar-toggleable-md navbar-inverse centered">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#"><img src="/img/Lahti_logo_nega_RGB_web.jpg" /></a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        </div>
        <a class="navbar-brand pull-sm-right mr-0" style="padding-right: 30px;" href="index.php"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
      </nav>
      <br>
    </div>
    <br>
    <br>
    <!-- /navbar -->
    <div class="restrict"><?php echo "Sinulla ei ole oikeuksia katsella sivua."; ?> </div>
    <br>

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
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.2.0.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

</body>
