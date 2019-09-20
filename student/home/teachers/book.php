
<?php
require "../../../database/db-config.php";
//update.php
$dbserver = DB_SERVER;
$dbuser = DB_USERNAME;
$dbpassword = DB_PASSWORD;
$db = DB_DATABASE;

$con = 'mysql:host=' . $dbserver . ';dbname=' . $db;

$connect = new PDO($con, $dbuser, $dbpassword);

if (isset($_POST["id"])) {

	$query = "
 UPDATE events
 SET title='Booked', student_id =:student_id, start_event=:start_event, end_event=:end_event
 WHERE teacher_id=:teacher_id and id = :id
 ";
	$statement = $connect->prepare($query);
	$statement->execute(
		array(
			':start_event' => $_POST['start'],
			':end_event' => $_POST['end'],
			':teacher_id' => $_POST['teacher_id'],
			':student_id' => $_POST['student_id'],
			':id' => $_POST['id'],
		)
	);
}

?>
