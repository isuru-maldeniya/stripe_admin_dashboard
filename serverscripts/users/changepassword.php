<?php require_once('../../codeblocks/session.php'); ?>
<?php require_once('../../database/connection.php'); ?>
<?php require_once('../../codeblocks/login.php');?>
<?php require_once('../../codeblocks/functions.php');?>
<?php
    // $conn = mysqli_connect(MYSQL_SERVER, MYSQL_ADMIN, MYSQL_TOCKEN, MYSQL_LOCATION);
    $conn=getConnection();
	if (isset($_POST['usr_password'])){ $usr_password = mysqli_real_escape_string($conn, textencode($_POST['usr_password'])); }
    if (isset($_POST['usr_cpassword'])){ $usr_cpassword = mysqli_real_escape_string($conn, textencode($_POST['usr_cpassword'])); }
    if (isset($_POST['usr_old_password'])){ $usr_old_password = mysqli_real_escape_string($conn, textencode($_POST['usr_old_password'])); }
    if (isset($_POST['usr_id'])){ $usr_id = mysqli_real_escape_string($conn, textencode($_POST['usr_id'])); }
	if (!empty($_POST['usr_password']) and !empty($_POST['usr_cpassword']) and !empty($_POST['usr_old_password'])){
        $usr_old_password = base64_encode($usr_old_password);
        if (countSql(mysqli_connect(MYSQL_SERVER, MYSQL_ADMIN, MYSQL_TOCKEN, MYSQL_LOCATION), "SELECT * FROM tblusers WHERE usr_id='$usr_id' AND usr_password='$usr_old_password'") > 0){
            if ($usr_password == $usr_cpassword){
                $usr_password = base64_encode($usr_password);
                $sql = "UPDATE tblusers SET usr_password='$usr_password' WHERE usr_id='$usr_id'";
                mysqli_query($conn,$sql);
                echo json_encode(array("status" => "SUCCESS", "msg" => "User details updated."));
            }else{
                echo json_encode(array("status" => "ERROR", "msg" => "Entered password does not match."));
            }
        }else{
            echo json_encode(array("status" => "ERROR", "msg" => "Current password not match."));
        }
	}else{
		echo json_encode(array("status" => "ERROR", "msg" => "Please enter all required data."));
	}
	mysqli_close($conn);
?>