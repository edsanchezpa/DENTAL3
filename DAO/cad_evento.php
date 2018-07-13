<?php
session_start();

include_once("conexion.php");

$id_paciente = filter_input(INPUT_POST, 'id_paciente', FILTER_SANITIZE_STRING);
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
//$color = filter_input(INPUT_POST, 'color', FILTER_SANITIZE_STRING);
$start = filter_input(INPUT_POST, 'start', FILTER_SANITIZE_STRING);
$end = filter_input(INPUT_POST, 'end', FILTER_SANITIZE_STRING);
$custom_param2 = filter_input(INPUT_POST, 'custom_param2', FILTER_SANITIZE_STRING);
$custom_param3 = filter_input(INPUT_POST, 'custom_param3', FILTER_SANITIZE_STRING);

//CONVERSION DE TEXTO A ENTERO
$id_paciente_convertido=(int)$id_paciente;
//$param3_convertido=(int)$custom_param3;

if(!empty($start) && !empty($end) ){
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
	
	$result_events = "INSERT INTO principal.tbl_citas( id_paciente,v_motivo, f_inicio, f_fin, v_observacion,color) VALUES ('$id_paciente_convertido','$title', '$start_sin_barra', '$end_sin_barra','$custom_param2','$custom_param3')";

	$resultado_events = pg_query($conn, $result_events);

//Mostrar mensaje si se guardo o no la cita

	$afectado = pg_affected_rows($resultado_events);
	
	if(!empty($afectado)){
		
		$_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Cita guardada exitosamente<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
		header("Location: ../agendita.php");

	} //else {}

} else{$_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>No se pudo guardar la cita <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
		header("Location: ../agendita.php");}


	//Verificar se salvou no banco de dados
/*
	if(pg_insert_id($conn)){
		$_SESSION['msg'] = "<div class='alert alert-success' role='alert'>O Evento Cadastrado com Sucesso<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
		header("Location: index.php");
	}else{
		$_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro ao cadastrar o evento <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
		header("Location: index.php");
	}
	
}else{
	$_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro ao cadastrar o evento <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
	header("Location: index.php");

*/



?>