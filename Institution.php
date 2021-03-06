<?php
include 'config.php';
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
$ID = $_SESSION['id'];
$sql_inst = "SELECT * FROM institution WHERE institution_user_id='$ID'";
$result_inst= mysqli_query($conn,$sql_inst);
$row_inst = $result_inst->fetch_assoc();
$_SESSION['institutionID'] = $row_inst['institution_id'];
$inst=$_SESSION['institutionID'];
$inst_name=$row_inst['Name'];
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

    <title>Institution</title>
</head>

<body>
	<div class="col-lg-8 container" style="background-color: #FFF;">
      <?php if($_SESSION["isInstitution"] == true) { ?>
        <div class="row">

            <nav class="col-lg-12 navbar navbar-toggleable-md navbar-inverse bg-primary centered">
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="#">Institution Page - <?php echo $inst_name; ?></a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <a class="navbar-brand pull-sm-right mr-0" style="padding-right: 30px;" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>
                </a>
                </div>
              </nav>
            <br>
        	<br>
        	<br>
        </div>
        <div class="row">
        <div class="col-lg-8 container" style="background-color: #FFF;">
			<div class="logTable">
				<table>
					<?php
					$month=date('n');
					$year=date('o');
					
					for (  $week=1; $week<(date('W', mktime(0,0,0,12,28,$year))+1); $week++) {
						switch($inst) {
							case 1:
								$code='MU';
								break;
							case 2:
								$code='TE';
								break;
							case 3:
								$code='SI';
								break;
							case 4:
								$code='KI';
								break;
						}
						
						$code .=$inst+$week*7+$month*7*5+$year*7*5*12;
						$code .=substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 2); 
	                	$week_year_value= $week . "_" . $year;
	                	$insertCodeQuery = "INSERT INTO institution_code_" .$inst. " (week_year, code)
											SELECT * FROM (SELECT '" .$week_year_value. "', '" .$code. "') AS confirmation
											WHERE NOT EXISTS (
	    										SELECT week_year FROM institution_code_" .$inst. " WHERE week_year=" . $week_year_value ."
											) LIMIT 1;";
						
						if (mysqli_query($conn, $insertCodeQuery)){
	          				
	   					 } else {
	   						echo mysqli_error($conn);
	   					}
	               	} 
	               	echo"<tr><td> Week_Year </td><td> Code </td></tr>";
	               	$query = "SELECT week_year, code FROM institution_code_" .$inst. " ORDER BY LENGTH(week_year), week_year ASC";
	             	$result = mysqli_query($conn, $query);
	              	while($row = mysqli_fetch_array($result))
	              	{
	                	echo"<tr><td>". $row["week_year"] ." </td><td> ". $row["code"] ." </td></tr>";
	              	}
	                      
	                ?>
		        </table>
			</div>
		</div>
	</div>
<?php }
else{ ?>

                  <div class="row">
                      <nav class="col-lg-12 navbar navbar-toggleable-md navbar-inverse bg-primary centered">
                      	<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            				<span class="navbar-toggler-icon"></span>
            			</button>
                          
                        <a class="navbar-brand" href="#">Logo</a>
                        <a class="navbar-brand pull-sm-right mr-0" style="padding-right: 30px;" href="index.php"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
                      </nav>
                      <br>
                  </div>

                  <br>
                  <br>
                  <!-- /navbar -->
                  <div class="restrict"><?php echo "You are not authorized to access this page."; ?> </div>
                      <br>
          <?php
          }
          ?>
    </div>
	
	<!-- jQuery first, then bootstrap js -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</body>

</html>