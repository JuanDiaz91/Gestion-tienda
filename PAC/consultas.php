<?php 

	include "conexion.php";

	function tipoUsuario($nombre, $correo){
		$connect = crearConexion();
		
		if (esSuperadmin($nombre, $correo)) {
			return 'superadmin';
		} else {
			$consulta = "SELECT FullName, Email, Enabled FROM user WHERE FullName = '$nombre' and Email = '$correo'";

			$resultado = mysqli_query($connect, $consulta);

			cerrarConexion($connect);

			if ($datos = mysqli_fetch_array($resultado)) {
				if ($datos["Enabled"] == 0) {
					return "registrado";
				} else if ($datos["Enabled"] == 1) {
					return "autorizado";
				}

			} else{
				return "no registrado";
			}
		}
	}


	function esSuperadmin($nombre, $correo){
		$connect = crearConexion();

		$consulta = "SELECT user.UserID FROM user INNER JOIN setup ON user.UserID = setup.SuperAdmin WHERE user.FullName = '$nombre' and user.Email = '$correo'";

		$resultado = mysqli_query($connect, $consulta);

		if ($datos = mysqli_fetch_array($resultado)) {
			return true;
		} else {
			return false;
		}
	}


	function getPermisos() {
		$connect = crearConexion();

		$consulta = "SELECT Autenticación FROM setup";

		$resultado = mysqli_fetch_assoc(mysqli_query($connect, $consulta));
		cerrarConexion($connect);
		return $resultado["Autenticación"];

	}


	function cambiarPermisos() {

		$permisos = getPermisos();

		$connect = crearConexion();

		if ($permisos == 1) {
			$consulta = "UPDATE setup SET Autenticación = 0";

		} else if ($permisos == 0) {
			$consulta = "UPDATE setup SET Autenticación = 1";

		}

		$resultado = mysqli_query($connect, $consulta);
		cerrarConexion($connect);
	}


	function getCategorias() {
		$connect = crearConexion();

		$consulta = "SELECT CategoryID, Name FROM category";

		$resultado = mysqli_query($connect, $consulta);

		cerrarConexion($connect);

		return $resultado;

	}


	function getListaUsuarios() {
		$connect = crearConexion();

		$consulta = "SELECT FullName, Email, Enabled FROM user";

		$resultado = mysqli_query($connect, $consulta);

		cerrarConexion($connect);

		return $resultado;
	}


	function getProducto($ID) {

		$connect = crearConexion();

		$consulta = "SELECT * FROM product WHERE ProductID = $ID";

		$resultado = mysqli_query($connect, $consulta);

		cerrarConexion($connect);

		return $resultado;

	}


	function getProductos($orden) {
		$connect = crearConexion();

		$consulta = "SELECT product.ProductID, product.Name, product.Cost, product.Price, category.Name as Categoria FROM
		 product INNER JOIN category WHERE product.CategoryID = category.CategoryID ORDER BY $orden";

		$resultado = mysqli_query($connect, $consulta);
		cerrarConexion($connect);
		return $resultado;

	}


	function anadirProducto($nombre, $coste, $precio, $categoria) {
		$connect = crearConexion();

		$consulta = "INSERT INTO product (Name, Cost, Price, CategoryID) 
				VALUES ('$nombre', $coste, $precio, $categoria)";

		$resultado = mysqli_query($connect, $consulta);

		cerrarConexion($connect);

		return $resultado;

	}


	function borrarProducto($id) {
		$connect = crearConexion();

		$consulta = "DELETE FROM product WHERE ProductID = $id";

		$resultado = mysqli_query($connect, $consulta);

		cerrarConexion($connect);

		return $resultado;

	}


	function editarProducto($id, $nombre, $coste, $precio, $categoria) {
		$connect = crearConexion();

		$consulta = "UPDATE product SET Name = '$nombre', Cost = $coste, Price = $precio, CategoryID = $categoria WHERE ProductID = $id";

		$resultado = mysqli_query($connect, $consulta);

		cerrarConexion($connect);

		return $resultado;

	}

?>