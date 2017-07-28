<?php
    
    session_start();
    include 'config.php';
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    header('Context-type: text/javascript');
    
    $institution_id = $_SESSION['institutionID'];
    $labels = array();
    $institution = array();
    array_push($labels, 'Aika', 'Käyntikerrat');
    array_push($institution, $labels);
    
    $instiQuery = "SELECT visitquery.gdate as date,
					visitquery._visits as visit_number
					from 
						(select dates.Date_value as gdate
						,visits.institution_id as institution
					    ,ifnull(count(visit_id), 0) as _visits
					  	from student_visits visits
					    	right join datedimension dates on dates.Date_value = cast(visits.time as date)
					   		where dates.Date_value BETWEEN (CURRENT_DATE() - INTERVAL 6 MONTH) AND CURRENT_DATE()
					  	group by institution, gdate
					  	order by gdate ASC
						) as visitquery
					where (visitquery.institution is null or visitquery.institution= '" .$institution_id. "')
					group by date" ;
	
	//    echo $instiQuery;
	$instiResult = mysqli_query($conn, $instiQuery);
	
	while($row = mysqli_fetch_array($instiResult))
	{
		$temp = array();
		array_push($temp,$row['date'],$row['visit_number']);
		
		array_push($institution, $temp);
	}
	echo json_encode($institution);
	
	