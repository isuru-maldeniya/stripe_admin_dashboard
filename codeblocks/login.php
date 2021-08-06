<?php
    // This checks the session of a user is valid. 
    // If user is not singed in, this return the user to login page
	if(!isset($_SESSION['iuni_usid'])){
		//Destroy Session
		$_SESSION = array();
		if(isset($_COOKIE[session_name()])) {
			setcookie(session_name(), '', time()-42000, '/');
		}
		session_destroy();
		header('Location: login.php');
		die();
	}
?>
