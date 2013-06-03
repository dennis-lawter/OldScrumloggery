<?php
	session_start();
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
		<table class="datatable">
			<th colspan=2>
				Edit User Account Information
			</th>
			<tr>
				<td>
					Username:
				</td>
				<td>
					<?php echo $_SESSION['username']; ?>
				</td>
			</tr>
			<tr>
				<td>
					Old Password(REQUIRED):
				</td>
				<td>
					<input type="password" name="oldpass" />
				</td>
			</tr>
			<th colspan=2">
				Reset Password
			</th>
			<tr>
				<td>
					New Password:
				</td>
				<td>
					<input type="password" name="oldpass" />
				</td>
			</tr>
			<tr>
				<td>
					Confirm New Password:
				</td>
				<td>
					<input type="password" name="oldpass" />
				</td>
			</tr>
			<th colspan=2">
				Reset Email
			</th>
			<tr>
				<td>
					New Email:
				</td>
				<td>
					<input type="password" name="oldpass" />
				</td>
			</tr>
			<tr>
				<td>
					Confirm New Email:
				</td>
				<td>
					<input type="password" name="oldpass" />
				</td>
			</tr>
		</table>
	</center>
	</div>
	</div>
	</div>
	</div>
	</body>
</html>