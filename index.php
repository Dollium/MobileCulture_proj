<!DOCTYPE html>
<html lang="en">
<?php session_start(); ?>
<head>
    <meta charset="UTF-8">
    <title>Culture Mobile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.css">
</head>

<body>

    <div class="main-navbar">
        <h1><i class="fa fa-commenting"></i> Our application name</h1>
    </div>
    <!-- div.main-header -->

    <div class="box-join">
        <p>Log in</p>
        <form method="POST" id="formJoin" action="login.php">
            <input type="text" placeholder="USERNAME" class="data-input" id="username" name="username">
            <input type="password" placeholder="PASSWORD" class="data-input" id="password" name="password">

            <?php if(!empty($_SESSION['field_null']))
            {
            ?>
            <div class="alert danger"></div>
            <?php
            echo $_SESSION['field_null']; ?> <?php
            unset($_SESSION['field_null']);
            } ?>
            <?php if(!empty($_SESSION['error']))
            {
            ?>
            <div class="alert danger"></div>
            <?php
            echo $_SESSION['error']; ?> <?php
            unset($_SESSION['error']);
            } ?>
            <br>
            <br>
            <button class="btn btn-primary">START</button>
          </form>
        <!-- form#formJoin -->
    </div>
    <!-- div.box-join -->

    <!-- div.main-header -->


    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js " integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n " crossorigin="anonymous "></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js " integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb " crossorigin="anonymous "></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js " integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn " crossorigin="anonymous "></script>

</body>

</html>
