<?php require_once('../../codeblocks/session.php'); ?>
<?php require_once('../../database/connection.php'); ?>
<?php require_once('../../codeblocks/login.php');?>
<?php require_once('../../codeblocks/functions.php');?>
<?php
    // $conn = mysqli_connect(MYSQL_SERVER, MYSQL_ADMIN, MYSQL_TOCKEN, MYSQL_LOCATION);
    $conn=getConnection();
	// if (isset($_POST['uni_name'])){ $uni_name = mysqli_real_escape_string($conn, textencode($_POST['uni_name'])); }
    if (isset($_POST['title'])){ $title = mysqli_real_escape_string($conn, textencode($_POST['title'])); }
    if (isset($_POST['stripe_key'])){ $stripe_key = mysqli_real_escape_string($conn, textencode($_POST['stripe_key'])); }
    if (isset($_POST['status'])){ $status = mysqli_real_escape_string($conn, textencode($_POST['status'])); }
    $statusBool=false;
    if($status==="Valid"){
        $statusBool = true;
    }
	if (!empty($_POST['title']) and !empty($_POST['stripe_key']) and !empty($_POST['status'])){

        $sql = "INSERT INTO `stripe_keys`( `stripe_key`, `title`, `status`) VALUES ('$stripe_key','$title','$statusBool')";
        mysqli_query($conn,$sql);
        echo json_encode(array("status" => "SUCCESS", "msg" => "key was successfully added."));
	}else{
		echo json_encode(array("status" => "ERROR", "msg" => "Please enter all required data."));
	}
	mysqli_close($conn);
?>