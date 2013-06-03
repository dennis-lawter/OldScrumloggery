<?php
	session_start();
	include 'config.php';
	
	function displayPage($depth = 0, $parentid = -1){
		$depthstr = "";
		switch($depth){
		case 0:
			$depthstr = "products";
			break;
		case 1:
			$depthstr = "sprints";
			break;
		case 2:
			$depthstr = "features";
			break;
		case 3:
			$depthstr = "user_stories";
			break;
		default:
			return;
			break;
		}
		$sl_query = 'SELECT * FROM '.$depthstr;
		if($depth != 0 && $parentid != -1){
			$sl_query .= " WHERE parentid='".$parentid."'";
		}
		$sl_query .= ' ORDER BY priority ASC';
		//echo $sl_query;
		$sl_result = mysql_query($sl_query) or die($sl_query);
		
		if($sl_result){
			$sl_num = mysql_num_rows($sl_result);
		}
		if($sl_result && $sl_num > 0){
			$sl_count = 1;
			
			while($sl_row = mysql_fetch_assoc($sl_result)){
				$sl_first = 'false';
				$sl_last = 'false';
				if($sl_count == 1){
					$sl_first = 'true';
				}
				if($sl_count == $sl_num){
					$sl_last = 'true';
				}
				$sl_count++;
				
				$id = $sl_row['id'];
				switch($sl_row['status']){
				case 0:
					$sl_status = 'todo';
					break;
				case 1:
					$sl_status = 'error';
					break;
				case 2:
					$sl_status = 'finished';
					break;
				}
				echo '<div UNSELECTABLE="on" class="'.$depthstr.'" onclick="openMenu('.$depth.',this,'
				.$sl_row['id'].
				",'"
				.$sl_first.
				"','"
				.$sl_last.
				'\')"><img src="img/'
				.$sl_status.
				'.png"><span UNSELECTABLE="on" class="titlename">'
				.stripslashes($sl_row['name']).
				' - </span>'
				.stripslashes($sl_row['details']).
				'</div>';
				
				displayPage($depth + 1, $id);
			}
		}
	}
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
	<body onclick="bodyclick()">
		<div UNSELECTABLE="on" id="menu" class="menu">
			<div UNSELECTABLE="on" id="headerdiv" class="menuheader" onclick="closeMenu()">
				MENU&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X
			</div>
			<div UNSELECTABLE="on" class="menuitem" id="editdiv">
				<a UNSELECTABLE="on" id="editlink">
					<img class="menuimg" src="img/page_white_edit.png">Edit
				</a>
			</div>
			<div UNSELECTABLE="on" class="menuitem" id="subitemdiv">
				<a UNSELECTABLE="on" id="subitemlink">
					<img class="menuimg" src="img/add.png">New Subitem
				</a>
			</div>
			<div UNSELECTABLE="on" class="menuitem" id="moveupdiv">
				<a UNSELECTABLE="on" id="moveuplink">
					<img class="menuimg" src="img/arrow_up.png">Move Up
				</a>
			</div>
			<div UNSELECTABLE="on" class="menuitem" id="movedowndiv">
				<a UNSELECTABLE="on" id="movedownlink">
					<img class="menuimg" src="img/arrow_down.png">Move Down
				</a>
			</div>
			<div UNSELECTABLE="on" class="menuitem" id="deletediv">
				<a UNSELECTABLE="on" id="deletelink">
					<img class="menuimg" src="img/delete.png">Delete
				</a>
			</div>
		</div>
		
		<div UNSELECTABLE="on" class="contents">
			<div UNSELECTABLE="on" class="header">
				PRODUCT BACKLOG <a href="newsubitem.php?tier=0"><img src="img/application_add.png">
				<span style="font-variant: small-caps;font-weight: bold;font-size:14px;color:white">New Product</span></a>
				<div style="display: inline;float: right">
				<?php if($_SESSION['id']){ ?>
					logged in as: <a href="useredit.php" style="color:light blue;"><?php echo $_SESSION['username'] ?></a>
				<?php }else{ ?>
					Welcome, guest!  <a href="login.php" style="color:light blue;">Sign in</a>
				<?php } ?>
				</div>
			</div>
			
			<?php
				displayPage();
			?>
			
		</div>
		
		<script type="text/javascript">
			var menu = document.getElementById("menu");
			var moveupdiv = document.getElementById("moveupdiv");
			var movedowndiv = document.getElementById("movedowndiv");
			var subitemdiv = document.getElementById("subitemdiv");
			
			var editlink = document.getElementById("editlink");
			var subitemlink = document.getElementById("subitemlink");
			var moveuplink = document.getElementById("moveuplink");
			var movedownlink = document.getElementById("movedownlink");
			var deletelink = document.getElementById("deletelink");
			
			var visible = false;
			
			var divclicked = false;
			
			function closeMenu(){
				menu.style.top=0;
				menu.style.left=0;
				menu.style.visibility="hidden";
				moveupdiv.style.visibility="hidden";
				movedowndiv.style.visibility="hidden";
				subitemdiv.style.visibility="hidden";
				visible = false;
			}
			function openMenu(type,caller,id,isTop,isBottom){
				if(!visible){
					
					
					if(isTop == "true"){
						moveupdiv.style.visibility="hidden";
						moveupdiv.style.display="none";
					}else{
						moveupdiv.style.visibility="visible";
						moveupdiv.style.display="block";
					}
					if(isBottom == "true"){
						movedowndiv.style.visiblity="hidden";
						movedowndiv.style.display="none";
					}else{
						movedowndiv.style.visibility="visible";
						movedowndiv.style.display="block";
					}
					if(type == 3){
						subitemdiv.style.visiblity="hidden";
						subitemdiv.style.display="none";
					}else{
						subitemdiv.style.visibility="visible";
						subitemdiv.style.display="block";
					}
					
					editlink.href = "edit.php?tier="+type+"&id="+id;
					subitemlink.href = "newsubitem.php?tier="+(type+1)+"&id="+id;
					moveuplink.href = "moveup.php?tier="+type+"&id="+id;
					movedownlink.href = "movedown.php?tier="+type+"&id="+id;
					deletelink.href = "delete.php?tier="+type+"&id="+id;
					
					menu.style.visibility="visible";
					visible = true;
					
					getSize();
					var derpleft = caller.offsetLeft;
					var derptop = caller.offsetTop;
					var height = caller.offsetHeight;
					var derpy = 0+derptop+height;
					var menutop = derpy-1 + "px";
					menu.style.top=menutop;
					menu.style.left=derpleft + "px";
					var menubottom = menu.offsetHeight + menu.offsetTop;
					if(menubottom > myHeight+scrOfY){
						//alert('out of window: ' + menubottom);
						var menuheight = menu.offsetHeight;
						menu.style.top = menu.offsetTop + 2 - menu.offsetHeight - height + "px";
						//alert(menuheight);
					}else{
						//alert('in window: ' + menubottom);
					}
				}else{
					closeMenu();
				}
				divclicked = true;
			}
			function bodyclick(){
				if(divclicked == true){
					divclicked = false;
				}else{
					closeMenu();
				}
			}
			var myWidth = 0, myHeight = 0, scrOfX = 0, scrOfY = 0;
			function getSize() {
				if( typeof( window.innerWidth ) == 'number' ) {
					//Non-IE
					myWidth = window.innerWidth;
					myHeight = window.innerHeight;
				} else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
					//IE 6+ in 'standards compliant mode'
					myWidth = document.documentElement.clientWidth;
					myHeight = document.documentElement.clientHeight;
				} else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
					//IE 4 compatible
					myWidth = document.body.clientWidth;
					myHeight = document.body.clientHeight;
				}
				//window.alert( 'Width = ' + myWidth );
				//window.alert( 'Height = ' + myHeight );
				getScrollXY();
			}
			function getScrollXY() {
				if( typeof( window.pageYOffset ) == 'number' ) {
					//Netscape compliant
					scrOfY = window.pageYOffset;
					scrOfX = window.pageXOffset;
				} else if( document.body && ( document.body.scrollLeft || document.body.scrollTop ) ) {
					//DOM compliant
					scrOfY = document.body.scrollTop;
					scrOfX = document.body.scrollLeft;
				} else if( document.documentElement && ( document.documentElement.scrollLeft || document.documentElement.scrollTop ) ) {
					//IE6 standards compliant mode
					scrOfY = document.documentElement.scrollTop;
					scrOfX = document.documentElement.scrollLeft;
				}
			}
			getSize();
			closeMenu();
		</script>
		
	</body>
</html>