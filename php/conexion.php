<?php
// Configurar los datos de conexión
$host="127.0.0.1";
$port=3306;
$socket="";
$user="root";
$password="admin";
$dbname="proyectointegrado";

// Establecer la conexión con la base de datos
$conexion = new mysqli($host, $user, $password, $dbname, $port, $socket);

// Verificar si la conexión fue exitosa
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Ejecutar una consulta SQL para obtener información de la tabla "restaurantes"
$sql = "SELECT nombre, direccion, texto, puntuacion, web, telefono, fotos, email, codigo_postal, provincia, ciudad FROM restaurantes";
$result = $conexion->query($sql);

// Verificar si la consulta fue exitosa
if ($result->num_rows > 0) {
    // Imprimir los datos obtenidos
    while($row = $result->fetch_assoc()) {
        echo "Nombre: " . $row["nombre"] . "<br>";
        echo "Dirección: " . $row["direccion"] . "<br>";
        echo "Telefono: " .$row["telefono"] . "<br>";
        // y así sucesivamente para los demás campos
    }
} else {
    echo "No se encontraron resultados.";
}

// Cerrar la conexión
$conexion->close();
?>