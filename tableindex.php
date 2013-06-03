<?php
	session_start();
	include 'config.php';
?>

<html>
	<head>
		<title>
			Scrum Overview
		</title>
		<style type="text/css" media="screen">
			@import url( style.css );
		</style>
		<script type="text/javascript">
			<!--
				function collapse(img,id){
					if(document.getElementById(id).style.visibility=="visible"){
						img.src = "img/icon/plus.png";
						document.getElementById(id).style.visibility = "hidden";
						document.getElementById(id).style.display = "none";
					}else{
						img.src = "img/icon/minus.png";
						document.getElementById(id).style.visibility = "visible";
						document.getElementById(id).style.display = "block";
					}
				}
			//-->
		</script>
		<link rel="icon" type="image/png" href="img/faveicon.png">
	</head>
	<body>
	
		<table class="maintable">
			<tr>
				<td class="tableheader" colspan="8">
					Product Backlog
				</td>
			</tr>
			
			<?php
				$list1 = "SELECT * FROM products ORDER BY 'priority'";
				$productlogs = mysql_query($list1) or die(mysql_error);
				if($productlogs){
					for ( $i = 0; $i < mysql_num_rows($productlogs); $i++ ){
						$row = mysql_fetch_assoc($productlogs);
					}
				}
			?>
			<tr>
				<td class="spacer">
					<img src="img/application.png">
				</td>
				<td colspan="4">
					Application
				</td>
				<td colspan="3">
					Description
				</td>
			</tr>
			<tr>
				<td class="spacer">
					<br />
				</td>
				<td class="spacer">
					<img src="img/book.png">
				</td>
				<td colspan="3">
					Sprint
				</td>
				<td colspan="3">
					Description
				</td>
			</tr>
			<tr>
				<td class="spacer">
					<br />
				</td>
				<td class="spacer">
					<br />
				</td>
				<td class="spacer">
					<img src="img/report.png">
				</td>
				<td colspan="2">
					Feature
				</td>
				<td colspan="3">
					Description
				</td>
			</tr>
			<tr>
				<td class="spacer">
					<br />
				</td>
				<td class="spacer">
					<br />
				</td>
				<td class="spacer">
					<br />
				</td>
				<td class="spacer">
					<img src="img/script.png">
				</td>
				<td>
					User Page
				</td>
				<td colspan="3">
					Description
				</td>
			</tr>
		</table>
	
	</body>
</html>