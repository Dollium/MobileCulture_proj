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
    <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.css">
    <style>
    h2, h3
    {
          color: #0275d8!important;
    }
    .form-signin input
    {
      width: 50%;
      display:inline;
      margin-top: 5px;
    }
    .form-signin button
    {
      margin-left: 5px;
      margin-top: 25px;
    }
    .form-signin label
    {
      width: 200px;
    }

    .crop img {
      width: 170px;
      height: 200px;
      margin: 0 50px 20px 30px;
      border: 7px solid white;
      box-shadow: 0 0 0 1px rgba(0,0,0,0.44);
      border-radius: 5px;
}

    body {
        font-family: 'Roboto', sans-serif;
    }

    table {
        font-family: "Roboto", helvetica, arial, sans-serif;
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
    .container-fluid
    {
       padding-left: 0!important;
       padding-right: 0!important;
    }
    .crop
    {
      display:inline;
    }
.main
{
  margin: 15px;
}
.upload_form
{
  display:inline;
  margin-top: 40px;
}
    .centered
    {
      margin: 0 auto;
    }
    .bordered
    {
      border: 1px solid;
    }

    .restrict
    {
      font-size: 22px;

    }
    #pass_change_div
    {
      display:inline-block;
      margin-top: 90px;
      vertical-align:top;
    }
    #reset_pass_div
    {
      display:inline-block;
      margin-top: 40px;
      margin-bottom:40px;
      vertical-align:top;
    }
    #email_result
    {
      max-width: 200px;
      display: inline;
    }
    button.mobile
    {
      display:none;
      margin-left: 20px;
    }
    .passForm, .photoForm
    {
      margin-top: 40px;
      margin-bottom: 20px;

    }
    .passForm
    {
      display:inline-block;
    }
    .photoForm
    {
      display:inline;
    }
    .result p
    {
      max-width: 200px;
      display:block;
      padding-left:12px;

    }
    @media screen and (max-width: 992px)
    {
      .container
      {
        width:100%!important;
      }

      .crop img
      {
        margin: 30px 20px 30px 0;
      }
      #pass_change_div
      {
        margin-top: 20px;
      }
      .passForm
      {
        margin:30px 0 30px 0;

      }
    }

    @media screen and (max-width: 653px)
    {
      .upload_form
      {

        margin-top: 20px;
        margin-bottom: 20px;
        margin-left: 5px;
      }
      .inputfile{
        width:46%;
      }
      .centered .col-lg-12
      {
        padding-left:0!important;
        padding-right:0!important;
      }

    }
    @media screen and (max-width: 528px)
    {
      .upload_form {

        width: 100%;
        display:block;
      }
      .inputfile{
        width:70%;
      }
      .form-signin input
      {
      width:100%;
      display:block;
      }
      .photoForm
      {
        display:block;
        margin: 20px 0 0 0;
      }
      .crop
      {
        display:block;
        text-align:center;
      }
      .crop img
      {
        margin: 0;
      }
      .form-signin button
      {
        display:block;
        margin-left: 5px;
        margin-top:0;
      }
      #email_result
      {
        max-width:100%;
      }
      button.desktop
      {
        display:none;
      }
      button.mobile
      {
        display:block;
        margin-left:0;
        margin-top: 10px;
      }
    }

    </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="container" style="background-color: #FFF;">
        <?php
        if (($_SESSION["isStudent"] == true) || ($_SESSION["isSchool"] == true) || ($_SESSION["isAdmin"] == true)) {

if($_SESSION["isStudent"] == true)
{
  $sql = "SELECT * FROM user AS us LEFT JOIN student AS stu ON stu.user_id = us.user_id LEFT JOIN class AS cl ON stu.class_id = cl.class_id LEFT JOIN school AS scl ON stu.school_id = scl.school_id WHERE Email='$username'";
  $result= mysqli_query($conn,$sql);
  $row = $result->fetch_assoc();
?>

  <div class="row">

    <nav class="col-lg-12 navbar navbar-toggleable-md navbar-inverse bg-primary centered">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                      <i class="fa fa-cog" aria-hidden="true"></i></i> Setting
                  </a>
              </li>
          </ul>
          <a class="navbar-brand pull-sm-right mr-0" style="padding-right: 30px;" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
      </div>
    </nav>
    <br>
  </div>
</div>

<div class="centered bordered container" style="background-color:#EDEDED;">
  <div class="row">
    <div class="main">
      <h2> Settings </h2>
    </div>

  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="photo wrapper" style="border-bottom: 1px solid #0275d8; margin: 0 15px 0 15px;">
        <div class="col-lg-3" style="display:inline-block;">
        <h5> Profile picture </h5>
      </div>

          <div class="crop">
          <!-- Photo from database -->
          <?php
          $sql = "SELECT * FROM user WHERE Email='$username'";
          $sth = $conn->query($sql);
          $result=mysqli_fetch_array($sth);
          echo '<img class="profile_photo" src="data:image/jpeg;base64,'.base64_encode( $result['Profile_photo'] ).'" />';
          ?>
          </div>
          <form method="POST" action="photoUpload.php" class="upload_form" enctype="multipart/form-data">
            <span><input type="file" name="myimage" id="file" class="inputfile" />
            <input type="submit"></span>
          </form>

        </div>
        <!-- Photo upload button -->

      </div>
    </div>
    </div>


<?php }
elseif ($_SESSION["isSchool"] == true)
{

  ?>
  <div class="row">

      <nav class="col-lg-12 navbar navbar-toggleable-md navbar-inverse bg-primary centered">
          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <a class="navbar-brand" href="#">School Admin Page</a>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                      <a class="nav-link" href="school.php">
                          <i class="fa fa-home" aria-hidden="true"></i> Home
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="addteacher_resp.php">
                          <i class="fa fa-user-circle-o" aria-hidden="true"></i> Add Teacher
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="addstudent_resp.php">
                          <i class="fa fa-user-circle-o" aria-hidden="true"></i> Add Student
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="statistics.html">
                          <i class="fa fa-code" aria-hidden="true"></i> Setting
                      </a>
                  </li>
              </ul>
              <a class="navbar-brand pull-sm-right mr-0" style="padding-right: 30px;" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>
          </a>
          </div>
      </nav>
      <br>
  <br>
  <br>
</div>
<div class="row">
  <div class="main">
    <h2> Settings </h2>
  </div>

</div>
<?php }
elseif ($_SESSION["isAdmin"] == true)
{
?>

<div class="row">

  <nav class="col-lg-12 navbar navbar-toggleable-md navbar-inverse bg-primary centered">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="admin.php">Admin Page</a>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                  <a class="nav-link" href="admin.php">
                      <i class="fa fa-home" aria-hidden="true"></i> Home
                  </a>
              </li>

              <li class="nav-item">
                  <a class="nav-link" href="addSclAd.php">
                      <i class="fa fa-user-circle-o" aria-hidden="true"></i> Add a school admin
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="settings.php">
                      <i class="fa fa-code" aria-hidden="true"></i> Settings
                  </a>
              </li>
          </ul>
          <a class="navbar-brand pull-sm-right mr-0" style="padding-right: 30px;" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>
      </a>
      </div>
  </nav>
  <br>
  <br>
  <br>
</div>
<div class="row">
  <div class="main">
    <h2> Settings </h2>
  </div>

</div>
<div class="row">
  <div class="col-lg-12">
    <div class="photo wrapper" style="border-bottom: 1px solid #0275d8; margin: 0 15px 0 15px;">
      <div class="col-lg-3" id="reset_pass_div">
      <h5> Reset user password </h5>
    </div>
    <div class="col-lg-8 passForm">
      <form method="POST" action="resetPass.php">
      <div class="search-box" style="max-width: 200px; display:inline;">
          <input type="text" class="form-control" name="email_result" id="email_result" autocomplete="off" placeholder="Search user" />
          <button type="submit" class="btn desktop" style="margin-left: 20px;">Submit</button>
          <div class="col-lg-1 result" style="display:inline;">
      </div>
      </div>
      <button type="submit" class="btn mobile">Submit</button>


    </form>
    </div>
  </div>


  </div>
</div>

<?php }
?>


      <div class="pass wrapper" style="margin: 0 15px 0 15px;">

        <div class="col-lg-3" id="pass_change_div">
        <h5> Change your password </h5>
      </div>
        <div class="col-lg-8 passForm">
          <form name="frmChange" role="form" class="form-signin" method="POST" action="passChange.php">

              <label for="InputPassword2">Old Password</label>
              <input type="password" class="form-control" id="InputPassword1" placeholder="Old Password" name="oldPassword" required>
              <?php if(!empty($_SESSION['Oldpass']))
              {
              ?>
              <div class="alert danger">
              <?php
              echo $_SESSION['Oldpass']; ?></div> <?php
              unset($_SESSION['Oldpass']);
              } ?>
              <br/>
              <label for="InputPassword2">New Password</label>
              <input type="password" class="form-control" id="InputPassword2" placeholder="New Password" name="newPassword" required>
              <?php if(!empty($_SESSION['passLen']))
              {
              ?>
              <div class="alert danger">  <?php
                echo $_SESSION['passLen']; ?></div>
             <?php
              unset($_SESSION['passLen']);
              } ?>
              <br/>
              <label for="InputPassword3">Confirm New Password</label>
              <input type="password" class="form-control" id="InputPassword3" placeholder="Confirm Password" name="confirmPassword" required> <br/>

              <?php if(!empty($_SESSION['passMatch']))
              {
              ?>
              <div class="alert danger"><?php
              echo $_SESSION['passMatch']; ?></div>
               <?php
              unset($_SESSION['passMatch']);
              } ?>
<label for=""></label><button class="btn" type="submit" value="send">Change it</button>


          </form>

        </div>
        <!-- Photo upload button -->

      </div>




    </div>

  </div>
</div>




<?php }
else { ?>


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
      </center>
  </div>




<?php
}
// print_r($_SESSION);
?>
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
