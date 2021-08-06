<?php require_once('../../codeblocks/session.php'); ?>
<?php require_once('../../database/connection.php'); ?>
<?php require_once('../../codeblocks/login.php');?>
<?php require_once('../../codeblocks/functions.php');?>
<?php
	// $conn = mysqli_connect(MYSQL_SERVER, MYSQL_ADMIN, MYSQL_TOCKEN, MYSQL_LOCATION);
	$conn=getConnection();
	$usr_id = $_POST['id'];
	$sql = "SELECT * FROM tblusers WHERE usr_id='$usr_id'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	echo json_encode(array(
		"usr_id" => $row['usr_id'],
		"usr_name" => $row['usr_name'],
		"usr_email" => $row['usr_email'],
		"usr_type" => $row['usr_type']
	));
?>