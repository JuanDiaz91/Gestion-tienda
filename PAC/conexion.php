<?php 

	function crearConexion() {
		// Cambiar en el caso en que se monte la base de datos en otro lugar
		$host = "localhost";
		$user = "root";
		$pass = "";
		$baseDatos = "pac3_daw";

		// Establecemos la conexión con la base de datos
		$conexion = mysqli_connect($host, $user, $pass, $baseDatos);

		 // Si hay un error en la conexión, lo mostramos y detenemos.
		 if (!$conexion) {
            die("<br>Error de conexión con la base de datos: " . mysqli_connect_error());
        }
        return $conexion;
	}


	function cerrarConexion($conexion) {
		// Cerramos la conexión a la base de datos.
		mysqli_close($conexion);
		
	}


?>