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
				if($tier!=0 && !$id){
					echo "Error: no ID specified!";
				}else{
					if($action == "save"){
						//print_r($_POST);
						//$status = $_POST['status'];
						//$title = $_POST['posttitle'];
						//$desc = $_POST['postdesc'];
						$table = $type[$tier];
						//$pattern = '/<br>$/';
						//$replace = '';
						//$title = preg_replace($pattern, $replace, $title);
						//$q1 = "UPDATE $table SET status = '$status', name = '$title', details =	'$desc' WHERE id = $id";
						//mysql_query($q1) or die($q1 . "<br>" . mysql_error());
						$haschildren = false;
						if($tier != 3){
							$subtable = $type[$tier+1];
							$q0 = "SELECT * FROM $subtable WHERE parentid = '$id'";
							$r0 = mysql_query($q0);
							if(mysql_num_rows($r0) > 0){
								$haschildren = true;
							}
						}
						if($haschildren){
							echo "Delete all children first!  <a href='index.php'>Index</a>";
						}else{
							$q1 = "SELECT * FROM $table WHERE id = $id";
							$r1 = mysql_query($q1);
							$row = mysql_fetch_assoc($r1);
							$priority = $row['priority'];
							$parentid = $row['parentid'];
							$q2 = "DELETE FROM $table WHERE id = $id LIMIT 1";
							mysql_query($q2) or die($q2 . "<br>" . mysql_error());
							$q3 = "UPDATE $table SET priority = priority-'1' WHERE parentid = $parentid AND priority > $priority";
							mysql_query($q3) or die($q3 . "<br>" . mysql_error());
							echo "<br>success!<br><a href='index.php'>Return</a>";
							header('Location: index.php');
						}
					}else{
						$table = $type[$tier];
						$q1 = "SELECT * FROM $table WHERE id = $id";
						$r1 = mysql_query($q1);
						$derp = mysql_fetch_assoc($r1);
						//print_r($derp);
						//echo $q1;
						echo '<div class="'.$type[$tier].'" style="width: 75%"><img src="img/todo.png" id="statusimg" name="statusimg"><div class="titlename" id="divtitle" style="width:auto;display:inline">'.stripslashes($derp[name]).'</div><div class="titlename" style="width:auto;display:inline">&nbsp;-&nbsp;</div><div id="divdesc" class="description"  style="width:auto;display:inline">'.stripslashes($derp[details]).'</div></div>';
						echo "<span style='text-size: larger;font-weight:bold'>ARE YOU SURE YOU WISH TO DELETE THIS ITEM?<br><a href='delete.php?tier=$tier&id=$id&action=save'>DELETE</a></span>";
					}
				}
			?>
		</center>
		</div>
		</div>
		</div>
		</div>
	</body>
</html>