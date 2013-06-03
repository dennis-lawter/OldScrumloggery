<?php
	session_start();
	include 'config.php';
	foreach($_POST as $key => $value){
		$_POST[$key] = mysql_real_escape_string($value);
		$_POST[$key] = addslashes($_POST[$key]);
	}
	
	foreach($_GET as $key => $value){
		$_GET[$key] = mysql_real_escape_string($value);
		$_GET[$key] = addslashes($_GET[$key]);
	}
	$tier = $_GET['tier'];
	$id = $_GET['id'];
	$action = $_GET['action'];
	//<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
?>

<!DOCTYPE HTML>
<html style="height: 100%">
	<head>
		<title>
			Scrum Overview
		</title>
		<style type="text/css" media="screen">
			@import url( style.css );
		</style>
		<link rel="icon" type="image/png" href="img/faveicon.png">
	</head>
	<body style="height: 100%">
		<div class="contents" style="height: 100%;width: 100%">
		<div class="greenBorder" style="display: table; height: 100%; width: 100%; #position: relative; overflow: hidden;">
		<div style=" #position: absolute; #top: 50%;display: table-cell; vertical-align: middle;">
		<div class="greenBorder" style=" #position: relative; #left: -50%;#top: -50%">
		<center>
		<?php
			$type[0] = 'products';
			$type[1] = 'sprints';
			$type[2] = 'features';
			$type[3] = 'user_stories';
			$table = $type[$tier];
			
			$q1 = "SELECT * FROM $table WHERE id = '$id'";
			$r1 = mysql_query($q1) or die($q1 . "<br>" . mysql_error());
			$derp = mysql_fetch_assoc($r1);
			$priority = $derp['priority'];
			$parent = $derp['parentid'];
			$goal = $priority + 1;
			echo "$q1; priority = $priority, parent = $parent<br>";
			
			$q2 = "SELECT * FROM $table WHERE priority = '$goal' AND parentid = '$parent'";
			$r2 = mysql_query($q2) or die($q2 . "<br>" . mysql_error());
			$herp = mysql_fetch_assoc($r2);
			$idofold = $herp['id'];
			echo "$q2; idofold = $idofold<br>";
			
			$q3 = "UPDATE $table SET priority = '$priority' WHERE id = '$idofold'";
			mysql_query($q3) or die($q3 . "<br>" . mysql_error());
			echo $q3 . "<br>";
			
			$q4 = "UPDATE $table SET priority = '$goal' WHERE id = '$id'";
			mysql_query($q4) or die($q4 . "<br>" . mysql_error());
			echo $q4 . "<br>";
			
			echo "<br>success!<br><a href='index.php'>Return</a>";
			header('Location: index.php');
		?>
		</center>
		</div>
		</div>
		</div>
		</div>
	</body>
</html>