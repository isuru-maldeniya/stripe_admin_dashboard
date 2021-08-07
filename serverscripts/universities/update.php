<?php require_once('../../codeblocks/session.php'); ?>
<?php require_once('../../database/connection.php'); ?>
<?php require_once('../../codeblocks/login.php');?>
<?php require_once('../../codeblocks/functions.php');?>
<?php
    // $conn = mysqli_connect(MYSQL_SERVER, MYSQL_ADMIN, MYSQL_TOCKEN, MYSQL_LOCATION);
    $conn=getConnection();
    if (isset($_POST['id_ed'])){ $id = mysqli_real_escape_string($conn, textencode($_POST['id_ed'])); }
	if (isset($_POST['stripe_key_ed'])){ $stripe_key = mysqli_real_escape_string($conn, textencode($_POST['stripe_key_ed'])); }
    if (isset($_POST['status_ed'])){ $status = mysqli_real_escape_string($conn, textencode($_POST['status_ed'])); }
    if (isset($_POST['title_ed'])){ $title = mysqli_real_escape_string($conn, textencode($_POST['title_ed'])); }
	if (!empty($_POST['id_ed']) and !empty($_POST['stripe_key_ed']) and !empty($_POST['status_ed']) and !empty($_POST['title_ed'])){
        $sql = "UPDATE `stripe_keys` SET `stripe_key`='$stripe_key',`title`='$title',`status`='$status' WHERE `id`='$id'";
        mysqli_query($conn,$sql);
        echo json_encode(array("status" => "SUCCESS", "msg" => "Key was successfully updated."));
	}else{
		echo json_encode(array("status" => "ERROR", "msg" => "Please enter all required data."));
	}
	mysqli_close($conn);
?>