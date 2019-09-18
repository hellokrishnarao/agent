<?php

class Student {

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
	public function register($firstName, $lastName, $password, $email, $gender, $dob, $nationality, $jlpt, $phone) {

		$password = md5($password); // HASH
		$sql = "SELECT * FROM students WHERE email='$email' OR phone='$phone'";

		//checking if the username or email is available in db
		$check = $this->db->query($sql);
		$count_row = $check->num_rows;

		//if the username is not in db then insert to the table
		if ($count_row == 0) {
			$insert = "INSERT INTO students SET first_name='$firstName',last_name='$lastName', password='$password', email='$email', gender='$gender', dob='$dob',nationality='$nationality', jlpt = '$jlpt', phone='$phone'";
			$result = mysqli_query($this->db, $insert) or die(mysqli_connect_errno() . " Data cannot inserted");
			$_SESSION['login'] = TRUE;

			$result = "SELECT id from students WHERE email='$email'";

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
		$check = "SELECT id, email, password from students WHERE email='$email' and password='$password'";

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
		$sql = "SELECT first_name, last_name FROM students WHERE id = $id";
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
	public function get_student_info() {
		$id = $_SESSION['id'];
		$result = "SELECT * from students WHERE id='$id'";

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
	public function get_student_data($id) {

		$result = "SELECT * from students WHERE id='$id'";

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
	public function update_details($id, $first_name, $last_name, $jlpt, $phone, $description) {

		$update = "UPDATE `students` SET `first_name`='$first_name',`last_name`='$last_name',`jlpt`='$jlpt',`description`='$description',`phone`='$phone'  WHERE `id` = '$id'";
		$result = mysqli_query($this->db, $update);

		$count_row = $result->num_rows;

		if (mysqli_affected_rows($this->db) == 1) {
			return true;
		} else {
			return false;
		}

	}
	public function change_password($current, $new, $confirm) {

		$id = $this->id;
		$result = "SELECT password from students WHERE id='$id'";
		$new = md5($new);
		$confirm = md5($confirm);
		$current = md5($current);
		//checking if the username is available in the table
		$result = mysqli_query($this->db, $result);
		$user_data = mysqli_fetch_array($result);
		$old = $user_data[0];

		if ($new != $confirm) {
			return 'New Password and Confirm Password do not match! Try Again!';
		} elseif ($current != $old) {
			return 'Please enter the previous password correctly!';
		} else {
			$change_password = "UPDATE teachers SET password='$new' WHERE id='$id'";

			//checking if the username is available in the table
			$change_password = mysqli_query($this->db, $change_password);

			if ($change_password == true) {
				return 'Password Changed Succes	fully';
			}
		}
	}
}
