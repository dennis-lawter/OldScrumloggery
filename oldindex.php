<?php session_start(); ?>

<html>
	<head>
		<title>
			Scrum Overview
		</title>
		<style type="text/css" media="screen">
			@import url( oldstyle.css );
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
		<h2>Scrum Resources</h2>
		<?php
			
			include 'config.php';
			
			$list1 = "SELECT * FROM product_backlogs ORDER BY 'priority'";
			$productlogs = mysql_query($list1) or die(mysql_error);
			if($productlogs){
				for ( $i = 0; $i < mysql_num_rows($productlogs); $i++ ){
					$row = mysql_fetch_assoc($productlogs);
					echo '<table>';
					echo '<tr><th rowspan="2"><img src="img/minus.png"><img src="img/product_backlog.png">';
					echo '</th><td class="priority"><strong>';
					echo $row['priority'];
					echo '.</strong></td><td><strong>';
					echo $row['name'];
					echo '</strong></td></tr><tr><td class="priority"><img src="img/docadd.png"><img src="img/docdel.png"></td><td>';
					echo $row['details'];
					echo '</td></tr></table>';
					$id = $row['id'];
					
					$list2 = "SELECT * FROM sprint_backlogs WHERE parentid = '$id' ORDER BY 'priority'";
					$sprintlogs = mysql_query($list2) or die(mysql_error);
					
					if($sprintlogs){
						for ($j = 0; $j < mysql_num_rows($sprintlogs); $j++ ){
							$row2 = mysql_fetch_assoc($sprintlogs);
							echo '<table style="margin-left: 51px">';
							echo '<tr><th rowspan="2"><img src="img/minus.png"><img src="img/sprint_backlog.png">';
							echo '</th><td class="priority"><strong>';
							echo $row2['priority'];
							echo '.</strong></td><td><strong>';
							echo $row2['name'];
							echo '</strong></td></tr><tr><td class="priority"><img src="img/docadd.png"><img src="img/docdel.png"></td><td>';
							echo $row2['details'];
							echo '</td></tr></table>';
							$id2 = $row2['id'];
							
							$list3 = "SELECT * FROM user_stories WHERE parentid = '$id2' ORDER BY 'priority'";
							$userlogs = mysql_query($list3) or die(mysql_error);
							
							if($sprintlogs){
								for ($k = 0; $k < mysql_num_rows($userlogs); $k++ ){
									$row3 = mysql_fetch_assoc($userlogs);
									echo '<table style="margin-left: 97px">';
									echo '<tr><th rowspan="2"><img src="img/minus.png"><img src="img/user_backlog.png">';
									echo '</th><td class="priority"><strong>';
									echo $row3['priority'];
									echo '.</strong></td><td><strong>';
									echo $row3['name'];
									echo '</strong></td></tr><tr><td class="priority"><img src="img/docadd.png"><img src="img/docdel.png"></td><td>';
									echo $row3['details'];
									echo '</td></tr></table>';
									$id2 = $row2['id'];
								}
							}
						}
					}
				}
			}
		?>
		
	</body>
</html>