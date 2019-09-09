<?php

session_start();
//load.php

$id = $_SESSION['teacher_id'];
$connect = new PDO('mysql:host=localhost;dbname=agent', 'root', 'root9080');
$student_id = $_SESSION['id'];
$teacher_id = $_SESSION['teacher_id'];
$query = "SELECT * FROM events WHERE teacher_id=$id and title='Available' or student_id=$student_id and title='Booked' ORDER BY id";
// query gets all bookings
// //show only available slots

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
			'title' => "Waiting For Confirmation",
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