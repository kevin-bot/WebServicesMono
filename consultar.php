<?php
 // se reliza un programa que cinsulte en la base de datos del usuario, recibiendo el parametro de busqueda por el metodo post y devolviendo sus datos, luego almacenar el un json 

	$json =array();


	
	if($_POST['txtdocumento'] !=""){

		include "conexion.php";
		$documentoUsu=$_POST['txtdocumento'];
		$sentencia=$conexion->prepare('SELECT * FROM USUARIO where documento=:cedula');
		$sentencia->execute(array(':cedula'=>$documentoUsu));
		

		if($resultado=$sentencia->fetch(PDO::FETCH_OBJ)){				
				$json['usuario'][]=$resultado;
				echo json_encode($json);
		}else{
				$resultado['documento']=0;
				$resultado['nombre']="no existe";
				$resultado['profesion']="no existe";
				$json['usuario'][]=$resultado;
				echo json_encode($json);			
		}


	}else{
				$resultado['documento']=0;
				$resultado['nombre']="no retorna";
				$resultado['profesion']="no retorna";
				$json['usuario'][]=$resultado;
				echo json_encode($json);
	}

?>