<?php

//function conectarBD(){

	$host="host=34.199.227.242";
	$port="port=5432";
	$dbname="dbname=db_webdent";
	$user="user=ewms";
	$password="password=ewms";

$conn = pg_connect("$host $port $dbname $user $password ");


/*

if(!$conn){
		
		echo "Error: ".pg_last_error;
	}else {echo "<h3>Conexión exitosa PHP - PostgreSQL</h3><hr>";
	return $conn;}

}

?>

	*/