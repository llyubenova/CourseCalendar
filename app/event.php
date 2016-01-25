<html>
<head>
	<link rel="stylesheet" href="../web/css/calendar.css" />
	<link rel="stylesheet" href="../web/css/event.css" />
</head>
<body>
	<?php
		require_once("../config/dbConfig.php");

		$requestedDate = $_GET['date'];
		$dateFormat = "d M Y";
		$timeFormat = "H:i";
		$dateFormated = date($dateFormat, strtotime($requestedDate));
		$timeFormated = '';
		$queryStr = "SELECT * FROM event WHERE STARTDATE LIKE '".$requestedDate."%' OR ENDDATE LIKE '".$requestedDate."%'";
		$events = $db->query($queryStr);
		$eventHolder = '';

		if ($events->num_rows > 0) {
			echo '<h1>All events for '.$dateFormated.':</h1>';
	        while($event = $events->fetch_object()){
	        	$eventHolder .= '<div class="eventHolder">';

	        	$eventHolder .= '<p>Title: '.$event->TITLE.'</p>';

	        	$eventType = ucfirst(strtolower($event->TYPE));
	        	$eventHolder .= '<p>Type: '.$eventType.'</p>';

	        	if (!empty($event->DESCRIPTION)){
	        		$eventHolder .= '<p>Description: '.$event->DESCRIPTION.'</p>';
	        	}

	        	if ($eventType == 'Homework') {
	        		if (!empty($event->ENDDATE)){
		        		$endTime = date($timeFormat, strtotime($event->ENDDATE));
			        	$eventHolder .= '<p>Due to: '.$endTime.'</p>';
			        }
	        	} else{
					if (!empty($event->STARTDATE && !empty($event->ENDDATE))){
						$startTime = date($timeFormat, strtotime($event->STARTDATE));
						$endTime = date($timeFormat, strtotime($event->ENDDATE));
						$eventHolder .= '<p>From '.$startTime.' to '.$endTime.'</p>';
					}
			    }

	        	if (!empty($event->LECTURER)){
	        		$eventHolder .= '<p>Lecturer: '.$event->LECTURER.'</p>';
	        	}

	        	if (!empty($event->LOCATION)){
	        		$eventHolder .= '<p>Location: '.$event->LOCATION.'</p>';
	        	}
	            $eventHolder .= '</div>';
	        }
	        echo $eventHolder;
	    } else {
	    	echo '<h1>There are no events for '.$dateFormated.'.</h1>';
	    }
	?>
</body>
</html>
