<?php
include 'config.php';
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
$uID = $_POST['id'];
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link type="text/css" rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

</head>

<div class="container-fluid">
  <div class="row-fluid">
    <div class="container" style="background-color:#f3f3f5;">
    <?php
    // User access restriction
    if($_SESSION["isAdmin"] == true)
    {
    ?>

      <div class="row">
        <nav class="col-lg-12 navbar navbar-toggleable-md navbar-inverse centered admin">
          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <a class="navbar-brand" href="admin.php"><img src="img/Lahti_logo_nega_RGB_web.jpg" /></a>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link" href="admin.php">
                  <i class="fa fa-home" aria-hidden="true"></i> Etusivu
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link" href="addSclAd.php">
                  <i class="fa fa-user-circle-o" aria-hidden="true"></i> Lisää koulu käyttäjä
                </a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="addstudent.php">
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i> Lisää opiskelija
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="addInst.php">
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i> Lisää instituutio
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="settings.php">
                  <i class="fa fa-code" aria-hidden="true"></i> Asetukset
                </a>
              </li>
            </ul>
            <a class="navbar-brand pull-sm-right mr-0" style="padding-right: 30px; padding-top:7px; font-size: 16px;" href="logout.php">Kirjaudu ulos &nbsp;<i class="fa fa-sign-out" aria-hidden="true"></i>
            </a>
          </div>
        </nav>

        <div class="centered bordered container addStudent" style="background-color:#f3f3f5; padding-bottom: 50px;">
          <div class="row">
            <div class="main">
              <h2> Päivitä käyttäjän tiedot </h2>
            </div>
          </div>
          <div class="row">
            <div class="alert wrapper" style="margin: 0 15px 0 15px;">
               <?php if(!empty($_SESSION['update_status']))
                {
                  echo "<br><div class='alert status'>".$_SESSION['update_status']."</div>";
                  unset($_SESSION['update_status']);
                } ?>
            </div>
          </div>

          <div class="col-lg-12 updateForm">

              <form name="frmUpdate" role="form" class="form-update" method="POST" action="userUpdate.php">
                <div class="form-group">

                  <?php
                  echo $uID;
                  $sql = "SELECT us.user_id as user_id, us.First_name as First_name, us.Last_name as Last_name, us.Email as Email, scl.Name as school_name, scl.school_id as scl_id, stu.Starting_year as Year FROM user as us
                  LEFT JOIN student AS stu ON stu.user_id = us.user_id
                  LEFT JOIN school AS scl ON stu.school_id = scl.school_id
                  WHERE us.user_id = $uID
                  ORDER BY stu.Starting_year DESC, us.Last_name ASC";

                  $result= mysqli_query($conn,$sql);
                  $row = $result->fetch_assoc();


                  echo '<br><label for="fname">Etunimi</label>';
                  echo '<input type="text" class="form-control" pattern="[a-zåäöA-ZÅÄÖ]+" id="fname" name="fname" value="'.$row['First_name'].'" required><br/>';
                  echo '<label for="lname">Sukunimi</label>';
                  echo '<input type="text" class="form-control" pattern="[a-zåäöA-ZÅÄÖ]+" id="lname" name="lname" value="'.$row['Last_name'].'" required><br/>';
                  echo '<label for="email">Sähköposti</label>';
                  echo '<input type="text" class="form-control" id="email" name="email" value="'.$row['Email'].'" required><br/>';
                  echo '<label for="year">Vuosi</label>';
                  echo '<input type="number" class="form-control" id="year" name="year" value="'.$row['Year'].'" required>
                    <input type="hidden" class="form-control" id="updateID" name="updateID" value="'.$row['user_id'].'"><br/>';
                  ?>

                  <label for="school"> Koulu </label>
                  <br/>
                  <form method="post" style="padding: 6px;margin-bottom:40px;">
                    <!-- Admin selects school which they want to see -->
                    <select class="custom-select mb-2 mr-sm-2 mb-sm-0 school" name="school" id="school">
                      <option name='school' value="1" <?php if($row['scl_id'] == '1') { echo 'selected'; } ?> >Kannaksen lukio</option>
                      <option name='school' value="2" <?php if($row['scl_id'] == '2') { echo 'selected'; } ?> >Tiirismaan lukio</option>
                      <option name='school' value="3" <?php if($row['scl_id'] == '3') { echo 'selected'; } ?> >Lahden lyseo</option>
                      <option name='school' value="4" <?php if($row['scl_id'] == '4') { echo 'selected'; } ?> >Nastopolin lukio</option>
                    </select>
                  </form>
                  <?php
                  if(isset($_POST['school']) && !empty($_POST['school']))
                  {
                    $_SESSION['schoolID'] = $_POST['school'];
                  }
                  $school = $_SESSION['schoolID'];
                  ?>
                </div>
                <label for="submit"></label><input class="btn" form="frmUpdate" id="submit" type="submit" value="Päivitä" name="submit" style="width:150px;" />
              </form>
            </div>
          </div>
        </div>

        <?php }
        // Show to non-admin users
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
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
<!-- jQuery first, then bootstrap js -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.2.0.js"></script>


</body>

</html>
