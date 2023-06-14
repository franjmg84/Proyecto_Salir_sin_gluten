<?php
// Define los detalles de la base de datos
$host = "127.0.0.1";
$port = 3306;
$socket = "";
$user = "root";
$password = "admin";
$dbname = "proyectointegrado";

// Establece la conexión con la base de datos
$conn = new mysqli($host, $user, $password, $dbname, $port, $socket);

// Verifica si la conexión ha fallado
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>

<?php
// Crea una consulta SQL para seleccionar todos los registros de la tabla "restaurantes"
$sql = "SELECT * FROM restaurantes";

// Ejecuta la consulta SQL
$result = $conn->query($sql);

// Verifica si la consulta SQL devuelve resultados
if ($result->num_rows > 0) {
    // Muestra los datos en una tabla HTML
    /*
    echo "<div class='tabla-restaurantes'>";
    echo "<div class='tabla-fila'>";
    echo "<div class='tabla-columna'><h3>Nombre</h3></div>";
    echo "<div class='tabla-columna'><h3>Dirección</h3></div>";
    echo "<div class='tabla-columna'><h3>Texto</h3></div>";
    echo "<div class='tabla-columna'><h3>Puntuación</h3></div>";
    echo "<div class='tabla-columna'><h3>Web</h3></div>";
    echo "<div class='tabla-columna'><h3>Teléfono</h3></div>";
    echo "<div class='tabla-columna'><h3>Código Postal</h3></div>";
    echo "<div class='tabla-columna'><h3>Provincia</h3></div>";
    echo "<div class='tabla-columna'><h3>Ciudad</h3></div>";
    echo "<div class='tabla-columna'><h3>Imagen</h3></div>";
    echo "</div>";
*/
    // Recorre los resultados de la consulta SQL y muestra los datos en la tabla
    echo "<div class='tabla-grid'>"; // Inicio de la tabla

    while ($row = $result->fetch_assoc()) {
        echo "<div class='tabla-fila'>";
        echo "<div class='tabla-columna'><p class='nombre'>Nombre:   " . $row["nombre"] . "</p></div>";
        echo "<div class='tabla-columna'><p class='nombre'>Direccion:   " . $row["direccion"] . "</p></div>";

        echo "<div class='tabla-columna'><p class='nombre'>Puntuacion:   " . $row["puntuacion"] . "</p></div>";
        echo "<div class='tabla-columna'><p class='nombre'>Web:   <a href='" . $row["web"] . "'>" . $row["web"] . "</a></p></div>";

        echo "<div class='tabla-columna'><p class='nombre'>Teléfono:   " . $row["telefono"] . "</p></div>";
        echo "<div class='tabla-columna'><p class='nombre'>CP:   " . $row["codigo_postal"] . "</p></div>";
        echo "<div class='tabla-columna'><p class='nombre'>Provincia:   " . $row["provincia"] . "</p></div>";
        echo "<div class='tabla-columna'><p class='nombre'>Ciudad:   " . $row["ciudad"] . "</p></div>";

        // Verifica si la clave "ruta_imagen" está definida en el array $row antes de mostrar la imagen
        if (isset($row["ruta_imagen"])) {
            echo "<div class='tabla-columna'><a href='#' onclick='mostrarImagenAmpliada(\"" . $row["ruta_imagen"] . "\")'><img src='" . $row["ruta_imagen"] . "' alt='Imagen' class='imagen-restaurante'></a></div>";
        } else {
            echo "<div class='tabla-columna'>No disponible</div>";
        }
        echo "<div class='tabla-columna'><p class='nombre'>Comentarios:   " . $row["texto"] . "</p></div>";
        echo "</div>";
    }

    echo "</div>";
} else {
    // Muestra un mensaje si la consulta SQL no devuelve resultados
    echo "No se encontraron resultados.";
}

// Cierra la conexión a la base de datos
$conn->close();
?>
