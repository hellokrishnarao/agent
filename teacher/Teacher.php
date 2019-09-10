<?php

class Teacher {

	private $db;
	private $id;
	public function __construct($server, $dbusername, $dbpassword, $dbname) {
		$this->db = new mysqli($server, $dbusername, $dbpassword, $dbname);

		if (mysqli_connect_errno()) {
			echo "Error: Could not connect to database.";
			exit;
		}
	}
	public function set_id($id) {
		$this->id = $id;
	}
	public function get_id() {
		return $this->id;
	}
	/*** for registration process ***/
	public function register($firstName, $lastName, $password, $email, $gender, $dob, $nationality, $jlpt, $experience, $phone) {

		$password = md5($password); // HASH
		$sql = "SELECT * FROM teachers WHERE email='$email' OR phone='$phone'";

		//checking if the username or email is available in db
		$check = $this->db->query($sql);
		$count_row = $check->num_rows;

		//if the username is not in db then insert to the table
		if ($count_row == 0) {
			$insert = "INSERT INTO teachers SET first_name='$firstName',last_name='$lastName', password='$password', email='$email', gender='$gender', dob='$dob', nationality='$nationality', jlpt = '$jlpt', experience='$experience', phone='$phone'";
			$result = mysqli_query($this->db, $insert) or die(mysqli_connect_errno() . "Data cannot inserted");
			$_SESSION['login'] = TRUE;

			$result = "SELECT id from teachers WHERE email='$email'";

			//checking if the id is available in the table
			$result = mysqli_query($this->db, $result);
			$data = mysqli_fetch_array($result);
			$count_row = $result->num_rows;

			if ($count_row == 1) {
				$_SESSION['id'] = $data['id'];
			} else {
				return false;
			}
			return $result;
		} else {
			return false;
		}
	}

	/*** for login process ***/
	public function login($email, $password) {

		$password = md5($password);
		$check = "SELECT id, email, password from teachers WHERE email='$email' and password='$password'";

		//checking if the username is available in the table
		$result = mysqli_query($this->db, $check);
		$user_data = mysqli_fetch_array($result);
		$count_row = $result->num_rows;
		if ($count_row == 1) {
			// this login var will use for the session thing
			$_SESSION['login'] = true;
			$_SESSION['id'] = $user_data['id'];
			$this->set_id($user_data['id']);
			return true;
		} else {
			return false;
		}
	}

	/*** for showing the username or fullname ***/
	public function get_fullname($id) {
		$sql = "SELECT first_name, last_name FROM teachers WHERE id = $id";
		$result = mysqli_query($this->db, $sql);
		$user_data = mysqli_fetch_array($result);
		echo $user_data['first_name'] . " " . ['last_name'];
	}

	/*** starting the session ***/
	public function get_session() {
		return $_SESSION['login'];
	}

	public function user_logout() {
		$_SESSION['login'] = FALSE;
		session_destroy();
	}

	public function get_teacher_info() {

		$id = $_SESSION['id'];

		$result = "SELECT * from teachers WHERE id='$id'";

		//checking if the username is available in the table
		$result = mysqli_query($this->db, $result);
		$user_data = mysqli_fetch_array($result);
		$count_row = $result->num_rows;

		if ($count_row == 1) {
			return $user_data;
		} else {
			return 'no data';
		}
	}

	public function get_all_teachers() {
		$result = "SELECT * from teachers";

		//checking if the username is available in the table

		$rows = array();
		$result = mysqli_query($this->db, $result);
		while ($row = mysqli_fetch_array($result)) {
			$rows[] = $row;
		}

		//$user_data = mysqli_fetch_array($result);
		$count_row = $result->num_rows;

		if ($count_row >= 1) {
			return $rows;
		} else {
			return 'no data';
		}
	}

	public function update_details($id, $first_name, $last_name, $jlpt, $experience, $phone, $description) {

		$update = "UPDATE `teachers` SET `first_name`='$first_name',`last_name`='$last_name',`jlpt`='$jlpt',`experience`='$experience',`description`='$description',`phone`='$phone'  WHERE `id` = '$id'";
		$result = mysqli_query($this->db, $update);

		$count_row = $result->num_rows;

		if (mysqli_affected_rows($this->db) == 1) {
			return true;
		} else {
			return false;
		}

	}

	public function confirm_event($start_event, $end_event, $event_id) {
		$update = "UPDATE events
 SET title='Confirmed', is_confirmed='1', start_event='$start_event', end_event='$end_event'
 WHERE id = '$event_id'
 ";
		$result = mysqli_query($this->db, $update);

		$count_row = $result->num_rows;

		if (mysqli_affected_rows($this->db) == 1) {
			return true;
		} else {
			return false;
		}
	}
	public function get_start_event($event_id) {

		$result = "SELECT start_event from events WHERE id='$event_id'";

		//checking if the username is available in the table
		$result = mysqli_query($this->db, $result);
		$user_data = mysqli_fetch_array($result);
		$count_row = $result->num_rows;

		if ($count_row == 1) {
			return $user_data;
		} else {
			return 'no data';
		}
	}
	public function get_end_event($event_id) {

		$result = "SELECT end_event from events WHERE id='$event_id'";

		//checking if the username is available in the table
		$result = mysqli_query($this->db, $result);
		$user_data = mysqli_fetch_array($result);
		$count_row = $result->num_rows;

		if ($count_row == 1) {
			return $user_data;
		} else {
			return 'no data';
		}
	}

	public function is_confirmed($event_id) {
		$result = "SELECT is_confirmed from events WHERE id='$event_id'";

		//checking if the username is available in the table
		$result = mysqli_query($this->db, $result);
		$result = mysqli_fetch_array($result);
		$is_confirmed = $result[0];
		return $is_confirmed;

	}

	public function cancel_event($start_event, $end_event, $event_id) {

		$update = "UPDATE events
 SET title='Available', is_confirmed='0', student_id = null, start_event='$start_event', end_event='$end_event'
 WHERE id = $event_id
 ";
		$result = mysqli_query($this->db, $update);

		$count_row = $result->num_rows;

		if (mysqli_affected_rows($this->db) == 1) {
			return "1";
		} else {
			return $update;
		}
	}
}
