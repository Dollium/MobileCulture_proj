<?php
include 'config.php';
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
$_SESSION['institutionID'] = 1;
$inst=$_SESSION['institutionID'];
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
		<div class="logTable">
			<table>
				<?php
				$month=date('n');
				$year=date('o');
				for (  $week=1; $week<(date('W', mktime(0,0,0,12,28,$year))+1); $week++) {
					$code=$inst+$week*7+$month*7*5+$year*7*5*12;
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
	<!-- jQuery first, then bootstrap js -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</body>

</html>