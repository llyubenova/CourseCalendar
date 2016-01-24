<html>
<head>
	<link type="text/css" rel="stylesheet" href="css/calendar.css" />
</head>
<body>
	<script src="../lib/js/jquery.min.js"></script>
	<script src="js/calendar.js"></script>

<?php
	error_reporting(E_ALL ^ E_WARNING);
	require_once('../app/calendar.php');
	
	$calendar = new Calendar();
?>

<div id="calendar_div">
	<?php
		$calendar->showCalendar();
	?>
</div>




</body>
</html>
