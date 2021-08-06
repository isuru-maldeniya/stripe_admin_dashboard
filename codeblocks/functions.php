<?php

    // Encode Data
	function sysencode($text){
		return base64_encode($text);
	}
    
    // Decode Data
	function sysdecode($text){
		return base64_decode($text);
	}
    
    // Use to prevent sql injection
	function textencode($str){
		$str = 	str_replace("'","",$str);
		$str = 	str_replace('"',"",$str);
		$str = 	str_replace(";","",$str);
		$str = 	str_replace("--","",$str);
		$str = 	str_replace("%","",$str);
		$str = 	str_replace("=","",$str);
		return $str;
	}

	function encodeHTML($str){
		$str = str_replace("'", "&#39;", $str);
		$str = str_replace('"', "&rdquo;", $str);
		return $str;
	}

    // Calculate row count in mysql query
	function countSql($conn, $sql){
		$result = mysqli_query($conn, $sql);
		mysqli_close($conn);
		if ($result){
			return mysqli_num_rows($result);
		}else{
			return 0;
		}
	}

    // Set default time zone to Sri Lanka
	date_default_timezone_set('Asia/Colombo');
?>