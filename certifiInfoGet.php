<?php
	$mysql_host = "localhost";
	$mysql_username = "root";
	$mysql_password = "linianyi11";
	$mysql_database = "graduation";	
	$username = $_POST["username"];
	$password = $_POST["password"];
	
	$conn = mysql_connect($mysql_host, $mysql_username, $mysql_password);

	if (!$conn) {
		message("mysql_connect faild");
		exit;
	}

	if (!mysql_select_db($mysql_database, $conn)) {
		message("mysql_select_db faild");
		exit;
	}
	$stmt = "SELECT COUNT(*),imei FROM users WHERE users.name = '".$username."' "." && "."users.pass = '".$password."';";	
	$res = mysql_query($stmt, $conn);
	if (!$res) {
		message("mysql_query faild");
		exit;
	}

	$row = mysql_fetch_row($res);
	if (!$row) {
		message("nothing");
		exit;
	}
	

	$retVal = array(
		"Success" => $row[0],
		"imei"	  => $row[1]
	);

	echo json_encode($retVal);
	exit;
	
	function message($msg) {
		$mesg = array("msg" => $msg);
		echo json_encode($mesg);
	}
?>


