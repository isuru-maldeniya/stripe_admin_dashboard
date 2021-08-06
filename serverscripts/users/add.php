<?php require_once('../../codeblocks/session.php'); ?>
<?php require_once('../../database/connection.php'); ?>
<?php require_once('../../codeblocks/login.php');?>
<?php require_once('../../codeblocks/functions.php');?>
<?php
    // $conn = mysqli_connect(MYSQL_SERVER, MYSQL_ADMIN, MYSQL_TOCKEN, MYSQL_LOCATION);
	$conn=getConnection();
	if (isset($_POST['usr_name'])){ $usr_name = mysqli_real_escape_string($conn, textencode($_POST['usr_name'])); }
	if (isset($_POST['usr_email'])){ $usr_email = mysqli_real_escape_string($conn, textencode($_POST['usr_email'])); }
	if (isset($_POST['usr_type'])){ $usr_type = mysqli_real_escape_string($conn, textencode($_POST['usr_type'])); }
	$usr_password = $_POST['usr_password'];
	if (!empty($_POST['usr_name']) AND !empty($_POST['usr_email']) AND !empty($_POST['usr_password'])){
		if (countSql(mysqli_connect(MYSQL_SERVER, MYSQL_ADMIN, MYSQL_TOCKEN, MYSQL_LOCATION), "SELECT * FROM tblusers WHERE usr_email='$usr_email'") == 0){
			$usr_password = base64_encode($usr_password);
			$sql = "INSERT INTO tblusers (usr_name, usr_email, usr_password, usr_type) VALUES('$usr_name', '$usr_email', '$usr_password', '$usr_type')";
			mysqli_query($conn,$sql);
			echo json_encode(array("status" => "SUCCESS", "msg" => "User added."));
		}else{
			echo json_encode(array("status" => "ERROR", "msg" => "Email already in the system."));
		}
	}else{
		echo json_encode(array("status" => "ERROR", "msg" => "Please enter all required data."));
	}
	mysqli_close($conn);
?>