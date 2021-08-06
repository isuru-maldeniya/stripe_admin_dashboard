<?php require_once('../../codeblocks/session.php'); ?>
<?php require_once('../../database/connection.php'); ?>
<?php require_once('../../codeblocks/login.php');?>
<?php require_once('../../codeblocks/functions.php');?>
<?php
	// $conn = mysqli_connect(MYSQL_SERVER, MYSQL_ADMIN, MYSQL_TOCKEN, MYSQL_LOCATION);
	$conn=getConnection();
	$uni_id = $_POST['id'];
	$sql = "SELECT * FROM tbluniversities WHERE uni_id='$uni_id'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	echo json_encode(array(
		"uni_id" => $row['uni_id'],
		"uni_name" => $row['uni_name'],
		"uni_code" => $row['uni_code'],
		"uni_logo" => $row['uni_logo']
	));
?>