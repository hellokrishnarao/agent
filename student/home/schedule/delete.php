
<?php
require "../../../database/db-config.php";

//delete.php
$dbserver = DB_SERVER;
$dbuser = DB_USERNAME;
$dbpassword = DB_PASSWORD;
$db = DB_DATABASE;

$con = 'mysql:host=' . $dbserver . ';dbname=' . $db;
if (isset($_POST["id"])) {
	$connect = new PDO($con, $dbuser, $dbpassword);
	$query = "
 DELETE from events WHERE id=:id
 ";
	$statement = $connect->prepare($query);
	$statement->execute(
		array(
			':id' => $_POST['id'],
		)
	);
}

?>
