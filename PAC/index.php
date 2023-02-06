<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Index.php</title>
</head>
<body>

	<?php
	
		include "consultas.php";

	?>

	<form action="index.php" method="post">
		<p><label for="usuario">Usuario: </label><input type="text" name="usuario"></p>
		<p><label for="correo">Correo: </label><input type="email" name="correo"></p>
		<p><input type="submit" name="Entrar"></p>
	</form>
	
	<?php
		if (isset($_POST['Entrar'])) {
			$nombre = $_POST['usuario'];
			$correo = $_POST['correo'];
			
			$tipoUsuario = tipoUsuario($nombre, $correo);
			setcookie("datos", $tipoUsuario, time()+500);
			if ($tipoUsuario == 'superadmin') {
				echo "Bienvenido " . $nombre . " Pulsa <a href='usuarios.php'>AQUÍ</a> para entrar al panel de usuarios.";
			} else if ($tipoUsuario == 'autorizado') {
				echo "Bienvenido " . $nombre . " Pulsa <a href='articulos.php'>AQUÍ</a> para entrar al panel de artículos.";
			} else if ($tipoUsuario == 'registrado') {
				echo "Bienvenido " . $nombre . " No tienes permisos para continuar";
			} else {
				echo "El usuario no está registrado en el sistema.";
			}
		}
	
	
	?>
	
</body>
</html>