<?php

	$json=array();

	if($_GET['txtdocumento'] !=""){

		$documento=$_GET['txtdocumento'];		
		
		include "conexion.php"	;

		$sentencia=$conexion->prepare("SELECT * FROM USUARIO WHERE documento=:documento");

		$sentencia->execute(array(":documento"=>$documento));

		if($resultado=$sentencia->fetch(PDO::FETCH_ASSOC)){

			$result['documento']=$resultado['documento'];
			$result['nombre']=$resultado['nombre'];
			$result['profesion']=$resultado['profesion'];
			$result['imagen']=base64_encode($resultado['imagen']);
			$json['usuario'][]=$result;
			
		}else{
			$result['documento']=0;
			$result['nombre']="no Existe";
			$result['profesion']="no existe";
			$result['imagen']="no existe";
			$json['usuario'][]=$result;
		}
		echo json_encode($json);		
	}else{
			$result['documento']=0;
			$result['nombre']="No retorna";
			$result['profesion']="no retorna";
			$result['imagen']="no retorna";
			$json['usuario'][]=$result;
			echo json_encode($json);
	}

?>