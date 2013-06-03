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
			echo "<form action='?action=save&tier=$tier&id=$id' method='post' onsubmit='handleSubmit()'>";
		?>
			<input type="hidden" id="status" name="status" value="0">
			<input type="hidden" id="posttitle" name="posttitle" value="0">
			<input type="hidden" id="postdesc" name="postdesc" value="0">
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
						$status = $_POST['status'];
						$title = $_POST['posttitle'];
						$desc = $_POST['postdesc'];
						$table = $type[$tier];
						$q0 = "SELECT * FROM $table WHERE parentid = '$id' ORDER BY priority DESC LIMIT 1";
						$r0 = mysql_query($q0);
						if(!$r0){
							echo $q0;
							$priority = 0;
						}else{
							$derp = mysql_fetch_assoc($r0);
							$priority = $derp['priority'] + 1;
							echo "$q0; priority = $priority";
						}
						$time = time();
						
						$pattern = '/<br>$/';
						$replace = '';
						$title = preg_replace($pattern, $replace, $title);
						$desc = preg_replace($pattern, $replace, $desc);
						$pattern = '/&nbsp;/';
						$title = preg_replace($pattern, $replace, $title);
						$pattern = '/^<br>/';
						$desc = preg_replace($pattern, $replace, $desc);
						
						if($tier == 0){
							$q1 = "INSERT INTO products (name, createdate, status, details, priority) VALUES ('$title', '$time', '$status', '$desc', '$priority')";
						}else{
							$q1 = "INSERT INTO $table (name, createdate, status, details, parentid, priority) VALUES ('$title', '$time', '$status', '$desc', '$id', '$priority')";
						}
						mysql_query($q1) or die($q1 . "<br>" . mysql_error());
						echo "<br>success!<br><a href='index.php'>Return</a>";
						header('Location: index.php');
					}else{
						echo '<div class="'.$type[$tier].'" style="width: 75%"><img src="img/todo.png" id="statusimg" name="statusimg" onclick="changeStatus()"><span class="titlename" contenteditable=true id="divtitle" style="width:auto;display:inline">Title Goes Here</span><div class="titlename" style="width:auto;display:inline">&nbsp;-&nbsp;</div><div contenteditable=true id="divdesc" class="description"  style="width:auto;display:inline">Description Goes Here</div></div><input type="submit" />';
					}
				}
			?>
		</form>
		</center>
		</div>
		</div>
		</div>
		</div>
		
		
		<script type="text/javascript">
			var hiddenElem = document.getElementById("status");
			var imgElem = document.getElementById("statusimg");
			//alert(imgElem);
			function changeStatus(){
				//alert(hiddenElem.value);
				hiddenElem.value++;
				if(hiddenElem.value > 2){
					hiddenElem.value = 0;
				}
				if(hiddenElem.value == 0){
					imgElem.src = "img/todo.png";
				}else if(hiddenElem.value == 1){
					imgElem.src = "img/error.png";
				}else{
					imgElem.src = "img/finished.png";
				}
				//alert(hiddenElem.value);
			}
			function handleSubmit(){
				var divtitle = document.getElementById("divtitle");
				var divdesc = document.getElementById("divdesc");
				var posttitle = document.getElementById("posttitle");
				var postdesc = document.getElementById("postdesc");
				posttitle.value = divtitle.innerHTML;
				postdesc.value = divdesc.innerHTML;
				return true;
			}
		</script>
	</body>
</html>