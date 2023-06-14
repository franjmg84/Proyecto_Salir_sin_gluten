<?php
session_start();

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "proyectointegrado";

$conexion = new mysqli($servername, $username, $password, $dbname);

if ($conexion->connect_error) {
    die("Connection failed: " . $conexion->connect_error);
}

// Función para validar el inicio de sesión
function validar_login($email, $password) {
    global $conexion;

    // Evitar inyección de SQL
    $email = $conexion->real_escape_string($email);
    $password = $conexion->real_escape_string($password);

    // Consulta a la tabla "usuario"
    $sql = "SELECT id, nombre, email, es_administrador FROM usuario WHERE email = '$email' AND password = '$password'";
    $result = $conexion->query($sql);

    if ($result->num_rows == 1) {
        // Inicio de sesión válido
        $row = $result->fetch_assoc();
        $_SESSION["id"] = $row["id"];
        $_SESSION["nombre"] = $row["nombre"];
        $_SESSION["email"] = $row["email"];
        $_SESSION["es_administrador"] = $row["es_administrador"];

        if ($row["es_administrador"] == 1) {
            // Si el usuario es administrador, redirigir a la página de administrador
            header("Location: ../html/administrador.php");
            exit(); 
        } else {
            // Si el usuario no es administrador, redirigir a la página normal de usuario
            header("Location: ../html/index.php");
            exit();
        }
    } else {
        // Inicio de sesión inválido
        return false;
    }
}

// Si el usuario ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (validar_login($email, $password)) {
        // Inicio de sesión válido
        $response = array("valid" => true);
        echo json_encode($response);
        exit();
    } else {
        // Inicio de sesión inválido
        $response = array("valid" => false);
        echo json_encode($response);
        exit();
    }
}

// Si el usuario ya está logueado, redirigir a la página principal
if (isset($_SESSION['email'])) {
    header('Location: ../html/index.php');
    exit();
}

// Si hay un error, mostrarlo
if (isset($error)) {
    echo $error;
}

// Mensaje de depuración
echo 'Nombre de usuario: ' . $_SESSION['nombre'] . '<br>';
echo 'Es administrador: ' . $_SESSION['es_administrador'] . '<br>';
?>

?>
