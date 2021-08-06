<?php require_once('../../codeblocks/session.php'); ?>
<?php require_once('../../database/connection.php'); ?>
<?php require_once('../../codeblocks/login.php');?>
<?php require_once('../../codeblocks/functions.php');?>
<?php
    // $conn = mysqli_connect(MYSQL_SERVER, MYSQL_ADMIN, MYSQL_TOCKEN, MYSQL_LOCATION);
	$conn=getConnection();
	if (isset($_POST['usr_reset_id'])){ $usr_id = mysqli_real_escape_string($conn, textencode($_POST['usr_reset_id'])); }
	$usr_password = $_POST['usr_password'];
	if (!empty($_POST['usr_reset_id']) and !empty($_POST['usr_password'])){
		$usr_password = base64_encode($usr_password);
        $sql = "UPDATE tblusers SET usr_password='$usr_password' WHERE usr_id='$usr_id'";
		mysqli_query($conn,$sql);
		echo json_encode(array("status" => "SUCCESS", "msg" => "Password updated."));
	}else{
		echo json_encode(array("status" => "ERROR", "msg" => "Please enter a password."));
	}
	mysqli_close($conn);
?>