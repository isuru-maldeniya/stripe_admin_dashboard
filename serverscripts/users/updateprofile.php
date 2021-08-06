<?php require_once('../../codeblocks/session.php'); ?>
<?php require_once('../../database/connection.php'); ?>
<?php require_once('../../codeblocks/login.php');?>
<?php require_once('../../codeblocks/functions.php');?>
<?php
    // $conn = mysqli_connect(MYSQL_SERVER, MYSQL_ADMIN, MYSQL_TOCKEN, MYSQL_LOCATION);
    $conn=getConnection();
	if (isset($_POST['usr_name'])){ $usr_name = mysqli_real_escape_string($conn, textencode($_POST['usr_name'])); }
    if (isset($_POST['usr_email'])){ $usr_email = mysqli_real_escape_string($conn, textencode($_POST['usr_email'])); }
    if (isset($_POST['usr_id'])){ $usr_id = mysqli_real_escape_string($conn, textencode($_POST['usr_id'])); }
    if (isset($_POST['usr_old_email'])){ $usr_old_email = mysqli_real_escape_string($conn, textencode($_POST['usr_old_email'])); }
	if (!empty($_POST['usr_name']) and !empty($_POST['usr_email']) and !empty($_POST['usr_id']) and !empty($_POST['usr_old_email'])){
        if (countSql(mysqli_connect(MYSQL_SERVER, MYSQL_ADMIN, MYSQL_TOCKEN, MYSQL_LOCATION), "SELECT * FROM tblusers WHERE usr_email='$usr_email' and usr_id<>'$usr_id'") == 0){
            $sql = "UPDATE tblusers SET usr_name='$usr_name', usr_email='$usr_email' WHERE usr_id='$usr_id'";
		    mysqli_query($conn,$sql);
		    echo json_encode(array("status" => "SUCCESS", "msg" => "User details updated."));
        }else{
            echo json_encode(array("status" => "ERROR", "msg" => "This email already in the system."));
        }
	}else{
		echo json_encode(array("status" => "ERROR", "msg" => "Please enter all required data."));
	}
	mysqli_close($conn);
?>