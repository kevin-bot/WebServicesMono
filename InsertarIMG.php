<?php

	if(isset($_POST['btnagregar'])){

		include "conexion.php";

		//sacar los bit de esa imagen y rescatamos el nombre
		$imagen=addslashes(file_get_contents($_FILES['txtarchivo']['tmp_name']));
		$nombre=$_POST['txtnombre']	;
		$profesion=$_POST['txtprofesion'];
		$documento=$_POST['txtdocumento'];


		$prepare=$conexion->prepare("INSERT INTO USUARIO VALUES(:documento,:nombre,:profesion,:imagen)");

		$prepare->execute(array(":imagen"=>$imagen,":nombre"=>$nombre,":profesion"=>$profesion,":documento"=>$documento));	 
	}



?>