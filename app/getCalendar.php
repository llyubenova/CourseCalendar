<?php
	if (empty($_POST)){
		$dateYear = ($year != '')?$year:date("Y");
		$dateMonth = ($month != '')?$month:date("m");
		$db = $GLOBALS['db'];
	} else {
		require_once('../config/dbConfig.php');
		$dateYear = $_POST['year'];
		$dateMonth = $_POST['month'];
	}

	$date = $dateYear.'-'.$dateMonth.'-01';
	$currentMonthFirstDay = date("N", strtotime($date));
	$totalDaysOfMonth = cal_days_in_month(CAL_GREGORIAN, $dateMonth,$dateYear);
	$totalDaysOfMonthDisplay = ($currentMonthFirstDay == 7) ? ($totalDaysOfMonth) : ($totalDaysOfMonth + $currentMonthFirstDay);
	$boxDisplay = ($totalDaysOfMonthDisplay <= 35) ? 35 : 42;
?>
	<div class="calendar_section">
		<div class="section_header">
        	<a href="javascript:void(0);" onclick="getCalendar('calendar_div','<?php echo date("Y",strtotime($date.' - 1 Month')); ?>','<?php echo date("m",strtotime($date.' - 1 Month')); ?>');">&lt;&lt;</a>
            <select name="month_dropdown" class="month_dropdown dropdown">
            	<?php echo getAllMonths($dateMonth); ?>
            </select>
			<select name="year_dropdown" class="year_dropdown dropdown">
				<?php echo getYearList($dateYear); ?>
			</select>
            <a href="javascript:void(0);" onclick="getCalendar('calendar_div','<?php echo date("Y",strtotime($date.' + 1 Month')); ?>','<?php echo date("m",strtotime($date.' + 1 Month')); ?>');">&gt;&gt;</a>
        </div>
		<table class="calendar_table">
			<thead>
				<th>Sun</th>
				<th>Mon</th>
				<th>Tue</th>
				<th>Wed</th>
				<th>Thu</th>
				<th>Fri</th>
				<th>Sat</th>
			</thead>
			<tbody>
			<?php 
				$dayCount = 1;
				$index = 0;
				$calendarBuilder = '';
				for( $row = 1; $row <= $boxDisplay / 7; $row++) {
					$calendarBuilder .= '<tr>';
					for( $col = 1; $col <= 7; $col++) {
						$index++;
						if(($index >= $currentMonthFirstDay + 1 || $currentMonthFirstDay == 7) && $index <= ($totalDaysOfMonthDisplay)){
							if ($dayCount < 10) {
								$dayCount = '0'.$dayCount;
							}
							$currentDate = $dateYear.'-'.$dateMonth.'-'.$dayCount;

							$eventNum = 0;

							$result = $db->query("SELECT TITLE FROM event WHERE STARTDATE LIKE '".$currentDate."%' OR ENDDATE LIKE '".$currentDate."%'");

							$eventNum = $result->num_rows;

							if(strtotime($currentDate) == strtotime(date("Y-m-d"))){
								$calendarBuilder .= '<td date="'.$currentDate.'" class="date_cell today">';
							} elseif($eventNum > 0){
								$calendarBuilder .= '<td date="'.$currentDate.'" class="date_cell event_date">';
							} else {
								$calendarBuilder .= '<td date="'.$currentDate.'" class="date_cell">';
							}
							
							$calendarBuilder .= '<span>'.$dayCount.'</span>';

							if ($eventNum > 0) {
								$calendarBuilder .= '<a href="app/event.php?date='.$currentDate.'" class="events_link">events ('.$eventNum.')</a>';
							}
							$calendarBuilder .= '</td>';
							$dayCount++;
						} else { 
							$calendarBuilder .= '<td><span>&nbsp;</span></td>';
						}
					}
					$calendarBuilder .= '</tr>';
				} 
				echo $calendarBuilder;
			?>
			</tbody>
		</table>
	</div>

<?php
function getAllMonths($selected = ''){
	$options = '';
	for($i=1;$i<=12;$i++)
	{
		$value = ($i < 01)?'0'.$i:$i;
		$selectedOpt = ($value == $selected)?'selected':'';
		$options .= '<option value="'.$value.'" '.$selectedOpt.' >'.date("F", mktime(0, 0, 0, $i+1, 0, 0)).'</option>';
	}
	return $options;
}

function getYearList($selected = ''){
	$options = '';
	for($i=2015;$i<=2025;$i++)
	{
		$selectedOpt = ($i == $selected)?'selected':'';
		$options .= '<option value="'.$i.'" '.$selectedOpt.' >'.$i.'</option>';
	}
	return $options;
}
?>
