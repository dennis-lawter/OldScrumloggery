<!DOCTYPE HTML>
<html>
	<script>
		var body = document.getElementById('body');
		var count = 0;
		var divcall = false;
		function divclick(){
			count++;
			alert('div clicked!  Func calls: ' + count);
			divcall = true;
		}
		function bodyclick(){
			count++;
			if(divcall == false){
				alert('body clicked!  Func calls: ' + count);
			}else{
				divcall = false;
			}
		}
	</script>
	<body onclick="bodyclick()" id='body'>
		<div onclick="divclick()" style='background-color:yellow;width:auto;text-align:center;#display:inline;border:1px solid black;margin:200px;padding:5px;'>DERP</div>
	</body>
</html>