<?php
	// Server info
	define ("MYSQL_SERVER", "localhost");
	define ("MYSQL_ADMIN", "root");
	define ("MYSQL_TOCKEN", "");
	define ("MYSQL_LOCATION", "ui_db");
	define("MYSQL_PORT",3307);

	function getConnection(){
		$conn = mysqli_connect(MYSQL_SERVER, MYSQL_ADMIN, MYSQL_TOCKEN, MYSQL_LOCATION,MYSQL_PORT);
		return $conn;
	}

	
?>