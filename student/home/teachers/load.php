<?php

session_start();
//load.php
$id = $_SESSION['teachers_id'];
$connect = new PDO('mysql:host=localhost;dbname=agent', 'root', 'root9080');

$query = "SELECT * FROM events WHERE teacher_id=$id and title='Available' ORDER BY id";
//show only available slots

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach ($result as $row) {
	$data[] = array(
		'id' => $row["id"],
		'title' => $row["title"],
		'start' => $row["start_event"],
		'end' => $row["end_event"],
	);
}

echo json_encode($data);

?>