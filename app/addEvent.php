<html>
<body>
<h1>A small example page to insert some data in to the MySQL database using PHP</h1>
<form action="addEvent.php" method="post">
Firstname: <input type="text" name="fname" /><br><br>
Lastname: <input type="text" name="lname" /><br><br>
<input type="submit" />
</form>
 <?php
 require_once('../config/dbConfig.php');
$db->query("INSERT INTO nametable (fname, lname)
VALUES
('$_POST[fname]','$_POST[lname]')");
?>



</body>
</html>
 