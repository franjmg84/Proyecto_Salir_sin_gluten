<?php
if (isset($_GET['id'])) {
    $idImagen = $_GET['id'];

    // Conexión a la base de datos
    $db_connection = mysqli_connect("localhost", "root", "admin", "proyectointegrado");

    if (!$db_connection) {
        die("Error de conexión a la base de datos: " . mysqli_connect_error());
    }

    // Obtener la información del registro de la imagen que se desea eliminar
    $query = "SELECT id, imagen FROM restaurantes WHERE id = $idImagen";
    // $query = "SELECT id, imagen FROM reseñas WHERE id = $idImagen";
    $result = mysqli_query($db_connection, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            $table_name = "restaurantes";
            $image_column_name = "imagen";
        } else {
            $table_name = "reseñas";
            $image_column_name = "imagen";
        }

        // Eliminar la referencia al registro de la imagen de la tabla correspondiente
        $delete_query = "DELETE FROM $table_name WHERE id = $idImagen";
        $delete_result = mysqli_query($db_connection, $delete_query);

        // Eliminar la imagen del servidor de almacenamiento
        $image_path = $row['imagen'];
        if (file_exists($image_path)) {
            unlink($image_path);
        }

        // Confirmar que la eliminación se ha realizado correctamente
        if ($delete_result && mysqli_affected_rows($db_connection) > 0 && !file_exists($image_path)) {
            echo "La imagen se ha eliminado correctamente.";
        } else {
            echo "No se pudo eliminar la imagen.";
        }
    } else {
        echo "Error al obtener la información del registro de la imagen.";
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($db_connection);

    // Redirigir de nuevo a la página del administrador después de eliminar la imagen
    header("Location: administrador.php");
    exit();
}

?>
