<html>
	<head>
		 <link rel="stylesheet" href="../lib/css/jquery-ui.css">
		 <link rel="stylesheet" href="../lib/css/jquery-ui-timepicker-addon.css">
		<style type="text/css">
			.error {
				color: #f00;
			}
		</style>
	</head>
	<body>
		<script src="../lib/js/jquery.min.js"></script>
  		<script src="../lib/js/jquery-ui.min.js"></script>
  		<script src="../lib/js/jquery-ui-timepicker-addon.js"></script>
	   <script>
	  $(function() {
	    $( ".datepicker" ).datetimepicker({
	    	showSecond: true,
	        timeFormat: 'hh:mm:ss',
	        dateFormat: 'yy-mm-dd',
	        minDate: getFormattedDate(new Date())
		});

		function getFormattedDate(date) {
		    var day = date.getDate();
		    var month = date.getMonth() + 1;
		    var year = date.getFullYear().toString().slice(2);
		    return day + '-' + month + '-' + year;
		}
		});
  </script>
		<?php
			$titleError = "";
			$endDateError = "";
			$descriptionError = "";

			if(isset($_POST['submit'])){
				$title = isset($_POST["title"]) ? $_POST["title"] : "";
				$endDate = isset($_POST["enddate"]) ? $_POST["enddate"] : "";
				$description = isset($_POST["description"]) ? $_POST["description"] : "";
				$startDate = isset($_POST["startdate"]) ? $_POST["startdate"] : "";
				$type = isset($_POST["type"]) ? $_POST["type"] : "";
				$lecturer = isset($_POST["lecturer"]) ? $_POST["lecturer"] : "";
				$location = isset($_POST["location"]) ? $_POST["location"] : "";
				if (empty($title) || strlen($title) > 50) {
					$titleError = "Invalid title.";
				}
				if (strlen($description) > 300) {
					$descriptionError = "Invalid description.";
				}
				if (empty($endDate)) {
					$endDateError = "End date is required.";
				}
				
			}
		?>
		<form method="post" action="addEvent.php">
			<div>
				<label for="title">*Title:</label>
				<input type="text" id="title" name="title" value = "<?php if (isset($_POST['title'])) { echo $_POST['title']; } ?>" />
				<span class="error"><?php echo $titleError; ?></span>

			</div>

			<div>
				<label for="description">Description: </label>
				<textarea id="description" name="description" > <?php if (isset($_POST['description'])) { echo $_POST['description']; } ?></textarea>
				<span class="error"><?php echo $descriptionError; ?></span>
			</div>

			<div>
				<label for="type">*Type: </label>
				<select name="type">
				  <option value="EXAM">Exam</option>
				  <option value="HOMEWORK">Homework</option>
				  <option value="PRESENTATION">Presentation</option>
				  <option value="LECTURE">Lecture</option>
				  <option value="PROJECT">Project</option>
				  <option value="PRACTICE">Practice</option>
				  <option value="EVENT">Event</option>
				</select>

			<div>
				<label>Start date: </label> <input type="text" class="datepicker" name="startdate" value ="<?php if (isset($_POST['startdate'])) { echo $_POST['startdate']; } ?>" />
			</div>

			<div>
				<label>*End date: </label>
				<input type="text" class="datepicker" name="enddate" value ="<?php if (isset($_POST['enddate'])) { echo $_POST['enddate']; } ?>"/>
				<span class="error"><?php echo $endDateError; ?></span>
			</div>

			<div>
				<label for="materials">Location: </label>
				<input type="text" name="location" value ="<?php if (isset($_POST['location'])) { echo $_POST['location']; } ?>"/>
			</div>
			<div>
				<label for="lecturer">Lecturer: </label>
				<input type="text" id="lecturer" name="lecturer" value ="<?php if (isset($_POST['lecturer'])) { echo $_POST['lecturer']; } ?>" />
			</div>

			<input type="submit" name="submit" value="Submit">
		</form>
	</body>
</html>