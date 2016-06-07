<?php
	$mysql_host = "localhost";
	$mysql_username = "root";
	$mysql_password = "linianyi11";
	$mysql_database = "graduation";
	$imei = "867982021445417";;
	$flag = "full";

	$conn = mysql_connect($mysql_host, $mysql_username, $mysql_password);

	if (!$conn) {
		message("mysql_connect faild");
		exit;
	}
	
	if (!mysql_select_db($mysql_database, $conn)) {
		message("mysql_select_db faild");
		exit;
	}
	
	$stmt = "SELECT longtitude,latitude FROM location WHERE location.imei = '".$imei."';";
	$res = mysql_query($stmt, $conn);		
	if (!$res) {
		message("mysql_query faild");
		exit;
	}
	$index = 0;
	$total = 0;
	$locArray = array();

	while ($row = mysql_fetch_row($res)) {
		array_push($locArray, floatval($row[0]), floatval($row[1])); 
		$total = $total+1;
	}
	if ($flag == "full") {
		$num = mysql_num_rows($res);
		$locArray['num'] = $num;
		echo json_encode($locArray);
	}
	if ($flag == "new") {
		$index = mysql_num_rows($res)*2-2;

		$new = array("long" => $locArray[$index], "lati" => $locArray[$index+1]);
		echo json_encode($new);
	}
	function message($msg) {
		$retVal = array("msg" => $msg);
		echo json_encode($retVal);
	}
?>
