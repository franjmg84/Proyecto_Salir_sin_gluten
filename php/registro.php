<?php
// Configuración de la conexión con la base de datos
$host = "127.0.0.1";
$port = 3306;
$socket = "";
$user = "root";
$password = "admin";
$dbname = "proyectointegrado";

// Establece la conexión con la base de datos
$conexion = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die('Could not connect to the database server' . mysqli_connect_error());

// Comprobación de la conexión
if (!$conexion) {
	die("Conexión fallida: " . mysqli_connect_error());
}

// Comprobación de si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	// Recogida de datos del formulario
	$nombre = $_POST["nombre"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$es_administrador = 0; // Como este campo no se encuentra en el formulario, se establece como 0 por defecto

	// Validación de los datos
	if (empty($nombre) || empty($email) || empty($password)) {
		echo "Por favor, rellene todos los campos";
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo "Por favor, introduzca una dirección de correo electrónico válida";
	} elseif (strlen($password) < 8) {
		echo "Por favor, introduzca una contraseña con al menos 8 caracteres";
		header("Location: ../html/registro.html");
	} elseif (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/", $password)) {
		echo "Por favor, introduzca una contraseña que contenga al menos una letra mayúscula, una letra minúscula y un número";
		header("Location: ../html/registro.html");
	} else {
		// Inserción de los datos en la base de datos
		$sql = "INSERT INTO usuario (nombre, email, password, es_administrador) VALUES ('$nombre', '$email', '$password', '$es_administrador')";

		if (mysqli_query($conexion, $sql)) {
			echo "Registro creado correctamente";
			header("Location: ../html/index.php"); // Redirigir al usuario a la página de inicio
			exit; // Salir del script para evitar que se siga ejecutando
		} else {
			echo "Error al crear el registro: " . mysqli_error($conexion);
		}
	}
}

// Cierre de la conexión con la base de datos
mysqli_close($conexion);
?>
