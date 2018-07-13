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
		
		<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
		<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js'></script>
		
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js'></script>
		<script src='locale/es.js'></script>
  
 </head>
 <body>
 
 <div class="container">
			<div class="page-header">
				<h1>Agenda</h1>
			</div>
					<?php
					if(isset($_SESSION['msg'])){
						echo $_SESSION['msg'];
						unset($_SESSION['msg']);
					}
					?>
 

		<div id='calendar'></div>
  
  </div>
		<!-- Form para ver datos -->
	
		<div class="modal fade" id="visualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" >Datos de la cita</h4>
					</div>
					<div class="modal-body">
					<div class="mostrar">
						<dl class="dl-horizontal">
							<dt>ID de Cita: </dt>
							<dd id="id_cita"></dd>
							<dt>ID de Paciente: </dt>
							<dd id="id_paciente"></dd>
							<dt>Cita: </dt>
							<dd id="title"></dd>
							<dt>Fecha de inicio: </dt>
							<dd id="start"></dd>
							<dt>Fecha fin : </dt>
							<dd id="end"></dd>
							<dt>Observación: </dt>
							<dd id="obs"></dd>
							<dt>Estado: </dt>
							<dd id="estado"></dd>
						</dl>
						<button class="btn btn-canc-vis btn-warning">Editar</button>
						</div>
						
						
					</div>
				</div>
			</div>
		</div>
		
		<!-- Form para insertar datos -->
		
		<div class="modal fade" id="registrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title text-left">Registrar Cita</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" method="POST" action="./dao/cad_evento.php">
							
							
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">ID Paciente</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="id_paciente" id="id_ing_paciente" placeholder="ID Paciente">
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Motivo</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="title" id="id_ing_motivo" placeholder="Motivo">
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Fecha de inicio</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="start" id="start" onKeyPress="DataHora(event, this)">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Fecha fin</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="end" id="end" onKeyPress="DataHora(event, this)">
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Observación: </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="custom_param2" >
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Estado</label>
								<div class="col-sm-10">
									<select class="form-control" name="custom_param3" id="estado">
										<option value="">Selecione</option>			

										<option style="color:#fff;background-color:#4C78CE" value="#4C78CE">Por confirmar</option>
									
										<option style="color:#fff;background-color:#039737" value="#039737">Confirmado</option>
										
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-success">Registrar</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Mascara para insertar hora -->
		<script>
		function DataHora(evento, objeto){
				var keypress=(window.event)?event.keyCode:evento.which;
				campo = eval (objeto);
				if (campo.value == '00/00/0000 00:00:00'){
					campo.value=""
				}
			 
				caracteres = '0123456789';
				separacao1 = '/';
				separacao2 = ' ';
				separacao3 = ':';
				conjunto1 = 2;
				conjunto2 = 5;
				conjunto3 = 10;
				conjunto4 = 13;
				conjunto5 = 16;
				if ((caracteres.search(String.fromCharCode (keypress))!=-1) && campo.value.length < (19)){
					if (campo.value.length == conjunto1 )
					campo.value = campo.value + separacao1;
					else if (campo.value.length == conjunto2)
					campo.value = campo.value + separacao1;
					else if (campo.value.length == conjunto3)
					campo.value = campo.value + separacao2;
					else if (campo.value.length == conjunto4)
					campo.value = campo.value + separacao3;
					else if (campo.value.length == conjunto5)
					campo.value = campo.value + separacao3;
				}else{
					event.returnValue = false;
				}
			}
			
			//Programa de boton editar
			
				$('.btn-canc-vis').on("click", function() {
				$('.form').slideToggle();
				$('.mostrar').slideToggle();
			});
			$('.btn-canc-edit').on("click", function() {
				$('.mostrar').slideToggle();
				$('.form').slideToggle();
			});
			
		</script>
		
		
  <script src="./js/eventos.js"></script>
 </body>
</html>

