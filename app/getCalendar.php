<?php
	if (!empty($_POST)){
		require_once('../config/dbConfig.php');
		$dateYear = $_POST['year'];
		$dateMonth = $_POST['month'];
	} else {
		$dateYear = ($year != '')?$year:date("Y");
		$dateMonth = ($month != '')?$month:date("m");
		$db = $GLOBALS['db'];
	} 
	
	$date = $dateYear.'-'.$dateMonth.'-01';
	$currentMonthFirstDay = date("N",strtotime($date));
	$totalDaysOfMonth = cal_days_in_month(CAL_GREGORIAN,$dateMonth,$dateYear);
	$totalDaysOfMonthDisplay = ($currentMonthFirstDay == 7)?($totalDaysOfMonth):($totalDaysOfMonth + $currentMonthFirstDay);
	$boxDisplay = ($totalDaysOfMonthDisplay <= 35)?35:42;
?>
	<div id="calender_section">
		<h2>
        	<a href="javascript:void(0);" onclick="getCalendar('calendar_div','<?php echo date("Y",strtotime($date.' - 1 Month')); ?>','<?php echo date("m",strtotime($date.' - 1 Month')); ?>');">&lt;&lt;</a>
            <select name="month_dropdown" class="month_dropdown dropdown"><?php echo getAllMonths($dateMonth); ?></select>
			<select name="year_dropdown" class="year_dropdown dropdown"><?php echo getYearList($dateYear); ?></select>
            <a href="javascript:void(0);" onclick="getCalendar('calendar_div','<?php echo date("Y",strtotime($date.' + 1 Month')); ?>','<?php echo date("m",strtotime($date.' + 1 Month')); ?>');">&gt;&gt;</a>
        </h2>
		<div id="event_list" class="none"></div>
		<div id="calender_section_top">
			<ul>
				<li>Sun</li>
				<li>Mon</li>
				<li>Tue</li>
				<li>Wed</li>
				<li>Thu</li>
				<li>Fri</li>
				<li>Sat</li>
			</ul>
		</div>
		<div id="calender_section_bot">
			<ul>
			<?php 
				$dayCount = 1; 
				for($cb=1;$cb<=$boxDisplay;$cb++){
					if(($cb >= $currentMonthFirstDay+1 || $currentMonthFirstDay == 7) && $cb <= ($totalDaysOfMonthDisplay)){
						if ($dayCount < 10) {
							$dayCount = '0'.$dayCount;
						}
						$currentDate = $dateYear.'-'.$dateMonth.'-'.$dayCount;

						$eventNum = 0;

						$result = $db->query("SELECT TITLE FROM event WHERE STARTDATE LIKE '".$currentDate."%' OR ENDDATE LIKE '".$currentDate."%'");

						$eventNum = $result->num_rows;

						if(strtotime($currentDate) == strtotime(date("Y-m-d"))){
							echo '<li date="'.$currentDate.'" class="grey date_cell">';
						}elseif($eventNum > 0){
							echo '<li date="'.$currentDate.'" class="light_sky date_cell"><a href="app/event.php?date='.$currentDate.'">events ('.$eventNum.')</a>';
						}else{
							echo '<li date="'.$currentDate.'" class="date_cell">';
						}
						
						echo '<span>';
						echo $dayCount;
						echo '</span>';
						
						echo '</li>';
						$dayCount++;
					}else{ 
			?>
				<li><span>&nbsp;</span></li>
			<?php 
				} } 
			?>
			</ul>
		</div>

	</div>
<div> <a href="app/addEvent.php">Add event</a></div>
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
