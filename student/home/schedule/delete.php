
<?php

//delete.php
$event_id = $_POST['id'];
$start = $_POST['start'];
$end = $_POST['end'];

if (isset($_POST["id"])) {
	$connect = new PDO('mysql:host=localhost;dbname=agent', 'root', 'root9080');
	$update = "UPDATE events
 SET title='Available', is_confirmed='0', student_id=null, start_event='$start', end_event='$end' WHERE id =$event_id ";
	$statement = $connect->prepare($update);
	$statement->execute();

}

?>
