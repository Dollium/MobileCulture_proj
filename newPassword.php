<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>New password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.css">

    <style>
    .alert
     {
       padding:0 0 0 10px!important;
       margin-bottom:0!important;
       color:red;
     }
    .btn:hover
    {
      background-color:#0275d8;
      color: white;
      transition-delay: 0.01s;
      border: 1px solid #07579b;
    }
    </style>
</head>

<body>

  <div class="col-lg-8 container" style="background-color: #FFF;">

      <div class="row">

          <nav class="col-lg-12 navbar navbar-toggleable-md navbar-inverse bg-primary centered">
              <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
              <a class="navbar-brand" href="#">Admin Page</a>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mr-auto">

                  </ul>
                  <a class="navbar-brand pull-sm-right mr-0" style="padding-right: 30px;" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>
                </a>
              </div>
          </nav>
          <br>
      </div>

      <br>
      <!-- /navbar -->

          <br>

      <form name="frmChange" role="form" class="form-signin" method="POST" action="passChange.php">
        <div class="form-group">
          <label for="InputPassword2">Old Password</label>
          <input type="password" class="form-control" id="InputPassword1" placeholder="Old Password" name="oldPassword" required>
          <?php if(!empty($_SESSION['Oldpass']))
          {
          echo "<div class='alert danger'>".$_SESSION['Oldpass']."</div>"; ?> <?php
          unset($_SESSION['Oldpass']);
          } ?>
          <br/>
          <label for="InputPassword2">New Password</label>
          <input type="password" class="form-control" pattern="[0-9a-zA-Z]{8,16}" minlength="8" id="InputPassword2" placeholder="New Password" name="newPassword" required>
          <?php if(!empty($_SESSION['pass_str']))
          {
          echo "<div class='alert danger'>".$_SESSION['pass_str']."</div>"; ?> <?php
          unset($_SESSION['pass_str']);
          } ?>
          <br/>
          <label for="InputPassword3">Confirm New Password</label>
          <input type="password" class="form-control" pattern="[0-9a-zA-Z]{8,16}" minlength="8" id="InputPassword3" placeholder="Confirm Password" name="confirmPassword" required>
          <?php if(!empty($_SESSION['passMatch']))
          {
          echo "<div class='alert danger'>".$_SESSION['passMatch']."</div>"; ?> <?php
          unset($_SESSION['passMatch']);
          } ?> <br/>


        </div>



          <input class="btn" type="submit" value="Vaihda" name="submit" />

      </form>
    </div>



      <!-- jQuery first, then bootstrap js -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
      <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.2.0.js"></script>


</body>

</html>
