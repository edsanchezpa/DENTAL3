<?php

$dbuser = 'ewms';
$dbpass = 'ewms';
$host = '34.199.227.242';
$dbname='db_webdent';

$connect = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);


if(isset($_POST["title"]))
{
 $query = "
 INSERT INTO principal.tbl_citas(id_cita, id_paciente, v_motivo, f_inicio, f_fin, v_observacion, id_estado)
    VALUES ( :f_inicio, :f_fin)";
	
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
 // ':id_cita'  => $_POST['id'],
  //':id_paciente'  => $_POST['e_id_paciente'],
   //':v_motivo'  => $_POST['title'],
   ':f_inicio' => $_POST['start'],
   ':f_fin' => $_POST['end'],
   //':e_obs' => $_POST['custom_param2'],
  // ':estado' => $_POST['custom_param3']
  )
 );
}


?>