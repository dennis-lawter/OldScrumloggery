<?php
	require("mysqlsettings.php");
	
	if($usingpassword){
		$link = mysql_connect($host, $user, $pass) or die('Could not connect to the server!' . mysql_error());
	}else{
		$link = mysql_connect($host, $user) or die('Could not connect to the server!' . mysql_error());
	}
	$db_selected = mysql_select_db($db, $link) or die('Could not connect to the database!');

	mysql_real_escape_string($_POST['']);
	mysql_real_escape_string($_GET['']);

	function getDisplayTime($time){
		global $timeformat;
		$t = date_create($time);
		return date_format($t, $timeformat);
	}
	
	function callback($buffer)
	{
		$pattern[0] = "/\t/";
		$pattern[1] = "/\n/";
		$pattern[2] = "/> +</";
		$buffer = (preg_replace($pattern, "", $buffer));
		return $buffer;
	}
	
	//Force login to avoid guests
	if(!$allowguests){
		if(!$_SESSION['id'] && !$loginpage){
			header('Location: login.php');
		}
	}
?>