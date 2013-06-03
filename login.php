<?php
	session_start();
	$loginpage = true;
	include 'config.php';
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
	</head>
	<body style="height: 100%">
	<div class="contents" style="height: 100%;width: 100%">
	<div class="greenBorder" style="display: table; height: 100%; width: 100%; #position: relative; overflow: hidden;">
	<div style=" #position: absolute; #top: 50%;display: table-cell; vertical-align: middle;">
	<div class="greenBorder" style=" #position: relative; #left: -50%;#top: -50%">
	<center>
	<?php if($_POST['user'] != '' && $_POST['pass'] != ''){
		$user = $_POST['user'];
		$pass = $_POST['pass'];
		$pass = sha1($pass);
		$q1 = "SELECT * FROM `users` WHERE `username` = '$user' AND `password` = '$pass' LIMIT 1";
		$r1 = mysql_query($q1);
		if(!$r1 || mysql_num_rows($r1) < 1){
			echo 'Login not found!';
			$failed = true;
		}else{
			$row = mysql_fetch_assoc($r1);
			$_SESSION['id'] = $row['id'];
			$_SESSION['username'] = $row['username'];
			$_SESSION['timedisplay'] = $row['timedisplay'];
			$_SESSION['administrator'] = $row['administrator'];
			echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=index.php">';
		}
	}else{
		$failed=true;
	}
	if($failed) {?>
		<h2>Login</h2>
		<form action="login.php" method="POST">
		<table>
			<tr>
				<td>
					Username: 
				</td>	
				<td>
					<input type="text" name="user" id="user"/>
				</td>
			</tr>
			<tr>
				<td>
					Password:
				</td>
				<td>
					<input type="password" name="pass" id="pass"/>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" value="Login" />
				</td>
			</tr>
		</table>
		</form>
		<?php } ?>
		</center>
		</div>
		</div>
		</div>
		</div>
	</body>
</html>