<?php
require "../../error-report.php";
require "../../database/db-config.php";
session_start();
//insert.php

$connect = new PDO('mysql:host=localhost;dbname=agent', 'root', 'root9080');

if (isset($_POST["title"])) {
	$query = "
 INSERT INTO events
 (title, teacher_id, student_id, is_confirmed, start_event, end_event)
 VALUES (:title, :id , NULL , 0, :start_event, :end_event)
 ";
	$statement = $connect->prepare($query);
	$statement->execute(
		array(
			':id' => $_SESSION['id'],
			':title' => $_POST['title'],
			':start_event' => $_POST['start'],
			':end_event' => $_POST['end'],
		)
	);
}

?>