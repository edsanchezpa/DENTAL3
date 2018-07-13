<?php   
class myDB{   
	var $conexion;   
  	var $total_consultas;    
	var $strCnx;
	 function myDB(){   
		  if(!isset($this->conexion)){   		  
			$strCnx= "host=34.199.227.242 port=5432 dbname=db_webdent user=ewms password=ewms";
			$this->conexion = pg_connect($strCnx);				
				if(!$this->conexion)	{
					die( $this->conexion." No se pude establecer la conexion con la base de datos.");	
				}						
		  }   
	 }   

	function execute($consulta){    
	  $this->total_consultas++;   	  
	  $resultado = pg_query($this->conexion, $consulta);	  
	  if(!$resultado){ 	  	
	  }else{
	  }
	  return $resultado;    
  	}  

 	function fetch_array($consulta){    
		return pg_fetch_array($consulta);
  	}   	
    

 	function fetch_assoc($consulta){    
		return pg_fetch_assoc($consulta);
    }

 	function fetch_row($consulta){    
		return pg_fetch_row($consulta);
  	}   
	
	 function fetch_object($consulta){    
		return pg_fetch_object($consulta);
  	}   
	

 	function num_rows($consulta){    
		return pg_num_rows($consulta);
  	}   
	
 	function num_fields($consulta){    
		return pg_num_fields($consulta) ;
  	}   

 	function field_name($consulta, $cam){    
		return pg_field_name($consulta, $cam) ;
  	}   
	
	function getTotalConsultas(){   
  		return $this->total_consultas;   
  	}   

 
  	function getArray($consulta){
		$name_col = array();
		$data = array();
		$item = array();		
		$num_col = pg_num_fields($consulta);		
		$c=0;
		$row;		
		while ($c<$num_col){
			$name_col[$c]= pg_field_name($consulta,$c);			
			$c++;
		}
		while ($row = pg_fetch_row($consulta)){			
		
				$c=0;
				while ($c<$num_col){
					$t_name=$name_col[$c];
					$item[$t_name] = trim($row[$c]);
					$c++;
				}
		  array_push($data, $item);
		}				
			return $data;
	}	
	
 
	function getArraySimple($consulta, $col=0){
		$item = array();
		$c=0;
			pg_lo_seek($consulta, 0); 
			while ($row = pg_fetch_row($consulta)){			
					$item[$c] = trim($row[$col]);
					$c++;
			}
			return $item;
	}
	
	function closeRS($consulta){
		return pg_free_result($consulta);
		
	}

	function close(){
		return pg_close($this->conexion) ;
	}
}
?> 
