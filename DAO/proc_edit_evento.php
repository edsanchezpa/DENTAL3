<?php
session_start();

include_once("conexion.php");

$id_paciente = filter_input(INPUT_POST, 'id_paciente', FILTER_SANITIZE_NUMBER_INT);
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
//$color = filter_input(INPUT_POST, 'color', FILTER_SANITIZE_STRING);
$start = filter_input(INPUT_POST, 'start', FILTER_SANITIZE_STRING);
$end = filter_input(INPUT_POST, 'end', FILTER_SANITIZE_STRING);
$custom_param2 = filter_input(INPUT_POST, 'custom_param2', FILTER_SANITIZE_STRING);
$custom_param3 = filter_input(INPUT_POST, 'custom_param3', FILTER_SANITIZE_STRING);

if(!empty($id) && !empty($title) && !empty($color) ){
	//Converter a data e hora do formato

	$data = explode(" ", $start);
	list($date, $hora) = $data;
	$data_sin_barra = array_reverse(explode("/", $date));
	$data_sin_barra = implode("-", $data_sin_barra);
	$start_sin_barra = $data_sin_barra . " " . $hora;
	
	$data = explode(" ", $end);
	list($date, $hora) = $data;
	$data_sin_barra = array_reverse(explode("/", $date));
	$data_sin_barra = implode("-", $data_sin_barra);
	$end_sin_barra = $data_sin_barra . " " . $hora;
	
	$result_events = "UPDATE principal.tbl_citas set v_motivo='$title', f_inicio='$start_sin_barra', f_fin='$end_sin_barra', v_observacion='$custom_param2',color='$custom_param3' WHERE id_paciente='$id_paciente'";

	$resultado_events = pg_query($conn, $result_events);

//Mostrar mensaje si se guardo o no la cita

	$afectado = pg_affected_rows($resultado_events);
	
	if(!empty($afectado)){
		
		$_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Cita editada exitosamente<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
		header("Location: ../agendita.php");

	} //else {}

} else{$_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>No se pudo editar la cita <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
		header("Location: ../agendita.php");}
