<?php
// Configuración de la base de datos y conexión
$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "proyectointegrado";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Función para limpiar y validar los datos ingresados por el usuario
function limpiarDatos($dato) {
    $dato = trim($dato);
    $dato = stripslashes($dato);
    $dato = htmlspecialchars($dato);
    return $dato;
}

// Procesar la búsqueda cuando se envíe el formulario
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $provincia = limpiarDatos($_GET["provincia"]);
    $ciudad = limpiarDatos($_GET["ciudad"]);

    if (empty($provincia) && empty($ciudad)) {
        echo "Ingresa al menos una provincia o ciudad para buscar.";
    } else {
        $sql = "SELECT * FROM restaurantes WHERE";

        if (!empty($provincia) && !empty($ciudad)) {
            $sql .= " provincia LIKE '%$provincia%' AND ciudad LIKE '%$ciudad%'";
        } elseif (!empty($provincia)) {
            $sql .= " provincia LIKE '%$provincia%'";
        } elseif (!empty($ciudad)) {
            $sql .= " ciudad LIKE '%$ciudad%'";
        }

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <title>Resultados de búsqueda</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            margin-bottom: 20px;
        }
        .restaurante {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #ccc;
        }
        .nombre {
            font-weight: bold;
        }
        .direccion {
            margin-top: 5px;
        }
        .puntuacion {
            margin-top: 5px;
            color: #888;
        }
        .imagen {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Resultados de búsqueda</h1>";

            // Mostrar los resultados en la página resultado_busqueda.html
while ($row = $result->fetch_assoc()) {
    $nombre = htmlspecialchars($row["nombre"]);
    $direccion = htmlspecialchars($row["direccion"]);
    $puntuacion = htmlspecialchars($row["puntuacion"]);
    $web = htmlspecialchars($row["web"]);
    $telefono = htmlspecialchars($row["telefono"]);
    $codigoPostal = htmlspecialchars($row["codigo_postal"]);
    $provincia = htmlspecialchars($row["provincia"]);
    $ciudad = htmlspecialchars($row["ciudad"]);
    $rutaImagen = isset($row["ruta_imagen"]) ? htmlspecialchars($row["ruta_imagen"]) : "no-disponible.jpg";
    $imagenPath = "../upload_image/" . $rutaImagen;
   
/* This code is generating HTML code to display the results of a search for restaurants. It creates a
div with class 'tabla-fila' and 'tabla-grid', and within that div, it creates another div with class
'restaurante'. Inside the 'restaurante' div, it displays the name, address, rating, website, phone
number, postal code, province, city, and image of each restaurant that matches the search criteria.
The variables , , , , , , , ,
and  are used to display the corresponding information for each restaurant. */
    echo "<div class='tabla-grid'>";
    echo "<div class='tabla-fila'>";
    echo "<div class='restaurante'>";
    echo "<div class='nombre'>Nombre: $nombre</div>";
    echo "<div class='direccion'>Dirección: $direccion</div>";
    echo "<div class='puntuacion'>Puntuación: $puntuacion</div>";
    echo "<div class='web'>Web: <a href='$web'>$web</a></div>";
    echo "<div class='telefono'>Teléfono: $telefono</div>";
    echo "<div class='codigo-postal'>Código Postal: $codigoPostal</div>";
    echo "<div class='provincia'>Provincia: $provincia</div>";
    echo "<div class='ciudad'>Ciudad: $ciudad</div>";
    echo "<div class='imagen'><img src='$imagenPath' alt='Imagen del restaurante'></div>";
    echo "</div>"; // cierre del div 'restaurante'
    echo "</div>"; // cierre del div 'tabla-fila'
    echo "</div>"; // cierre del div 'tabla-grid'
}


                    echo "</body>
        </html>";
        
    } else {
        echo "No se encontraron restaurantes.";
    }

    // Liberar memoria
    $result->free_result();
}
}

// Cerrar la conexión a la base de datos
$conn->close();
