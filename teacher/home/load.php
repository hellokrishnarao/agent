<?php
require "../../error-report.php";
require "../../database/db-config.php";
session_start();
//load.php
$id = $_SESSION['id'];
$dbserver = DB_SERVER;
$dbuser = DB_USERNAME;
$dbpassword = DB_PASSWORD;
$db = DB_DATABASE;

$con = 'mysql:host=' . $dbserver . ';dbname=' . $db;
$connect = new PDO($con, 'root', 'root9080');

$query = "SELECT * FROM events WHERE teacher_id=$id ORDER BY id";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach ($result as $row) {
	if ($row["title"] == 'Available') {
		$data[] = array(
			'id' => $row["id"],
			'title' => $row["title"],
			'start' => $row["start_event"],
			'end' => $row["end_event"],
			'color' => '#FF6C00',
		);
	} elseif ($row['title'] == 'Booked') {
		$data[] = array(
			'id' => $row["id"],
			'title' => "New Request",
			'start' => $row["start_event"],
			'end' => $row["end_event"],
			'color' => '#00BFFF',
			'student_id' => $row['student_id'],
		);
	} elseif ($row['title'] == 'Confirmed') {
		$data[] = array(
			'id' => $row["id"],
			'title' => $row["title"],
			'start' => $row["start_event"],
			'end' => $row["end_event"],
			'color' => '#53D467',
			'student_id' => $row['student_id'],
		);
	}

}

echo json_encode($data);

?>