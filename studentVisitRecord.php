<?php
include 'config.php';
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
$ID = $_SESSION['id'];
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
                            <a class="nav-link" href="#">
                                <i class="fa fa-home" aria-hidden="true"></i> Profile <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="studentVisitLog.html">
                                <i class="fa fa-user-circle-o" aria-hidden="true"></i> Log
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="statistics.html">
                                <i class="fa fa-code" aria-hidden="true"></i> Offers
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#projects">
                                <i class="fa fa-cog" aria-hidden="true"></i></i> Setting
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
        
        <div class="box-code">
        <p>Record your visit by the code provided by the institution</p>
        <form method="POST" id="formCode" action="studentVisitRecord.php">
            <input type="text" placeholder="Code" class="data-input" id="institutionCode" name="institutionCode">
            <br>
            <br>
            <button class="btn btn-primary">START</button>
         </form>
          
    	<?php 
    	//SHOULD DELETE SESSIONS EVERY PAGE RELOAD
          $code = $_POST['institutionCode'];
          $numbercode= substr($code,0,6);
          $inst = $numbercode % 7;          
          $week = ($numbercode / 7) % 5;
          $year = floor($numbercode / (7*5*12));
          $week_year_value= $week . "_" . $year;
         
         //NEED REVIEW
        $sql = "SELECT * FROM institution_code WHERE week_year='$week_year_value' AND institution_" .$inst. "='$code'";
		$result= mysqli_query($conn,$sql);
		
        if($result->fetch_assoc() && date('W')==$week && date('o')==$year){
        $q = mysqli_query($conn, "INSERT INTO `student_visits`(`user_id`, `institution_id`, `time`) VALUES ('$ID','$inst',NOW())"); 
        } else {echo "Wrong code";}  
        ?>
    	</div>
    </div>

    <!-- jQuery first, then bootstrap js -->

    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</body>
</html>