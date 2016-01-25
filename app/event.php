<html>
<head>
	<link rel="stylesheet" href="../web/css/calendar.css" />
</head>
<body>
	<div class="events_section">
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
		        	$eventHolder .= '<div class="event_holder">';

		        	$eventHolder .= '<div class="event_heading">'.$event->TITLE.'</div>';

		        	$eventHolder .= '<div class="event_body">';
		        	$eventType = ucfirst(strtolower($event->TYPE));
		        	$eventHolder .= '<p><span class="italic">Type:</span><span class="bold"> '.$eventType.'</span></p>';

		        	if (!empty($event->DESCRIPTION)){
		        		$eventHolder .= '<p><span class="italic">Description:</span><span class="bold"> '.$event->DESCRIPTION.'</span></p>';
		        	}

		        	if ($eventType == 'Homework') {
		        		if (!empty($event->ENDDATE)){
			        		$endTime = date($timeFormat, strtotime($event->ENDDATE));
				        	$eventHolder .= '<p><span class="italic">Due to:<span> <span class="bold">'.$endTime.'</span></p>';
				        }
		        	} else{
						if (!empty($event->STARTDATE && !empty($event->ENDDATE))){
							$startTime = date($timeFormat, strtotime($event->STARTDATE));
							$endTime = date($timeFormat, strtotime($event->ENDDATE));
							$eventHolder .= '<p><span class="italic">From</span> <span class="bold">'.$startTime.'</span> <span class="italic">to</span> <span class="bold">'.$endTime.'</span></p>';
						}
				    }

		        	if (!empty($event->LECTURER)){
		        		$eventHolder .= '<p><span class="italic">Lecturer:</span><span class="bold"> '.$event->LECTURER.'</span></p>';
		        	}

		        	if (!empty($event->LOCATION)){
		        		$eventHolder .= '<p><span class="italic">Location:</span><span class="bold"> '.$event->LOCATION.'</span></p>';
		        	}
		            $eventHolder .= '</div></div>';
		        }
		        echo $eventHolder;
		    } else {
		    	echo '<h1>There are no events for '.$dateFormated.'.</h1>';
		    }
		?>
	</div>
</body>
</html>
