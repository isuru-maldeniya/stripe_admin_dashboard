<?php require_once('../../codeblocks/session.php'); ?>
<?php require_once('../../database/connection.php'); ?>
<?php require_once('../../codeblocks/login.php');?>
<?php require_once('../../codeblocks/functions.php');?>
<?php
	// $conn = mysqli_connect(MYSQL_SERVER, MYSQL_ADMIN, MYSQL_TOCKEN, MYSQL_LOCATION);
	$conn=getConnection();
	$uni_id = $_POST['id'];
	$sql = "SELECT * FROM stripe_keys WHERE id='$uni_id'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	echo json_encode(array(
		// "uni_id" => $row['id'],
		// "uni_name" => $row['stripe_key'],
		// "uni_code" => $row['title'],
		// "uni_logo" => $row['status']

		"id" => $row['id'],
		"stripe_key" => $row['stripe_key'],
		"title" => $row['title'],
		"status" => $row['status']
	));
?>