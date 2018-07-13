<?php
session_start();
//include_once("conexion.php");
?>
<!DOCTYPE html>
<html>
 <head>
  <title>Web Dent 0.5</title>
  
  <link rel="icon" type="image/png" href="images/icon.png" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
  <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.print.min.css' rel='stylesheet' media='print' />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/personalizado.css" />
  <link rel="stylesheet" href="css/loginconestilo.css" />
		
		<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
		<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js'></script>
		
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js'></script>
		<script src='locale/es.js'></script>




  
 </head>
 
 <body>
 
 <div class="body"></div>
		<div class="grad"></div>
		<div class="header">
			<div ><h1>Web<span>Dent</span></h1></div>
		</div>
		<br>
		<div class="login">
				<div id="userdiv" class="wrap-input100 validate-input" data-validate="Ingrese Contraseña"><input id="txtuser" type="text" placeholder="Usuario" name="user"><br></div>

				<div id="passdiv" class="wrap-input100 validate-input" data-validate="Ingrese Contraseña"><input id="txtpass" type="password" placeholder="Contraseña" name="password"><br></div>

				<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Recordarme
						</label>
					</div>

				<div><input id="btnenviar" value="Login"  type="button"></div>

				<div class="text-center p-t-15">
						<a class="txt1" href="UI/update_contrasena.php">
							Olvidaste tu contraseña?
						</a>
		</div>
	<script src="js/jsValidate.js?time=<?php echo date('Y-m-d-h-i-s'); ?>"></script>
<!--===============================================================================================-->
	<script src="http://pajhome.org.uk/crypt/md5/2.2/md5-min.js"></script>
</body>
 
 </html>

