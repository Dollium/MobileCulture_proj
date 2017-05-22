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

// Show query results
// var_dump($row);

$sql = "SELECT * FROM user AS us WHERE Email='$username'";
$result= mysqli_query($conn,$sql);
$row = $result->fetch_assoc();

?>
<head>
    <meta charset="UTF-8">
    <title>Culture Mobile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.css">


</head>
<body>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="container" style="background-color:#f3f3f5;">
        <?php
        if (($_SESSION["isStudent"] == true) || ($_SESSION["isSchool"] == true) || ($_SESSION["isAdmin"] == true) || ($_SESSION["isInst"] == true)) {

          // STUDENT SETTINGS
          if($_SESSION["isStudent"] == true)
          {
            $sql = "SELECT * FROM user AS us LEFT JOIN student AS stu ON stu.user_id = us.user_id LEFT JOIN school AS scl ON stu.school_id = scl.school_id WHERE Email='$username'";
            $result= mysqli_query($conn,$sql);
            $row = $result->fetch_assoc();
          ?>

          <div class="row">

            <nav class="col-lg-12 navbar navbar-toggleable-md navbar-inverse centered">
              <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <a class="navbar-brand" href="student.php"><img src="img/Lahti_logo_nega_RGB_web.jpg" /></a>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                    <a class="nav-link" href="student.php">
                      <i class="fa fa-home" aria-hidden="true"></i> Profiili <span class="sr-only">(current)</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="log.php">
                      <i class="fa fa-user-circle-o" aria-hidden="true"></i> Logi
                    </a>
                  </li>
                  <li class="nav-item active">
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

        <div class="col-md-12 col-sm-12 banner_image">
        </div>

        <div class="centered bordered container" style="background-color:#f3f3f5;">
          <div class="row">
            <div class="main">
              <h2> Asetukset </h2>
            </div>

          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="photo_wrapper_thumb" style="border-bottom: 1px solid #0275d8; margin: 0 15px 0 15px;">
                <div class="col-lg-3" style="display:inline-block;">
                  <h5> Profiilikuva </h5>
                </div>

                <div class="crop">
                  <!-- Photo from database -->
                  <?php
                  $sql = "SELECT * FROM user WHERE Email='$username'";
                  $sth = $conn->query($sql);
                  $result=mysqli_fetch_array($sth);
                  if($result['Profile_photo'] != NULL)
                  {
                    echo "<img class='profile_photo_thumb' src='". $row['Profile_photo'] ."'/>";
                  }
                  else {
                    echo '<img class="profile_photo_thumb" style="background-color: lightgrey;"/>';
                  }
                  ?>
                </div>
                <form method="POST" action="photoUpload.php" class="upload_form photo_thumb" enctype="multipart/form-data">
                  <input type="file" name="myimage" id="file" class="input_file" />
                  <button type="submit" class="btn justify">Lähetä</button>
                </form>
              </div>
              <!-- Photo upload button -->
            </div>
          </div>

      <?php }
      // END OF STUDENT SETTINGS


      // SCHOOL ADMIN SETTINGS
      elseif ($_SESSION["isSchool"] == true)  {
        ?>

        <div class="row">

          <nav class="col-lg-12 navbar navbar-toggleable-md navbar-inverse centered">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#"><img src="img/Lahti_logo_nega_RGB_web.jpg" /></a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                  <a class="nav-link" href="school.php">
                    <i class="fa fa-home" aria-hidden="true"></i> Etusivu
                  </a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="settings.php">
                    <i class="fa fa-code" aria-hidden="true"></i> Asetuksista <span class="sr-only">(current)</span>
                  </a>
                </li>
              </ul>
              <a class="navbar-brand pull-sm-right mr-0" style="padding-right: 30px; padding-top:7px; font-size: 16px;" href="logout.php">Kirjaudu ulos &nbsp;<i class="fa fa-sign-out" aria-hidden="true"></i></a></a>
            </div>
          </nav>
          <br>
        </div>
        </div>


        <div class="col-md-12 col-sm-12 banner_image">
        </div>

        <div class="centered bordered container" style="background-color:#f3f3f5;">
          <div class="row">
            <div class="main">
              <h2> Asetukset </h2>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <?php
              if(!empty($_SESSION['email_exist']))
              {
              echo "<div class='alert danger'>".$_SESSION['email_exist']."</div>";
              unset($_SESSION['email_exist']);
              }

              if(!empty($_SESSION['pass_reset']))
              {
              echo "<div class='alert success'>". $_SESSION['pass_reset']."</div>";
              unset($_SESSION['pass_reset']);
              }

              if(!empty($_SESSION['error']))
              {
              echo "<div class='alert danger'>".$_SESSION['error']."</div>";
              unset($_SESSION['error']);
              } ?>

              <div class="wrapper" style="border-bottom: 1px solid #0275d8; margin: 0 15px 0 15px;">
                <div class="col-lg-3" id="reset_pass_div">
                  <h5> Palauta käyttäjän salasana </h5>
                </div>
                <div class="col-lg-8 passForm">
                  <form method="POST" action="resetPass.php">
                    <div class="search-box" style="max-width: 200px; display:inline;">
                      <input type="text" class="form-control" name="email_result" id="email_result" autocomplete="off" placeholder="Hae käyttäjää" />
                      <button type="submit" class="btn desktop" style="margin-left: 20px;">Lähetä</button>
                      <div class="col-lg-1 result" style="display:inline;">
                      </div>
                    </div>
                    <button type="submit" class="btn mobile">Lähetä</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
      <?php }
      // END OF SCHOOL ADMIN SETTINGS


      // ADMIN SETTINGS
      elseif ($_SESSION["isAdmin"] == true)
      {
      ?>

      <div class="row">

        <nav class="col-lg-12 navbar navbar-toggleable-md navbar-inverse centered admin">
          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <a class="navbar-brand" href="#"><img src="img/Lahti_logo_nega_RGB_web.jpg" /></a>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link" href="admin.php">
                  <i class="fa fa-home" aria-hidden="true"></i> Etusivu
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="addSclAd.php">
                  <i class="fa fa-user-circle-o" aria-hidden="true"></i> Lisää koulun pääkäyttäjä
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="addstudent.php">
                  <i class="fa fa-user-circle-o" aria-hidden="true"></i> Lisää opiskelija
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="addInst.php">
                  <i class="fa fa-user-circle-o" aria-hidden="true"></i> Lisää instituutio
                </a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="settings.php">
                  <i class="fa fa-code" aria-hidden="true"></i> Asetukset <span class="sr-only">(current)</span>
                </a>
              </li>
            </ul>
            <a class="navbar-brand pull-sm-right mr-0" style="padding-right: 30px; padding-top:7px; font-size: 16px;" href="logout.php">Kirjaudu ulos &nbsp;<i class="fa fa-sign-out" aria-hidden="true"></i></a></a>
          </div>
        </nav>
      </div>
      </div>

    <div class="col-md-12 col-sm-12 banner_image">
    </div>

    <div class="centered bordered container" style="background-color:#f3f3f5;">
      <div class="row">
        <div class="main">
          <h2> Asetukset </h2>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <?php if(!empty($_SESSION['email_exist']))
          {
          echo "<div class='alert danger'>".$_SESSION['email_exist']."</div>";
          unset($_SESSION['email_exist']);
          }

          if(!empty($_SESSION['pass_reset']))
          {
          echo "<div class='alert success'>". $_SESSION['pass_reset']."</div>";
          unset($_SESSION['pass_reset']);
          }

          if(!empty($_SESSION['error']))
          {
          echo "<div class='alert danger'>".$_SESSION['error']."</div>";
          unset($_SESSION['error']);
          }
          ?>
          <div class="wrapper" style="border-bottom: 1px solid #0275d8; margin: 0 15px 0 15px;">
            <div class="col-lg-3" id="reset_pass_div">
              <h5> Nollaa käyttäjän salasana </h5>
            </div>
            <div class="col-lg-8 passForm">
              <form method="POST" action="resetPass.php">
                <div class="search-box" style="max-width: 200px; display:inline;">
                  <input type="text" class="form-control" name="email_result" id="email_result" autocomplete="off" placeholder="Hae käyttäjää" />
                  <button type="submit" class="btn desktop" style="margin-left: 20px;"> Lähetä </button>
                  <div class="col-lg-1 result" style="display:inline;">
                  </div>
                </div>
                <button type="submit" class="btn mobile">Lähetä</button>
              </form>
            </div>
          </div>
        </div>
      </div>


<?php }
// END OF ADMIN SETTINGS


// INSTITUTION SETTINGS
elseif ($_SESSION["isInst"] == true)
{
  ?>
  <div class="row">
    <nav class="col-lg-12 navbar navbar-toggleable-md navbar-inverse centered">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#"><img src="img/Lahti_logo_nega_RGB_web.jpg" /></a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="Institution.php">
              <i class="fa fa-home" aria-hidden="true"></i> Etusivu
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="settings.php">
              <i class="fa fa-code" aria-hidden="true"></i> Asetukset <span class="sr-only">(current)</span>
            </a>
          </li>
        </ul>
        <a class="navbar-brand pull-sm-right mr-0" style="padding-right: 30px; padding-top:7px; font-size: 16px;" href="logout.php">Kirjaudu ulos &nbsp;<i class="fa fa-sign-out" aria-hidden="true"></i></a>
      </div>
    </nav>
  </div>
</div>
  <div class="centered bordered container" style="background-color:#f3f3f5;">
  <?php }
  // END OF INSTITUTION SETTINGS


  // PASSWORD CHANGE IN SETTINGS -PAGE
  ?>

  <div class="pass wrapper" style="margin: 0 15px 0 15px;">
    <?php if(!empty($_SESSION['pass_success']))
    {
      echo "<br><div class='alert success'>".$_SESSION['pass_success']."</div>";
      unset($_SESSION['pass_success']);
    } ?>

    <div class="col-lg-3" id="pass_change_div">
      <h5> Vaihda salasanasi </h5>
    </div>

    <div class="col-lg-8 passForm">
      <form name="frmChange" role="form" class="form-signin" method="POST" action="passChange.php">
        <label for="InputPassword2">Vanha salasana</label>
        <input type="password" class="form-control" id="InputPassword1" placeholder="Vanha salasana" name="oldPassword" required>
        <?php if(!empty($_SESSION['Oldpass']))
        {
        echo "<div class='alert text'>".$_SESSION['Oldpass']."</div>";
        unset($_SESSION['Oldpass']);
        } ?>

        <br/>
        <label for="InputPassword2">Uusi salasana</label>
        <input type="password" class="form-control newpass" pattern="[0-9a-zA-Z]{8}" minlength="8" id="InputPassword2" placeholder="Uusi salasana" name="newPassword" required>
        <?php if(!empty($_SESSION['pass_str']))
        {
        echo "<div class='alert text'>".$_SESSION['pass_str']."</div>";
        unset($_SESSION['pass_str']);
        } ?>

        <br/>
        <label for="InputPassword3">Vahvista uusi salasana</label>
        <input type="password" class="form-control" pattern="[0-9a-zA-Z]{8}" minlength="8" id="InputPassword3" placeholder="Vahvista uusi salasana" name="confirmPassword" required>
        <?php if(!empty($_SESSION['passMatch']))
        {
        echo "<div class='alert text'>".$_SESSION['passMatch']."</div>";
        unset($_SESSION['passMatch']);
        } ?>
        <br/>
        <label for=""></label><input class="btn" type="submit" value="Vaihda" name="submit" />
      </form>
    </div>
  </div>
<?php
// END OF PASSWORD CHANGE


// STUDENT FOOTER
if ($_SESSION["isStudent"] == true)
{ ?>
      <div class="row footer">
        <div class="col-lg-12" style="border-top:1px solid;">
          <div class="tooltipz"><i class="fa fa-question fa-2x" aria-hidden="true"></i></p>
              <span class="tooltiptextz">Asetuksista voit muuttaa profiilikuvaasi ja salasanaasi.</span>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
    <?php }
// END OF STUDENT FOOTER

// Show if user is none of the above
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
    <?php
    } ?>
  </div>
</div>


<!-- jQuery first, then bootstrap js -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.2.0.js"></script>




<script type="text/javascript">
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("search.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });

    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>



</body>
