<?php require_once('../../codeblocks/session.php'); ?>
<?php require_once('../../database/connection.php'); ?>
<?php require_once('../../codeblocks/login.php');?>
<?php require_once('../../codeblocks/functions.php');?>
<?php
    // $conn = mysqli_connect(MYSQL_SERVER, MYSQL_ADMIN, MYSQL_TOCKEN, MYSQL_LOCATION);
    $conn=getConnection();
    if (isset($_POST['uni_id'])){ $uni_id = mysqli_real_escape_string($conn, textencode($_POST['uni_id'])); }
	if (isset($_POST['uni_name'])){ $uni_name = mysqli_real_escape_string($conn, textencode($_POST['uni_name'])); }
    if (isset($_POST['uni_code'])){ $uni_code = mysqli_real_escape_string($conn, textencode($_POST['uni_code'])); }
    if (isset($_POST['uni_logo'])){ $uni_logo = mysqli_real_escape_string($conn, textencode($_POST['uni_logo'])); }
	if (!empty($_POST['uni_name']) and !empty($_POST['uni_code']) and !empty($_POST['uni_logo']) and !empty($_POST['uni_id'])){
        $sql = "UPDATE tbluniversities SET uni_name='$uni_name', uni_code='$uni_code', uni_logo='$uni_logo' WHERE uni_id='$uni_id'";
        mysqli_query($conn,$sql);
        echo json_encode(array("status" => "SUCCESS", "msg" => "University updated."));
	}else{
		echo json_encode(array("status" => "ERROR", "msg" => "Please enter all required data."));
	}
	mysqli_close($conn);
?>