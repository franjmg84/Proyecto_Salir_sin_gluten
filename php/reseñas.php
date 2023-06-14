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

// Crea una consulta SQL para seleccionar todos los registros de la tabla "restaurantes"
$sql = "SELECT * FROM restaurantes";

// Ejecuta la consulta SQL
$result = $conn->query($sql);

// Verifica si la consulta SQL devuelve resultados
if ($result->num_rows > 0) {
    // Muestra los datos en una tabla HTML
    echo "<div class='tabla-grid'>"; // Inicio de la tabla

    while ($row = $result->fetch_assoc()) {
        echo "<div class='tabla-fila'>";
        echo "<div class='tabla-columna'><p class='nombre'>Nombre:   " . $row["nombre"] . "</p></div>";
        echo "<div class='tabla-columna'><p class='nombre'>Direccion:   " . $row["direccion"] . "</p></div>";
        echo "<div class='tabla-columna'><p class='nombre'>Puntuacion:   " . $row["puntuacion"] . "</p></div>";
        echo "<div class='tabla-columna'><p class='nombre'>Web:   " . $row["web"] . "</p></div>";
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

        echo "</div>";

       // Obtener las reseñas del restaurante
$sql_resenas = "SELECT * FROM reseñas WHERE id_restaurante = " . $row['id'];
$result_resenas = $conn->query($sql_resenas);

if ($result_resenas->num_rows > 0) {
    // Mostrar las reseñas del restaurante
    echo "<div class='tabla-fila'>";
    echo "<div class='tabla-columna' colspan='10'>";
    echo "<h3>Reseñas</h3>";
    while ($row_resena = $result_resenas->fetch_assoc()) {
        echo "<p>" . $row_resena['texto'] . "</p>";
        echo "<p>Puntuación: " . $row_resena['puntuacion'] . "</p>";
        // Mostrar la imagen de la reseña si existe
        if (!empty($row_resena['ruta_imagen'])) {
            echo '<img src="' . $row_resena['ruta_imagen'] . '" alt="Imagen de la reseña" />';
        }
    }
    echo "</div>";
    echo "</div>";
} else {
    echo "<div class='tabla-fila'>";
    echo "<div class='tabla-columna' colspan='10'>";
    echo "<p>No hay reseñas</p>";
    echo "</div>";
    echo "</div>";
}


        echo "</div>"; // Cierre de la tabla-fila
    }

    echo "</div>"; // Cierre de la tabla-grid
} else {
    // Muestra un mensaje si la consulta SQL no devuelve resultados
    echo "<p>No se encontraron resultados.</p>";
}

// Cierra la conexión a la base de datos
$conn->close();
?>