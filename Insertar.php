

<?php
/*se capturan datos de llegan por medio del metodo post, para luego hacer una insercion y luego consultar esa insercion, codificando esto en un json, para luego enviarlo y que nuestra app en adroid lo reciba*/

$json=array();
	//se valida si el usuario ingresa datos
	if($_POST['txtprofesion'] !="" && $_POST['txtnombre'] !=""   && $_POST['txtcedula'] !="" ){
		include "conexion.php";

		$nombre=$_POST['txtnombre'];
		$profesion=$_POST['txtprofesion'];
		$cedula=$_POST['txtcedula'];
			
		$sentencia=$conexion->prepare("INSERT INTO usuario values (:cedula,:nombre,:profesion)");

		$resultado=$sentencia->execute(array(":cedula"=>$cedula,":nombre"=>$nombre,":profesion"=>$profesion));

		if($resultado){
			$sentencia=$conexion->prepare("SELECT * FROM usuario WHERE documento = :cedula");

				$sentencia->execute(array(":cedula"=>$cedula));			
				
				if($resultado=$sentencia->fetch(PDO::FETCH_OBJ)){
						$json['usuario'][]=$resultado; 	
				}				
				echo json_encode($json);								
		}else{
			// si el usuario repite la llave primaria
				$resultado['documento']=0;
				$resultado['nombre']="no retorna";
				$resultado['profesion']="no retorna";
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