<?php
include 'config.php';
session_start();
error_reporting(0);
ini_set('display_errors', 0);
$username = $_SESSION['username'];
$password = $_SESSION['password'];

$sql = "SELECT * FROM user WHERE Email='$username' AND Password='$password'";
$result= mysqli_query($conn,$sql);
$row = $result->fetch_assoc();

// print_r($_SESSION);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>

<body>
    <div class="col-lg-8 container" style="background-color: #FFF;">
      <?php if($_SESSION["isAdmin"] == true) { ?>
        <div class="row">

            <nav class="col-lg-12 navbar navbar-toggleable-md navbar-inverse bg-primary centered">
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="#">Admin Page</a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="school.php">
                                <i class="fa fa-home" aria-hidden="true"></i> Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="addInst.php">
                                <i class="fa fa-user-circle-o" aria-hidden="true"></i> Add institution
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="addSclAd.php">
                                <i class="fa fa-user-circle-o" aria-hidden="true"></i> Add school admin
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="settings.php">
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
        <div class="row">
        <form>

            <label class="mr-sm-2" for="inlineFormCustomSelect">Show statistics by</label>
            <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="inlineFormCustomSelect">
              <option value="school" selected>School</option>
              <option value="institution">Institution</option>
              <option value="Timespan">Timespan</option>
          </select>
            <br>
            <br>
            <input type="text" name="startDate" id="startDate"> <input type="text" name="endDate" id="endDate">
            <button type="submit" class="btn btn-primary">Get the statistics</button>
        </form>
        <br>
        <center>
            <div id="columnchart_material" style="width: 900px; height: 500px;"></div>
        </center>
      </div>





        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['bar']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['School', 'Museum', 'Cinema', 'City Symphony', 'City Theater'],
                    ['School1', 1000, 400, 200, 247],
                    ['School2', 1170, 460, 250, 240],
                    ['School3', 660, 1120, 300, 230]
                ]);

                var options = {
                    chart: {
                        title: 'Student visits record',
                        subtitle: 'Timespan: 16/9/2017-16/03/2017',
                    }
                };

                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                chart.draw(data, options);
            }
            $(document).ready(function() {
                $('#startDate').datepicker();
                $('#endDate').datepicker();
            })
        </script>
<?php }
else{ ?>

                  <div class="row">

                      <nav class="col-lg-12 navbar navbar-toggleable-md navbar-inverse bg-primary centered">
                          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
                          <a class="navbar-brand" href="#">Logo</a>

                          <div class="collapse navbar-collapse" id="navbarSupportedContent">




                          </div>
                            <a class="navbar-brand pull-sm-right mr-0" style="padding-right: 30px;" href="index.php"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
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

</body>

</html>
