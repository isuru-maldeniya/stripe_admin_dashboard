<?php require_once('../../codeblocks/session.php'); ?>
<?php require_once('../../database/connection.php'); ?>
<?php require_once('../../codeblocks/login.php');?>
<?php require_once('../../codeblocks/functions.php');?>
<?php
    // $conn = mysqli_connect(MYSQL_SERVER, MYSQL_ADMIN, MYSQL_TOCKEN, MYSQL_LOCATION);
    $conn=getConnection();
	$usr_id = $_POST['id'];
	$sql = "DELETE FROM tblusers WHERE usr_id='$usr_id'";
    mysqli_query($conn,$sql);
    echo json_encode(array("status" => "SUCCESS", "msg" => "User deleted."));
	mysqli_close($conn);
?>