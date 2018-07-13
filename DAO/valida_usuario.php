<?php
session_start();
require("../DAO/db.cls.php");

$db= new myDB;  

$usuario = $_REQUEST["usuario"];
$clave = $_REQUEST["clave"];

//$new_clave = md5($clave);

$sql = "SELECT 
			cl.v_nombre , cl.v_apellido
		  ,	us.id_usuario
		  , cl.id_cliente
		  , us.v_email
		  , tp.id_tipo
		  , tp.v_tipo
		FROM principal.tbl_cliente cl inner join security.tbl_usuario us on cl.id_usuario=us.id_usuario
		inner join security.tbl_tipo tp on us.id_tipo = tp.id_tipo
		 where us.v_email = '$usuario' 
		 and us.v_password = '$clave'
		 ";

$rs = $db->execute($sql) or die("Error");

//print_r($sql);

$datos = array();
$jsondata = array();
	$jsondata  = array(
				  "status"=> -100
				, "msg"=> 'ER'
				, "id_usuario"=> 0
				, "v_email"=> 0
		);
	
while ($row = $db->fetch_array($rs)) {
	$jsondata  = array(
				  "status"=> 100
				, "msg"=> 'OK'
				, "id_usuario"=> $row["id_usuario"] 
				, "v_email"=> $row["v_email"]
				, "v_nombre"=> $row["v_nombre"]
				, "v_apellido"=> $row["v_apellido"]
				, "v_tipo"=> $row["v_tipo"] 

		);

	$_SESSION["gIdUsuario"] = $row["id_cliente"];
	$_SESSION["gEmail"] = $row["v_email"];
	$_SESSION["gTipo"] = $row["v_tipo"];
	$_SESSION["gNombre"] = $row["v_nombre"];
	$_SESSION["gApellido"] = $row["v_apellido"];
	//$_SESSION["gPerfil"] = $row["id_pefil"];
	//$_SESSION["gCliente"] = $row["id_cliente"];
}

$db->close();
$datos = array('datos' => $jsondata ); 
echo json_encode($datos);

/*$validate =  $jsondata['status'];
if ($validate == 100) {
	echo "<script>window.location='Agenda.php';</script>";
}else {
	session_destroy();
	echo "<script>window.location='../index.php';</script>";
}*/

?>
