<?php require_once('../../codeblocks/session.php'); ?>
<?php require_once('../../database/connection.php'); ?>
<?php require_once('../../codeblocks/login.php');?>
<?php require_once('../../codeblocks/functions.php');?>
<?php
    // $conn = mysqli_connect(MYSQL_SERVER, MYSQL_ADMIN, MYSQL_TOCKEN, MYSQL_LOCATION);
    $conn=getConnection();
	$uni_id = $_POST['id'];
	$sql = "UPDATE tbluniversities SET uni_active='0' WHERE uni_id='$uni_id'";
    mysqli_query($conn,$sql);
    echo json_encode(array("status" => "SUCCESS", "msg" => "University deleted."));
	mysqli_close($conn);
?>