<?php require_once('../../codeblocks/session.php'); ?>
<?php require_once('../../database/connection.php'); ?>
<?php require_once('../../codeblocks/login.php');?>
<?php require_once('../../codeblocks/functions.php');?>
<?php
    // $conn = mysqli_connect(MYSQL_SERVER, MYSQL_ADMIN, MYSQL_TOCKEN, MYSQL_LOCATION);
    $conn=getConnection();
	$id = $_POST['id'];
    $val=false;
	// $sql = "UPDATE stripe_keys SET status='$val' WHERE id='$uni_id'";
    $sql="UPDATE `stripe_keys` SET `status`='$val' WHERE `id`='$id'";
    mysqli_query($conn,$sql);
    echo json_encode(array("status" => "SUCCESS", "msg" => "Key was successfully deleted."));
	mysqli_close($conn);
?>