<?php
include 'config.php';
session_start();
//ini_set('display_errors', 1);
//error_reporting(E_ALL);
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
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <title>Instituutio</title>
</head>

<body>
  <div class="container-fluid">
    <div class="row-fluid">

	<div class="container" style="background-color:#f3f3f5;">
      <?php if($_SESSION["isInst"] == true) { ?>
        <div class="row">
            <nav class="col-lg-12 navbar navbar-toggleable-md navbar-inverse">
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="#"><img src="img/Lahti_logo_nega_RGB_web.jpg" /></a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mr-auto">
                      <li class="nav-item">
                        <li class="nav-item active">
                            <a class="nav-link" href="Institution.php">
                                <i class="fa fa-home" aria-hidden="true"></i> Etusivu <span class="sr-only">(current)</span>
                            </a>
                        </li>
                          <a class="nav-link" href="settings.php">
                              <i class="fa fa-cog" aria-hidden="true"></i> Asetukset
                          </a>
                      </li>
                    </ul>
                    <a class="navbar-brand pull-sm-right mr-0" style="padding-right: 30px; padding-top:7px; font-size: 16px;" href="logout.php">Kirjaudu ulos &nbsp;<i class="fa fa-sign-out" aria-hidden="true"></i>
                </a>
                </div>
              </nav>
            <br>
        	<br>
        	<br>
          <div class="container" style="background-color:#f3f3f5; padding-bottom: 50px;">
        <div class="row">
        	<div class="col-sm-12 container">
	        	<div class="col-sm-12 container-code">
					<br><br><br>
					<p>
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

		               	//only shows the code of current week
		               	$currentWeek=date('W');
		               	$current_week_year_value=$currentWeek ."_". $year;
		               	$query = "SELECT * FROM institution_code_" .$inst. " WHERE week_year='" . $current_week_year_value ."'";
		             	$result = mysqli_query($conn, $query);
		              	if($row = mysqli_fetch_array($result))
		              	{
		                	echo"<h3 style='text-align:center'> Viikko "; echo "".date('W')." : ". $row["code"] ."</h3>";
		              	}

		                ?>
			        </p>
			    </div>
			    <br><br><br>
			    
	  			<div class="col-sm-12 file-download">
				    <div class="text-center">
				    	<button id="fileDownload" class="btn btn-primary"> Lataa vuoden <?php echo date('o') ?> koodit</button>
		    		<br> <br> <br>
		    		</div>
		    	</div>
			    
			    <div class="col-sm-12 chart">
		  			<div id="chart" style='display: block; margin: 0 auto !important; width: 80%; display: flex; min-height: 450px;'></div>
				</div>			
			</div>
		</div>	
  </div>
<?php }
else{ ?>
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

          <?php
          }
          ?>

</div>
</div>
</div>

	<!-- jQuery first, then bootstrap js -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    	<script type="text/javascript">
        	document.getElementById('fileDownload').addEventListener('click', function() {
      		document.location.href = 'Institution_code_file.php';
    		});
    		
    	</script>
    	
    	<script>
    	
    	document.addEventListener("DOMContentLoaded", function(event) {
		    		$.getJSON("chartInsti_line.php", function(result){
		                window.institutionVisit = result;
		                institutionVisit = institutionVisit.map(function (row) {                
		                	if (row === institutionVisit[0]) {
		                        return row;
		                    }
		                    return row.map(function (value, index) {
		
								if (index===0) {
									var date = new Date (value);
									date.setHours(0,0,0,0);
									return date;
								}
								
		                        if(index===1)   {
		                        	return  Number(value);                            
		                        }
		                        return value;
		                     
		                    })
		                })
		          	});

            		// Load the Visualization API and the piechart package.
    				google.charts.load('current', {'packages': ['corechart'], 'language': 'fi'});
    		
    				// Set a callback to run when the Google Visualization API is loaded.
    				google.charts.setOnLoadCallback(drawChart);
    		
    				function drawChart() {

    					console.log(institutionVisit);
    					var data = new google.visualization.arrayToDataTable(institutionVisit);
    					

          				var options = {
                                title: "Opiskelijoiden käyntikerrat viimeisen 6kk aikana",
                                width: 850,
                                height: 400,  
                                linewidth: 5,
                                chartArea: {left:"10%"},                                                 
                               	hAxis: {
          							title: 'Aika'
        						},
        						vAxis: {
          							title: 'Käyntien määrä'
        						},
                                fill: '#f3f3f5',
                            };
	      				//Instantiate and draw our chart, passing in some options.
	      				var chart = new google.visualization.LineChart(document.getElementById("chart"));
	      				chart.draw(data, options);
      				}
    	});
    	</script>            
</body>

</html>
