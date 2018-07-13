<?php
//include 'config.php';
//$conexion=conectarBD(); 

$dbuser = 'ewms';
$dbpass = 'ewms';
$host = '34.199.227.242';
$dbname='db_webdent';

$connect = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);

$data = array();

$query = "SELECT id_cita, id_paciente, v_motivo, f_inicio, f_fin, v_observacion, id_estado,color
  FROM principal.tbl_citas ORDER BY id_cita";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["id_cita"],
  'e_id_paciente'   => $row["id_paciente"],
  'title'   		=> $row["v_motivo"],
  'start'   		=> $row["f_inicio"],
  'end'   			=> $row["f_fin"],
  'custom_param2'   => $row["v_observacion"],
  'custom_param3'   => $row["id_estado"],
  'color' 			=> $row["color"]
  
 );
}

echo json_encode($data);

?>